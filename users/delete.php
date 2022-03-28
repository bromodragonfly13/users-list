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

    if(!$user->checkUserById()){
        http_response_code(404);

        $error = array(
            "status" => false,
            "error" => array(
                "code" => "201",
                "message" => "User not found"
            ),
        );

        echo json_encode($error, JSON_UNESCAPED_UNICODE);
        die;
    }

    if($user->delete()){

        http_response_code(200);

        $user = array(
            "status" => true,
            "error" => null,
            "user" => array(
                "id" => $user->id,
            )
        );

        echo json_encode($user);

    }

    else {
        http_response_code(503);

        $error = array(
            "status" => false,
            "error" => array(
                "code" => "202",
                "message" => "Deletion error"
            ),
        );

        echo json_encode($error, JSON_UNESCAPED_UNICODE);
        die;


    }

}
else {
    http_response_code(400);

    $error = array(
        "status" => false,
        "error" => array(
            "code" => "200",
            "message" => "ID not passed"
        ),
    );

    echo json_encode($error, JSON_UNESCAPED_UNICODE);
    die;


}