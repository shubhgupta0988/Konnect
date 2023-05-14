<?php
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/user.php';

// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare user object
$user = new User($db);
 
// set user property values
$user->username = $_POST['username'];
$user->username = "p123";
 
// remove the user
if($user->delete()){
    $user_arr=array(
        "status" => true,
        "message" => "Successfully Removed!"
    );
}
else{
    $user_arr=array(
        "status" => false,
        "message" => "User Cannot be deleted!"
    );
}
print_r(json_encode($user_arr));
?>