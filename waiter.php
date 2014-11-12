<?php
 
/*
 * Following code will list all the products
 */
 
// array for JSON response
$response = array();
 if (isset($_POST['login_id']) && isset($_POST['pass']))
 {
	$login_id=$_POST['login_id'];
	$pass=$_POST['pass'];
	// include db connect class
	require_once __DIR__ . '/connect.php';
	 
	// connecting to db
	$db = new DB_CONNECT();
	 
	// get all products from products table
	$result = mysql_query("SELECT *FROM waiter WHERE login_id='$login_id' AND pass='$pass'") or die(mysql_error());
	 
	// check for empty result
	if (mysql_num_rows($result) > 0) {
		// looping through all results
		// products node
		$response["waiter"] = array();
		
		while ($row = mysql_fetch_array($result)) {
			// temp user array
			$waiter=array();
			$waiter["name"]=$row["name"];
			$waiter["phone_no"]=$row["phone_no"];
	 
			// push single product into final response array
			array_push($response["waiter"],$product);
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