<?php
$conn = mysqli_connect('localhost','root','','blogdb');

if (!$conn){
    die("Connection failed: ".mysqli_connect_error());
}
//check if form is submitted
if (isset($_POST['submit']))
{
     //upload file
    if(!empty($_FILES["file"]["name"])) { 
        // Get file info 
        $fileName = basename($_FILES["file"]["name"]); 
        $fileType = pathinfo($fileName, PATHINFO_EXTENSION);
        $allowed = ['pdf', 'txt', 'doc', 'docx', 'png', 'jpg', 'jpeg',  'gif'];
    
        //check if file type is valid
        if (in_array($fileType, $allowed))
        {
            // get last record id
            // $sql = "SELECT MAX(id) AS id FROM files";
            // $result = mysqli_query($conn, $sql);
            // if (count($result) > 0)
            // {
            //     $row = $result->fetch_assoc();
            //     $filename = ($row['id']+1) . '-' . $filename;
            // }
            // else
            //     $filename = '1' . '-' . $filename;

            //set target directory
            $path = 'uploads/';
            
                
            $created = @date('Y-m-d H:i:s');
            // move_uploaded_file($_FILES['file']['tmp_name'],($path . $filename));
            
            // insert file details into database
            $sql = "INSERT INTO files(filename, created) VALUES('$fileName', '$created')";
            mysqli_query($conn, $sql);
            header("Location: files.php?st=success");
        }
        else
        {
            header("Location: files.php?st=error");
        }
    }
    else
        header("Location: files.php");
}
?>
