<?php

//Sets the Imonggo api key and account id based on user input
$imonggo_api_key = $_SESSION['imonggo_api_token'];
$imonggo_URL = 'https://'.$_SESSION['acct_id'].'.c3.imonggo.com';

//Sets the Bigcommerce api key and account id based on user input
$bigcommerce_api_key = $_SESSION['token_api'];
$bigcommerce_URL = 'https://'.$_SESSION['url'].'.mybigcommerce.com';

$bigcommerce_username=$_SESSION['username'];

?>
 

