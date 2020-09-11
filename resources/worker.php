<?php

switch ($method) {
    //запрашиваем данные из таблицы
    case 'GET':
        //подготавливает запрос к выполнению и возвращает связанный с этим запросом обьект
        $query = $pdo->prepare("SELECT * FROM workers WHERE id = :id");
        //привязывает параметр запроса к переменной
        $query->bindParam('id', $resourceId);
        //запускает подготовленный запрос
        $query->execute();
        //возвращаем ассоциативный массив
        return $query->fetch(PDO::FETCH_ASSOC);

    //заменяем всю строку новыми данными запроса с id = :id.
    case 'PUT':
        $query = $pdo->prepare("SELECT * FROM workers WHERE id = :id");
        $query->execute(['id' => $resourceId]);

        //Возвращает количество строк, затронутых последним SQL-запросом
        if (!$query->rowCount()) {
            return false;
        }

        //изменяем в поле каждый столбец на новое значение
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
        $parsed = file_get_contents('php://input');
        parse_str($parsed, $parsed);
        //print_r($parsed);
        //exit();

        $query->execute([
            'age'     => $parsed['userAge'],
            'name'    => $parsed['userName'],
            'surname' => $parsed['userSurname'],
            'salary'  => $parsed['userSalary'],
            'id' => $resourceId
        ]);

        //Возвращает все значения этого поля
        $query = $pdo->prepare("SELECT * FROM workers WHERE id = :id");
        $query->execute(['id' => $resourceId]);
        return $query->fetch(PDO::FETCH_ASSOC);
        break;

    case 'DELETE':
        $query = $pdo->prepare("SELECT * FROM workers WHERE id = :id");
        $query->execute(['id' => $resourceId]);
        $data = $query->fetch(PDO::FETCH_ASSOC);

        if (!$data) {
            return false;
        }

        $query = $pdo->prepare("DELETE FROM workers WHERE id = :id");
        $query->execute(['id' => $resourceId]);

        return $data;
        break;

    case 'PATCH':
        //PATCH - используется для частичного иземенения, не всей таблицы а отдельного поля
        //получить данные из таблицы с id=id того поля которое нам необходимо(name, surname...) для проверки что это поле существует: SELECT
        //данный запрос вернет не все поле а 1
        $query = $pdo->prepare("SELECT 1 FROM workers WHERE id = :id");
        $query->execute(['id' => $resourceId]);
        //Возвращает количество строк, затронутых последним SQL-запросом
        if (!$query->rowCount()) {
            return false;
        }

        $requestString = file_get_contents('php://input');
        parse_str($requestString, $_patch);
        //print_r($_patch);
        //exit();

        //изменить это поле: UPDATE
        switch (key($_patch)) {
            case 'userName':
                $value = $_patch['userName'];
                $sql = "UPDATE workers SET name = :value WHERE id = :id";
                break;

            case 'userSurname':
                $value = $_patch['userSurname'];
                $sql = "UPDATE workers SET surname = :value WHERE id = :id";
                break;

            case 'userAge':
                $value = $_patch['userAge'];
                $sql = "UPDATE workers SET age = :value WHERE id = :id";
                break;

            case 'userSalary':
                $value = $_patch['userSalary'];
                $sql = "UPDATE workers SET salary = :value WHERE id = :id";
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
        $query = $pdo->prepare("SELECT * FROM workers WHERE id = :id");
        $query->execute(['id' => $resourceId]);
        return $query->fetch(PDO::FETCH_ASSOC);

        break;
}