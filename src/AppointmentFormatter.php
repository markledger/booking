<?php

namespace App;

use Carbon\Carbon;
use Carbon\CarbonPeriod;

class AppointmentFormatter
{

    public function handle(array $data)
    {
        $earliestStart = '07:00';
        $startDate = '2020-08-03'; //request()->start_date ? request()->start_date : '2020-08-03';
        $endDate = '2020-08-13'; //request()->end_date ? Carbon::parse(request()->end_date)->addDays(2)->format('Y-m-d') : '2020-08-10';
        $period = CarbonPeriod::create($startDate, $endDate);

        foreach ($period as $date) {
            $dateKey = $date->format('Y-m-d');
            if (!array_key_exists($dateKey, $data)) {
                $data[$dateKey][] = [
                    'start_time' => $dateKey,
                    'end_time' => $dateKey,
                ];
            }
        }

        $formatData = [];
        foreach ($data as $date => $events) {
            foreach ($events as $event) {

                $start = Carbon::parse($event['start_time']);
                $formatData[$date][] = [
                    'start' => $start,
                    'end' => Carbon::parse($event['end_time']),
                ];
            }
        }

        return $formatData;
    }
}
