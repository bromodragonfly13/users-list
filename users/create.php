<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../config/Database.php';
include_once '../Model/User.php';

$database = new Database();
$db = $database->getConnection();

$user = new User($db);

$data = json_decode(file_get_contents("php://input"));

if(
    !empty($data->f_name) &&
    !empty($data->l_name) &&
    !empty($data->status) &&
    !empty($data->role)
) {
    $user->f_name = $data->f_name;
    $user->l_name = $data->l_name;
    $user->status = $data->status;
    $user->role = $data->role;

    if($user->create()){

        http_response_code(201);

        echo json_encode(array("message" => "Пользователь быо создан."), JSON_UNESCAPED_UNICODE);


    } 
    else{

        http_response_code(503);

        echo json_encode(array("message" => "Ошибка создания пользователя"), JSON_UNESCAPED_UNICODE);

    }
}

else{

    http_response_code(400);

    echo json_encode(array("message" => "Не все данные заполнены."), JSON_UNESCAPED_UNICODE);


}