<?php

namespace App;

class AppointmentReducer
{

    public function handle(array $data)
    {
        foreach ($data as $date => $events) {
            $data[$date] = array_reduce($events, [$this, 'reducer'], []);
        }
        return $data;
    }

    private function reducer($accumulator, $current)
    {
        $last = isset($accumulator[count($accumulator) - 1]) ? $accumulator[count($accumulator) - 1] : [];

        if ($last['start'] <= $current['start'] && $current['start'] <= $last['end']) {
            if ($last['end'] < $current['end']) {
                $last['end'] = $current['end'];
            }
            $accumulator[count($accumulator) - 1]['end'] = $current['end'];
            return $accumulator;
        }
        $accumulator[] = $current;
        return $accumulator;
    }
}
