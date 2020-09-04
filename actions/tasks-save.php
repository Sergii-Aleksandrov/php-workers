<?php
if (!empty($_POST['id'])) {
    $sql = <<<SQL
UPDATE tasks
SET 
    title = :title,
    description = :description,
    status = :status,
    deadline = :deadline
WHERE id = :id
SQL;

    $query = $pdo->prepare($sql);
    $query->bindParam('id', $_POST['id']);
} else {
    $sql = <<<SQL
INSERT INTO tasks (title, description, status, created_at, deadline) VALUE (:title, :description, :status, :created_at, :deadline)
SQL;
    $query = $pdo->prepare($sql);
}

$deadline = !empty($_POST['deadline_date'])
    ? $_POST['deadline_date'] . ' ' . $_POST['deadline_time']
    : null;

$query->bindParam('title', $_POST['title']);
$query->bindParam('description', $_POST['description']);
$query->bindParam('status', $_POST['status']);
$query->bindParam('deadline', $deadline);
$query->execute();
