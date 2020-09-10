<?php
switch ($method) {
    case 'GET':
        $query = $pdo->prepare("SELECT * FROM tasks");
        $query->execute();

        return $query->fetchAll(PDO::FETCH_ASSOC);
    case 'POST':
        break;
}