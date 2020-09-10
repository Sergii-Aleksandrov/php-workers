<?php
switch ($method) {
    //запрашиваем таблицу из БД и выводим массивом
    case 'GET':
        //подготавливает запрос на выполнение и возвращает связаный с этим запросом обьект
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
        //выполняем запрос. Передаем параметры в 'age' из $_POST['userAge'], и т.д.
        $query->execute([
            'age'     => $_POST['userAge'],
            'name'    => $_POST['userName'],
            'surname' => $_POST['userSurname'],
            'salary'  => $_POST['userSalary']
        ]);

        //Возвращает ID последней вставленной строки
        $id = $pdo->lastInsertId();
        $query = $pdo->prepare("SELECT * FROM workers WHERE id = :id");
        $query->execute(['id' => $id]);
        return $query->fetch(PDO::FETCH_ASSOC);
        break;

    default:
        return false;
}