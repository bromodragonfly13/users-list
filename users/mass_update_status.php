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

if(isset($_POST['ids'])){

    $ids = explode(',', $_POST['ids']);
    $response = [];

    if (isset($_POST['status'])) {
        $user->status = $_POST['status'];

        foreach($ids as $id){

            $user->id = $id;
        
            if(!$user->checkUserById()){        
                $response[$id] = array(
                    "status" => false,
                    "error" => array(
                        "code" => "502",
                        "message" => "User not found"
                    ),
                );

                continue;
            
            }
        
            if(!preg_match("/^[0-1]*$/", $user->status)) {        
                $response[$id]= array(
                    "status" => false,
                    "error" => array(
                        "code" => "503",
                        "message" => "Invalid status"
                    ),
                );
                continue;
            }
        
            if($user->updateStatus()){
                $response[$id] = array(
                    "status" => true,
                    "error" => null,
                    "user" => array(
                        "id" => $user->id,
                        "status" => $user->status
                    )
                );
                continue;
        
            }
        
            else {        
                $response[$id] = array(
                    "status" => false,
                    "error" => array(
                        "code" => "504",
                        "message" => "Unable to update data"
                    ),
                );
        
                continue;
            }
        }

        http_response_code(200);
        echo json_encode($response, JSON_UNESCAPED_UNICODE);
        die;
    } 

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