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
    $sql = "SELECT uid,date,message FROM comments WHERE 'uid' = '$uid'";
    $result = $conn->query($sql);
    while($row = $result->fetch_assoc()){
        echo "<div class = 'commentbox'><p>";
            echo $row['uid']."<br>";
            echo $row['date']."<br>";
            echo nl2br($row['message']);
        echo "</p></div>";
    }
}
?>