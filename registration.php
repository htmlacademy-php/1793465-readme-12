<?php
require_once('connect.php');
require_once('helpers.php');
require_once('functions.php');

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $form = filter_input_array(INPUT_POST, [
        'email' => FILTER_SANITIZE_EMAIL,
        'login' => FILTER_SANITIZE_SPECIAL_CHARS,
        'password' => FILTER_SANITIZE_SPECIAL_CHARS,
        'password-repeat' => FILTER_SANITIZE_SPECIAL_CHARS
    ]);

    $required_fields = ['email', 'login', 'password','password-repeat'];

    foreach ($required_fields as $field) {
        if (empty($form[$field])) {
            $errors[$field] = 'Поле не заполнено';
        }
    }

    if (!is_uploaded_file($_FILES['userpic-file']['tmp_name']))  {
        $errors['userpic-file'] = 'Необходимо добавить аватар';
    } else {
        $rules['userpic-file'] = function($value) {
            return validateTypePictures($value);
        };
    }

    if ($form['password'] !== $form['password-repeat']) {
        $errors['passwordRepeatError'] = 'Пароли не совпадают';
        $errors['password-repeatError'] = 'Пароли не совпадают';
    }

    if (empty($errors)) {
        $email = mysqli_real_escape_string($con, $form['email']);
        $sql = "SELECT id FROM users WHERE email = '$email'";
        $res = mysqli_query($con, $sql);

        if (mysqli_num_rows($res) > 0) {
            $errors['email'] = 'Пользователь с этим email уже зарегистрирован';
        } else {

            $password = password_hash($form['password'], PASSWORD_DEFAULT);
            $userpic = $_FILES['userpic-file']['name'] . '_' . time();
            $file_path = __DIR__ . '/img/';
            move_uploaded_file($_FILES['userpic-file']['tmp_name'], $file_path . $userpic);

            $sql = 'INSERT INTO users (reg_date, email, login, password, avatar_link) VALUES (NOW(), ?, ?, ?, ?)';
            $stmt = db_get_prepare_stmt($con, $sql, [$form['email'], $form['login'], $password, $userpic ]);
            $res = mysqli_stmt_execute($stmt);
        }

        if ($res && empty($errors)) {
            header('Location: /index.php');
            exit();
        }
    }
}

$add_block = include_template(
    'registration.php',
    [
        'errors' => $errors
    ]);

$layout_block = include_template(
    'layout.php',
    [
        'content' => $add_block,
        'title' => 'Readme | Регистрация'
    ]);

print($layout_block);
