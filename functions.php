<?php
/**
 * функция, возвращающая время относительно даты публикации
 *
 * @param string $str_date дата публикации
 *
 * @return string строку с относительной датой и верным склонением
 */
function get_post_date (string $str_date): string
{
    date_default_timezone_set("Europe/Moscow");
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

/**
 * функция принудительного ограничения текста
 *
 * @param string $text строка с текстом поста
 * @param integer $num_letters число символов, до которых надо обрезать текст
 *
 * @return string обрезанный текст с ссылкой на продолжение
 */
function get_text_content(string $text, int $num_letters = 300) : string
{
    $text_length = mb_strlen($text);

    if ($text_length > $num_letters) {
        $words = explode(' ', $text);
        $result_words_length = 0;
        $result_words = [];

        foreach ($words as $word) {
            $result_words_length += mb_strlen($word);

            if ($result_words_length > $num_letters) {
                break;
            }

            $result_words_length += 1;
            $result_words[] = $word;
        }

        $result = implode(' ', $result_words);

        $result .= '...';
        $result = '<p>' . $result . '</p>';
        $result .= '<a class="post-text__more-link" href="#">Читать далее</a>';
    } else {
        $result = '<p>' . $text . '</p>';
    }

    return $result;
}
