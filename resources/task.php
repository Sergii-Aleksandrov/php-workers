<?php

switch ($method) {
    //запрашиваем данные из таблицы
    case 'GET':
        //подготавливает запрос к выполнению и возвращает связанный с этим запросом обьект
        $query = $pdo->prepare("SELECT * FROM tasks WHERE id= :id");
        //привязывает параметр запроса к переменной
        $query->bindParam('id', $resourceId);
        //запускает подготовленный запрос
        $query->execute();

        //возвращаем ассоциативный массив и выходим
        return $query->fetch(PDO::FETCH_ASSOC);
        break;


    //заменяем всю строку новыми данными запроса с id = :id.
    case 'PUT':
        //подготавливаем запрос с параметрами
        $query = $pdo->prepare("SELECT * FROM tasks WHERE id = :id");
        //выполняем запрос
        $query->execute(['id' => $resourceId]);

        //Возвращает количество строк, затронутых последним SQL-запросом
        if (!$query->rowCount()) {
            return false;
        }

        //изменяем в поле каждый столбец на новое значение
        $requestString = file_get_contents('php://input');
        $requestString = json_decode($requestString, true);
        //parse_str($requestString, $_patch);
       /* print_r($requestString);
        exit();*/


        /*print_r($deadline);
        exit();*/

        $deadline = !empty($_patch['deadline_date'])
            ? $_patch['deadline_date'] . ' ' . $_patch['deadline_time']
            : null;

        $worker_id = empty($_patch['worker_id']) ? null : $_patch['worker_id'];

        $sql = <<<SQL
UPDATE tasks
SET 
    title = :title,
    description = :description,
    status = :status,
    worker_id = :worker_id,
    deadline = :deadline
WHERE id = :id
SQL;
        $query = $pdo->prepare($sql);
        $query->execute([
            'title' => $requestString['title'],
            'description' => $requestString['description'],
            'status' => $requestString['status'],
            'worker_id' => $worker_id,
            'deadline' => $deadline,
            'id' => $resourceId
        ]);

        //Возвращает все значения этого поля
        $query = $pdo->prepare("SELECT * FROM tasks WHERE id = :id");
        $query->execute(['id' => $resourceId]);
        return $query->fetch(PDO::FETCH_ASSOC);
        break;


    case 'DELETE':
        $query = $pdo->prepare("SELECT * FROM tasks WHERE id = :id");
        $query->execute(['id' => $resourceId]);
        $data = $query->fetch(PDO::FETCH_ASSOC);

        if (!$data) {
            return false;
        }
        break;

    case 'PATCH':
        //PATCH - используется для частичного иземенения, не всей таблицы а отдельного поля
        //получить данные из таблицы с id=id того поля которое нам необходимо(title, status...) для проверки что это поле существует: SELECT
        //данный запрос вернет не все поле а 1
        $query = $pdo->prepare("SELECT * FROM tasks WHERE id = :id");
        $query->execute(['id' => $resourceId]);

        //Возвращает количество строк, затронутых последним SQL-запросом
        if (!$query->rowCount()) {
            return false;
        }

        //Читаем содержимое файла в строкую. Возвращается содержимое файла в строке
        $requestString = file_get_contents('php://input');
        //забиваем строку в массив
        parse_str($requestString, $_patch);
        //print_r($_patch);

        //изменить это поле: UPDATE
        switch (key($_patch)) {
            case 'title':
                $value = $_patch['title'];
                $sql = "UPDATE tasks SET title = :value WHERE id = :id";
                break;

            case 'description':
                $value = $_patch['description'];
                $sql = "UPDATE tasks SET description = :value WHERE id = :id";
                break;

            case 'status':
                $value = $_patch['status'];
                $sql = "UPDATE tasks SET status = :value WHERE id = :id";
                break;

            case 'deadline':
                $value = $_patch['deadline'];
                $sql = "UPDATE tasks SET deadline = :value WHERE id = :id";
                break;

            case 'worker_id':
                $value = $_patch['worker_id'];
                $sql = "UPDATE tasks SET worker_id = :value WHERE id = :id";
                break;

            default:
                return false;
        }

        $query = $pdo->prepare($sql);
        $query->execute([
            'value' => $value,
            'id' => $resourceId
        ]);

        //Возвращаем все значения этого поля на фронтент
        $query = $pdo->prepare("SELECT * FROM tasks WHERE id = :id");
        $query->execute(['id' => $resourceId]);
        return $query->fetch(PDO::FETCH_ASSOC);

        break;
}