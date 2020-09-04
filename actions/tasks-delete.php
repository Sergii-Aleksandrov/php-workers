<?php
$query = $pdo->prepare("DELETE FROM tasks WHERE id = :id");
$query->bindParam('id', $_GET['id']);
$query->execute();