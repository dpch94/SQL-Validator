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

        if (empty($_REQUEST['subject'])) {
            echo "<span class=\"error\">Error: Subject is required</span>";
        }
        elseif (empty($_REQUEST['description'])) {
            echo "<span class=\"error\">Error: Description is required</span>";
        }
        else {

        $subject = $_REQUEST['subject'];
        $description = $_REQUEST['description'];

        error_reporting(0);

        $msg = "";
            if (isset($_POST['add_post'])) {

                $filename = $_FILES["uploadfile"]["name"];
                $tempname = $_FILES["uploadfile"]["tmp_name"];	
                $folder = "image/".$filename;
                $sql = "INSERT INTO data(subject, description, image) VALUES('$subject', '$description', '$filename')";
                mysqli_query($conn, $sql);

                echo $sql;

                header("Location: index.php?info=added");
                exit();
            }
            else {                   
                $sql = "INSERT INTO data(subject, description) VALUES('$subject', '$description')";
                mysqli_query($conn, $sql);

                echo $sql;

                header("Location: index.php?info=added");
                exit();
            }

        }
        
    }

   
        


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
            
            header("Location: index.php?info=deleted");
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
        
        $sql = "UPDATE data SET subject = '$subject', description = '$description' WHERE id = $id";
        mysqli_query($conn, $sql);

        header("Location: index.php?info=updated");
        exit();
        }
    }
    
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