<?php
require_once 'vendor/autoload.php';
use App\AppointmentFormatter;
use App\AppointmentMachine;
use App\AppointmentReducer;
use App\AppointmentSorter;
use App\CalendarFreeTimeCalculator;
use App\Data;
use App\DetermineAppointmentOverlap;

function dd($data)
{
    print '<pre>';
    var_dump($data);
    die;
}

$calendarData = json_decode(Data::CALENDAR, 1);

$data = (new AppointmentFormatter())->handle($calendarData);
$data = (new AppointmentSorter())->handle($data);
$data = (new AppointmentReducer())->handle($data);
$freeTimeInCalendars = (new CalendarFreeTimeCalculator())->handle($data);

$rules = [
    'data' => [
        'exclude_days' => [
            2, //tue
        ],
        'max_interviews_per_day' => [
            4,
        ],
        'min_time_before_booking' => [
            'label' => "3 hour",
            'value' => 180,
        ],
        'start_time_buffer' => 120, //mins
        'interview_duration_hours' => [
            'label' => "0 hours",
            'value' => 60,
        ],
        'interview_duration_minutes' => [
            'label' => "30 minutes",
            'value' => 0,
        ],
        'interval' => [
            'label' => "30 minutes",
            'value' => 30,
        ],
        'availability_increments' => [
            'label' => "15 minutes",
            'value' => 15,
        ],
        'available_times' => [
            '2020-08-05' => [
                [
                    'period_end_time' => [
                        'label' => "17:00",
                        'value' => "17:00",
                    ],
                    'period_start_time' => [
                        'label' => "14:00",
                        'value' => "14:00",
                    ],
                ],

                [
                    'period_end_time' => [
                        'label' => "09:00",
                        'value' => "09:00",
                    ],
                    'period_start_time' => [
                        'label' => "11:00",
                        'value' => "11:00",
                    ],
                ],

            ],
        ],
    ],
];

$appointmentsThatFitCalendars = (new AppointmentMachine())->handle($freeTimeInCalendars, $rules);
$appointmentsThatFitAvailabilityRules = (new DetermineAppointmentOverlap())->handle($rules['data']['available_times'], $appointmentsThatFitCalendars);
dd($appointmentsThatFitAvailabilityRules);
