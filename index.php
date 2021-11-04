<?php /** @noinspection PhpUndefinedVariableInspection */
require_once ('connect.php');
require_once('helpers.php');
require_once ('functions.php');

$is_auth = rand(0, 1);
$user_name = 'Ромaн'; // укажите здесь ваше имя


/* SQL-запрос для получения типов контента */
$content_type = "SELECT * FROM `content_type`";
$result_content_type = mysqli_query($con, $content_type);
$content_type_arr = mysqli_fetch_all($result_content_type, MYSQLI_ASSOC);

// запрос на показ девяти самых популярных постов
$posts_sql = 'SELECT posts.id AS post_id, pub_date_post, title, text,
text_quote, author_quote, image_link, video_link, site_link, views, user_id,
content_type_id, hashtag_id, users.id AS users_id, reg_date, email, login, avatar_link, content_type.id AS cont_id, type_name, class_name
FROM posts
JOIN users ON user_id = users.id
JOIN content_type ON content_type_id = content_type.id ORDER BY views DESC';
$result_posts = mysqli_query($con, $posts_sql);

if (isset($_GET['post_list'])) {
    $active_tab = $_GET['post_list'];
    $sql = show_tasks_by_date($active_tab);
    $result_posts = mysqli_query($con, $sql);
}

$posts_arr = mysqli_fetch_all($result_posts, MYSQLI_ASSOC);

$main_block = include_template('main.php', ['posts_arr' => $posts_arr, 'content_type_arr' =>  $content_type_arr]);
$layout_block = include_template('layout.php', ['content' => $main_block, 'is_auth' => $is_auth, 'user_name' => $user_name, 'title' => 'readme: популярное']);
print($layout_block);
?>
