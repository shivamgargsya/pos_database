<?php
 
/*
 * Following code will list all the products
 */
 
// array for JSON response
$response = array();
 if (isset($_POST['date']) && isset($_POST['waiter_id']))
 {
	$date=$_POST['date'];
	$waiter_id=$_POST['waiter_id'];
	// include db connect class
	require_once __DIR__ . '/connect.php';
	 
	// connecting to db
	$db = new DB_CONNECT();
	 
	// get all products from products table
	$result = mysql_query("SELECT *FROM bill WHERE date='$date'") or die(mysql_error());
	 
	// check for empty result
	if (mysql_num_rows($result) > 0) {
		// looping through all results
		// products node
		$response["bills"] = array();
		
		while ($row = mysql_fetch_array($result)) {
			// temp user array
			$product=array();
			//$product["id"]=array();
			$product["id"]=$row["id"];
			//$product["order_no"]=array();
			$product["order_no"]=$row["order_no"];
			//$product["table_no"]=array();
			$product["table_no"]=$row["table_no"];
			//$product["date"]=array();
			$product["date"]=$row["date"];
			//$product["customer_name"]=array();
			$product["customer_name"]=$row["customer_name"];
			//$product["phone_no"]=array();
			$product["phone_no"]=$row["phone_no"];
			//$product["waiter_name"]=array();
			$product["waiter_name"]=$row["waiter_name"];
			//$product["waiter_id"]=array();
			$product["waiter_id"]=$row["waiter_id"];
			//$product["discount"]=array();
			$product["discount"]=$row["discount"];
			//$product["reason"]=array();
			$product["reason"]=$row["reason"];
			//$product["notes"]=array();
			$product["notes"]=$row["notes"];
			//$product["total_amount"]=array();
			$product["total_amount"]=$row["total_amount"];
			//$product["payment_mode"]=array();
			$product["payment_mode"]=$row["payment_mode"];
			//$product["item_list"]=array();
			$product["item_list"]=$row["item_list"];
	 
			// push single product into final response array
			array_push($response["bills"],$product);
		}
		// success
		
		$response["success"] = 1;
	 
		// echoing JSON response
		echo json_encode($response);
	} else {
		// no products found
		$response["success"] = 0;
		$response["message"] = "No products found";
	 
		// echo no users JSON
		echo json_encode($response);
	}
}
else
	{
		echo "Required parameter are not set";
	}
?>