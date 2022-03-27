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

if(isset($_POST['id'])){

    $user->id = $_POST['id'];

    if($user->delete()){

        http_response_code(200);

        echo json_encode(array("message" => true), JSON_UNESCAPED_UNICODE);

    }

    else {
        http_response_code(503);

        echo json_encode(array("message" => "Ошибка удаления."));


    }

}