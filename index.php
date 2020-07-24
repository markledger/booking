<?php
require_once 'vendor/autoload.php';
use App\AppointmentFormatter;
use App\AppointmentMachine;
use App\AppointmentReducer;
use App\AppointmentSorter;
use App\CalendarFreeTimeCalculator;
use App\Data;
use Carbon\Carbon;

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
        'start_time_buffer' => 120, //mins
        'duration' => 60, //mins
        'interval' => 15, //mins
        'start_increment' => 15,
        'availability' => [
            '2020-08-05' => [
                [
                    'start' => Carbon::parse('2020-08-05 09:00'),
                    'end' => Carbon::parse('2020-08-05 11:00'),
                ],
                [
                    'start' => Carbon::parse('2020-08-05 14:00'),
                    'end' => Carbon::parse('2020-08-05 17:00'),
                ],

            ],
            '2020-08-06' => [
                [
                    'start' => Carbon::parse('2020-08-06 09:00'),
                    'end' => Carbon::parse('2020-08-06 15:00'),
                ],
                [
                    'start' => Carbon::parse('2020-08-06 15:30'),
                    'end' => Carbon::parse('2020-08-06 17:00'),
                ],

            ],
            '2020-07-24' => [
                [
                    'start' => Carbon::parse('2020-07-24 07:00'),
                    'end' => Carbon::parse('2020-07-24 10:00'),
                ],
                [
                    'start' => Carbon::parse('2020-07-24 11:30'),
                    'end' => Carbon::parse('2020-07-24 12:00'),
                ],
                [
                    'start' => Carbon::parse('2020-07-24 12:45:00'),
                    'end' => Carbon::parse('2020-07-24 15:00'),
                ],
                [
                    'start' => Carbon::parse('2020-07-24 15:30'),
                    'end' => Carbon::parse('2020-07-24 18:00'),
                ],

            ],
        ],
    ],
];

$rules['data']['availability'] = $freeTimeInCalendars; //CODE ALL CORRET TO HERE

$appointmentsThatFitCalendars = (new AppointmentMachine())->handle($freeTimeInCalendars, $rules);
/*
I have the free times available in calendars (however, this is assumed that I have filtered out non essential
attendees)  $freeTimeInCalendars

This also does not yet account for interviews that may have been booked into a recruiters calendar who is
allowed to be double booked.... do we care? After all, they'vebeen seleted to be 'not required/ double booked

Next steps:
generate the appointments that fit into the $freeTimeCAlendars using the code in appointment

 */

dd($appointmentsThatFitCalendars);
//BOOKED TIME  (CORRECT)
//  2020-08-05
// 6 -> 9.45
// 10->11.30
// 11.30->11.45

// //  2020-08-06
// 9.30->9.45
// 10->10.15
// 11.30 ->11.45
// 14->15

//REDUCED BUSY TIME IN CALENDARS   (CORRECT)
//  2020-08-05(CORRECT)
// 6 -> 9.45
// 10->11.45

// //  2020-08-06(CORRECT)
// 9.30->9.45
// 10->10.15
// 11.30 ->11.45
// 14->15

//  FREE SLOTS  $freeTimeInCalendars
//  2020-08-05(CORRECT)
//  9.45-> 10
//  11:45 -> 19:00

//  2020-08-06   (CORRECT)
// 7.00 -> 9.30
// 9.45 -> 10
// 10.15 -> 11.30
// 11.45 ->14
// 15 -> 19
//

dd($appointmentsThatFitCalendars);
