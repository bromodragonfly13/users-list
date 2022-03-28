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

        $error = array(
            "status" => false,
            "error" => array(
                "code" => "105",
                "message" => "Incorrect first name"
            ),
        );

        echo json_encode($error, JSON_UNESCAPED_UNICODE);

        die();
    }

    if(!preg_match("/^[a-zA-Zа-яА-Я]+$/u", $user->l_name)) {
        http_response_code(400);

        $error = array(
            "status" => false,
            "error" => array(
                "code" => "104",
                "message" => "Incorrect last name"
            ),
        );

        echo json_encode($error, JSON_UNESCAPED_UNICODE);
        die();
    } 

    if(!preg_match("/^[0-1]*$/", $user->status)) {
        http_response_code(400);

        $error = array(
            "status" => false,
            "error" => array(
                "code" => "103",
                "message" => "Incorrect status"
            ),
        );

        echo json_encode($error, JSON_UNESCAPED_UNICODE);

        die();
    } 

    if(!preg_match("/^[1-2]*$/", $user->role)) {
        http_response_code(400);

        $error = array(
            "status" => false,
            "error" => array(
                "code" => "102",
                "message" => "Incorrect role"
            ),
        );

        echo json_encode($error, JSON_UNESCAPED_UNICODE);
        die();
    } 



    if($user->create()){

        http_response_code(201);

        $query  = $db->query("SELECT LAST_INSERT_ID()");
        $id = $query->fetchColumn();

        $user = array(
            "status" => true,
            "error" => null,
            "user" => array(
                "id" => $id,
                "f_name" => $user->f_name,
                "l_name" => $user->l_name,
                "role" => $user->role,
                "status" => $user->status
            )
        );

        echo json_encode($user);


    } 
    else{

        http_response_code(503);

        $error = array(
            "status" => false,
            "error" => array(
                "code" => "101",
                "message" => "User creation error"
            ),
        );

        echo json_encode($error, JSON_UNESCAPED_UNICODE);

    }
}

else{

    http_response_code(400);

    $error = array(
        "status" => false,
        "error" => array(
            "code" => "100",
            "message" => "Not all data is complete"
        ),
    );

    echo json_encode($error, JSON_UNESCAPED_UNICODE);


}