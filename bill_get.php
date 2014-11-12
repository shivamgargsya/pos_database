<?php
 
/*
 * Following code will list all the products
 */
 
// array for JSON response
$response = array();
 if (isset($_POST['date']) && isset($_POST['waiter_id']))
 {
	$date=$_POST['date'];
	$waiter=$_POST['waiter_id'];
	// include db connect class
	require_once __DIR__ . '/db_connect.php';
	 
	// connecting to db
	$db = new DB_CONNECT();
	 
	// get all products from products table
	$result = mysql_query("SELECT *FROM bill WHERE 'date'=$date AND 'waiter_id'=$waiter_id") or die(mysql_error());
	 
	// check for empty result
	if (mysql_num_rows($result) > 0) {
		// looping through all results
		// products node
		$response["bills"] = array();
	 
		while ($row = mysql_fetch_array($result)) {
			// temp user array
			
	 
			// push single product into final response array
			array_push($response["bills"], $row);
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