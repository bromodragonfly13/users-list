<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Credentials: true");
header("Content-Type: application/json");

include_once '../config/Database.php';
include_once '../Model/User.php';

$database = new Database();
$db = $database->getConnection();

$user = new User($db);

$user->id = isset($_POST['id']) ? $_POST['id'] : die();

$user->readOne();

if($user->f_name!=null){

    $user_arr = array(
        "id" => $user->id,
        "f_name" => $user->f_name,
        "l_name" => $user->l_name,
        "role" => $user->role,
        "status" => $user->status
    );

    http_response_code(200);

    echo json_encode($user_arr);

}

else{

    http_response_code(404);

    echo json_encode(array("message" => "Пользователь не существует."), JSON_UNESCAPED_UNICODE);

}

