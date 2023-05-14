<?php
// include database and object files
include_once '../config/database.php';
include_once '../objects/user.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare user object
$user = new User($db);
 
// query user
$stmt = $user->read();
$num = $stmt->rowCount();
// check if more than 0 record found
if($num>0){
 
    // user array
    $user_arr=array();
    $user_arr["user"]=array();
 
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        $user_item=array(
            "name" => $name,
            "email" => $email,
            "username" => $username,
            "dob" => $dob,
        );
        array_push($user_arr["user"], $user_item);
    }
 
    echo json_encode($user_arr["user"]);
}
else{
    echo json_encode(array());
}
?>