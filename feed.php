<?php
require_once('connect.php');
require_once('helpers.php');
require_once('functions.php');

if (!isset($_SESSION['id'])) {
    header('Location: /index.php');
    exit();
}

$user_name = $_SESSION['login']; // укажите здесь ваше имя
$title = 'readme: Моя лента';

$main_block = include_template('feed.php');
$layout_block = include_template(
    'layout.php',
    [
        'content' => $main_block,
        'user_name' => $user_name,
        'title' => $title
    ]
);
print($layout_block);
