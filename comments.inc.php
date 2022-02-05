<?php
$conn = mysqli_connect("localhost", "root", "", "bloggingdb");

function setComments($conn){
    if (isset($_POST['commentSubmit'])){
        // $sl = "SELECT id from data RIGHT JOIN comments on comments.pid=data.id WHERE ";
        // $pid = $_POST['id'];
        $uid = (int) $_POST['uid'];
        $date = $_POST['date'];
        $message = $_POST['message'];

        $sql="INSERT INTO comments (uid,date,message) VALUES('$uid','$date','$message')";
        $result = $conn->query($sql);
       
    }
}

// function getComments($conn){
//     $uid = $_POST['uid'];    
//     $sql = "SELECT uid,data,message FROM comments WHERE uid = $uid";
    
//     $result = $conn->query($sql);
    
//     if (mysqli_num_rows($result) > 0) {
//     while($row = mysqli_fetch_assoc($result)){
//         echo "<div class = 'commentbox'><p>";
//             echo $row['uid']."<br>";
//             echo $row['date']."<br>";
//             echo nl2br($row['message']);
//         echo "</p>
            
        
//         </div>";
//     }
//     } else {
//         echo "no comments";
        
//     }
// }

function editComments($conn){
    if (isset($_POST['commentEdit'])){        
        $cid = (int) $_POST['cid'];     
        $uid = (int) $_POST['uid'];   
        $date = $_POST['date'];        
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
