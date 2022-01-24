<?php

$conn = mysqli_connect('localhost','root','','blogdb');

if (!$conn){
    die("Connection failed: ".mysqli_connect_error());
}
?>