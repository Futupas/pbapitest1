<?php
$url = "https://api.privatbank.ua/p24api/rest_fiz";       
$xml2= file_get_contents('request.xml'); 
$stream_options = array (
             'http' => array (
                   'method' => "POST",
                   'header' => "Content-type: application/x-www-form-urlencoded\r\n",
                   'content' => $xml2
                 )
             );
$context=stream_context_create($stream_options);
$response=file_get_contents($url, false, $context);

header('Content-Type: application/xml');
echo $response;
// $array_data = json_decode(json_encode(simplexml_load_string($response)), true);
// echo $array_data;
?>