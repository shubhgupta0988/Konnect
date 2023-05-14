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
$user->name = $_POST['name'];
$user->email = $_POST['email'];
$user->dob = $_POST['dob'];
$user->username = $_POST['username'];

// create the User
if($user->create()){
    $user_arr=array(
        "status" => true,
        "message" => "Successfully Signup!",
        "name" => $user->name,
        "email" => $user->email,
        "dob" => $user->dob,
        "username" => $user->username,
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