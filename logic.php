<?php

    // Don't display server errors 
    ini_set("display_errors", "off");

    // Initialize a database connection
    $conn = mysqli_connect("localhost", "root", "", "blogdb");

    // Destroy if not possible to create a connection
    if(!$conn){
        echo "<h3 class='container bg-dark p-3 text-center text-warning rounded-lg mt-5'>Not able to establish Database Connection<h3>";
    }

    // Get data to display on index page
    $sql = "SELECT * FROM data";
    $query = mysqli_query($conn, $sql);

    // Create a new post
    if(isset($_REQUEST['add_post'])){
        $subject = $_REQUEST['subject'];
        $description = $_REQUEST['description'];

        $sql = "INSERT INTO data(subject, description) VALUES('$subject', '$description')";
        mysqli_query($conn, $sql);

        echo $sql;

        header("Location: index.php?info=added");
        exit();
    }

    // Get post data based on id
    if(isset($_REQUEST['id'])){
        $id = $_REQUEST['id'];
        $sql = "SELECT * FROM data WHERE id = $id";
        $query = mysqli_query($conn, $sql);
    }

    // Delete a post
    // if(isset($_REQUEST['delete'])){
    //     $id = $_REQUEST['id'];
    //     $sql = "DELETE FROM data WHERE id = $id";
    //     mysqli_query($conn, $sql);
    //     header("Location: index.php?info=deleted");
    //     exit();
    // }
    if ($_SERVER['REQUEST_METHOD'] == 'DELETE' || ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['_METHOD'] == 'DELETE')) {
        $id = (int) $_POST['id'];
        // $result = mysql_query('DELETE FROM data WHERE id='.$id);
        $sql = "DELETE FROM data WHERE id = $id";
        $result = mysqli_query($conn, $sql);
        if ($result !== false) {
            // there's no way to return a 200 response and show a different resource, so redirect instead. 303 means "see other page" and does not indicate that the resource has moved.
            header("Location: index.php?info=deleted");
            exit;
        }
    }


    

    
    // Update a post
    if(isset($_REQUEST['update'])){
        $id = $_REQUEST['id'];
        $subject = $_REQUEST['subject'];
        $description = $_REQUEST['description'];

        $sql = "UPDATE data SET subject = '$subject', description = '$description' WHERE id = $id";
        mysqli_query($conn, $sql);

        header("Location: index.php?info=updated");
        exit();
    }

?>