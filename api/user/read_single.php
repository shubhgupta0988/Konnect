<?php
// include database and object files
include_once '../config/database.php';
include_once '../objects/user.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare user object
$user = new User($db);

// set ID property of user to be edited
$user->username = isset($_GET['username']) ? $_GET['username'] : die();

// read the details of user to be edited
$stmt = $user->read_single();

if($stmt->rowCount() > 0){
    // get retrieved row
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    // create array
    $user_arr=array(
        "name" => $row['name'],
        "dob" => $row['dob'],
        "email" => $row['email'],
        "username" => $row['username'],
    );
}
// make it json format
print_r(json_encode($user_arr));
?>