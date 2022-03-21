<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Credentials: true");
header("Content-Type: application/json");

include_once '../config/database.php';
include_once '../Model/User.php';

$database = new Database();
$db = $database->getConnection();

$user = new User($db);

$stmt= $user->read();
$num = $stmt->rowCount();

if($num>0) {

    $users_arr = array();
    $users_arr["records"] = array();

    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){

        extract($row);

        $user_item = array(
            "id" => $id,
            "f_name" => $f_name,
            "l_name" => $l_name,
            "role" => $role,
            "status" => $status
        );

        array_push($users_arr["records"], $user_item);
    } 
    

    http_response_code(200);

    echo json_encode($users_arr);
} 
else{
    http_response_code(404);
    echo json_encode(array("message" => "Пользователи не найдены"), JSON_UNESCAPED_UNICODE);

}