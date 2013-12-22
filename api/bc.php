<?php

$api_url = 'https://store-bwvr466.mybigcommerce.com/api/v2/products.json?category=502&limit=1&page=1';
$ch = curl_init(); curl_setopt( $ch, CURLOPT_URL, $api_url ); 
curl_setopt( $ch, CURLOPT_HTTPHEADER, array ('Accept: application/json', 'Content-Length: 0') );                                   
curl_setopt( $ch, CURLOPT_CUSTOMREQUEST, 'GET'); 
curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, 0 ); 
curl_setopt( $ch, CURLOPT_USERPWD, "demo:df38dd10e9665a3cfa667817d78ec91ee9384bc3" ); 
curl_setopt( $ch, CURLOPT_SSL_VERIFYHOST, 0 );
curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1 );   
$response = curl_exec( $ch );   
$result = json_decode($response); 
echo json_encode($result);