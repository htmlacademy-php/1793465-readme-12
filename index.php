<?php /** @noinspection PhpUndefinedVariableInspection */
require_once ('connect.php');
require_once('helpers.php');
require_once ('functions.php');

$is_auth = rand(0, 1);
$user_name = 'Ромaн'; // укажите здесь ваше имя
$title = 'readme: популярное';


/* SQL-запрос для получения типов контента */
$content_type_arr = getContentTypes($con);

// запрос на показ девяти самых популярных постов ??? почему только девяти, вроде ограничения на количество в запросе нет

// получаем значение из GET параметра через фильтрацию потому, что она не вызывает ошибки в случае отсутствия ключа
// а записывает null, плюс мы сразу фильтруем значение по нужному нам признаку
$typeId = filter_input(INPUT_GET, 'type_id', FILTER_VALIDATE_INT) ?? 0;
$posts_arr = getTasksDataByType($con, $typeId);

$main_block = include_template(
    'main.php',
    [
        'posts_arr' => $posts_arr,
        'content_type_arr' =>  $content_type_arr,
        'type_id' => $typeId
    ]
);
$layout_block = include_template(
    'layout.php',
    [
        'content' => $main_block,
        'is_auth' => $is_auth,
        'user_name' => $user_name,
        'title' => $title
    ]
);
print($layout_block);
