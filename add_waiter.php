<?php 
//insertnew.php 
/* * Following code will create a new product row * All product details are read from HTTP GET Request */ 
// array for JSON response 
$response = array(); 
// check for required fields 
if (isset($_POST['waiter_name']) && isset($_POST['login_id'])&& isset($_POST['password'])&& isset($_POST['address'])&& isset($_POST['phone_no'])){ 
$waiter_name = $_POST['waiter_name']; 
$login_id = $_POST['login_id'];
$password = $_POST['password'];
$address = $_POST['address'];
$phone_no = $_POST['phone_no'];


// include db connect class 
require_once __DIR__ . '/connect.php'; 

// connecting to db 
$db = new DB_CONNECT(); 

$res = mysql_query("SELECT * FROM waiter WHERE login_id='$login_id'");
if(mysql_num_rows($res)==0)
{
$result = mysql_query("INSERT INTO waiter(waiter_name,login_id, address, phone_no, password) VALUES('$waiter_name', '$login_id', '$address', '$phone_no', '$password')"); 

// check if row inserted or not 

if ($result) { 
// successfully inserted into database 
$response["success"] = 1; 
$response["message"] = "new waiter saved...."; 

// echoing JSON response 
echo json_encode($response); } 
else { 

// failed to insert row 
$response["success"] = 0; 
$response["message"] = "Oops! An error occurred."; 

// echoing JSON response 
echo json_encode($response); } }
else{

$response["success"]= 2;
$response["message"] = "Mobile Number Already Exists";
echo json_encode($response);}
 }
else { 
// required field is missing 
$response["success"] = 0; 
$response["message"] = "Required field(s) is missing"; 

// echoing JSON response echo 
json_encode($response); } 
?> 