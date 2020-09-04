<?php
include 'config.php';
include 'include/functions.php';

//Соединяемся с базой данных используя наши доступы:
$pdo = new PDO("mysql:host={$host};dbname={$db_name}", $user, $password);

$body = '';

$action = $_GET['action'] ?? null;
$isTableShow = true;

switch ($_SERVER['REQUEST_METHOD']) {
    case 'GET':
        if ($action === 'edit') {
            $body .= include 'actions/worker-edit.php';
            $isTableShow = false;
        } elseif ($action === 'delete') {
            include "actions/worker-delete.php";
        } elseif ($action === 'add') {
            $body .= include 'actions/worker-edit.php';
            $isTableShow = false;
        }
        break;
    case 'POST':
        include 'actions/worker-save.php';
        break;
}
if ($isTableShow) {
    $body .= include 'actions/worker-table.php';
}

render('templates/index.html', 'Workers', $body);
