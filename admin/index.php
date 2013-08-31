<?php
session_start();

include './class/exceptionHandler.php';
include './class/db.php';
include './class/Controller.php';
include "./class/classMenu.php";
include './class/classEvent.php';

if($_POST['login'] = "admin" && md5($_POST['password']) == "d88ef0be9ba12d3788d50193c74c1f07") {
    $_SESSION['auth'] = 1;
} 
if($_SESSION['auth'] != 1) {
    $_GET['event'] = 'main';
    $_GET['action'] = 'auth';
}

$menu_array = array(
    ["Главная", "main", ""],
    ["Фото", "photo", ""],
    ["Слайдер", "slider", ""],
    ["Отзывы", "review", ""],
);

$menu = new Menu($menu_array);
$menu->build();

$event = new classEvent($_GET['event'], $_GET['action']);
$event->run();

if(!$event->class->is_ajax) {
    include "./templ/main.php";
} else {
    echo $event->getResult();
}