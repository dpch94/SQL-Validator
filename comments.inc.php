<?php

function setComments($conn){
    if (isset($_POST['commentSubmit'])){
        // $sl = "SELECT id from data RIGHT JOIN comments on comments.pid=data.id WHERE ";
        // $pid = $_POST['id'];
        $uid = $_POST['uid'];
        $date = $_POST['date'];
        $message = $_POST['message'];

        $sql="INSERT INTO comments (uid,date,message) VALUES('$uid','$date','$message')";
        $result = $conn->query($sql);
    }
}

function getComments($conn){
    $id = $_POST['id'];    
    $sql = "SELECT uid,date,message FROM comments WHERE 'uid' = '$id'";
    $result = $conn->query($sql);
    if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)){
        echo "<div class = 'commentbox'><p>";
            echo $row['uid']."<br>";
            echo $row['date']."<br>";
            echo nl2br($row['message']);
        echo "</p></div>";
    }
    } else {
        echo " no comments";
    }
}

function editComments($conn){
    if (isset($_POST['commentSubmit'])){        
        $cid = $_POST['cid'];          
        $message = $_POST['message'];
        $sql="UPDATE comments SET message = '$message' WHERE cid = '$cid'";
        $result = $conn->query($sql);
        header("Location: index.php");
    }
}

function deleteComments($conn){
    if (isset($_POST['commentDelete'])){        
        $cid = $_POST['cid'];
        $sql="DELETE FROM comments WHERE cid = '$cid'";
        $result = $conn->query($sql);
        
    }
}