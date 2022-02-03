<?php

$conn = mysqli_connect('localhost','root','','bloggingdb');

if (!$conn){
    die("Connection failed: ".mysqli_connect_error());
}
?>