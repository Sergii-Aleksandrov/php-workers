<?php

if (!empty($_POST['userId'])) {
    $sql = <<<SQL
UPDATE workers
SET
    age = :age,
    name = :name,
    surname = :surname,
    salary = :salary
WHERE id = :id
SQL;
    $query = $pdo->prepare($sql);
    $query->bindParam('id', $_POST['userId']);
} else {
    $sql = <<<SQL
INSERT INTO workers (age, name, surname, salary) VALUES (:age, :name, :surname, :salary)
SQL;
    $query = $pdo->prepare($sql);
}
$query->bindParam('age', $_POST['userAge']);
$query->bindParam('name', $_POST['userName']);
$query->bindParam('surname', $_POST['userSurname']);
$query->bindParam('salary', $_POST['userSalary']);
$query->execute();
