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

<script src="https://kit.fontawesome.com/f6154e7f2f.js" crossorigin="anonymous"></script>

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

        <div class="page-wrapper">
            <div class="container mt-5">
                <?php foreach($query as $q){?>
                    <div class="bg-dark p-5 rounded-lg text-white text-center" style="border:1px solid white; margin:70px 40px; position:relative; width:80%;">
                        <h1><?php echo $q['subject'];?></h1>
                        <div class="bg-dark p-5 rounded-lg text-white text-center" style="border:1px solid white; margin:70px 40px; position:relative; width:80%;">
                            <h1><?php echo "Created By ".$q['created_by'];?></h1>

                        <div>
                            <p class="mt-5 border-left border-dark pl-3" style="border:1px solid #3a6e3a; border-radius: 20px; padding: 5px 15px; margin:60px 0px;  width: 80%; min-height: 300px;overflow: hidden"><?php echo $q['description'];?></p>
                            <?php
                            $conn = mysqli_connect("localhost", "root", "", "bloggingdb");
                                // $result = mysqli_query($conn, "SELECT image FROM data WHERE id = $id");

                                // Get image data from database to display image
                            $result = $conn->query("SELECT image FROM data WHERE id = $id");
                            $rows = $conn->query("SELECT COUNT(image) FROM data WHERE id = $id");
                            $row = mysqli_fetch_assoc($result);
                            if (!$row['image']){
                                echo "no image uploaded";

                            } else {
                            if($row['image']){
                                echo "<div class='gallery'>"; ?>
                                    <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($row['image']); ?>" class="imcenter" style="width:500px;height:300px"/>
                                          <?php
                                echo "</div>";
                                ?>

                            <?php    }?>

                            <?php } ?>









                            <a href="edit.php?id=<?php echo $q['id']?>" class="btn btn-outline-dark my-3" name="edit" style=" position:absolute; text-align:center; width: 140px; bottom:100px; height: 40px; left:500px;">Edit</a>


                            <!-- <form method="POST">
                                <input type="text" hidden value='<?php echo $q['id']?>' name="id" style="border:1px solid red; ">
                                <button class="btn btn-danger btn-sm ml-2" name="delete" style=" position:absolute ; left:1300px; bottom:40px; text-align:center; width: 140px; height: 40px;">Delete</button>
                            </form> -->

                            <form method="POST" onsubmit="return confirm('Are you sure you want to delete this Post?');">
                            <input type="hidden" name="_METHOD" value="DELETE">
                            <input type="hidden" name="id" value="<?php echo $q['id']; ?>">
                            <button  class="btn btn-danger btn-sm ml-2" type="submit" style=" position:absolute ; left:500px; bottom:40px; text-align:center; width: 140px; height: 40px;">Delete</button>
                            </form>
                        </div>
                        </div>
                    </div>




                <?php } ?>
            </div>
        </div>

        <?php


        echo "<form method='POST' action='".setComments($conn)."'>
            <input type='hidden' name='uid' value='$id'>
            <input type='hidden' name='date' value='".date('Y-m-d H:i:s')."'>
            <textarea name='message' style= 'width: 600px; height: 100px; margin-left:14px; resize=none; background-color: #fff;'></textarea><br>
            <button class='btn btn-outline-dark my-3' type='submit' style= 'position:absolute; text-align:center; width: 120px; height: 40px; left:490px;' ' name='commentSubmit'>Comment</button>
        </form>";





        // Create connection
        $conn = mysqli_connect("localhost", "root", "", "bloggingdb");
        // Check connection
        if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
        }

        $sql = "SELECT * FROM comments WHERE uid='$id'";
        $result = mysqli_query($conn, $sql);
        // View, Edit and Delete comments
        if (mysqli_num_rows($result) > 0) {

        // output data of each row
            while($row = mysqli_fetch_assoc($result)) {
                echo "<div class = 'comment-box'><p>";
                    // echo $row['uid']."<br>";
                    echo $row['date']."<br>";
                    echo nl2br($row['message']);
                echo "</p>   
                
                    <form class ='edit-form' method='POST' action ='editcomment.php'>
                        <input type='hidden' name='cid' value='".$row['cid']."'>   
                        <input type='hidden' name='uid' value='".$row['uid']."'>                
                        <input type='hidden' name='date' value='".$row['date']."'>   
                        <input type='hidden' name='message' value='".$row['message']."'>
                        <button>Edit</button>
                    </form>
    
                    <form class ='delete-form' method='POST' action ='".deleteComments($conn)."'>
                        <input type='hidden' name='cid' value='".$row['cid']."'>          
                        <button type ='submit' name='commentDelete'>Delete</button>
                    </form>
                </div>";


            }
        }else {
        echo "no comments";
        }

        mysqli_close($conn);
        ?>




    <!-- footer -->

<!--        <div class="footer">-->
<!--            <div class="footer-content">-->
<!--                <div class="footer-section about">-->
<!--                    <h2 class="logo-text">Learn and Blog</h2>-->
<!---->
<!--                </div>-->
<!--                <div class="footer-section contact-form" >-->
<!--                    <h2>Contact us   <i class="fas fa-envelope"></i>  contact.team03@gmail.com   </h2>-->
<!--                </div>-->
<!--            </div>-->
<!---->
<!--            <div class="footer-bottom">-->
<!--                Blog Developed by Team 3-->
<!--            </div>-->
<!--        </div>-->
</div>

<!-- //footer -->



<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script src="js/scripts.js"></script>



</body>
</html>