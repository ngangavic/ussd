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
case "*1*1":
$output ="Select pick point\n";
$output .="1. Nairobi\n";
$output .="2. Kisumu\n";
break;
case "*1*1*1":
$output ="Fare from Nairobi to Mombasa is 1400\n";
$output.="1.Complete\n";
$output.="2.Cancel";
break;
case "*1*1*1*1":
$output= book_bus("Mombasa","Nairobi",$phone,$connection);
break;
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