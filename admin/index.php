<?php
include './class/exceptionHandler.php';
include './class/db.php';
include './class/Controller.php';
include "./class/classMenu.php";
include './class/classEvent.php';

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