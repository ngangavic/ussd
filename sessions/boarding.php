<?php 

function boarding($code){
switch($code){
case 1:
$output="Choose dropping point.</br>";
$output.="1. Nairobi</br>";
$output.="2. Kisumu";
echo $output;
break;
case 2:
header("location:main.php?code=2");
break;
case 3:
header("location:main.php?code=3");
break;
default:
echo $output='Application error';
break;
}
}