<?php 
//insertnew.php 
/* * Following code will create a new product row * All product details are read from HTTP GET Request */ 
// array for JSON response 
$response = array(); 
// check for required fields 
if (isset($_POST['date']) && isset($_POST['time'])&& isset($_POST['customer_name'])&& isset($_POST['phone_no'])&& isset($_POST['table_no'])){ 
$date = $_POST['date']; 
$time = $_POST['time'];
$customer_name = $_POST['customer_name'];
$phone_no= $_POST['phone_no'];
$table_no = $_POST['table_no'];


// include db connect class 
require_once __DIR__ . '/connect.php'; 

// connecting to db 
$db = new DB_CONNECT(); 

// mysql inserting a new row (idioms) 
$result = mysql_query("INSERT INTO reservation( date, time, customer_name, phone_no, table_no) VALUES('$date', '$time', '$customer_name', '$phone_no', '$table_no')"); 

// check if row inserted or not 

if ($result) { 
// successfully inserted into database 
$response["success"] = 1; 
$response["message"] = "new reservation saved...."; 

// echoing JSON response 
echo json_encode($response); } 
else { 

// failed to insert row 
$response["success"] = 0; 
$response["message"] = "Oops! An error occurred."; 

// echoing JSON response 
echo json_encode($response); } } 
else { 
// required field is missing 
$response["success"] = 0; 
$response["message"] = "Required field(s) is missing"; 

// echoing JSON response echo 
echo json_encode($response);
 } 
?> 