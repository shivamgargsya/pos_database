<?php 
//insertnew.php 
/* * Following code will create a new product row * All product details are read from HTTP GET Request */ 
// array for JSON response 
$response = array(); 
// check for required fields 
if (isset($_POST['order_no']) && isset($_POST['table_no'])&& isset($_POST['date'])&& isset($_POST['customer_name'])&& isset($_POST['phone_no'])&& isset($_POST['waiter_name'])&& isset($_POST['waiter_id'])&& isset($_POST['discount'])&& isset($_POST['reason'])&& isset($_POST['notes'])&& isset($_POST['total_amount'])&& isset($_POST['payment_mode'])&& isset($_POST['item_list'])){ 
$order_no = $_POST['order_no']; 
$table_no = $_POST['table_no'];
$date = $_POST['date'];
$customer_name= $_POST['customer_name'];
$phone_no = $_POST['phone_no'];
$waiter_name= $_POST['waiter_name'];
$waiter_id = $_POST['waiter_id'];
$discount = $_POST['discount'];
$reason = $_POST['reason'];
$notes = $_POST['notes'];
$total_amount = $_POST['total_amount'];
$payment_mode = $_POST['payment_mode'];
$item_list = $_POST['item_list'];

// include db connect class 
require_once __DIR__ . '/connect.php'; 

// connecting to db 
$db = new DB_CONNECT(); 

// mysql inserting a new row (idioms) 
$reply=mysql_query("DELETE FROM final_order WHERE order_no='$order_no'")or die(mysql_error());
$result = mysql_query("INSERT INTO bill( order_no, table_no, date, customer_name, phone_no, waiter_name, waiter_id, discount, reason, notes, total_amount, payment_mode, item_list) VALUES('$order_no', '$table_no', '$date', '$customer_name', '$phone_no', '$waiter_name', '$waiter_id', '$discount', '$reason', '$notes', '$total_amount', '$payment_mode', '$item_list')")or die(mysql_error()); 

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