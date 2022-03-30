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

if(isset($_POST['ids'])){

    $ids = explode(',', $_POST['ids']);
    $response = [];
    foreach($ids as $id){
        
        $user->id = $id;

        if(!$user->checkUserById()){    
            $response[$id] = array(
                "status" => false,
                "error" => array(
                    "code" => "201",
                    "message" => "User not found"
                ),
            );
        }
    
        if($user->delete()){
        
            $response[$id] = array(
                "status" => true,
                "error" => null,
                "user" => array(
                    "id" => $user->id,
                )
            );    
        }
    
        else {    
            $response[$id] = array(
                "status" => false,
                "error" => array(
                    "code" => "202",
                    "message" => "Deletion error"
                ),
            );    
        }
    }

    http_response_code(200);
    echo json_encode($response, JSON_UNESCAPED_UNICODE);
    die;
}
else{

    http_response_code(400);
    $error = array(
        "status" => false,
        "error" => array(
            "code" => "600",
            "message" => "IDs not passed"
        ),
    );

    echo json_encode($error, JSON_UNESCAPED_UNICODE);
    die;
}