<?php

/*
 * Getting PSR7 HTTP Requests
 */
 
 // Getting requested method
$sMethod = isset($_SERVER['REQUEST_METHOD']) ? $_SERVER['REQUEST_METHOD'] : 'GET';
 
// Depending on the method, the action perfromed will be different
switch ($sMethod) {
    case 'GET':
		// Search string goes in the URI
		if (isset($_SERVER['REQUEST_URI']))
			$sSearch = $_SERVER['REQUEST_URI'];
		
		include(__DIR__ . DIRECTORY_SEPARATOR . 'Init.php');
		
		$status = 200;
		$headers = ['Content-Type' => 'application/json'];
		$body = implode(',', $aResults);
		$protocol = '1.1';
		$response = new \GuzzleHttp\Psr7\Response($status, $headers, $body, $protocol);
		
		echo \GuzzleHttp\Psr7\str($response);
		
        break;
    case 'POST':
        $aArguments = $_POST;
        // code for POST Method
        break;
    case 'PUT':
        // code for PUT Method
        break;
    case 'DELETE':
        // code for DELETE Method
        break;
}

?>