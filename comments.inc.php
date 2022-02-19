<?php
$conn = mysqli_connect("localhost", "root", "", "bloggingdb");

function setComments($conn){
    if (isset($_POST['commentSubmit'])){
        // $sl = "SELECT id from data RIGHT JOIN comments on comments.pid=data.id WHERE ";
        // $pid = $_POST['id'];
        if (empty($_REQUEST['comment_by'])) {
            echo "<span class=\"error\">Error: Please enter Name to comment</span>";
        }
        else {
            $uid = (int) $_POST['uid'];
            $date = $_POST['date'];
            $cname = $_POST['comment_by'];
            $message = $_POST['message'];

            $sql="INSERT INTO comments (uid,date,cname,message) VALUES('$uid','$date','$cname','$message')";
            $result = $conn->query($sql);
        }
        
       
    }
}

function editComments($conn){
    if (isset($_POST['commentEdit'])){        
        $cid = (int) $_POST['cid'];     
        $uid = (int) $_POST['uid'];   
        $date = $_POST['date'];  
        $cname = $_POST['cname'];      
        $message = $_POST['message'];

        $sql="UPDATE comments SET message = '$message' WHERE cid = '$cid'";
        $result = mysqli_query($conn, $sql);
        header("Location: index.php");   
        
    }
}


function deleteComments($conn){
    if (isset($_POST['commentDelete'])){        
        $cid = (int) $_POST['cid'];
        $sql="DELETE FROM comments WHERE cid = '$cid'";
        $result = mysqli_query($conn, $sql);
        header("Location: index.php");
        
    }
}
?>
