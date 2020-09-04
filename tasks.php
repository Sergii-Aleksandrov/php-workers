<?php
include "config.php";
include 'include/functions.php';

//Соединяемся с базой данных используя наши доступы:
$pdo = new PDO("mysql:host={$host}; dbname={$db_name}", $user, $password, [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
]);

$body = '';

$action = $_GET['action'] ?? null;
$isTableShow = true;

switch ($_SERVER['REQUEST_METHOD']) {
    case 'GET':
        if ($action === 'edit') {
            $body .= include 'actions/tasks-edit.php';
            $isTableShow = false;
        } elseif ($action === 'add') {
            $body .= include 'actions/tasks-edit.php';
            $isTableShow = false;
        } elseif ($action === 'delete') {
            include 'actions/tasks-delete.php';
        }
        break;
    case 'POST':
        include 'actions/tasks-save.php';
        break;
}

if ($isTableShow) {
    $body .= include "actions/tasks-table.php";
}

render('templates/index.html', 'Tasks', $body);