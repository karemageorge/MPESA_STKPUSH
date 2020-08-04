<?php
// generating ACCESS_TOKEN

  $consumerKey = '5R9khgKLFGGyvIKKaaEtX1ABCy8VtvJA'; //Fill with your app Consumer Key
  $consumerSecret = 'YrEjIuPRPfP5Lvjm'; // Fill with your app Secret
  $headers = ['Content-Type:application/json; charset=utf8'];
  $access_token_url = 'https://api.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials';
  $curl = curl_init($access_token_url);
  curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
  curl_setopt($curl, CURLOPT_HEADER, FALSE);
  curl_setopt($curl, CURLOPT_USERPWD, $consumerKey.':'.$consumerSecret);
  $result = curl_exec($curl);
  $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
  $result = json_decode($result);
  $access_token = $result->access_token;
//  echo $access_token;

  curl_close($curl);


// initiating the transactions
// defining the variable

// stk push part 1 - initiate transactions on behalf of our clients
  $initiate_url = 'https://api.safaricom.co.ke/mpesa/stkpush/v1/processrequest';

  $BusinessShortCode = '7238919'; // 174379 gotten from safaricom dev test credentials replace with your own 5214599
  $Timestamp = date('YmdHis'); // 20190819092612 - yymmddhhmmss
  $PartyA = $_POST["number"]; // 254708003481       $_GET["number"]
  $PartyB = '5214599'; // 7238919
  $CallBackURL = 'http://vanguardtech.co.ke/mpesa/callback_url.php';
  $AccountReference = 'cart098'; // can be your invoice number or cart number
  $TransactionDesc = 'cart payment for online service';
  $Amount = '1';

  $Passkey = '233a74d185676294dedc53cb86622896f3c02b9c659465582bcda7f88a73c1b5'; // gotten from safaricom dev test credentials
  $Password = base64_encode($BusinessShortCode.$Passkey.$Timestamp); // business shortcode then pass key then timestamp in that order. you get them from the above variables




  $curl = curl_init();
  curl_setopt($curl, CURLOPT_URL, $initiate_url);
  curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json','Authorization:Bearer '.$access_token)); //setting custom header


  $curl_post_data = array(
    //Fill in the request parameters with valid values
    'BusinessShortCode' => $BusinessShortCode,
    'Password' => $Password,
    'Timestamp' => $Timestamp,
    'TransactionType' => 'CustomerBuyGoodsOnline',
    'Amount' => $Amount, // THERE WAS AN ERROR HERE, PREVIOUSLY 'Amount"'
    'PartyA' => $PartyA,
    'PartyB' => $PartyB,// same as the business shortcode
    'PhoneNumber' => $PartyA,
    'CallBackURL' => $CallBackURL,
    'AccountReference' => $AccountReference,
    'TransactionDesc' => $TransactionDesc
  );

  $data_string = json_encode($curl_post_data);

  curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($curl, CURLOPT_POST, true);
  curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);

  $curl_response = curl_exec($curl);
//  print_r($curl_response);

 // echo json_decode($curl_response)->MerchantRequestID;
 
 $merchantRequestID = json_decode($curl_response)->MerchantRequestID;
 
//  echo $merchantRequestID;
  
 
 sleep(30); // delay in seconds
  
  
$servername = "localhost";
$username = "vanguar1_mpesa";
$password = "mpesa1720!";
$dbname = "vanguar1_mpesa";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT merchantRequestID FROM mpesa_pay WHERE merchantRequestID = '$merchantRequestID' AND resultCode=0 "; // merchant request id gotten from the first response variable
$result = $conn->query($sql);


if ($result->num_rows > 0) {
  
  //  echo "transaction was successful";
    $myObj->status = 201;
    $myObj->message = "Transaction was successful";


   
    echo json_encode($myObj);
    
    
// Initialize a file URL to the variable 
$url = 'https://contribute.geeksforgeeks.org/wp-content/uploads/gfg-40.png'; 
  
// Use basename() function to return the base name of file  
$file_name = basename($url); 
   
// Use file_get_contents() function to get the file 
// from url and use file_put_contents() function to 
// save the file by using base name 
if(file_put_contents( $file_name,file_get_contents($url))) { 
    echo "File downloaded successfully"; 
} 
else { 
    echo "File downloading failed."; 
} 


  
} else {
  
  $myObj->status = 417;
  $myObj->message = "Transaction failed";


  echo json_encode($myObj);
} 


  ?>
