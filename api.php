<?php
//подключаем конфигурацию и устанавливаем доступы к базе данных
include 'config.php';

//проверям существует ли переменная с значением '/worker' or '/worker/id'
$path = isset($_GET['path']) ? $_GET['path'] : '';

//сохраняем метод HTTP запроса,- (GET,POST,PUT, DELETE)
$method = $_SERVER['REQUEST_METHOD'];

//если первый символ пути = /, вырезаем оставшуюся часть запроса и перезаписываем путь
if (strpos($path, '/') === 0) {
    $path = substr($path, 1);
}

//разбиваем на массив по разделителю /: [worker, id]
$arrayPath = explode('/', $path);

//если первый эл-т массива сущетсвует,- сохраняем его, иначе,- null
$resource = isset($arrayPath[0]) ? $arrayPath[0] : null;
//если второй эл-т массива сущетсвует,- сохраняем его, иначе,- null
$resourceId = isset($arrayPath[1]) ? $arrayPath[1] : null;

//представляет соединение м/д PHP и сервером БД
$pdo = new PDO("mysql:host={$host};dbname={$db_name}", $user, $password);

//создаем переменную "ответ" и помещаем туда null для дальнейшего ее изменения
$response = null;

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: PUT, POST, GET, DELETE, PATCH');
header('Access-Control-Allow-Headers: Content-Type');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

//в зависимости от $resource(пути) выполняем следующий скрипт
switch ($resource) {
    //если $resource = 'worker' выводим данные таблицы worker:
    case 'worker':
        //Проверяем, если у нас нет id тогда в ответ записываем все данные из БД
        if (is_null($resourceId)) {
            $response = include 'resources/workers.php';
        } else {
            //записываем одного пльзователя с id = id
            $response = include 'resources/worker.php';
        }
        break;

    //если $resource = 'task' выводим данные таблицы task:
    case 'task':
        //Проверяем, если у нас нет id тогда в ответ записываем все данные из БД
        if (is_null($resourceId)) {
            $response = include 'resources/tasks.php';
        } else {
            //записываем одного пльзователя с id = id
            $response = include 'resources/task.php';
        }
        break;

        //если ничего не найдено, выводаем ошибку и выходим
    default:
        http_response_code(404);
        exit();
}

//если в ответ === false, выдаем ошибку, иначе выводим данные из БД, кодируем их в json-формат и выводим в броузер
if ($response === false) {
    http_response_code(404);
}else {
    http_response_code(200);
    header('Content-Type: application/json');
    echo json_encode($response, JSON_THROW_ON_ERROR);
}
