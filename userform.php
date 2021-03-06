<?php

  // Don't display server errors 
  ini_set("display_errors", "off");
  $msg = "";
  $msg_class = "";
  $conn = mysqli_connect("localhost", "root", "", "bloggingdb");
  if (isset($_POST['save_profile'])) {
    if (empty($_POST['bio'])) {
      echo "<span class=\"error\">Error: Say something about you</span>";
    }else {
    // for the database
      $bio = stripslashes($_POST['bio']);
      $profileImageName = time() . '-' . $_FILES["profileImage"]["name"];
      // For image upload
      // $target_dir = "images/";
      // $target_file = $target_dir . basename($profileImageName);
      $target = 'images/'.$profileImageName;
      // VALIDATION
      // validate image size. Size is calculated in Bytes
      if($_FILES['profileImage']['size'] > 200000) {
        $msg = "Image size should not be greated than 200Kb";
        $msg_class = "alert-danger";
      }
      // check if file exists
      if(file_exists($target)) {
        $msg = "File already exists";
        $msg_class = "alert-danger1";
      }
      // Upload image only if no errors
      if (empty($error)) {
        if(move_uploaded_file($_FILES["profileImage"]["tmp_name"], $target)) {
          $sql = "INSERT INTO users (profile_image, bio) VALUES ('$profileImageName', '$bio')";
          if(mysqli_query($conn, $sql)){
            $msg = "Thanks for the details, your profile is saved";
            $msg_class = "alert-success";
          } else {
            $msg = "There was an error in the database";
            $msg_class = "alert-danger2";
          }
        } else {
          $error = "There was an error uploading the file";
          $msg = " please upload image";
        }
      }
    }
  }

  $conn = mysqli_connect("localhost", "root", "", "bloggingdb");

  if ($_SERVER['REQUEST_METHOD'] == 'DELETE' || ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['_DELPROFILE'] == 'DELETE')) {
    $id = (int) $_POST['id'];
    
    $sql = "DELETE FROM users WHERE id = $id";
    $result = mysqli_query($conn, $sql);
    if ($result !== false) {
        
      header("Location: profile.php?info=deleted");
      exit;
    }
  }
?>
