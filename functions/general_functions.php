<?php

//=========================================GET FUNCTION=========================================
//This function sends GET requests to a given URL 

function get_file($url, $username, $pw) {

   
    $options = array(

    	CURLOPT_HTTPAUTH  	   => CURLAUTH_BASIC,
    	CURLOPT_USERPWD		   => $username.":".$pw,
        
        CURLOPT_RETURNTRANSFER => true,   // return web page
        CURLOPT_HEADER         => false,  // don't return headers
        CURLOPT_FOLLOWLOCATION => true,   // follow redirects
        CURLOPT_FAILONERROR    => 1,
        CURLOPT_MAXREDIRS      => 10,     // stop after 10 redirects
        CURLOPT_ENCODING       => "",     // handle compressed
        CURLOPT_USERAGENT      => "test", // name of client
        CURLOPT_AUTOREFERER    => true,   // set referrer on redirect
        CURLOPT_CONNECTTIMEOUT => 120,    // time-out on connect
        CURLOPT_TIMEOUT        => 120,    // time-out on response
        CURLOPT_SSL_VERIFYPEER => false
    ); 


    $ch = curl_init($url);
    curl_setopt_array($ch, $options);

	$content  = simplexml_load_string(curl_exec($ch));

    curl_close($ch);

    return $content;
}


//=======================================POST FUNCTION======================================

    //This function sends POST requests to a given URL 
    function post_file($url, $xml, $username, $pw){


            $options = array(
                CURLOPT_HTTPAUTH       => CURLAUTH_BASIC,
                CURLOPT_USERPWD        => $username.":".$pw,
                CURLOPT_RETURNTRANSFER => true,   // Will return the response, if false it print the response
                CURLOPT_FOLLOWLOCATION => true,   // follow redirects
                CURLOPT_MAXREDIRS      => 10,     // stop after 10 redirects
                CURLOPT_ENCODING       => "",     // handle compressed
                CURLOPT_USERAGENT      => "test", // name of client
                CURLOPT_AUTOREFERER    => true,   // set referrer on redirect
                CURLOPT_CONNECTTIMEOUT => 120,    // time-out on connect
                CURLOPT_TIMEOUT        => 120,    // time-out on response
                CURLOPT_SSL_VERIFYPEER => false,  // Disable SSL verification
                CURLOPT_POST           => true,
                CURLOPT_HTTPHEADER     => array('Content-Type: application/xml'),
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_POSTFIELDS     => $xml
            );

            $ch = curl_init($url);
            curl_setopt_array($ch, $options);
            
            $result  = curl_exec($ch);
            curl_close($ch);

            return $result;
            
    }

//=======================================PUT FUNCTION======================================

    //This function sends PUT requests to a given URL 
    function put_file($url, $xml, $username, $pw){


            $options = array(
                CURLOPT_HTTPAUTH       => CURLAUTH_BASIC,
                CURLOPT_USERPWD        => $username.":".$pw,
                CURLOPT_RETURNTRANSFER => true,   // Will return the response, if false it print the response
                CURLOPT_FOLLOWLOCATION => true,   // follow redirects
                CURLOPT_MAXREDIRS      => 10,     // stop after 10 redirects
                CURLOPT_ENCODING       => "",     // handle compressed
                CURLOPT_USERAGENT      => "test", // name of client
                CURLOPT_AUTOREFERER    => true,   // set referrer on redirect
                CURLOPT_CONNECTTIMEOUT => 120,    // time-out on connect
                CURLOPT_TIMEOUT        => 120,    // time-out on response
                CURLOPT_SSL_VERIFYPEER => false,  // Disable SSL verification
                CURLOPT_CUSTOMREQUEST  => "PUT",
                CURLOPT_POST           => true,
                CURLOPT_HTTPHEADER     => array('Content-Type: application/xml'),
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_POSTFIELDS     => $xml
            );

            $ch = curl_init($url);
            curl_setopt_array($ch, $options);
            
            $result  = curl_exec($ch);
            curl_close($ch);


            return $result;
            
    }

//=========================================GET FUNCTION=========================================
//This function requests for Imonggo API Token given the user email and password
function get_token($url) {

   
    $options = array(
        
        CURLOPT_RETURNTRANSFER => true,   // return web page
        CURLOPT_HEADER         => false,  // don't return headers
        CURLOPT_HTTPHEADER     => array('Content-Type: application/xml'),
        CURLOPT_FOLLOWLOCATION => true,   // follow redirects
        CURLOPT_FAILONERROR    => 1,
        CURLOPT_MAXREDIRS      => 10,     // stop after 10 redirects
        CURLOPT_ENCODING       => "",     // handle compressed
        CURLOPT_USERAGENT      => "test", // name of client
        CURLOPT_AUTOREFERER    => true,   // set referrer on redirect
        CURLOPT_CONNECTTIMEOUT => 120,    // time-out on connect
        CURLOPT_TIMEOUT        => 120,    // time-out on response
        CURLOPT_SSL_VERIFYPEER => false
    ); 


    $ch = curl_init($url);
    curl_setopt_array($ch, $options);

    $content  = simplexml_load_string(curl_exec($ch));

    curl_close($ch);

    if($content != NULL){
        return $content->api_token;
    }else{
         return NULL;
    }

}


?>