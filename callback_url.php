
<?php

        $callbackJSONData=file_get_contents('php://input');
        $callbackData=json_decode($callbackJSONData);
        $resultCode=$callbackData->Body->stkCallback->ResultCode;
        $resultDesc=$callbackData->Body->stkCallback->ResultDesc;
        $merchantRequestID=$callbackData->Body->stkCallback->MerchantRequestID;
        $checkoutRequestID=$callbackData->Body->stkCallback->CheckoutRequestID;

        $amount=$callbackData->Body->stkCallback->CallbackMetadata->Item[0]->Value;
        $mpesaReceiptNumber=$callbackData->Body->stkCallback->CallbackMetadata->Item[1]->Value;
        $balance=$callbackData->Body->stkCallback->CallbackMetadata->Item[2]->Value;
  //   $b2CUtilityAccountAvailableFunds=$callbackData->Body->stkCallback->CallbackMetadata->Item[3]->Value;
        $transactionDate=$callbackData->Body->stkCallback->CallbackMetadata->Item[3]->Value;
        $phoneNumber=$callbackData->Body->stkCallback->CallbackMetadata->Item[4]->Value;
        
        
    //    echo $phoneNumber;
     //   $result=[
     //       $transTime=>$transTime,
      //      $transAmount=>$transAmount,
        //    $businessShortCode=>$businessShortCode,
          //  $billRefNumber=>$billRefNumber,
            // $invoiceNumber=>$invoiceNumber,
    //        $orgAccountBalance=>$orgAccountBalance,
    //        $thirdPartyTransID=>$thirdPartyTransID,
     //       $MSISDN=>$MSISDN,
     //       $firstName=>$firstName,
    //        $lastName=>$lastName,
    //        $middleName=>$middleName,
    //        $transID=>$transID,
    //        $transactionType=>$transactionType

    //    ];
        
    //       return json_encode($result);

    
    
/* Attempt MySQL server connection. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
$link = mysqli_connect("localhost", "vanguar1_mpesa", "mpesa1720!", "vanguar1_mpesa");
 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
 
// Attempt insert query execution
$sql = "INSERT INTO mpesa_pay (
resultCode,
resultDesc,
merchantRequestID,
checkoutRequestID,
amount,
mpesaReceiptNumber,
balance,
transactionDate,
phoneNumber) VALUES ('$resultCode', '$resultDesc', '$merchantRequestID', '$checkoutRequestID', '$amount', '$mpesaReceiptNumber', '$balance','$transactionDate', '$phoneNumber' )";
if(mysqli_query($link, $sql)){
    echo "Records inserted successfully.";
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}


 // sleep(100); // delay in seconds







// Close connection
mysqli_close($link);

/*
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

$sql = "SELECT merchantRequestID FROM mpesa_pay WHERE merchantRequestID = $merchantRequestID "; // merchant request id gotten from the first response variable
$result = $conn->query($sql);


if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    echo "transaction was successful";
  }
} else {
  echo "Transaction failed";
}
 */

//  $stkCallbackResponse = file_get_contents('php://input');

//   $logFile = "stkPushCallbackResponse.json";
//   $log = fopen($logFile, "a");
//   fwrite($log, $callbackJSONData);
//   fclose($log);


?>
