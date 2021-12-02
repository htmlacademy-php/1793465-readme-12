<?php
require_once ('connect.php');
require_once('helpers.php');
require_once ('functions.php');

$is_auth = rand(0, 1);
$user_name = 'Ромaн'; // укажите здесь ваше имя

if (isset($_GET['active_post'])) {
    $active_tab = $_GET['active_post'];
    $post_sql = "SELECT * FROM `posts` JOIN users ON user_id = users.id WHERE posts.id = '$active_tab'";
    $result_post = mysqli_query($con, $post_sql);
    $post_active = mysqli_fetch_assoc($result_post);
    if (!$post_active) {
        header("HTTP/1.0 404 Not Found");
        exit;
    }
}

/*
"SELECT posts.id AS post_id, pub_date_post, title, text,
    text_quote, author_quote, image_link, video_link, site_link, views, user_id,
    content_type_id, hashtag_id, users.id AS users_id, reg_date, email, login, avatar_link
    FROM posts JOIN users ON user_id = users.id
    WHERE posts.id = '$active_tab'";
*/





$main_block = include_template('post.php', ['post_active' => $post_active]);
$layout_block = include_template('layout.php', ['content' => $main_block, 'is_auth' => $is_auth, 'user_name' => $user_name, 'title' => 'readme: пост']);
print($layout_block);
