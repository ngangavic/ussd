<?php

function stkpush($destination,$pickpoint,$phone,$connection,$amount,$ssid){
    require "access-token.php";//access token
$url = 'https://sandbox.safaricom.co.ke/mpesa/stkpush/v1/processrequest';//sktpush url
$BusinessShortCode='174379';//shortcode
$Passkey='bfb279f9aa9bdbcf158e97dd71a467cd2e0c893059b10f78e6b72ada1ed2c919';//passkey
$Timestamp=date("YmdGis");//timestamp
$Password=base64_encode($BusinessShortCode.$Passkey.$Timestamp);//password encoded Base64

$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json', 'Authorization:Bearer '.$access_token)); //setting custom header

$curl_post_data = array(
    //Fill in the request parameters with valid values
    'BusinessShortCode' => $BusinessShortCode,//The organization shortcode used to receive the transaction.
    'Password' => $Password,//This is generated by base64 encoding BusinessShortcode, Passkey and Timestamp.
    'Timestamp' => $Timestamp,//The timestamp of the transaction in the format yyyymmddhhiiss.
    'TransactionType' => 'CustomerPayBillOnline',//The transaction type to be used for this request.
    'Amount' => $amount,//The amount to be transacted.
    'PartyA' => $phone,//The MSISDN sending the funds.
    'PartyB' => '174379',//The organization shortcode receiving the funds
    'PhoneNumber' => $phone,//The MSISDN sending the funds.
    'CallBackURL' => 'http://jochebedscrib.org/victor/callback.php',//The url to where logs from M-Pesa will be sent to.
    'AccountReference' => $ssid,//Used with M-Pesa PayBills.
    'TransactionDesc' => 'bus booking ussd'//A description of the transaction.
);

$data_string = json_encode($curl_post_data);

curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);

$curl_response = curl_exec($curl);
//print_r($curl_response);

//display result
//echo $curl_response;

$callbackJSONData=file_get_contents('php://input');
        $callbackData=json_decode($callbackJSONData);
        echo $callbackData;
        $resultCode=$callbackData->Body->stkCallback->ResultCode;
        if($resultCode==0){
//insert to db
$stmt=$connection->prepare("INSERT INTO tbl_booking(ssid,destination,pickpoint,phone)VALUES(?,?,?,?)");
$stmt->bind_param("ssss",$ssid,$destination,$pickpoint,$phone);
if(!$stmt->execute()){
 return   $output="Booking failed";
}else{
  return  $output="Booking success";
}
        }
    }