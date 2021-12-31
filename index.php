<?php
require_once ('connect.php');
require_once('helpers.php');
require_once ('functions.php');

if (!isset($_SESSION['user'])) {
    header('Location: /feed.php');
    exit();
}
header('Location: /guest.php');
