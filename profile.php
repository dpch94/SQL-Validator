<?php include 'userform.php' ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Image Preview and Upload</title>
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0/css/bootstrap.min.css" />
  <link rel="stylesheet" href="CSS/style.css">
</head>
<body class="concenter" style =" background: #a8c4c4;">

<div class="concenter">
      <div class="blog-alert">
        <!-- Display any info -->
        <?php if(isset($_REQUEST['info'])){?>
                    <?php if($_REQUEST['info'] == "deleted"){?>
                        <div class="alert-alert-success" role="alert" style="width: 680px; height: 80px;">
                            <p>Profile has been deleted successfully.</p>
                        </div>
                    <?php }?>
        <?php }?>
      </div>

      <div class="container">
        <div class="row">
          <div class="col-4 offset-md-4 form-div">
            <a href="users.php">View all profiles</a>
            <form action="profile.php" method="post" enctype="multipart/form-data">
              <h2 class="text-center mb-3 mt-3">Add user profile</h2>
              <?php if (!empty($msg)): ?>
                <div class="alert <?php echo $msg_class ?>" role="alert">
                  <?php echo $msg; ?>
                </div>
              <?php endif; ?>
              <div class="form-group text-center" style="position: relative;" >
                <span class="img-div">
                  <div class="text-center img-placeholder"  onclick="triggerClick()">
                    <h4>Update image</h4>
                  </div>
                  <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS5U9TSnZEl9VWr77TbG0AfzUB09d1pWTXx95sPlsgk8g8jJ1NTmrM5CNpXbkmBzjoEIAk&usqp=CAU"  onclick="triggerClick()" id="profileDisplay">
                </span>
                <input type="file" name="profileImage" onchange="displayImage(this)" id="profileImage" class="form-control" style="display: none;">
                <!-- <label>Profile Image</label> -->
              </div>

              <div class="form-group">
                <!-- <label>Bio</label> -->

                <textarea name="bio" class="form-control" placeholder="Describe about yourself and mention your course..."></textarea>
              </div>
              <div class="form-group">
                <button type="submit" name="save_profile" class="btn btn-primary btn-block">Save User</button>
                <button formaction="index.php" class="btn btn-primary btn-block">Home</button>
              </div>
            </form>
          </div>
        </div>
      </div>
</div>

</body>
</html>
<script src="js/scripts.js"></script>