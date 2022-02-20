<?php

if(array_key_exists('createDB', $_POST)) {
    createDB();
}
else if(array_key_exists('createTables', $_POST)) {
    createTables();
}
// else if(array_key_exists('dropDB', $_POST)) {
//     dropDB();
// }


//Creating a connection
function createDB()
{
    $con = mysqli_connect("localhost", "root", "");
    $success = mysqli_query($con, "CREATE DATABASE IF NOT EXISTS bloggingdb");


    echo "Database created successfully\n";

    //Closing the connection
    mysqli_close($con);
}

function createTables()
{
    $con = mysqli_connect("localhost", "root", "", "bloggingdb");
    mysqli_query($con, "CREATE TABLE IF NOT EXISTS comments(
                                `cid` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
                                `uid` int(11) NOT NULL,
                                `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                                `cname` varchar(255) NOT NULL,
                                `message` text NOT NULL )");


    mysqli_query($con, "CREATE TABLE IF NOT EXISTS data(
                                `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
                                `created_by` varchar(255) NOT NULL,
                                `subject` varchar(255) NOT NULL,
                                `description` longblob NOT NULL,
                                `image` longblob NOT NULL,
                                `created_at` datetime NOT NULL DEFAULT current_timestamp(),
                                `upvotes` int(11) NULL,
                                `ratename` varchar(255) NOT NULL,
                                `rating` float DEFAULT 0 )");


    mysqli_query($con, "CREATE TABLE IF NOT EXISTS users(
                                `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
                                `profile_image` varchar(255) NOT NULL,
                                `bio` text NOT NULL )");





    //Closing the connection
    mysqli_close($con);
}

//Creating a connection
// function dropDB()
// {
//     //Creating a connection
//     $con = mysqli_connect("localhost", "root", "");

//     if(! $con ) {
//         die('Could not connect: ' . mysqli_error());
//     }

//     $sql = 'DROP DATABASE bloggingdb';
//     $retval = mysqli_query($con,$sql);

//     if(! $retval ) {
//         die('Could not delete database db_test: ' . mysqli_error());
//     }

//     echo "Database deleted successfully\n";

//     mysqli_close($con);
// }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Candal&family=Lora&display=swap" rel="stylesheet">

    <link rel ="stylesheet" href="CSS/style.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.css">
    <title>Blog and Learn</title>

    
    
</head>

<body  style ="  background: #517e80;">
<div class="concenter">


    <header>
        <div class="logo">
            <h1 class="logo-text"style="text-align:center">Blog and Learn</h1>
        </div>
        <i class="fa fa-bars menu-toggle"></i>
        <ul class="nav" align-content: center;>
            <li><a href="home.php">Database</a></li>


            <li><a href="index.php">Home</a></li> 
            
            <li><a href="https://docs.google.com/document/d/17_ZMhns8wg6_umKgsxu9fja6OWFL9CenwSApa6GW8qw/edit?usp=sharing" target="_blank">Tutorial</a></li>
                      
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

            <!-- <form method="post">
            <h2>DB Deletion</h2>
            <div>
                <input type="submit" name="dropDB" class="btn btn-outline-dark my-3" value="Drop DB" style="font-size: 20px"/>
            </div>
            <br>
            <br>
            </form> -->
    
</div>     
   
</body>        
</html>
<script src="https://kit.fontawesome.com/f6154e7f2f.js" crossorigin="anonymous"></script>
<link href="https://fonts.googleapis.com/css2?family=Candal&family=DM+Serif+Display&family=Inria+Serif:wght@700&family=Lato:ital,wght@0,300;0,400;0,700;0,900;1,300&family=Lora&family=Merriweather:ital,wght@0,300;0,400;0,700;1,400&family=Montserrat:wght@300;400;600&family=PT+Serif:wght@700&family=Roboto+Serif&display=swap" rel="stylesheet">
    
