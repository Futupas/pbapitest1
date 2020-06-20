<?php
// Your ID and token
// $blogID = '8070105920543249955';
// $authToken = 'OAuth 2.0 token here';

// The data to send to the API
// $postData = array(
//     'kind' => 'blogger#post',
//     'blog' => array('id' => $blogID),
//     'title' => 'A new post',
//     'content' => 'With <b>exciting</b> content...'
// );

$data = "<oper>cmt</oper>
<wait>45</wait>
<test>0</test>
<payment id=\"1111\">
    <prop name=\"cardnum\" value=\"5168745013738544\" />
    <prop name=\"country\" value=\"UA\" />
</payment>";

$password = getenv('password');

$sign=sha1(md5($data.$password));

// Setup cURL
$ch = curl_init('https://api.privatbank.ua/p24api/balance');
curl_setopt_array($ch, array(
    CURLOPT_POST => TRUE,
    CURLOPT_RETURNTRANSFER => TRUE,
    CURLOPT_HTTPHEADER => array(
        // 'Authorization: '.$authToken,
        'Content-Type: application/xml'
    ),
    // CURLOPT_POSTFIELDS => json_encode($postData)
    CURLOPT_POSTFIELDS => "
<?xml version=\"1.0\" encoding=\"UTF-8\"?>
<request version=\"1.0\">
    <merchant>
        <id>163187</id>
        <signature>$sign</signature>
    </merchant>
    <data>$data</data>
</request>
    "
));

// Send the request
$response = curl_exec($ch);

// Check for errors
if($response === FALSE){
    die(curl_error($ch));
}

// Decode the response
$responseData = $response;

// Print the date from the response
echo $responseData;
?>
