<?php

function licejus_lt_month_genitive($month)
{
    $months = [
        1  => 'sausio',
        2  => 'vasario',
        3  => 'kovo',
        4  => 'balandžio',
        5  => 'gegužės',
        6  => 'birželio',
        7  => 'liepos',
        8  => 'rugpjūčio',
        9  => 'rugsėjo',
        10 => 'spalio',
        11 => 'lapkričio',
        12 => 'gruodžio',
    ];
    $month = (int) $month;
    return $months[$month] ?? '';
}

function licejus_lt_weekday($weekday_index)
{
    $weekdays = [
        1 => 'Pirmadienis',
        2 => 'Antradienis',
        3 => 'Trečiadienis',
        4 => 'Ketvirtadienis',
        5 => 'Penktadienis',
        6 => 'Šeštadienis',
        7 => 'Sekmadienis',
    ];
    return $weekdays[(int) $weekday_index] ?? '';
}
