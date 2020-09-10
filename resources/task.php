<?php
switch ($method) {
    case 'GET':
        $query = $pdo->prepare("SELECT * FROM tasks WHERE id= :id");
        $query->bindParam('id', $resourceId);
        $query->execute();

        return $query->fetch(PDO::FETCH_ASSOC);
        break;
    case 'POST':
        break;
}