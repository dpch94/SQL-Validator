<?php
    date_default_timezone_set('Europe/Copenhagen');
    include 'comments.inc.php';
    include 'db8.inc.php';
    include 'logic.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<link href="https://fonts.googleapis.com/css2?family=Candal&family=Lora&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Candal&family=DM+Serif+Display&family=Inria+Serif:wght@700&family=Lato:ital,wght@0,300;0,400;0,700;0,900;1,300&family=Lora&family=Merriweather:ital,wght@0,300;0,400;0,700;1,400&family=Montserrat:wght@300;400;600&family=PT+Serif:wght@700&family=Roboto+Serif&display=swap" rel="stylesheet">
    

<link rel ="stylesheet" href="CSS/style.css">
</head>

<body class="concenter" style =" background: #a8c4c4;">
<div class="concenter">
    <header>
            <div class="logo">
                <h1 class="logo-text"style="text-align:center">Blog and Learn</h1>
            </div>
            <i class="fa fa-bars menu-toggle"></i>
            <ul class="nav" align-content: center;>
                <li><a href="index.php">Home</a></li>

                <li><a href="https://docs.google.com/document/d/17_ZMhns8wg6_umKgsxu9fja6OWFL9CenwSApa6GW8qw/edit?usp=sharing" target="_blank">Tutorial</a></li>            
                <li><a href="profile.php">Profile</a></li>




            </ul>
    </header>

        <div class="page-wrapper">


        </div>

        <?php
        $conn = mysqli_connect("localhost", "root", "", "bloggingdb");
        $cid = (int) $_POST['cid'];
        $uid = (int) $_POST['uid'];
        $date = $_POST['date'];
        $cname = $_POST['cname'];
        $message = $_POST['message'];

        echo "<form method='POST' action='".editComments($conn)."'>
            <input type='hidden' name='cid' value='".$cid."'>    
            <input type='hidden' name='uid' value='".$uid."'>
            <input type='hidden' name='date' value='".$date."'>  
            <textarea name='message' style='margin:100px 20px; width:60%; height: 120px; font-size: 1.3em;'>".$message."</textarea><br>
            <button  class='btn btn-outline-dark my-3' type='submit' style= 'position:absolute; text-align:center; width: 140px; height: 40px; left:20px;'name='commentEdit'>Save</button>
        </form>";

        ?>


</div>
</body>
</html>

<script src="https://kit.fontawesome.com/f6154e7f2f.js" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<!-- <script src="js/scripts.js"></script> -->
