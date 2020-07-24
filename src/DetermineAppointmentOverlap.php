<?php
namespace App;

use Carbon\Carbon;

class DetermineAppointmentOverlap
{

    public function handle($availability, $appointmentsThatFitCalendars)
    {

        $apptsFitCals = $this->keyByDate($appointmentsThatFitCalendars);
        $appointmentsToOfferCandidate = [];
        foreach ($availability as $date => $availablePeriods) {
            foreach ($availablePeriods as $p) {
                foreach ($apptsFitCals as $dateKey => $daysAppts) {
                    if ($dateKey !== $date) {
                        continue;
                    }
                    $pStart = Carbon::parse($dateKey . ' ' . $p['period_start_time']['value']);
                    $pEnd = Carbon::parse($dateKey . ' ' . $p['period_end_time']['value']);

                    foreach ($daysAppts as $a) {
                        // if ($p['start'] <= $a['end'] && $p['end'] >= $a['start']) {
                        if ($pStart <= $a['start'] && $pEnd >= $a['end']) {
                            $appointmentsToOfferCandidate[] = $a;
                        }
                    }

                }
            }
        }

        return $appointmentsToOfferCandidate;

    }

    private function keyByDate($appointments)
    {
        $keyedByDate = [];
        foreach ($appointments as $appointment) {
            $date = $appointment['start']->format('Y-m-d');

            $keyedByDate[$date][] = $appointment;
        }

        ksort($keyedByDate);
        return $keyedByDate;

    }
}
