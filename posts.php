<?php
require_once ('connect.php');
require_once('helpers.php');
require_once ('functions.php');

if (!isset($_SESSION['id'])) {
    header('Location: /guest.php');
    exit();
}

$user_name = $_SESSION['login']; // укажите здесь ваше имя

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

$main_block = include_template('post.php', ['post_active' => $post_active]);
$layout_block = include_template('layout.php', ['content' => $main_block, 'user_name' => $user_name, 'title' => 'readme: пост']);
print($layout_block);
