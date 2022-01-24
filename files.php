<?php
$conn = mysqli_connect('localhost','root','','blogdb');

if (!$conn){
    die("Connection failed: ".mysqli_connect_error());
}

// fetch files
$sql = "select filename from files";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>
<head>
    
    <meta content="width=device-width, initial-scale=1.0" name="viewport" >
    <!-- <link rel="stylesheet" href="css/bootstrap.css" type="text/css" /> -->
    <script src="https://kit.fontawesome.com/f6154e7f2f.js" crossorigin="anonymous"></script>

    <link href="https://fonts.googleapis.com/css2?family=Candal&family=Lora&display=swap" rel="stylesheet">

    <link rel ="stylesheet" href="css/style.css">
    <title>Blog and Learn</title>
</head>
<body>
    <header>
            <div class="logo">
                <h1 class="logo-text"style="text-align:center">Blog and Learn</h1>
            </div>
            <i class="fa fa-bars menu-toggle"></i>
            <ul class="nav" align-content: center;>
                <li><a href="index.php">Home</a></li> 
                <li><a href="files.php">Documents</a></li>
                <li><a href="#">Tutorial</a></li>
                
                <!-- <li><a href="#"class="downloadaspdf">Download</a></li> -->
                <li><button class="download-btn">Download</button></li> 
                <li><a href="profile.php">Profile</a></li>
                
            </ul>
            
    </header>
    <br/>
    <br/>
    <br/>
<div class="container">
    <div class="row">
        <div class="col-xs-8 col-xs-offset-2 well">
        <form action="upload.php" method="post" enctype="multipart/form-data">
            <legend>Select File to Upload:</legend>
            <div class="form-group">
                <input type="file" name="file" />
            </div>
            <div class="form-group">
                <input type="submit" name="submit" value="Upload" class="btn btn-info"/>
            </div>
            <?php if(isset($_GET['st'])) { ?>
                <div class="alert alert-danger text-center">
                <?php if ($_GET['st'] == 'success') {
                        echo "File Uploaded Successfully!";
                    }
                    else
                    {
                        echo 'Invalid File Extension!';
                    } ?>
                </div>
            <?php } ?>
        </form>
        </div>
    </div>
    
    <div class="row">
        <div class="col-xs-8 col-xs-offset-2">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>File Name</th>
                        <th>View</th>
                        <th>Download</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                $i = 1;
                while($row = $result->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo $i++; ?></td>
                    <td><?php echo $row['filename']; ?></td>
                    <td><a href=".uploads/<?php echo $row['filename']; ?>" target="_blank">View</a></td>
                    <td><a href=".uploads/<?php echo $row['filename']; ?>" download>Download</td>
                </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</body>
</html>