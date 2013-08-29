<?php
include './admin/class/exceptionHandler.php';
include './admin/class/db.php';
include './admin/class/Controller.php';
include "./admin/class/classMenu.php";
include './admin/class/classEvent.php';

$event = new classEvent($_GET['event'], $_GET['action']);
$event->run();

if(!$event->class->is_ajax) {
    include "./templ/main.php";
} else {
    echo $event->getResult();
}
/*
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
}*/