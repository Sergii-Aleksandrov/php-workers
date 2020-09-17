<?php

//в зависимости от метода формируем разные запросы
switch ($method) {
    //запрашиваем таблицу из БД и выводим массивом
    case 'GET':
        //подготавливает запрос на выполнение связаный с этим запросом обьект
        $query = $pdo->prepare("SELECT * FROM workers");
        //выполняем зарос
        $query->execute();

        //возвращаем массив
        return $query->fetchAll(PDO::FETCH_ASSOC);

    //добавляем нового пользователя в БД
    case 'POST':
        //создаем переменную с нужными параметрами для запроса
        $sql = <<<SQL
INSERT INTO workers (age, name, surname, salary) VALUE (:age, :name, :surname, :salary)
SQL;
        //подготавливаем запрос
        $query = $pdo->prepare($sql);
        $parsed = file_get_contents('php://input');
        $parsed = json_decode($parsed, true);
        //выполняем запрос. Передаем параметры в 'age' из $_POST['userAge'], и т.д.
        $query->execute([
            'age'     => $_POST['userAge'],
            'name'    => $_POST['userName'],
            'surname' => $_POST['userSurname'],
            'salary'  => $_POST['userSalary']
        ]);

        //Возвращает ID последней вставленной строки
        $id = $pdo->lastInsertId();
        //формируем запрос
        $query = $pdo->prepare("SELECT * FROM workers WHERE id = :id");
        //выполняем запрос
        $query->execute(['id' => $id]);
        //возвращаем массив
        return $query->fetch(PDO::FETCH_ASSOC);
        break;

    default:
        return false;
}