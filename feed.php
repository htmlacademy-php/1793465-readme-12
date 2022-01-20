<?php
require_once('connect.php');
require_once('helpers.php');
require_once('functions.php');

if (!isset($_SESSION['id'])) {
<<<<<<< HEAD
    header('Location: /index.php');
=======
    header('Location: /guest.php');
>>>>>>> f942cc893fa6687ecb90dcadf2ae2192d606e4d5
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
