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

        $error = array(
            "status" => false,
            "error" => array(
                "code" => "501",
                "message" => "Status not passed"
            ),
        );
    
        echo json_encode($error, JSON_UNESCAPED_UNICODE);
        die;
    }

    if(!$user->checkUserById()){
        http_response_code(404);

        $error = array(
            "status" => false,
            "error" => array(
                "code" => "502",
                "message" => "User not found"
            ),
        );
    
        echo json_encode($error, JSON_UNESCAPED_UNICODE);
        die;
    }

    if(!preg_match("/^[0-1]*$/", $user->status)) {
        http_response_code(400);

        $error = array(
            "status" => false,
            "error" => array(
                "code" => "503",
                "message" => "Invalid status"
            ),
        );
    
        echo json_encode($error, JSON_UNESCAPED_UNICODE);
        die;
    }

    if($user->updateStatus()){

        http_response_code(200);
        $user = array(
            "status" => true,
            "error" => null,
            "user" => array(
                "id" => $user->id,
                "status" => $user->status
            )
        );

        echo json_encode($user);

    }

    else {
        http_response_code(503);

        $error = array(
            "status" => false,
            "error" => array(
                "code" => "504",
                "message" => "Unable to update data"
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
            "code" => "500",
            "message" => "ID not passed"
        ),
    );

    echo json_encode($error, JSON_UNESCAPED_UNICODE);
    die;

}