<?php
/**
 * функция, возвращающая время относительно даты публикации
 *
 * @param string $str_date дата публикации
 *
 * @return string строку с относительной датой и верным склонением
 */
function get_post_date(string $str_date): string
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
function get_text_content(string $text, int $num_letters = 300): string
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

/**
 * функция вывода постов по категориям
 *
 * @param int $typeId имя категории из массива GET
 *
 * @return array строка запроса в MySql
 */
function getTasksDataByType($con, $typeId)
{
    // переименовал название функции для лучшего понимания, что мы тут делаем

    // вынес запрос в отдельную переменную, что бы лучше читалось и понимать алгоритм действий в функции
    $query = 'SELECT posts.id AS post_id, pub_date_post, title, text,
            text_quote, author_quote, image_link, video_link, site_link, views, user_id,
            content_type_id, hashtag_id, users.id AS users_id,
            reg_date, email, login, avatar_link, content_type.id AS cont_id, type_name, class_name
        FROM posts
        JOIN users ON posts.user_id = users.id
        JOIN content_type ON posts.content_type_id = content_type.id';

    // отделил подстановку в запрос дополнительного условия чтобы не дублировать весь запрос
    if ($typeId) {
        $query .= ' AND content_type_id = ' . $typeId;
    }

    $query .= ' ORDER BY posts.views DESC';

    // перенёс методы запросов и разбора ответа БД в саму функцию чтобы не путаться в файле где мы её вызываем
    // и был чище код
    $queryResult = mysqli_query($con, $query);

    return mysqli_fetch_all($queryResult, MYSQLI_ASSOC);
}

/**
 * функция для проверки заполненности поля формы
 *
 * @param string $name имя поля формы
 *
 * @return string текст ошибки
 */
function validateFilled($name)
{
    if (empty($name)) {
        return 'Это поле должно быть заполнено';
    }
}

/**
 * функция для проверки заполненности поля формы
 *
 * @param string $name имя поля формы
 *
 * @return string текст ошибки
 */
function validateImage($name)
{
    if (empty($form[$name])) {
        return 'Необходимо выбрать файл изображения со своего компьютера, либо указать прямую ссылку на изображение, размещенное в интернете';
    }
}

/**
 * Функция получения значений из POST запроса
 *
 * @param string $name input[name] из которого необходимо получить значение
 *
 * @return string Возвращает строку введенную пользователем, если форма отправленна с ошибкой.
 */
function getPostVal($name)
{
    return $_POST[$name] ?? '';
}

/**
 * функция для проверки заполненности поля формы
 *
 * @param string $value имя поля формы
 *
 * @return string текст ошибки
 */
function validateYoutube($value)
{
    if (empty($value)) {
        return 'Ссылка на YouTube. Это поле должно быть заполнено';
    } else {
        return check_youtube_url($value);
    }
}

/**
 * функция для проверки заполненности поля формы
 *
 * @param string $value имя поля формы
 *
 * @return string текст ошибки
 */
function validateTypePictures($value)
{
    $mimeType = [
        'image/png',
        'image/jpeg',
        'image/gif',
        'image/jpg'
    ];

    if (!in_array($value, $mimeType)) {
        return 'Загруженный файл должен быть формата png, jpeg, gif';
    }

    return '';
}

function validateWebPictures($value)
{
    if (!filter_var($value, FILTER_VALIDATE_URL)) {
        $result = 'Неверная ссылка';
    } elseif (!file_get_contents($value)) {
        $result = 'По данной ссылке изображение недоступно';
    } else {
        $type = 'image/' . pathinfo($value, PATHINFO_EXTENSION);
        $result = validateTypePictures($type);
    }

    return $result;
}

/**
 * @param mysqli $con
 * @return array
 */
function getContentTypes($con)
{
    // вынес запрос для упрощения кода в месте где нам необходимо вызывать эти запросы
    // плюс мы теперь можем во всех местах вызывать только одну функцию не расписывая каждый раз как мы получаем данные
    $query = 'SELECT * FROM `content_type`';
    $queryResult = mysqli_query($con, $query);

    return mysqli_fetch_all($queryResult, MYSQLI_ASSOC);
}
