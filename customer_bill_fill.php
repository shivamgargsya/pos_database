<?php
 
/*
 * Following code will list all the products
 */
 
// array for JSON response
$response = array();
 if (isset($_POST['table_no']))
 {
	$table_no=$_POST['table_no'];
	
	// include db connect class
	require_once __DIR__ . '/connect.php';
	 
	// connecting to db
	$db = new DB_CONNECT();
	 
	// get all products from products table
	$result = mysql_query("SELECT *FROM papa WHERE table_no='$table_no'") or die(mysql_error());
	 
	// check for empty result
	if (mysql_num_rows($result) > 0) {
		// looping through all results
		// products node
		
		$row = mysql_fetch_array($result);
		$response["order_no"]=$row["order_no"];
		$order_no=$row["order_no"];
		$response["table_no"]=$table_no;
		$response["customer_name"]=$row["customer_name"];
		$response["customer_mobile"]=$row["customer_mobile"];
		$result=mysql_query("SELECT *FROM table_table WHERE table_no='$table_no'") or die(mysql_error());
		// success
		$row = mysql_fetch_array($result);
		
		$waiter_id=$row["waiter_id"];
		$response["waiter_id"]=$waiter_id;
		$result=mysql_query("SELECT *FROM waiter WHERE id='$waiter_id'") or die(mysql_error());
		$row = mysql_fetch_array($result);
		$response["waiter_name"]=$row["waiter_name"];
		$response["phone_no"]=$row["phone_no"];
		$result=mysql_query("SELECT *FROM final_order WHERE order_no='$order_no'") or die(mysql_error());
		if (mysql_num_rows($result) > 0) {
		// looping through all results
		// products node
		
		$response["item_list"] = array();
		
		while ($row = mysql_fetch_array($result)) {
			// temp user array
			$product=array();
			//$product["id"]=array();
			$product["order_no"]=$row["order_no"];
			//$product["order_no"]=array();
			$product["name"]=$row["name"];
			//$product["table_no"]=array();
			$product["quantity"]=$row["quantity"];
			//$product["date"]=array();
			$product["price"]=$row["price"];
			//$product["customer_name"]=array();
			$product["table_no"]=$row["unit_price"];
			
	 
			// push single product into final response array
			array_push($response["item_list"],$product);
		}
		$response["success"] = 1;
	 
		// echoing JSON response
		echo json_encode($response);
	}
	else {
		// no products found
		$response["success"] = 0;
		$response["message"] = "No products found in final order table";
	 
		// echo no users JSON
		echo json_encode($response);
	}
	}
	else {
		// no products found
		$response["success"] = 0;
		$response["message"] = "No products found in papa table";
	 
		// echo no users JSON
		echo json_encode($response);
	}
}
else
	{
		echo "Required parameter are not set";
	}
?>