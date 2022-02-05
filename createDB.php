<?php
include 'logic.php';
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Candal&family=Lora&display=swap" rel="stylesheet">
    <link rel ="stylesheet" href="css/style.css">
</head>

<body>
<div class="concenter">
    <header>

        <div class="logo">
            <h1 class="logo-text"style="text-align:center">Blog and Learn</h1>
        </div>
        <i class="fa fa-bars menu-toggle"></i>
        <ul class="nav" align-content: center;>
            <li><a href="index.php">Home</a></li>

            <li><a href="https://docs.google.com/document/d/17_ZMhns8wg6_umKgsxu9fja6OWFL9CenwSApa6GW8qw/edit?usp=sharing" target="_blank">Tutorial</a></li>
            <!-- <li><a href="#">Download</a></li> -->
            <li><button class="download-btn">Download</button></li>
            <li><a href="profile.php">Profile</a></li>

        </ul>
    </header>
    <br>
    <br>
    <br>
    <br>
    <h2>DB Creation </h2>
            <form method="post">

                <div>
                    <input type="submit" name="createDB" class="btn btn-outline-dark my-3" value="Create DB"  style="font-size: 20px"/>
                </div>
                <br>
                <br>
            </form>

            <form method="post">
                <h2> Table Creation</h2>
                <div>
                    <input type="submit" name="createTables" class="btn btn-outline-dark my-3" value="Create Tables" style="font-size: 20px" />
                </div>
                <br>
                <br>
            </form>

<form method="post">
   <h2>DB Deletion</h2>
   <div>
       <input type="submit" name="dropDB" class="btn btn-outline-dark my-3" value="Drop DB" style="font-size: 20px"/>
   </div>
   <br>
   <br>
</form>




</div>
</body>
</html>