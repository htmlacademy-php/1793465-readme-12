<?php /** @noinspection PhpUndefinedVariableInspection */
require_once ('connect.php');
require_once('helpers.php');
require_once ('functions.php');

if (!isset($_SESSION['id'])) {
<<<<<<< HEAD
    header('Location: /index.php');
=======
    header('Location: /guest.php');
>>>>>>> f942cc893fa6687ecb90dcadf2ae2192d606e4d5
    exit();
}

$user_name = $_SESSION['login']; // укажите здесь ваше имя
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
        'user_name' => $user_name,
        'title' => $title
    ]
);
print($layout_block);
