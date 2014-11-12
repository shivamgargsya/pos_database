<?php 
//insertnew.php 
/* * Following code will create a new product row * All product details are read from HTTP GET Request */ 
// array for JSON response 
$response = array(); 
// check for required fields 
if (isset($_POST['order_no']) && isset($_POST['table_no'])&& isset($_POST['date'])&& isset($_POST['waiter_name'])&& isset($_POST['reason'])&& isset($_POST['notes'])&& isset($_POST['total_amount'])){ 
$order_no = $_POST['order_no']; 
$table_no = $_POST['table_no'];
$date = $_POST['date'];

$waiter_name= $_POST['waiter_name'];

$reason = $_POST['reason'];
$notes = $_POST['notes'];
$total_amount = $_POST['total_amount'];


// include db connect class 
require_once __DIR__ . '/connect.php'; 

// connecting to db 
$db = new DB_CONNECT(); 

// mysql inserting a new row (idioms) 
$result = mysql_query("INSERT INTO return_orders( order_no, table_no, date, waiter_name, reason, note, total_amount) VALUES('$order_no', '$table_no', '$date', '$waiter_name', '$reason', '$notes', '$total_amount')")or die(mysql_error()); 

// check if row inserted or not 

if ($result) { 
// successfully inserted into database 
$response["success"] = 1; 
$response["message"] = "new bill saved...."; 

// echoing JSON response 
echo json_encode($response); 
} 
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
json_encode($response); } 
?> 