<?php

include 'parse.php';
include 'API_keys.php';

date_default_timezone_set('UTC');
$conn = mysql_connect('localhost','root','');	
$db = mysql_select_db('bigcommerce_imonggo', $conn);



//==============================GET FUNCTIONS========================================

//This function pulls products from Imonggo and returns an array of arrays consisting tags and products 
function get_products(){

	$username = $GLOBALS['imonggo_api_key'];
	$pw = 'x';
	$response = get_file($GLOBALS['imonggo_URL'].'/api/products.xml', $username, $pw);

	$tags = array();
	foreach($response->product as $product){
		//Stores each unique tag to an array
		if($product->tag_list != ""){
			$tags_per_product = explode(",",preg_replace('/\s+/','', strtolower($product->tag_list)));
			$tags = array_unique(array_merge($tags, $tags_per_product));
		}
	}

    $return = array();
    array_push($return, $response, $tags);
    return $return; 
}

//This function pulls products from Imonggo and returns an array of arrays consisting tags and products 
function get_all_products($inventories){

	$username = $GLOBALS['imonggo_api_key'];
	$pw = 'x';
	$response = get_file($GLOBALS['imonggo_URL'].'/api/products.xml', $username, $pw);

	$url = $GLOBALS['bigcommerce_URL'].'/api/v2/products';
	$username1 = $GLOBALS['bigcommerce_username'];
	$pw1 =$GLOBALS['bigcommerce_api_key'];

	parse_all_products($response,$username1, $pw1,$inventories);
	
}


//This function pulls customers from Bigcommerce
function get_customers(){

	$username = $GLOBALS['bigcommerce_username'];
	$pw =$GLOBALS['bigcommerce_api_key'];
	$response =get_file($GLOBALS['bigcommerce_URL'].'/api/v2/customers' , $username, $pw);

	post_customers($response);
}

function get_invoices($inventories){

	$username = $GLOBALS['bigcommerce_username'];
	$pw =$GLOBALS['bigcommerce_api_key'];
	$response = get_file($GLOBALS['bigcommerce_URL'].'/api/v2/orders' , $username, $pw);
	$result = post_invoices($response,$inventories);
	
}


//This function pulls inventories from imonggo and returns an array of products available on-hand
function get_inventories(){

	$url = $GLOBALS['imonggo_URL'].'/api/inventories.xml';
	$username = $GLOBALS['imonggo_api_key'];
	$pw ='x';
	$response = get_file($url, $username, $pw);

	$result = array();

	foreach ($response->inventory as $inventory){
		//Checks if product is available
		if($inventory->quantity > 0){

			array_push($result, (string)$inventory->product_id);
		}
	}

	return $result;
}


//==============================POST FUNCTIONS=======================================

function post_products($response,$tags,$inventories){

	$url = $GLOBALS['bigcommerce_URL'].'/api/v2/products';
	$username = $GLOBALS['bigcommerce_username'];
	$pw =$GLOBALS['bigcommerce_api_key'];

    parse_products($url, $response,$username, $pw,$tags,$inventories);
}

function post_customers($response){
	$url = $GLOBALS['imonggo_URL'].'/api/customers.xml';
	$username = $GLOBALS['imonggo_api_key'];
	$pw = 'x';

	parse_customers($url, $response,$username,$pw);
}


function post_invoices($response,$inventories){

		$url = $GLOBALS['imonggo_URL'].'/api/invoices.xml';
		$username = $GLOBALS['imonggo_api_key'];
		$pw ='x';

		//check date of last invoice posted
		$query = "SELECT * FROM last_invoice_posting";
		$result = mysql_query($query);
		$row = mysql_fetch_array($result);
		
		$date_time = date('Y-m-d h:i:s a', time());
		echo "Invoices posted from " . $row[1] . " to " . $date_time . "<br>";
		
		if(!$row)
		{
			$insert_to_last_posting = mysql_query("INSERT INTO last_invoice_posting (id, date) VALUES(DEFAULT, '$date_time') ");
			$insert_to_invoices = mysql_query("INSERT INTO invoices (post_id, post_date) VALUES (DEFAULT, '$date_time')");
		}
		
		else
		{
			$update_last_posting = mysql_query("UPDATE last_invoice_posting SET date = '$date_time' WHERE id='$row[0]'");
			$insert_to_invoices = mysql_query("INSERT INTO invoices (post_id, post_date) VALUES (DEFAULT, '$date_time')");
		}
		
	
		$result = parse_invoices($url, $response,$username, $pw,$inventories);

		return $result;
}



//==============================UPDATE FUNCTIONS=======================================
//This function pulls enabled customers on Imonggo and updates them on Bigcommerce
function update_get_customers(){

	$username = $GLOBALS['imonggo_api_key'];
	$pw ='x';
	$response =get_file($GLOBALS['imonggo_URL'].'/api/customers.xml?active_only=1' , $username, $pw);

	$username1 = $GLOBALS['bigcommerce_username'];
	$pw1 = $GLOBALS['bigcommerce_api_key']; 

	parse_update_customers($response,$username1,$pw1);
}


?>




