<?php
require_once ('connect.php');
require_once('helpers.php');
require_once ('functions.php');

if (isset($_SESSION['id'])) {
    header('Location: /feed.php');
    exit();
}

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $form = filter_input_array(INPUT_POST, [
        'email' => FILTER_SANITIZE_EMAIL,
        'password' => FILTER_SANITIZE_SPECIAL_CHARS
    ]);

    $required_fields = ['email', 'password'];

    foreach ($required_fields as $field) {
        if (empty($form[$field])) {
            switch ($field) {
                case 'email':
                    $errors['email'] = 'Поле электронная почта не заполнено';
                    break;
                case 'password':
                    $errors['password'] = 'Поле пароль не заполнено';
                    break;
                default:
                    break;
            }
        }
    }

    $email = mysqli_real_escape_string($con, $form['email']);
    $sql = "SELECT * FROM users WHERE email = '$email'";
    $res = mysqli_query($con, $sql);
    $user = $res ? mysqli_fetch_array($res, MYSQLI_ASSOC) : null;

    if (empty($errors)) {
        if (!mysqli_num_rows($res)) {
            $errors['email'] = 'Пользователь с такой почтой не зарегистрирован';
        } elseif (!password_verify($form['password'], $user['password']))  {
              {
                $errors['password'] = 'Пароли не совпадают';
            }
        }


    }

    if (empty($errors)) {
        $_SESSION['id'] = $user['id'];
        $_SESSION['login'] = $user['login'];
        $_SESSION['avatar_link'] = $user['avatar_link'];

        header('Location: /feed.php');
        exit();
    }
}

$layout_block = include_template('guest.php', ['errors' => $errors]);
print($layout_block);

