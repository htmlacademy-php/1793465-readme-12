<?php
require_once ('connect.php');
require_once('helpers.php');
require_once ('functions.php');

$title = 'readme: гостевая страница';


$layout_block = include_template(
    'guest.php',
    [
        'title' => $title
    ]
);
print($layout_block);
