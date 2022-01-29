<?php
include 'userform.php';
  $sql = "SELECT * FROM users";
  $result = mysqli_query($conn, $sql);
  $users = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Image Preview and Upload</title>
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0/css/bootstrap.min.css" />
  <style>
    html,body{
    height: 100%;
    padding: 0px;
    margin: 0px;
    background: #f5f5f5;
    font-family: 'Lora', serif;
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="row">
      <div class="col-4 offset-md-4" style="margin-top: 30px;">
        <a href="profile.php" class="btn btn-success">New profile</a>
        <a href="index.php" class="btn btn-success">Home</a>
        <br>
        <br>
        <table class="table table-bordered">
          <thead>
            <th>Image</th>
            <th>Bio</th>
            <th>Delete</th>
          </thead>
          <tbody>
            <?php foreach ($users as $user): ?>
              <tr>
                <td> 
                  <img src="images/<?php echo $user['profile_image']; ?>" width="90" height="90" alt=""> 
                </td>
                <td> <?php echo $user['bio']; ?> </td>
                
                <form method="POST" onsubmit="return confirm('Are you sure you want to delete this Profile');">
                  <input type="hidden" name="_DELPROFILE" value="DELETE">
                  <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
                  <td> <button class="btn btn-danger btn-sm ml-2" type="submit">&#10006;</button> </td>
                </form>

              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</body>
</html>