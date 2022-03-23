<?php 

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once('../config/Database.php');
include_once('../Model/User.php');

$database = new Database();
$db = $database->getConnection();

$user = new User($db);

if(isset($_POST['id'])){

    
    if (isset($_POST['status'])) {
        $user->id = $_POST['id'];
        $user->status = $_POST['status'];
    } else{

        http_response_code(400);

        echo json_encode(array("message" => " Укажите статус."), JSON_UNESCAPED_UNICODE);
        die();
    }

    if($user->updateStatus()){

        http_response_code(200);
        echo json_encode(array("message" => "Успех."), JSON_UNESCAPED_UNICODE);

    }

    else {
        http_response_code(503);
    
        echo json_encode(array("message" => "Невозможно обновить данные."), JSON_UNESCAPED_UNICODE);
    }

}

else {
    http_response_code(404);

    echo json_encode(array("message" => "Неверный id пользователя."), JSON_UNESCAPED_UNICODE);

    die();

}