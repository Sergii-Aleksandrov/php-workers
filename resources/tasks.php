<?php

//в зависимости от метода запроса выводим данные
switch ($method) {
    //запрашиваем таблицу из БД и выводим массивом
    case 'GET':
        //пготавливаем запрос на выполнение из таблицы tasks
        $query = $pdo->prepare("SELECT * FROM tasks");
        //выыполняем запрос
        $query->execute();

        //возвращаем массив
        return $query->fetchAll(PDO::FETCH_ASSOC);

    //добавляем новую задачу в БД
    case 'POST':
        //создаем переменную для подачи запроса
        $sql = <<<SQL
INSERT INTO tasks (title, description, status, deadline, worker_id) 
VALUE (:title, :description, :status, :deadline, :worker_id)
SQL;
        //подготавливаем запрос
        $query = $pdo->prepare($sql);

        //если существует конечная дата,-обьединяем ее в строку ч/з пробел
        $deadline = !empty($_POST['deadline_date'])
            ? $_POST['deadline_date'] . ' ' . $_POST['deadline_time']
            : null;
       /* print_r($deadline);
        exit();*/

        //выполняем запрос
        $query->execute([
            'title' => $_POST['title'],
            'worker_id' => $_POST['worker_id'],
            'description' => $_POST['description'],
            'status' => $_POST['status'],
            'deadline' => $deadline
        ]);

        //Возвращает ID последней вставленной строки
        $id = $pdo->lastInsertId();
        $query = $pdo->prepare("SELECT * FROM tasks WHERE id = :id");
        $query->execute(['id' => $id]);
        return $query->fetch(PDO::FETCH_ASSOC);
        break;

    default:
        return false;
}