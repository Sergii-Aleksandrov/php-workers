<?php
if (!empty($_POST['id'])) {
    $sql = <<<SQL
UPDATE tasks
SET 
    title = :title,
    description = :description,
    worker_id = :worker_id,
    status = :status,
    deadline = :deadline
WHERE id = :id
SQL;

    $query = $pdo->prepare($sql);
    $query->bindParam('id', $_POST['id']);
} else {
    $sql = <<<SQL
INSERT INTO tasks (title, worker_id, description, status, deadline) VALUE (:title, :worker_id, :description, :status, :deadline)
SQL;
    $query = $pdo->prepare($sql);
}

$deadline = !empty($_POST['deadline_date'])
    ? $_POST['deadline_date'] . ' ' . $_POST['deadline_time']
    : null;

$worker_id = empty($_POST['worker_id']) ? null : $_POST['worker_id'];
$query->bindParam('title', $_POST['title']);
$query->bindParam('worker_id', $worker_id);
$query->bindParam('description', $_POST['description']);
$query->bindParam('status', $_POST['status']);
$query->bindParam('deadline', $deadline);
$query->execute();
