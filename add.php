<?php
require_once('connect.php');
require_once('helpers.php');
require_once('functions.php');

$is_auth = 1;
$user_name = 'Ромaн'; // укажите здесь ваше имя

/* SQL-запрос для получения типов контента */
$content_type = "SELECT * FROM `content_type`";
$result_content_type = mysqli_query($con, $content_type);
$content_type_arr = mysqli_fetch_all($result_content_type, MYSQLI_ASSOC);

$postTypeID = filter_input(INPUT_GET, 'postTypeID', FILTER_SANITIZE_NUMBER_INT) ?? 1;

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $postTypeID = filter_input(INPUT_POST, 'postTypeID', FILTER_SANITIZE_NUMBER_INT) ?? $postTypeID;

    $form = filter_input_array(INPUT_POST, [
        'title' => FILTER_SANITIZE_STRING,
        'text' => FILTER_SANITIZE_SPECIAL_CHARS,
        'text_quote' => FILTER_SANITIZE_SPECIAL_CHARS,
        'author_quote' => FILTER_SANITIZE_SPECIAL_CHARS,
        'image_link_web' => FILTER_SANITIZE_URL,
        'video_link' => FILTER_SANITIZE_URL,
        'site_link' => FILTER_SANITIZE_URL,
        'hashtag' => FILTER_SANITIZE_SPECIAL_CHARS
    ]);
    $form['image_link'] = NULL;

    $rules = [
        'title' => function($value) {
            return validateFilled($value);
        },
        'hashtag' => function($value) {
            return validateFilled($value);
        }
    ];

    switch ($postTypeID) {
        case 1:
            $rules['text'] = function($value) {
                return validateFilled($value);
            };
            break;
        case 2:
            $rules['text_quote'] = function($value) {
                return validateFilled($value);
            };
            $rules['author_quote'] = function($value) {
                return validateFilled($value);
            };
            break;
        case 3:
            if (isset($_FILES['image_link']['tmp_name'])) {
                $form['image_link_web'] = NULL;
                $form['image_link'] = $_FILES['image_link']['type'];


                $rules['image_link'] = function($value) {

                    return validateTypePictures($value);
                };

            } elseif ((!is_uploaded_file($_FILES['image_link']['tmp_name'])) && (!isset($form['image_link_web'])))  {

                $errors['image_link'] = 'Необходимо выбрать файл изображения со своего компьютера, либо указать прямую ссылку на изображение, размещенное в интернете';

                $errors['image_link_web'] = 'Необходимо выбрать файл изображения со своего компьютера, либо указать прямую ссылку на изображение, размещенное в интернете';

            } elseif (isset($form['image_link_web'])) {
                $form['image_link'] = NULL;
                $rules['image_link_web'] = function($value) {
                    return validateWebPictures($value);
                };
            }
            break;
        case 4:
            $rules['video_link'] = function($value) {
                return validateYoutube($value);
            };

            break;
        case 5:
            $rules['site_link'] = function($value) {
                return validateFilled($value);
            };
            break;
    }


    foreach ($form as $key => $value) {
        if (isset($rules[$key])) {
            $rule = $rules[$key];
            $errors[$key] = $rule($value);
        }
    }

    $errors = array_filter($errors);
    $hashtag_id = 1;
    if (!count($errors)) {
        $image_link = NULL;
        if (isset($_FILES['image_link']) && !empty($_FILES['image_link']['name'])) {
            $image_link = $_FILES['image_link']['name'] . '_' . time();
            $file_path = __DIR__ . '/uploads/';
            move_uploaded_file($_FILES['image_link']['tmp_name'], $file_path . $image_link);
        } elseif (!empty($form['image_link_web'])) {
            $filePicture = file_get_contents($form['image_link_web']);
            $image_link = basename($form['image_link_web']);
            $file_path = __DIR__ . '/uploads/';
            file_put_contents($file_path . $image_link, $filePicture);
        }
        $sql = "INSERT INTO `posts`
        (`title`, `text`, `text_quote`, `author_quote`, `image_link`, `video_link`, `site_link`, `user_id`, `content_type_id`)
        VALUES  (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = db_get_prepare_stmt(
            $con,
            $sql,
            [
                $form['title'],
                $form['text'],
                $form['text_quote'],
                $form['author_quote'],
                $image_link,
                $form['video_link'],
                $form['site_link'],
                $is_auth,
                $postTypeID
            ]
        );
        $result = mysqli_stmt_execute($stmt);
        if ($result) {
            $last_id = mysqli_insert_id($con);
            $hastag_arr = explode(' ', $form['hashtag']);
            $values = [];

            foreach($hastag_arr as $hashtag) {
                $sql_hashtags = "INSERT INTO `hashtags` (`hashtag_name`) VALUES ($hashtag)";
                mysqli_query($con, $sql_hashtags);

                $hashtag_id = mysqli_insert_id($con);
                $query = 'INSERT INTO `hashtags_posts` (`hashtag_id`, `post_id`) VALUES ('. $hashtag_id . ',' . $last_id . ')';
                mysqli_query($con, $query);
            }

            header("Location: /posts.php?active_post=$last_id");
        }
    }
}

$main_block = include_template('add.php', ['content_type_arr' =>  $content_type_arr, 'postTypeID' => $postTypeID, 'errors' => $errors]);
$layout_block = include_template('layout.php', [
    'content' => $main_block,
    'is_auth' => $is_auth,
    'user_name' => $user_name,
    'title' => 'readme: добавить публикацию'
]);
print($layout_block);
