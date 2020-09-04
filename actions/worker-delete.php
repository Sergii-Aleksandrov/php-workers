<?php
$query = $pdo->prepare("DELETE FROM workers WHERE id = :id");
$query->bindParam('id',  $_GET['id']);
$query->execute();