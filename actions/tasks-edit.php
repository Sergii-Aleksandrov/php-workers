<?php
$header = '';

if (isset($_GET['id'])) {
    $query = $pdo->prepare("SELECT * FROM tasks WHERE id = :id");
    $query->bindParam('id', $_GET['id']);
    $query->execute();

    $data = $query->fetch(PDO::FETCH_ASSOC);
    $header = "Изменить задачу: {$data['title']}";

} else {
    $data = [
        'id' => '',
        'title' => '',
        'description' => '',
        'status' => '',
        'deadline' => ' ',
    ];
    $header = 'Добавить новую задачу';
}
$deadline = (!empty($data['deadline'])) ? explode(' ', $data['deadline']) : ['',''];

return <<<HTML
<div class="card">
    <div class="card-header">$header</div>
    <div class="card-body">
        <form method="post" action="tasks.php">
            <input type="hidden" name="id" value="{$data['id']}">
            <div class="form-group">
                <label for="title">Заголовок</label>
                <input class="form-control" id="title" name="title" type="text" value="{$data['title']}">
            </div>
            <div class="form-group">
                <label for="description">Описание</label>
                <textarea class="form-control" id="description" name="description" rows="6">{$data['description']}</textarea>
            </div>
            <div class="form-group">
                <label for="status">Статус</label>
                <input class="form-control" id="status" name="status" type="text" value="{$data['status']}">
            </div>
            <div class="form-group">
                <label for="deadline">Срок окончания</label>
                <input class="form-control" id="deadline" name="deadline_date" type="date" value="{$deadline[0]}">
                <input class="form-control" name="deadline_time" type="time" value="{$deadline[1]}">
            </div>
            <button class="btn btn-success" type="submit">Сохранить</button>
            <a class="btn btn-dark" href="tasks.php">Закрыть</a>
        </form>
    </div>
</div>
HTML;
