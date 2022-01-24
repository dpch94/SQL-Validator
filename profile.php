<?php include_once('userform.php') ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Image Preview and Upload</title>
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0/css/bootstrap.min.css" />
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
  <div class="container">
    <div class="row">
      <div class="col-4 offset-md-4 form-div">
        <a href="users.php">View all profiles</a>
        <form action="profile.php" method="post" enctype="multipart/form-data">
          <h2 class="text-center mb-3 mt-3">Update profile</h2>
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
              <img src="images/avatar5.jpg"  onclick="triggerClick()" id="profileDisplay">
            </span>
            <input type="file" name="profileImage" onchange="displayImage(this)" id="profileImage" class="form-control" style="display: none;">
            <!-- <label>Profile Image</label> -->
          </div>
          
          <div class="form-group">
            <!-- <label>Bio</label> -->
            
            <textarea name="bio" class="form-control" placeholder="Describe about yourself..."></textarea>
          </div>
          <div class="form-group">
            <button type="submit" name="save_profile" class="btn btn-primary btn-block">Save User</button>
            <button formaction="index.php" class="btn btn-primary btn-block">Home</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</body>
</html>
<script src="js/scripts.js"></script>