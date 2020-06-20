<?php
$data = "<oper>cmt</oper>
<wait>45</wait>
<test>1</test>
<payment id=\"1111\">
    <prop name=\"cardnum\" value=\"5168745013738544\" />
    <prop name=\"country\" value=\"UA\" />
</payment>";

$password = getenv('password');

$sign=sha1(md5($data.$password));

$url = "https://api.privatbank.ua/p24api/rest_fiz";       
$xml2= file_get_contents('request.xml'); 
$xml2 = str_replace('--SIGNATURE--', $sign, $xml2);
$xml2 = str_replace('--DATA--', $data, $xml2);
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