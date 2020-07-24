<?php

namespace App;

use Carbon\Carbon;

class AppointmentMachine
{

    public function handle(array $data, $rules)
    {
        $now = Carbon::now();
        foreach ($rules['data']['availability'] as $date => $availability_slots) {

            foreach ($availability_slots as $slot) {

                $start = $slot['start_free'];
                if ($start->isPast()) {
                    continue;
                }
                $end = $slot['end_free'];
                $duration = $rules['data']['duration'];
                $interval = $rules['data']['interval'];
                $start_increment = $rules['data']['start_increment'];
                $noSpaceForInterview = $start->diffInMinutes($end) < ($duration + $interval);
                if ($noSpaceForInterview) {
                    continue;
                }

                //5am  240
                //6am  180
                //7am  120
                //7.01  119 -> should increment start time by 1 min
                //take buffer before earliest booking time into account
                if ($now < $start && $now->diffInMinutes($start) < $rules['data']['start_time_buffer']) {
                    //current time falls inside the buffer zone
                    $start = clone $now;
                    //add the difference between now and buffer on to the earliest start time
                    //to move the start time to the next closest time an appt can be booked.
                    $start->add($rules['data']['start_time_buffer'], 'minutes'); //move the earliest start time
                }

                // did we set a specific minutes past the hour increment rule?

                while ($start < $end) {
                    $this->handleIncrement($start_increment, $start);
                    $apptStart = clone $start;
                    $apptEnd = clone $start;
                    $appts[] = ['start' => $apptStart, 'end' => $apptEnd->add($duration, 'minutes')];
                    $start->add($duration + $interval, 'minutes');

                }
            }
        }

        return $appts;

    }

    private function handleIncrement($start_increment, $start)
    {
        if (!is_null($start_increment)) {
            $currentHourIncrementHasPassed = !is_null($start_increment) && $start->format('i') > $start_increment;
            if ($currentHourIncrementHasPassed) {
                $start->add(1, 'hour')->minutes($start_increment);
            } else {
                $start->minutes($start_increment);
            }

        }

    }
}

// $appts = [];

// 09:00 - 09:30
// 09:45 - 10:15
// 10:30 - 11:00

// $now  = Carbon::parse('2020-08-05 07:16');

// print "<h1>Available appointments</h1><p>Before taking into account the calendar availability</p>";
// print "<p>For that I need to merge all calendar appointments and overlay them on this rules array</p>";
//
//https://stackoverflow.com/questions/19277348/how-to-calculate-free-available-time-based-on-array-values

// This one shows how to determine which appointments overlap so I can use that to either lazily filter
// out the results of this $appts array
// or overlay calendar results on the availabilty in rules to further restrict the rules['availability']
//https://stackoverflow.com/questions/325933/determine-whether-two-date-ranges-overlap
// https://www.soliantconsulting.com/blog/determining-two-date-ranges-overlap/
