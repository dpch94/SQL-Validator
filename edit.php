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
        <!-- <i class="fa fa-bars menu-toggle"></i>
        <ul class="nav" align-content: center;>
            <li><a href="index.php">Home</a></li> 
            <li><a href="#">Documents</a></li>
            <li><a href="#">Tutorial</a></li>
            <!-- <li><a href="#">Download</a></li> -->
            <!-- <li><button class="download-btn">Download</button></li>
            <li><a href="#">GoogleDrive</a></li>
            <li><a href="#">Zoom</a></li>
            <li><a href="#">GitHub</a></li>
                       
            
        </ul> -->
    
    </header>

    <div class="page-wrapper">
        <div class="container mt-5">
            <?php foreach($query as $q){?>
                <form method="GET">
                    <input type="text" hidden name="id" style="border:1px solid blue; margin:60px;"value="<?php echo $q['id'];?>">
                    <input type="text" name="subject" placeholder="Blog Subject" class="form-control bg-dark text-white my-3" style="margin:60px 20px; width:60%; height: 60px; font-size: 1.5em;" value="<?php echo $q['subject']?>">
                    <textarea name="description" class="form-control bg-dark text-white my-3" style="margin:20px 20px; width:60%; height: 450px; font-size: 1.3em;"><?php echo $q['description']?></textarea>
                    <!-- <textarea name="description" class="form"><?php echo $q['description']?></textarea> -->
                    <button name="update" class="btn btn-dark" style=" position:absolute ; left:1300px; bottom:100px; text-align:center; width: 140px; height: 40px;">Update</button>
                    
                    <button formaction="index.php" class="btn btn-dark" style=" position:absolute ; left:1300px; bottom:40px; text-align:center; width: 140px; height: 40px;">Cancel</button>

                </form>
            <?php }?> 
        </div>          
    </div>

           
        


<!-- <div class="page-wrapper">
    <div class="EDIT-content">
        <form method="POST">
            <input type="text" hidden value='<?php echo $q['id']?>' name="id">
            <input type="text" placeholder="Blog Title" class="text-input" name="subject" value="<?php echo $q['subject']?>">
            <textarea name="description" class="createpost-input" cols="30" rows="10"><?php echo $q['description']?></textarea>

            <!-- <div class="msg">
                <li>Subject required</li>
            </div> -->

            <!-- <div>
                <button type="update" name="update"class="btn btn-edit">Update</button>
            </div>
            
        </form>
    </div>
</div> -->



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