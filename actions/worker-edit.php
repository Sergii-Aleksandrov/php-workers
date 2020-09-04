<?php

$head = '';
if (isset($_GET['id'])) {
    $query = $pdo->prepare("SELECT * FROM workers WHERE id = :id");
    $query->bindParam('id', $_GET['id']);
    $query->execute();

    $data = $query->fetch(PDO::FETCH_ASSOC);
    $head = "Изменить {$data['name']} {$data['surname']}";
} else {
    $data = [
        'id' => '',
        'age' => '',
        'name' => '',
        'surname' => '',
        'salary' => '',
    ];
    $head = 'Добавить нового пользователя';
}


return <<<HTML
<div class="card">
    <div class="card-header">$head</div>
    <div class="card-body">
        <form method="post" action="workers.php">
            <input type="hidden" name="userId" value="{$data['id']}">
            <div class="form-group">
                <label for="user_name">Имя</label>
                <input class="form-control" type="text" id='user_name' name="userName" value="{$data['name']}">
            </div>
            <div class="form-group">
                <label for="user_surname">Фамилия</label>
                <input class="form-control" type="text" id="user_surname" name="userSurname" value="{$data['surname']}">
            </div>
            <div class="form-group">
                <label for="user_age">Возвраст</label>
                <input class="form-control" type="text" id="user_age" name="userAge" value="{$data['age']}">
            </div>
            <div class="form-group">
                <label for="user_salary">Зарплата</label>
                <input class="form-control" type="text" id="user_salary" name="userSalary" value="{$data['salary']}">
            </div>
            <button type="submit" class="btn btn-success">Сохранить</button>
            <a class="btn btn-dark" href="workers.php">Закрыть</a>
        </form>
    </div>
</div>
HTML;