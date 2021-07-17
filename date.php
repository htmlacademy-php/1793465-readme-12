<?php
date_default_timezone_set("Europe/Moscow");

function get_post_date ($str_date) {
    $date = strtotime($str_date);
    $current_date = time();
    $diff_date = $current_date - $date;
    $diff_minute = floor($diff_date / 60);
    $diff_hours = floor($diff_minute / 60);
    $diff_days = floor($diff_hours / 24);
    $diff_week = floor($diff_days / 7);
    $diff_month = floor($diff_days / 30);

    switch (true) {
        case ($diff_minute < 60):
            $plural_form = get_noun_plural_form($diff_minute, 'минута', 'минуты', 'минут');
            return $diff_minute . ' ' . $plural_form . ' назад';

        case ($diff_hours < 24):
            $plural_form = get_noun_plural_form($diff_hours, 'час', 'часа', 'часов');
            return $diff_hours . ' ' . $plural_form . ' назад';

        case ($diff_days < 7):
            $plural_form = get_noun_plural_form($diff_days, 'день', 'дней', 'дня');
            return $diff_days . ' ' . $plural_form . ' назад';

        case ($diff_week < 5):
            $plural_form = get_noun_plural_form($diff_week, 'неделя', 'недели', 'недель');
            return $diff_week . ' ' . $plural_form . ' назад';

        case ($diff_week >= 5):
            $plural_form = get_noun_plural_form($diff_month, 'месяц', 'месяца', 'месяцев');
            return $diff_month . ' ' . $plural_form . ' назад';
    }
}
