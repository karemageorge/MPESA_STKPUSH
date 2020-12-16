
<?php

        $callbackJSONData=file_get_contents('php://input');
        $callbackData=json_decode($callbackJSONData);
        $TransactionType=$callbackData->TransactionType;
        $TransID=$callbackData->TransID;
        $TransTime=$callbackData->TransTime;
        $TransAmount=$callbackData->TransAmount;

        $BusinessShortCode=$callbackData->BusinessShortCode;
        $BillRefNumber=$callbackData->BillRefNumber;
        $InvoiceNumber=$callbackData->InvoiceNumber;
        $OrgAccountBalance=$callbackData->OrgAccountBalance;
        $ThirdPartyTransID=$callbackData->ThirdPartyTransID;
        $MSISDN=$callbackData->MSISDN;
        $FirstName=$callbackData->FirstName;
        $MiddleName=$callbackData->MiddleName;
        $LastName=$callbackData->LastName;
        
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
$link = mysqli_connect("localhost", "vanguar1_mp", "mpesa1720!", "vanguar1_mp");
 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
 
// Attempt insert query execution
$sql = "INSERT INTO confirmation (
TransactionType,
TransID,
TransTime,
TransAmount,
BusinessShortCode,
BillRefNumber,
InvoiceNumber,
OrgAccountBalance,
ThirdPartyTransID,
MSISDN,
FirstName,
MiddleName,
LastName
) VALUES ('$TransactionType',
'$TransID',
'$TransTime',
'$TransAmount',
'$BusinessShortCode',
'$BillRefNumber',
'$InvoiceNumber',
'$OrgAccountBalance',
'$ThirdPartyTransID',
'$MSISDN',
'$FirstName',
'$MiddleName',
'$LastName' )";
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
