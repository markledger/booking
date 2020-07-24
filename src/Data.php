<?php
namespace App;

class Data
{
    const RULES = [
        'attendees' => [
            'bledger@booking.com',
            'mledger@booking.com',
        ],
        'availability_increments' => [
            'label' => "15 minutes",
            'value' => 15,
        ],
        'available_times' => [
            '2020-08-05' => [
                [
                    'period_end_time' => [
                        'label' => "18:30",
                        'value' => "18:30",
                    ],
                    'period_start_time' => [
                        'label' => "15:30",
                        'value' => "15:30",
                    ],
                ],

                [
                    'period_end_time' => [
                        'label' => "07:30",
                        'value' => "07:30",
                    ],
                    'period_start_time' => [
                        'label' => "14:00",
                        'value' => "14:00",
                    ],
                ],

            ],
        ],
        'cancellation_notice' => [
            'label' => "1 hour",
            'value' => 60,
        ],
        'duration' => 30,
        'end' => 'Thu Aug 06 2020 00:00:00 GMT+0100',
        'start' => 'Wed Aug 05 2020 00:00:00 GMT+0100',
        'exclude_days' => [
            2, //tuesday
        ],
        'interval' => [
            'label' => "15 minutes",
            'value' => 15,
        ],
        'interview_duration_hours' => [
            'label' => "0 hours",
            'value' => 0,
        ],
        'interview_duration_minutes' => [
            'label' => "30 minutes",
            'value' => 30,
        ],
        'max_interviews_per_day' => [
            4,
        ],
        'min_time_before_booking' => [
            'label' => "3 hour",
            'value' => 180,
        ],
    ];

    const CALENDAR = '{"2020-08-05":[{"start_time":"2020-08-05T06:00:00+01:00","end_time":"2020-08-05T09:45:00+01:00","status":"confirmed","start_date":"2020-08-05","duration_minutes":15,"start_minutes":30,"start_hour":9,"created_at":"2020-07-01T07:30:22.000Z","updated_at":"2020-07-01T07:30:46.106Z","created_by":"mledger@booking.com","created_by_name":"","end_date":"2020-08-05"},{"id":"95pmjvfq0ija9vh5nvtqonrblq_20200805T103000Z","calendar":"mledger@booking.com","title":"QA Team Meeting ","location":"","start_time":"2020-08-05T11:30:00+01:00","end_time":"2020-08-05T11:45:00+01:00","status":"confirmed","start_date":"2020-08-05","duration_minutes":15,"start_minutes":30,"start_hour":11,"created_at":"2020-07-06T13:40:06.000Z","updated_at":"2020-07-16T10:59:17.639Z","created_by":"mledger@booking.com","created_by_name":"","end_date":"2020-08-05"},{"id":"38j3p08vsu9duh7c7mhhpepd87_20200805T090000Z","calendar":"bledger@booking.com","title":"Dev meeting","location":"","start_time":"2020-08-05T10:00:00+01:00","end_time":"2020-08-05T11:30:00+01:00","status":"confirmed","start_date":"2020-08-05","duration_minutes":15,"start_minutes":0,"start_hour":10,"created_at":"2020-07-13T09:00:23.000Z","updated_at":"2020-07-20T09:03:27.007Z","created_by":"mledger@booking.com","created_by_name":"","end_date":"2020-08-05"}],"2020-08-06":[{"id":"_60q30c1g60o30e1i60o4ac1g60rj8gpl88rj2c1h84s34h9g60s30c1g60o30c1g8co32ga160pj2e1h6h348dhg64o30c1g60o30c1g60o30c1g60o32c1g60o30c1g64o44chi8opj2gpn6p2j4d9k6cskacpj6sr42g9h71132dpk8p20_20200806T083000Z","calendar":"mledger@booking.com","title":"ATB Daily Standup","location":"Microsoft Teams Meeting","start_time":"2020-08-06T09:30:00+01:00","end_time":"2020-08-06T09:45:00+01:00","status":"confirmed","start_date":"2020-08-06","duration_minutes":15,"start_minutes":30,"start_hour":9,"created_at":"2020-07-01T07:30:22.000Z","updated_at":"2020-07-01T07:30:46.106Z","created_by":"mledger@booking.com","created_by_name":"","end_date":"2020-08-06"},{"id":"95pmjvfq0ija9vh5nvtqonrblq_20200806T103000Z","calendar":"mledger@booking.com","title":"QA Team Meeting ","location":"","start_time":"2020-08-06T11:30:00+01:00","end_time":"2020-08-06T11:45:00+01:00","status":"confirmed","start_date":"2020-08-06","duration_minutes":15,"start_minutes":30,"start_hour":11,"created_at":"2020-07-06T13:40:06.000Z","updated_at":"2020-07-16T10:59:17.639Z","created_by":"mledger@booking.com","created_by_name":"","end_date":"2020-08-06"},{"id":"7po83o9kraot9s7ccfnl7g3e3s_20200806T130000Z","calendar":"mledger@booking.com","title":"GT Internal Project Call","location":"","start_time":"2020-08-06T14:00:00+01:00","end_time":"2020-08-06T15:00:00+01:00","status":"confirmed","start_date":"2020-08-06","duration_minutes":60,"start_minutes":0,"start_hour":14,"created_at":"2020-06-18T11:44:04.000Z","updated_at":"2020-06-18T13:08:18.867Z","created_by":"bledger@booking.com","created_by_name":"","end_date":"2020-08-06"},{"id":"38j3p08vsu9duh7c7mhhpepd87_20200806T090000Z","calendar":"bledger@booking.com","title":"Dev meeting","location":"","start_time":"2020-08-06T10:00:00+01:00","end_time":"2020-08-06T10:15:00+01:00","status":"confirmed","start_date":"2020-08-06","duration_minutes":15,"start_minutes":0,"start_hour":10,"created_at":"2020-07-13T09:00:23.000Z","updated_at":"2020-07-20T09:03:27.007Z","created_by":"mledger@booking.com","created_by_name":"","end_date":"2020-08-06"}]}';
}
