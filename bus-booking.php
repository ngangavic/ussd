<?php
/******Bus booking ussd systsem******/
session_start();
require "connection.php"; 
require "stk-push.php";


if(isset($_GET['phonenumber'])){
$phone=$_GET['phonenumber'];
$text=$_GET['text'];

$_SESSION['id']=md5($phone);
$_SESSION['phone']=$phone;

if(isset($_SESSION['id'])&&isset($_SESSION['phone'])){

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
//$output= book_bus("Mombasa","Nairobi",$phone,$connection);
$output=stkpush("Mombasa","Nairobi",$phone,$connection,"1400");
break;
//insert data kisumu mombasa
case "*1*1*2*1":
//$output=book_bus("Mombasa","Kisumu",$phone,$connection);
$output=stkpush("Mombasa","Kisumu",$phone,$connection,"2200");
break;
//cancel 
case "*1*1*1*2":
$output="Booking cancelled.";
break;
case "*1*1*2*2":
$output="Booking cancelled.";
break;
//[END] destination mombasa

//[START] destination nairobi
case "*1*2":
$output ="Select pick point\n";
$output .="1. Mombasa\n";
$output .="2. Kisumu\n";
break;
//from mombasa
case "*1*2*1":
$output ="Fare from Mombasa to Nairobi is 1400\n";
$output.="1.Complete\n";
$output.="2.Cancel";
break;
//from kisumu
case "*1*2*2":
$output ="Fare from Kisumu to Nairobi is 1200\n";
$output .="1.Complete\n";
$output .="2.Cancel";
break;
//insert data mombasa nairobi
case "*1*2*1*1":
//$output= book_bus("Nairobi","Mombasa",$phone,$connection);
$output=stkpush("Nairobi","Mombasa",$phone,$connection,"1400");
break;
//insert data kisumu nairobi
case "*1*2*2*1":
//$output=book_bus("Nairobi","Kisumu",$phone,$connection);
$output=stkpush("Nairobi","Kisumu",$phone,$connection,"1200");
break;
//cancel 
case "*1*2*1*2":
$output="Booking cancelled.";
break;
case "*1*2*2*2":
$output="Booking cancelled.";
break;
//[END] destination nairobi

//[START] destination kisumu
case "*1*3":
$output ="Select pick point\n";
$output .="1. Nairobi\n";
$output .="2. Mombasa\n";
break;
//from nairobi
case "*1*3*1":
$output ="Fare from Nairobi to Kisumu is 1200\n";
$output.="1.Complete\n";
$output.="2.Cancel";
break;
//from kisumu
case "*1*3*2":
$output ="Fare from Mombasa to Kisumu is 2200\n";
$output .="1.Complete\n";
$output .="2.Cancel";
break;
//insert data nairobi kisumu
case "*1*3*1*1":
//$output= book_bus("Kisumu","Nairobi",$phone,$connection);
$output=stkpush("Kisumu","Nairobi",$phone,$connection,"1200");
break;
//insert data mombasa kisumu
case "*1*3*2*1":
//$output=book_bus("Kisumu","Mombasa",$phone,$connection);
$output=stkpush("Kisumu","Mombasa",$phone,$connection,"2200");
break;
//cancel 
case "*1*3*1*2":
$output="Booking cancelled.";
break;
case "*1*3*2*2":
$output="Booking cancelled.";
break;

//[END] destination kisumu
}
}else{
    $output="Application error.";
}}else{
    $output="Please provide a phonenumber";
}


echo $output;

// function book_bus($destination,$pickpoint,$phone,$connection){
// $stmt=$connection->prepare("INSERT INTO tbl_booking(destination,pickpoint,phone)VALUES(?,?,?)");
// $stmt->bind_param("sss",$destination,$pickpoint,$phone);
// if(!$stmt->execute()){
//  return   $output="Booking failed";
// }else{
//   return  $output="Booking success";
// }
// }

?>