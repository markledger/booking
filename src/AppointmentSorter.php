<?php
namespace App;

class AppointmentSorter
{

    public function handle(array $data)
    {
        foreach ($data as $date => $events) {
            $data[$date] = $this->sortDates($events);
        }
        return $data;
    }

    private function sortDates($events)
    {

        uasort($events, function ($previousEvent, $currentEvent) {
            return $previousEvent['start'] <=> $currentEvent['start'];

        });

        return $events;
    }
}
