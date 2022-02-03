<?php

if(array_key_exists('createDB', $_POST)) {
    createDB();
}
else if(array_key_exists('createTables', $_POST)) {
    createTables();
}
else if(array_key_exists('dropDB', $_POST)) {
    dropDB();
}


//Creating a connection
function createDB()
{
    $con = mysqli_connect("localhost", "root", "");
    $success = mysqli_query($con, "CREATE DATABASE IF NOT EXISTS bloggingdb");


    echo "Database created successfully\n";

    //Closing the connection
    mysqli_close($con);
}

function createTables()
{
    $con = mysqli_connect("localhost", "root", "", "bloggingdb");
    mysqli_query($con, "CREATE TABLE IF NOT EXISTS comments(
                                `cid` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
                                `uid` int(11) NOT NULL,
                                `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                                `message` text NOT NULL )");


    mysqli_query($con, "CREATE TABLE IF NOT EXISTS data(
                                `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
                                `created_by` varchar(255) NOT NULL,
                                `subject` varchar(255) NOT NULL,
                                `description` longblob NOT NULL,
                                `image` longblob NOT NULL,
                                `created_at` datetime NOT NULL DEFAULT current_timestamp(),
                                `rid` int(11) NOT NULL,
                                `ratename` varchar(255) NOT NULL,
                                `rating` float DEFAULT 0 )");


    mysqli_query($con, "CREATE TABLE IF NOT EXISTS users(
                                `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
                                `profile_image` varchar(255) NOT NULL,
                                `bio` text NOT NULL )");





    //Closing the connection
    mysqli_close($con);
}

//Creating a connection
function dropDB()
{
    //Creating a connection
    $con = mysqli_connect("localhost", "root", "");

    if(! $con ) {
        die('Could not connect: ' . mysqli_error());
    }

    $sql = 'DROP DATABASE bloggingdb';
    $retval = mysqli_query($con,$sql);

    if(! $retval ) {
        die('Could not delete database db_test: ' . mysqli_error());
    }

    echo "Database deleted successfully\n";

    mysqli_close($con);
}
    // Don't display server errors 
    ini_set("display_errors", "off");

    // Initialize a database connection
    $conn = mysqli_connect("localhost", "root", "", "bloggingdb");

    // Destroy if not possible to create a connection
    if(!$conn){
        echo "<h3 class='container bg-dark p-3 text-center text-warning rounded-lg mt-5'>Not able to establish Database Connection<h3>";
    }

    // Get data to display on index page
    $sql = "SELECT * FROM data";
    $query = mysqli_query($conn, $sql);

    // Create a new post
    if(isset($_REQUEST['add_post'])){

        if (empty($_REQUEST['subject'])) {
            echo "<span class=\"error\">Error: Subject is required</span>";
        }
        elseif (empty($_REQUEST['created_by'])) {
            echo "<span class=\"error\">Error: Created by and Description are required</span>";
        }
        
        elseif (empty($_REQUEST['description'])) {
            echo "<span class=\"error\">Error: Created by and Description are required</span>";
        }
        else {

            $subject = $_REQUEST['subject'];
            $created_by = $_REQUEST['created_by'];
            $description = $_REQUEST['description'];
            

            // If file upload form is submitted 
            $status = $statusMsg = '';
            if(isset($_POST["add_post"])){ 
                $status = 'error'; 
                if(!empty($_FILES["uploadfile"]["name"])) { 
                    // Get file info 
                    $fileName = basename($_FILES["uploadfile"]["name"]); 
                    $fileType = pathinfo($fileName, PATHINFO_EXTENSION);
                    // Allow certain file formats 
                    $allowTypes = array('jpg','png','jpeg','gif'); 
                    if(in_array($fileType, $allowTypes)){ 
                        $image = $_FILES['uploadfile']['tmp_name']; 
                        $imgContent = addslashes(file_get_contents($image));   

                        //inserting into database
                        
                        $insert = $conn->query("INSERT into data (subject, created_by, description, image) VALUES ('$subject', '$created_by', '$description', '$imgContent')");
                        //$sql = "INSERT INTO data(subject, description, image) VALUES('$subject', '$description', '$imgContent')";
                        mysqli_query($conn, $sql);

                        if($insert){ 
                            $status = 'success'; 
                            $statusMsg = "File uploaded successfully.";
                            // echo $statusMsg;
                            header("Location: index.php");
                            exit(); 
                        }else{ 
                            $statusMsg = "File upload failed, please try again.";
                            echo $statusMsg; 
                        }  
                    }else{ 
                        $statusMsg = 'Sorry, only JPG, JPEG, PNG, & GIF files are allowed to upload.'; 
                        echo $statusMsg;
                    } 
                }elseif(empty($_FILES["uploadfile"]["name"])) {  
                                
                    $sql = "INSERT INTO data(subject, created_by, description) VALUES('$subject', '$created_by', '$description')";
                    mysqli_query($conn, $sql);

                    // echo $sql;

                    header("Location: index.php");
                    exit();
                }       
                        
                        
                        
            }
        }
    }  

   
    



    
                
        //old code for image uploading
        // error_reporting(0);

        // $msg = "";
        //     if (isset($_POST['add_post'])) {

        //         $filename = $_FILES["uploadfile"]["name"];
        //         $tempname = $_FILES["uploadfile"]["tmp_name"];	
        //         $folder = "image/".$tempname;
        //         $sql = "INSERT INTO data(subject, description, image) VALUES('$subject', '$description', '$folder')";
        //         mysqli_query($conn, $sql);
                
        //         echo $sql;
                
        //         if ($sql)  {
        //             $msg = "Image uploaded successfully";
        //         }else{
        //             $msg = "Failed to upload image";
        //         }
                

        //         header("Location: index.php?info=added");
        //         exit();

                
        //     }
            

   
        


    // Get post data based on id
    if(isset($_REQUEST['id'])){
        $id = $_REQUEST['id'];
        $sql = "SELECT * FROM data WHERE id = $id";
        $query = mysqli_query($conn, $sql);
    }

    
    // if(isset($_REQUEST['delete'])){
    //     $id = $_REQUEST['id'];
    //     $sql = "DELETE FROM data WHERE id = $id";
    //     mysqli_query($conn, $sql);
    //     header("Location: index.php?info=deleted");
    //     exit();
    // }

    // Delete a post
    if ($_SERVER['REQUEST_METHOD'] == 'DELETE' || ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['_METHOD'] == 'DELETE')) {
        $id = (int) $_POST['id'];
        // $result = mysql_query('DELETE FROM data WHERE id='.$id);
        $sql = "DELETE FROM data WHERE id = $id";
        $result = mysqli_query($conn, $sql);
        if ($result !== false) {
            
            header("Location: index.php");
            exit;
        }
    }


    

    
    // Update a post
    if(isset($_REQUEST['update'])){

        if (empty($_REQUEST['subject'])) {
            echo "<span class=\"error\">Error: Subject is required</span>";
        }
        elseif (empty($_REQUEST['description'])) {
            echo "<span class=\"error\">Error: Description is required</span>";
        }
        else {
            $id = $_REQUEST['id'];
            $subject = $_REQUEST['subject'];
            $description = $_REQUEST['description'];
            if(!empty($_FILES["uploadfile"]["name"])) { 
                // Get file info 
                $fileName = basename($_FILES["uploadfile"]["name"]); 
                $fileType = pathinfo($fileName, PATHINFO_EXTENSION);
                // Allow certain file formats 
                $allowTypes = array('jpg','png','jpeg','gif'); 
                if(in_array($fileType, $allowTypes)){ 
                    $image = $_FILES['uploadfile']['tmp_name']; 
                    $imgContent_new = addslashes(file_get_contents($image));   
                    $sql = "UPDATE data SET subject = '$subject', description = '$description', image = '$imgContent_new' WHERE id = $id";
                    $sql_run = mysqli_query($conn, $sql);
                    if($sql_run)
                    {
                        move_uploaded_file($_FILES['uploadfile']['name'] ,"upload/".$imgContent_new);
                        header("Location: index.php");
                        exit();


                    } 


                   
                    
                }
            }

            
           
                    
        
            
            else {                   
                $sql = "UPDATE data SET subject = '$subject', description = '$description' WHERE id = $id";
                mysqli_query($conn, $sql);

                // echo $sql;

                header("Location: index.php");
                exit();
            }
        }
    }

    // $conn = mysqli_connect("localhost", "root", "", "bloggingdb");
    
    
    
    
    
    //Displaying search results
    function selectAll($table, $conditions = [])
    {
        global $conn;
        $sql = "SELECT * FROM $table";
        if (empty($conditions)) {
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            $records = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
            return $records;
        } else {
            $i = 0;
            foreach ($conditions as $key => $value) {
                if ($i === 0) {
                    $sql = $sql . " WHERE $key=?";
                } else {
                    $sql = $sql . " AND $key=?";
                }
                $i++;
            }
            
            $stmt = executeQuery($sql, $conditions);
            $records = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
            return $records;
        }
    }


    function selectOne($table, $conditions)
    {
        global $conn;
        $sql = "SELECT * FROM $table";

        $i = 0;
        foreach ($conditions as $key => $value) {
            if ($i === 0) {
                $sql = $sql . " WHERE $key=?";
            } else {
                $sql = $sql . " AND $key=?";
            }
            $i++;
        }

        $sql = $sql . " LIMIT 1";
        $stmt = executeQuery($sql, $conditions);
        $records = $stmt->get_result()->fetch_assoc();
        return $records;
    }


    function executeQuery($sql, $data)
    {
        global $conn;
        $stmt = $conn->prepare($sql);
        $values = array_values($data);
        $types = str_repeat('s', count($values));
        $stmt->bind_param($types, ...$values);
        $stmt->execute();
        return $stmt;
    }
    function getPosts()
    {
        global $conn;
        $sql = "SELECT d.* FROM data AS d WHERE d.created_at=?";

        $stmt = executeQuery($sql, ['created_at' => $created_at]);
        $records = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        return $records;
    }


    function getPostsById($subject)
    {
        global $conn;
        $sql = "SELECT d.* FROM data AS d WHERE d.subject=?";

        $stmt = executeQuery($sql, ['subject' => $subject]);
        $records = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        return $records;
    }


    //Search posts method
    function searchPosts($term)
    {
        $match = '%' . $term . '%';
        global $conn;
        $sql = "SELECT d.* FROM data AS d WHERE d.subject LIKE ? OR d.description LIKE ?";
                    

        $stmt = executeQuery($sql, ['subject' => $match, 'description' => $match]);
        $records = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        return $records;
    }    

?>