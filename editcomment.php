<?php
    date_default_timezone_set('Europe/Copenhagen');
    include 'comments.inc.php';
    include 'db8.inc.php';

    include "logic.php";

?>

<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<script src="https://kit.fontawesome.com/f6154e7f2f.js" crossorigin="anonymous"></script>

<link href="https://fonts.googleapis.com/css2?family=Candal&family=Lora&display=swap" rel="stylesheet">

<link rel ="stylesheet" href="css/style.css">
</head>

<body>
<header>
        <div class="logo">
            <h1 class="logo-text"style="text-align:center">Blog and Learn</h1>
        </div>
        <i class="fa fa-bars menu-toggle"></i>
        <ul class="nav" align-content: center;>
            <li><a href="index.php">Home</a></li> 
            
            <li><a href="#">Tutorial</a></li>
            <!-- <li><a href="#">Download</a></li> -->
            <li><button class="download-btn">Download</button></li>
            
            
                        
            
        </ul>
    </header>

    <div class="page-wrapper">

        
    </div>
    
    <?php
    $cid = $_POST['cid'];    
    $message = $_POST['message'];
    echo "<form method='POST' action='".editComments($conn)."'>
        <input type='hidden' name='cid' value='".$cid."'>        
        <textarea name='message'>".$message."</textarea><br>
        <button type='submit' name='commentSubmit'>Edit</button>
    </form>";
        
    ?>
  
    
    

    
<!-- footer -->
    
    <div class="footer">
        <div class="footer-content">
            <div class="footer-section about">
                <h2 class="logo-text">Learn and Blog</h2>

            </div>
            <div class="footer-section contact-form" >
                <h2>Contact us   <i class="fas fa-envelope"></i>   team03@gmail.com   </h2>                
            </div>
        </div>

        <div class="footer-bottom">
            Blog Developed by Team 3
        </div>
    </div>
           

<!-- //footer -->



<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script src="js/scripts.js"></script>



</body>
</html>