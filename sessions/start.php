<?php 
/****
 * application starts here
 * check if phone number is given
 * verify phone number
 * set sessions i.e. id & phone
 * ****/
session_start();

if(isset($_GET['phonenumber'])&&!empty($_GET['phonenumber'])){
$phone=$_GET['phonenumber'];

if(verifyPhone($phone)){
    $_SESSION['id']=md5($phone);
    $_SESSION['phone']=$phone;
    
    header("location: main.php");
}else{
    echo 'Invalid phone number';
}

}else{
    echo 'Application error';
}

function verifyPhone($phone){
if(strlen($phone)>=10)
  return true;
else
  return false;
}

