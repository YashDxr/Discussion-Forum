<?php

$server = 'localhost';
$username = 'root';
$password = '';
$database = 'discuss';

$connect = mysqli_connect($server,$username,$password,$database);

if(!$connect){
    die("Technical Issue");
}



?>