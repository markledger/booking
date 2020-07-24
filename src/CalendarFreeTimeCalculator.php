<?php
namespace App;

use Carbon\Carbon;

class CalendarFreeTimeCalculator
{

    public function handle(array $data)
    {
        $meeting = [];
        foreach ($data as $busyPeriod) {
            foreach ($busyPeriod as $period) {
                $meeting[] = $period;
            }
        }

        $min = "07:00:00";
        $max = "19:00:00";
        $start = "2030-01-01 00:00:00";
        $end = "2000-01-01 00:00:00";
        $free = [['start' => "2000-01-01 00:00:00", 'end' => "2030-01-01 00:00:00"]];
        foreach ($meeting as $m) {
            foreach ($free as $k => $f) {
                if ($m['start'] > $f['start'] && $m['start'] <= $f['end']) {
                    $free[$k]['end'] = $m['start'];
                    if ($m['end'] < $f['end']) {
                        $free[] = ['start' => $m['end'], 'end' => $f['end']];
                    }

                } elseif ($m['end'] < $f['end'] && $m['end'] > $f['start']) {
                    $free[$k]['start'] = $m['end'];
                }
            }
            $start = min($start, $m['start']);
            $end = max($end, $m['end']);
        }

        $begin = new \DateTime($start);
        $end = new \DateTime($end);

        $interval = \DateInterval::createFromDateString('1 day');
        $period = new \DatePeriod($begin, $interval, $end);

        $freeTime = [];

        foreach ($period as $dt) {
            $m = [
                'start' => date('Y-m-d ', strtotime($dt->format('Y-m-d') . ' -1 day')) . $max,
                'end' => $dt->format('Y-m-d ') . $min,
            ];

            foreach ($free as $k => $f) {
                if ($m['start'] > $f['start'] && $m['start'] <= $f['end']) {
                    $free[$k]['end'] = $m['start'];
                    if ($m['end'] < $f['end']) {
                        $free[] = ['start' => $m['end'], 'end' => $f['end']];
                    }

                } elseif ($m['end'] < $f['end'] && $m['end'] > $f['start']) {
                    $free[$k]['start'] = $m['end'];
                }
            }
        }
        foreach ($free as $k => $f) {
            $s = explode(" ", $f['start']);
            $e = explode(" ", $f['end']);
            if ($s[0] == $e[0]) {
                $freeTime[$s[0]][] = ['start_free' => Carbon::parse($s[0] . ' ' . $s[1]), 'end_free' => Carbon::parse($s[0] . ' ' . $e[1])];
            }
        }

        return $freeTime;
    }
}
