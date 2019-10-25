<?php
$username="root";
$password="";
$host="localhost";
$database="ussd";

$connection=mysqli_connect($host,$username,$password,$database);
if(!$connection){
echo "Connection failed";
}