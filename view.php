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
        <div class="container mt-5">
            <?php foreach($query as $q){?>
                <div class="bg-dark p-5 rounded-lg text-white text-center" style="border:1px solid white; margin:70px 40px; position:relative; width:80%;">
                    <h1><?php echo $q['subject'];?></h1>
                    
                    <div>
                        <p class="mt-5 border-left border-dark pl-3" style="border:1px solid #3a6e3a; border-radius: 20px; padding: 5px 15px; margin:60px 0px;  width: 80%; min-height: 300px;overflow: hidden"><?php echo $q['description'];?></p>
                        <?php
                            $conn = mysqli_connect("localhost", "root", "", "blogdb");
                            // $result = mysqli_query($conn, "SELECT image FROM data WHERE id = $id");
                            
                            // Get image data from database 
                            $result = $conn->query("SELECT image FROM data WHERE id = $id"); 
                        ?>    
                        

                        
                        <?php if($result->num_rows > 0){ ?> 
                            <div class="gallery"> 
                                <?php while($row = $result->fetch_assoc()){ ?> 
                                    <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($row['image']); ?>" class="imcenter" style="width:500px;height:300px"/> 
                                <?php } ?> 
                            </div>
                        
                        <?php }
                        ?>
                        
                      
                        
                       
                                            
                            
                        
                                      
                        <a href="edit.php?id=<?php echo $q['id']?>" class="btn btn-outline-dark my-3" name="edit" style=" position:absolute; text-align:center; width: 140px; bottom:100px; height: 40px; left:1300px;">Edit</a>                        
                        

                        <!-- <form method="POST">
                            <input type="text" hidden value='<?php echo $q['id']?>' name="id" style="border:1px solid red; ">
                            <button class="btn btn-danger btn-sm ml-2" name="delete" style=" position:absolute ; left:1300px; bottom:40px; text-align:center; width: 140px; height: 40px;">Delete</button>                            
                        </form> -->

                        <form method="POST" onsubmit="return confirm('Are you sure you want to delete this Post?');">
                        <input type="hidden" name="_METHOD" value="DELETE">
                        <input type="hidden" name="id" value="<?php echo $q['id']; ?>">
                        <button  class="btn btn-danger btn-sm ml-2" type="submit" style=" position:absolute ; left:1300px; bottom:40px; text-align:center; width: 140px; height: 40px;">Delete</button>
                        </form>
                    </div>
                </div>
                
                
                
                
            <?php } ?>        
        </div>
    </div>
    <?php
    echo "<form method='POST' action='".getComments($conn)."' style='width: 20%; margin:20px;'>
    </form>"; 

    ?>
    <?php
    echo "<form method='POST' action='".setComments($conn)."'>
        <input type='hidden' name='uid' value='Anonymous'>
        <input type='hidden' name='date' value='".date('Y-m-d H:i:s')."'>
        <textarea name='message' style= 'width: 840px; height: 150px; resize=none; background-color: #fff;'></textarea><br>
        <button type='submit' style= 'width: 100px; height: 40px; border=none; color:#fff; background-color: #282828; font-family:arial; cursor:pointer;' name='commentSubmit'>Comment</button>
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