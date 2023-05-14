<?php
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/user.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare User object
$user = new User($db);
 
// set user property values
$user->dob = $_POST['dob'];
$user->name = $_POST['name'];
$user->email = $_POST['email'];
$user->username = $_POST['username'];
 
// create the user
if($user->update()){
    $user_arr=array(
        "status" => true,
        "message" => "Successfully Updated!"
    );
}
else{
    $user_arr=array(
        "status" => false,
        "message" => "Email already exists!"
    );
}
print_r(json_encode($user_arr));
?>