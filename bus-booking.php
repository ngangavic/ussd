<?php
/******Bus booking ussd systsem******/
require "connection.php";

$phone=$_GET['phonenumber'];
$text=$_GET['text'];

switch($text){
case "":
$output="Welcome to MOBILE BUS BOOKING\n";
$output .="1. Book bus\n";
$output .="2. Check bus";
break;
case "*1":
$output="Select your destination\n";
$output .="1. Mombasa\n";
$output .="2. Nairobi\n";
$output .="3. Kisumu";
break;
case "*2":
$output="Check bus availability\n";
$output .="1. Mombasa\n";
$output .="2. Nairobi\n";
$output .="3. Kisumu";
break;
//[START] destination mombasa
case "*1*1":
$output ="Select pick point\n";
$output .="1. Nairobi\n";
$output .="2. Kisumu\n";
break;
//from nairobi
case "*1*1*1":
$output ="Fare from Nairobi to Mombasa is 1400\n";
$output.="1.Complete\n";
$output.="2.Cancel";
break;
//from kisumu
case "*1*1*2":
$output ="Fare from Kisumu to Mombasa is 2200\n";
$output .="1.Complete\n";
$output .="2.Cancel";
break;
//insert data nairobi mombasa
case "*1*1*1*1":
$output= book_bus("Mombasa","Nairobi",$phone,$connection);
break;
//insert data kisumu mombasa
case "*1*1*2*1":
$output=book_bus("Mombasa","Kisumu",$phone,$connection);
break;
//cancel 
case "*1*1*1*2":
$output="Booking cancelled.";
break;
case "*1*1*2*2":
$output="Booking cancelled.";
break;
//[END] destination mombasa
}


echo $output;

function book_bus($destination,$pickpoint,$phone,$connection){
$stmt=$connection->prepare("INSERT INTO tbl_booking(destination,pickpoint,phone)VALUES(?,?,?)");
$stmt->bind_param("sss",$destination,$pickpoint,$phone);
if(!$stmt->execute()){
 return   $output="Booking failed";
}else{
  return  $output="Booking success";
}
}

?>