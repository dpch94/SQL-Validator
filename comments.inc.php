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
    $uid = $_POST['uid'];    
    $sql = "SELECT uid,data,message FROM comments WHERE uid = 9";
    
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
        echo "no comments";
        
    }
}

function editComments($conn){
    if (isset($_POST['commentSubmit'])){        
        $cid = (int) $_POST['cid'];     
        $uid = $_POST['uid'];   
        $date = $_POST['date'];        
        $message = $_POST['message'];

        $sql="UPDATE comments SET message = '$message', date = '$date' WHERE cid = '$cid'";
        $result = $conn->query($sql);
        header("Location: index.php");
    }
}

function deleteComments($conn){
    if ($_SERVER['REQUEST_METHOD'] == 'DELETE' || ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['commentDelete'])){        
        $cid = (int) $_POST['cid'];

        $sql="DELETE FROM comments WHERE cid = '$cid'";
        $result = $conn->query($sql);
        header("Location: index.php");
        
    }
}
?>
