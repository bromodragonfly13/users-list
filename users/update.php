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

    $user->id = $_POST['id'];
    
    if (
    !empty($_POST['f_name']) && 
    !empty($_POST['l_name']) &&
    isset($_POST['role']) && 
    isset($_POST['status'])) {
        $user->l_name = $_POST['l_name'];
        $user->f_name = $_POST['f_name'];
        $user->status = $_POST['status'];
        $user->role = $_POST['role'];


        if(!$user->checkUserById()){
            http_response_code(404);
    
            $error = array(
                "status" => false,
                "error" => array(
                    "code" => "601",
                    "message" => "User not found"
                ),
            );
    
            echo json_encode($error, JSON_UNESCAPED_UNICODE);
            die;
        }

        if(!preg_match("/^[a-zA-Zа-яА-Я]+$/u", $user->f_name)) {
            http_response_code(400);
    
            $error = array(
                "status" => false,
                "error" => array(
                    "code" => "602",
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
                    "code" => "603",
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
                    "code" => "604",
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
                    "code" => "605",
                    "message" => "Incorrect role"
                ),
            );
    
            echo json_encode($error, JSON_UNESCAPED_UNICODE);
            die();
        }

    } else{

        http_response_code(400);

        $error = array(
            "status" => false,
            "error" => array(
                "code" => "601",
                "message" => "Not all data is complete"
            ),
        );
    
        echo json_encode($error, JSON_UNESCAPED_UNICODE);
    }

    if($user->update()){

        http_response_code(200);

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

        echo json_encode($user);



    }

    else {
        http_response_code(503);

        $error = array(
            "status" => false,
            "error" => array(
                "code" => "606",
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
            "code" => "600",
            "message" => "ID not passed"
        ),
    );

    echo json_encode($error, JSON_UNESCAPED_UNICODE);
    die;

}