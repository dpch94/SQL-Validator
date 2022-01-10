<?php

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
            <li><a href="#">Documents</a></li>
            <li><a href="#">Tutorial</a></li>
            <li><a href="#">Download</a></li>
            <li><a href="#">GoogleDrive</a></li>
            <li><a href="#">Zoom</a></li>
            <li><a href="#">GitHub</a></li>
            <li><a href="#"><i class="fas fa-search"></i></a></li>            
            
        </ul>
    </header>


    <div class="container mt-5">

            <?php foreach($query as $q){?>
                <div class="bg-dark p-5 rounded-lg text-white text-center">
                    <h1><?php echo $q['subject'];?></h1>

                    <div>
                        <a href="edit.php?id=<?php echo $q['id']?>" class="btn btn-outline-dark my-3" name="edit">Edit</a>
                        
                        <form method="POST">
                            <input type="text" hidden value='<?php echo $q['id']?>' name="id">
                            <button class="btn btn-danger btn-sm ml-2" name="delete">Delete</button>

                            
                        </form>
                    </div>

                </div>
                <p class="mt-5 border-left border-dark pl-3"><?php echo $q['description'];?></p>
            <?php } ?>    
        
        
        
        
   </div>


<!-- footer -->
    <!--
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
            -->

<!-- //footer -->



<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<!--script src="js/scripts.js"></script>-->



</body>
</html>