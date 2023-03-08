<?php

session_start();

date_default_timezone_set("Asia/Calcutta");

$curl = curl_init();

$Firstname = $_POST['firstname'];
$Lastname = $_POST['lastname'];
$Phone = $_POST['phone'];
$Email = $_POST['email'];
$Amount = $_POST['amount'];
$Currency = $_POST['currency'];
$PeerBankCode = $_POST['peerBankCode'];

// Sample request string for the API call
$merchant_json_data = array(
    'firstname' => $Firstname ,
    'lastname' => $Lastname ,
    'phone' => $Phone ,
    'email' => $Email,
    'amount' => $Amount ,
    'currency' => $Currency ,
    'peerBankCode' => $PeerBankCode 
);

// Generate json data after call below method
$merchant_data = json_encode($merchant_json_data);
//print_r($merchant_data);

//print_r($merchant_data);

curl_setopt_array($curl, array(
  CURLOPT_URL => 'localhost:8080/User',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>$merchant_data,
  CURLOPT_HTTPHEADER => array(
    'Content-Type: application/json'
  ),
));

$response = curl_exec($curl);

$apiResponse = json_decode($response, true);

//UserRequest Response
$respfname = $apiResponse['firstname'];
$resplname = $apiResponse['lastname'];
$respphone = $apiResponse['phone'];
$respemail = $apiResponse['email'];
$respamount = $apiResponse['amount'];
$respcurrency = $apiResponse['currency'];
$resppeerbankcode = $apiResponse['peerBankCode'];
$resppeerBankName = $apiResponse['peerBankName'];
$resppeerBankBranch = $apiResponse['peerBankBranch'];
$resppid = $apiResponse['pid'];
$respstatus = $apiResponse['status'];
$respuvr = $apiResponse['uvr'];
$resptransactionid = $apiResponse['transactionid'];
$respdate = $apiResponse['date'];


//Check Validation Error
foreach($apiResponse as $key => $value) {
      if(str_contains($value, "!!Error!!")){
        echo " <b>" . $key . " : " . $value . "</b> ";
        echo "<br><br>"."<b>Exception Occured !! Please check error msg and retry the payment !!</b>";
        header("refresh:5; URL=http://google.com");
        exit();
      }
   }


//response must not be empty null
if($response){

//Intiatate bank API to Authorize with UVR
$curl1 = curl_init();

curl_setopt_array($curl1, array(
  CURLOPT_URL => 'http://localhost:8082/bank/transaction',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>'{
    "transactionid":"'.$resptransactionid.'",
    "uvr": "'.$respuvr.'"
}',
  CURLOPT_HTTPHEADER => array(
    'Content-Type: application/json'
  ),
));
$response1 = curl_exec($curl1);


//BankResponse Collected
$BankResponse = json_decode($response1, true);

$brespName = $BankResponse['firstname'];
$brespDate = $BankResponse['date'];
$brespVerify = $BankResponse['bank_verify'];
$brespLastname = $BankResponse['lastname'];
$brespPhone = $BankResponse['phone'];
$brespBankName = $BankResponse['peerBankName'];
$brespBankCode = $BankResponse['peerBankCode'];
$brespBranchCode = $BankResponse['peerBankBranch'];
$brespAmount = $BankResponse['amount'];
$brespPID = $BankResponse['pid'];
$brespStatus = $BankResponse['status'];
$brespEmail = $BankResponse['email'];
$brespTxnID = $BankResponse['transactionid'];
$brespUVR = $BankResponse['uvr'];
$brespCurrency = $BankResponse['currency'];


// BankResponse Displayed
echo "<br><B>Transaction ID: </B>".$brespTxnID;
echo "<br>";

echo "<B>UVR: </B>".$brespUVR;
echo "<br>";

echo "<B>Customer Name: </B>".$brespName;
echo "<br>";

echo "<B>Transaction Status: </B>".$brespStatus;
echo "<br>";

$dateFormat = date('d-m-Y H:i:s',$brespDate/1000);
echo "<B>Date: </B>".$dateFormat;
echo "<br>";


/*

<?php
$today = date("F j, Y, g:i a");                 // March 10, 2001, 5:16 pm
$today = date("m.d.y");                         // 03.10.01
$today = date("j, n, Y");                       // 10, 3, 2001
$today = date("Ymd");                           // 20010310
$today = date('h-i-s, j-m-y, it is w Day');     // 05-16-18, 10-03-01, 1631 1618 6 Satpm01
$today = date('\i\t \i\s \t\h\e jS \d\a\y.');   // it is the 10th day.
$today = date("D M j G:i:s T Y");               // Sat Mar 10 17:16:18 MST 2001
$today = date('H:m:s \m \i\s\ \m\o\n\t\h');     // 17:03:18 m is month
$today = date("H:i:s");                         // 17:16:18
?>

*/

echo "<B>Date: </B>".$brespDate;
echo "<br>";


echo "<B>Date: </B>".$brespDate;
echo "<br>";


echo "<B>Date: </B>".$brespDate;
echo "<br>";


echo "<B>Date: </B>".$brespDate;
echo "<br>";


echo "<B>Date: </B>".$brespDate;
echo "<br>";

echo "<B>Date: </B>".$brespDate;
echo "<br>";


echo "<B>Date: </B>".$brespDate;
echo "<br>";


echo "<B>Date: </B>".$brespDate;
echo "<br>";


echo "<B>Date: </B>".$brespDate;
echo "<br>";


echo "<B>Date: </B>".$brespDate;
echo "<br>";

//echo idate('y', $brespDate);

//print_r($response1);

// Transaction ID and UVR validation 
if($brespTxnID == $resptransactionid && $brespUVR == $respuvr ){
  //Success
  //sleep(seconds)
  header("refresh:5; URL=http://www.example.com/another-page.php");
  exit();
}else{

  //Failed
  foreach($BankResponse as $key => $value) {
      if(str_contains($value, "!!Error!!")){
        echo " <b>" . $key . " : " . $value . "</b> ";
        echo "<br><br>"."<b>Exception Occured !! Please check error msg and retry the payment !!</b>";
        header("refresh:5; URL=http://google.com");
        exit();
      }
   }

  header("refresh:5; URL=http://tutorialspoint.com");
  exit();
}

curl_close($curl1); 

}

/*echo "<B>Transaction ID: </B>".$resptransactionid;
echo "<br>";

echo "<B>UVR: </B>".$respuvr;
echo "<br>";

echo "<B>Status: </B>".$respstatus;
echo "<br>";

echo "<B>PID: </B>".$resppid;
echo "<br>";

echo "<B>Bank Code: </B>".$resppeerbankcode;
echo "<br>";

echo "<B>Bank Name: </B>".$resppeerBankName;
echo "<br>";

echo "<B>Branch Name: </B>".$resppeerBankBranch;
echo "<br>";

echo "<B>Firstname: </B>".$respfname;
echo "<br>";

echo "<B>Lastname: </B>".$resplname;
echo "<br>";

echo "<B>Phone Number: </B>".$respphone;
echo "<br>";

echo "<B>Amount: </B>".$respamount;
echo "<br>";

echo "<B>Currency </B>".$respcurrency;
echo "<br>";

echo "<B>Email ID: </B>".$respemail;
echo "<br>";*/

/*echo $resppeerbankcode;
echo "<br>";
echo $respemail;

/*foreach($apiResponse as $value){
  print_r($value);
}

echo '<script type ="text/JavaScript">';  
echo 'alert(" Transaction Initiated !!!! ")';  
echo '</script>';*/
curl_close($curl);  
?>