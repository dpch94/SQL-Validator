<?php
include 'logic.php';
?>
<?php
$posts = array();
$postsTitle = 'Searched Posts';
//searching
if (isset($_POST['subject'])) {
    $posts = getPostsById($_POST['subject']);
    $postsTitle = "You searched for posts under '" . $_POST['subject'] . "'";
} else if (isset($_POST['search-term'])) {
    $postsTitle = "You searched for '" . $_POST['search-term'] . "'";
    $posts = searchPosts($_POST['search-term']);
} else {
    $posts = getPosts($_POST['description']);
}
$conn = mysqli_connect("localhost", "root", "", "bloggingdb");

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://fonts.googleapis.com/css2?family=Candal&family=Lora&display=swap" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css2?family=Candal&family=DM+Serif+Display&family=Inria+Serif:wght@700&family=Lato:ital,wght@0,300;0,400;0,700;0,900;1,300&family=Lora&family=Merriweather:ital,wght@0,300;0,400;0,700;1,400&family=Montserrat:wght@300;400;600&family=PT+Serif:wght@700&family=Roboto+Serif&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <link rel="stylesheet" href="CSS/style.css">
    <title>Blog and Learn</title>

    
</head>

<body>
    <div class="concenter">
        <div class="container">


            <header>
                <div class="logo">
                    <h1 class="logo-text" style="text-align:center">Blog and Learn</h1>
                </div>
                <i class="fa fa-bars menu-toggle"></i>
                <ul class="nav" align-content: center;>
                    <li><a href="home.php">Database</a></li>
                    <li><a href="index.php">Home</a></li>

                    <li><a href="https://docs.google.com/document/d/17_ZMhns8wg6_umKgsxu9fja6OWFL9CenwSApa6GW8qw/edit?usp=sharing"
                            target="_blank">Tutorial</a></li>

                    <li><a href="profile.php">Profile</a></li>

        </ul>

        </header>
        <br>
        <br>
        <br>




        <!-- Search posts -->
        <div class="sidebar">
            <div class="section search">

                <form action="index.php" method="post">
                    <input type="text" name="search-term" class="textsubject-input" placeholder="Search"
                        style="margin:30px 2px;">
                </form>
            </div>

            <!-- Page Wrapper -->
            <div class="page-wrapper">

                <!-- Post Slider -->
                <div class="post-slider">
                    <h1 class="slider-title">Searched Posts</h1>               

                    <div class="post-wrapper">

                        <?php foreach ($posts as $post): ?>
                        <div class="post">

                            <div class="post-info">
                                <h4><a href="view.php?id=<?php echo $post['id']; ?>"><?php echo $post['subject']; ?></a>
                                </h4>

                                <p class="card-text" style="padding:5px;">
                                    <?php echo "Created By ".$post['created_by']; ?></p>
                                <p class="card-text" style="padding:5px;"><?php echo $post['description'];?></p>

                                <i class="far fa-calendar">
                                    <?php echo date('F j, Y H:i', strtotime($post['created_at'])); ?></i>
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
                <div style="margin:60px 30px; font-weight: bold;">
                    <h1>Recent Posts</h1>
                </div>
                <!-- Display posts from database -->
                <div class="container">
                    <div class="row">

                        <?php foreach($query as $q){ ?>

                        <div class="col-6">
                            <div class>
                                <div class="card-body"
                                    style=" border:1px solid #005255; margin:5px; line-height: 1.8rem; border-radius: 15px;">
                                    <h5 class="card-title" style="padding:1px; font-size: 1.6em; font-weight: bold; background: #0b2829; color:white;">
                                        <?php echo $q['subject'];?></h5>
                                    <h5 class="card-title" style="padding:5px; font-size: 1.3em;background: #005255; color:white;">
                                        <?php echo "Created By ".$q['created_by'];?></h5>
                                    <p class="card-text" style="padding:5px; font-size: 1.4em;">
                                        <?php echo substr($q['description'], 0, 100);?>...</p>
                                    <a href="view.php?id=<?php echo $q['id']?>" class="btn btn-light">Read More
                                        <span class="text-more">&rarr;</span></a>
                                    <i class="card-text"
                                        style="padding:5px;"><?php echo "Created at ", date('F j, Y H:i', strtotime($q['created_at']));?></i>
                                    <br>
                                </div>
                            </div>


                            <div class="container">
                                <div class="row">

                                    <form action="" method="POST">
                                        <input type="hidden" name="id" value="<?php echo $q['id']; ?>">
                                        <div class="rateyo" style="margin:5px;" id="rating" data-rateyo-rating="3"
                                            data-rateyo-num-stars="5" data-rateyo-score="3">
                                        </div>
                                        <div style="margin:5px;">
                                            <span class='result'>3</span>
                                            <input type="hidden" name="rating">

                                        </div>

                                        <div style="margin:15px; font-size: 1.3em;">
                                            <label>Tutor's Name and Feedback</label>
                                            <input type="text" name="name" size="20">
                                        </div>


                                        <div>

                                            <button name="add" type="submit" class="btn btn-dark">Rate</button>
                                        </div>

                                        <h5 class="card-title" style="margin:5px; padding:5px; font-size: 1.3em;">
                                            <?php echo "Rating given by Tutor ".$q['ratename'].": " .$q['rating'];?>
                                        </h5>
                                        

                                    </form>

                                </div>
                            </div>

                        </div>



                        <?php }?>
                    </div>
                </div>
            </div>
                <!-- footer -->
            <div class="footer">
                <div class="footer-content">
                    <div class="footer-section about">
                        <h2 class="logo-text">Learn and Blog</h2>
                        <h3>This blog is a project for our Master studies at Otto-von-Guericke Univerty Magdeburg offered by Computer Science Department.</h3>

                    </div>
                    <div class="footer-section contact-form" >
                        <h2>Contact us at    </h2> 
                        <h3><i class="fas fa-phone"></i> :  123-432-546</h3>          
                        <h3><i class="fas fa-envelope"></i>   :  contact.team03@gmail.com </h3> 

                                  
                    </div>
                </div>

                <div class="footer-bottom">
                    Blog Developed by Team 03
                </div>
            </div>
    <!-- //footer -->
        </div>
    </div>
    
</body>

</html>

    <script src="https://kit.fontawesome.com/f6154e7f2f.js" crossorigin="anonymous"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
        integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- <script src="js/scripts.js"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.js"></script>

    <script>
    $(function() {
        $(".rateyo").rateYo({
            halfStar: true
        }).on("rateyo.change", function(e, data) {


            var rating = data.rating;


            $(this).parent().find('.score').text('score :' + $(this).attr('data-rateyo-score'));
            $(this).parent().find('.result').text('rating :' + rating);
            $(this).parent().find('input[name=rating]').val(
                rating); //add rating value to input field

        });
    });
    </script>