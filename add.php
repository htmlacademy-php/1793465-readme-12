<?php
require_once ('connect.php');
require_once('helpers.php');
require_once ('functions.php');

$is_auth = rand(0, 1);
$user_name = 'Ромaн'; // укажите здесь ваше имя

/* SQL-запрос для получения типов контента */
$content_type = "SELECT * FROM `content_type`";
$result_content_type = mysqli_query($con, $content_type);
$content_type_arr = mysqli_fetch_all($result_content_type, MYSQLI_ASSOC);



/*function show_post_id($post_add_id)
{
    $typesMapId = [
        'text' => 1,
        'quote' => 2,
        'photo' => 3,
        'video' => 4,
        'link' => 5
    ];


} */

function validateFilled($name)
{
    if (empty($_POST[$name])) {
        return 'Это поле должно быть заполнено';
    }
}

$errors = [];
$rules = [
    'title' => function () {
        return validateFilled('title');
    }
];

$form = $_POST;

if (isset($_POST['task-btn'])) {
    foreach ($_POST as $key => $value) {
        if (isset($rules[$key])) {
            $rule = $rules[$key];
            $errors[$key] = $rule();
        }
    }
    $errors = array_filter($errors);

    //var_dump($errors);


    if (!count($errors)) {
        $title = filter_var(trim($_POST['title']), FILTER_SANITIZE_STRING);
        $text = NULL;
        if ($_POST['text']) {
            $text = $_POST['text'];
        }
        $text_quote = NULL;
        if ($_POST['text_quote']) {
            $text = $_POST['text_quote'];
        }
        $author_quote = NULL;
        if ($_POST['author_quote']) {
            $text = $_POST['author_quote'];
        }
        $image_link = NULL;
        if ($_POST['image_link']) {
            $text = $_POST['image_link'];
        }
        $video_link = NULL;
        if ($_POST['video_link']) {
            $text = $_POST['video_link'];
        }
        $site_link = NULL;
        if ($_POST['site_link']) {
            $text = $_POST['site_link'];
        }
        $views = 0;
        $user_id = $is_auth;
        $content_type_id =


        $filename = NULL;
        if (isset($_FILES['link']) && !empty($_FILES['link']['name'])) {
            $filename = $_FILES['link']['name'] . '_' . time();
            $file_path = __DIR__ . '/uploads/';
            move_uploaded_file($_FILES['link']['tmp_name'], $file_path . $filename);
        }
        $sql = "INSERT INTO `posts`
        (`title`, `text`, `text_quote`, `author_quote`, `image_link`, `video_link`, `site_link`, `views`, `user_id`, `content_type_id`, `hashtag_id`)
        VALUES  (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = db_get_prepare_stmt($con, $sql,
        [$title, $text, $text_quote, $author_quote, $image_link, $video_link, $site_link, $views, $user_id, $content_type_id, $hashtag_id]);
        $result = mysqli_stmt_execute($stmt);
        if ($result) {
            header("Location: /posts.php?active_post=$id_project");
        }
    }
}

$main_block = include_template('add.php', ['content_type_arr' =>  $content_type_arr]);
$layout_block = include_template('layout.php', [
    'content' => $main_block,
    'is_auth' => $is_auth,
    'user_name' => $user_name,
    'title' => 'readme: добавить публикацию']);
print($layout_block);
