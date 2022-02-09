<?php
include 'logic.php';

?>
<?php
$posts = array();
$postsTitle = 'Searched Posts';
//searching
if (isset($POST['subject'])) {
    $posts = getPostsById($POST['subject']);
    $postsTitle = "You searched for posts under '" . $_POST['subject'] . "'";
} else if (isset($_POST['search-term'])) {
    $postsTitle = "You searched for '" . $_POST['search-term'] . "'";
    $posts = searchPosts($_POST['search-term']);
} else {
    $posts = getPosts($POST['description']);
}
$conn = mysqli_connect("localhost", "root", "", "bloggingdb");

if (isset($_POST['add']))
    {
        $id = (int) $_POST['id'];
        $rid = (int) $_POST['rid'];
        
        $name = $_POST['name'];
        $rating = $_POST['rating'];

        $sql = "UPDATE data SET rid = id, ratename = '$name', rating = '$rating' WHERE rid=$rid";
        if (mysqli_query($conn, $sql))
        {
            echo "New Rating added successfully";
            header("Location: index.php");
        }
        
        else if (!mysqli_query($conn, $sql)){
            
            $sqlu = "UPDATE data SET ratename = '$name', rating ='$rating' WHERE rid=$rid";
            mysqli_query($conn, $sqlu);
            
            header("Location: index.php");
        }
        else
        {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
       
    }

            



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

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.css">
    
    <title>Blog and Learn</title>

    
    
</head>

<body>
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
            
            <!-- <li><a href="#"class="downloadaspdf">Download</a></li> -->
            <li><button class="download-btn">Download</button></li> 
            <li><a href="profile.php">Profile</a></li>
            

              
        </ul>
        
    </header>
        <br>
        <br>
        <br>

        <div class="blog-alert">

            <!-- Display any info -->
            <?php if(isset($_REQUEST['info'])){?>
                <?php if($_REQUEST['info'] == "added"){?>
                    <div class="alert-alert-success" role="alert" style="width: 680px; height: 80px;">
                        <p>Post has been added successfully at <span id="date-time"></span>.</p>
                    </div>
                <?php }else if ($_REQUEST['info'] == "updated"){ ?>
                    <div class="alert-alert-success" role="alert" style="width: 680px; height: 80px;">
                        <p>Post has been edited successfully at <span id="date-time"></span>.</p>
                    </div>
                <?php }else if ($_REQUEST['info'] == "deleted"){ ?>
                    <div class="alert alert-caution" role="alert" style="width: 680px; height: 80px;">
                        <p>Post has been deleted successfully at <span id="date-time"></span>.</p>
                    </div>
                <?php }?>      
            <?php }?>
        </div>
        <br>
        <br>

         
        <!-- Search posts -->
        <div class="sidebar">
            <div class="section search">
                    
                <form action="index.php" method="post">
                    <input type="text" name="search-term" class="textsubject-input" placeholder="Search" style="margin:30px 2px;">
                </form>
            </div>

        <!-- Page Wrapper -->
        <div class="page-wrapper">

        <!-- Post Slider -->
            <div class="post-slider">
                <h1 class="slider-title">Searched Posts</h1>
                    <!-- <i class="fas fa-chevron-left prev"></i>
                    <i class="fas fa-chevron-right next"></i> -->

                    <div class="post-wrapper">

                        <?php foreach ($posts as $post): ?>
                            <div class="post">
                
                                <div class="post-info">
                                    <h4><a href="view.php?id=<?php echo $post['id']; ?>"><?php echo $post['subject']; ?></a></h4>

                                    <p class="card-text" style="padding:5px;"><?php echo "Created By ".$post['created_by']; ?></p>
                                    <p class="card-text" style="padding:5px;"><?php echo $post['description'];?></p>
                                    
                                    <i class="far fa-calendar"> <?php echo date('F j, Y H:i', strtotime($post['created_at'])); ?></i>
                                </div>
                            </div>
                        <?php endforeach; ?>  
                    </div>  
            </div>            

            
            
        </div>

        <!-- Create Post button -->
        <div class="page-wrapper">
            <div class="create">
                <div class="create-post">
                    <!-- <h1 class="create-post-text">Create Post</h1> -->
                    <h1><a href="createpost.php">Create Post</a></h1>
                </div>                
            </div>
            <div style="margin:60px 30px;">
                <h1>Recent Posts</h1>                
            </div>
        <!-- Display posts from database -->
        <div class ="container">
            <div class="row">
               
                    <?php foreach($query as $q){ ?>
                   

                            <div class="card text-white bg-dark mt-5" style=" position: relative; padding:5px; width:90%; margin:10px;">
                                <div class="card-body" style=" border:1px solid #005255;width:60%; margin:20px; height:180px; line-height: 1.1rem; border-radius: 15px;">
                                    <h5 class="card-title" style="padding:5px; font-size: 1.3em;"><?php echo $q['subject'];?></h5>
                                    <h5 class="card-title" style="padding:5px; font-size: 1.3em;"><?php echo "Created By ".$q['created_by'];?></h5>
                                    <p class="card-text" style="padding:5px;"><?php echo substr($q['description'], 0, 100);?>...</p>
                                    <a href="view.php?id=<?php echo $q['id']?>" class="btn btn-light">Read More <span class="text-more">&rarr;</span></a>
                                    <i class="card-text"  style="padding:5px;"><?php echo "Created at ", date('F j, Y H:i', strtotime($q['created_at']));?></i>
                                    <br>
                                </div>
                            </div>


                                <div class="container">
                                    <div class="row" style="position: relative; left:20px; width:30%;">
                                        
                                            <form action="" method="POST">



                                                    <div class="rateyo" id= "rating"
                                                        data-rateyo-rating="3"
                                                        data-rateyo-num-stars="5"
                                                        data-rateyo-score="3">
                                                    </div>
                                                        <div>
                                                            <span class='result'>3</span>
                                                            <input type="hidden" name="rating">

                                                        </div>
                                                        <div>
                                                            <label>Tutor's Name and Feedback</label>
                                                            <input type="text" name="name" size="20">
                                                        </div>

                                                        <div>

                                                            <button name="add" type="submit" class="btn btn-dark">Rate</button>
                                                        </div>

                                                        

                                                        <h5 class="card-title" style="padding:5px; font-size: 1.3em;"><?php echo "Rating given by Tutor ".$q['ratename'].": " .$q['rating'];?></h5>
                                                        
                                                        <!-- <hr style="width:200%;text-align:left;margin-left:0"> -->

                                            </form>
                                        
                                    </div>
                                </div>
                            
                                                



                        </div>
               
                
                            
                    <?php }?>
            </div>
        </div>
        </div>
    
</div>
        
        


                       
    <!-- footer -->
    
    <!-- <div class="footer">
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
    </div> -->
           
    <!-- //footer -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="js/scripts.js"></script>
    <script>
    var dt = new Date();
    document.getElementById('date-time').innerHTML=dt;
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.js"></script>
    
    <script>
    
    
        $(function () {
            $(".rateyo").rateYo({halfStar: true}).on("rateyo.change", function (e, data) {
                
                
                var rating = data.rating;
                
                
                $(this).parent().find('.score').text('score :'+ $(this).attr('data-rateyo-score'));
                $(this).parent().find('.result').text('rating :'+ rating);
                $(this).parent().find('input[name=rating]').val(rating); //add rating value to input field
                
            });
        });
    
    </script>

</body>
</html>

