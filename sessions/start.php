<?php 
/****
 * application starts here
 * check if phone number is given
 * import the database connection
 * set sessions i.e. id & phone
 * ****/
session_start();
require "../connection.php";

if(isset($_GET['phonenumber'])&&!empty($_GET['phonenumber'])){
$phone=$_GET['phonenumber'];

$_SESSION['id']=md5($phone);
$_SESSION['phone']=$phone;

header("location: main.php");

}else{
    echo 'Application error';
}

