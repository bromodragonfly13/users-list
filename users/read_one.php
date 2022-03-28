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


if(isset($_POST['id'])){

    $user->id = $_POST['id'];
    $user->readOne();

    if($user->f_name!=null){

        $user = array(
            "status" => true,
            "error" => null,
            "user" => array(
                "id" => $user->id,
                "f_name" => $user->f_name,
                "l_name" => $user->l_name,
                "role" => $user->role,
                "status" => $user->status
            )
        );

        http_response_code(200);

        echo json_encode($user);
    }

    else{

        http_response_code(404);

        $error = array(
            "status" => false,
            "error" => array(
                "code" => "301",
                "message" => "User not found"
            ),
        );
    
        echo json_encode($error, JSON_UNESCAPED_UNICODE);
        die;

    }
} else{

    http_response_code(400);

    $error = array(
        "status" => false,
        "error" => array(
            "code" => "300",
            "message" => "ID not passed"
        ),
    );

    echo json_encode($error, JSON_UNESCAPED_UNICODE);
    die;
}

