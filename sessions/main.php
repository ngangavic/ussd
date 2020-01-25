<?php
session_start();

require "mombasa.php";
require "kisumu.php";


if(isset($_GET['text'])&&!empty($_GET['text'])){
$code=$_GET['text'];

// if(checkText($code)){
switch($code){
    case "1":
    //msa
    // header("location: boarding.php?code=1");
    require "boarding.php";
     boarding("1");

    break;
    case "2":
    //kisumu
    break;
    case "3":
    //nairobi
    break;
    case "1*1":
    //dest Nairobi
    require "nairobi.php";
    // toNairobi();
    break;
    default:
    $output="Choose boarding point.</br>";
    $output.="1. Mombasa</br>";
    $output.="2. Nairobi</br>";
    $output.="3. Kisumu";
    echo $output;
}

// }else{
//     $output="Choose boarding point.</br>";
//     $output.="1. Mombasa</br>";
//     $output.="2. Nairobi</br>";
//     $output.="3. Kisumu";
//     echo $output;
// }

}else{
    $output="Choose boarding point.</br>";
    $output.="1. Mombasa</br>";
    $output.="2. Nairobi</br>";
    $output.="3. Kisumu";
    echo $output;
}

// function checkText($code){
//     return is_numeric($code);
// }