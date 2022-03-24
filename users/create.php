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

//$data = json_decode(file_get_contents("php://input"));

//echo json_encode($_POST); die();

if (
!empty(trim($_POST['f_name'])) && 
!empty(trim($_POST['l_name'])) &&
!empty($_POST['role']) && isset($_POST['status'])) {
    $user->f_name = $_POST['f_name'];
    $user->l_name = $_POST['l_name'];
    $user->status = $_POST['status'];
    $user->role = $_POST['role'];


    if(!preg_match("/^[a-zA-Zа-яА-Я]+$/u", $user->f_name)) {
        http_response_code(400);

        echo json_encode(array("message" => "Некоректные данные имени."), JSON_UNESCAPED_UNICODE);
        die();
    }

    if(!preg_match("/^[a-zA-Zа-яА-Я]+$/u", $user->l_name)) {
        http_response_code(400);

        echo json_encode(array("message" => "Некоректные данные фамилии."), JSON_UNESCAPED_UNICODE);
        die();
    } 

    if(!preg_match("/^[0-1]*$/", $user->status)) {
        http_response_code(400);

        echo json_encode(array("message" => "Некоректный статус. Доступные варианты : 1 - active, 0 - not active"), JSON_UNESCAPED_UNICODE);
        die();
    } 

    if(!preg_match("/^[1-3]*$/", $user->role)) {
        http_response_code(400);

        echo json_encode(array("message" => "Некоректная роль. Доступные варианты : 1 - active, 3 - user, 3 - admin"), JSON_UNESCAPED_UNICODE);
        die();
    } 



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