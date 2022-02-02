<!DOCTYPE html>
<html>
<body>

<h2>DB Creation </h2>
<form method="post">

    <div>
        <input type="submit" name="createDB" class="button" value="Create DB"  style="font-size: 20px"/>
    </div>
    <br>
    <br>
</form>

<form method="post">
    <h2> Table Creation</h2>
    <div>
        <input type="submit" name="createTables" class="button" value="Create Tables" style="font-size: 20px" />
    </div>
    <br>
    <br>
</form>

<form method="post">
    <h2>DB Deletion</h2>
    <div>
        <input type="submit" name="dropDB" class="button" value="Drop DB" style="font-size: 20px"/>
    </div>

    <br>
    <br>
    <br>
    <br>


</form>


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
    $success = mysqli_query($con, "CREATE DATABASE IF NOT EXISTS teams_ss2021");


    echo "Database created successfully\n";

    //Closing the connection
    mysqli_close($con);
}

function createTables()
{
    $con = mysqli_connect("localhost", "root", "", "teams_ss2021");
    mysqli_query($con, "CREATE TABLE IF NOT EXISTS group_members(
                                usr_id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                                usr_name VARCHAR(255) NOT NULL,
                                usr_email VARCHAR(255) NOT NULL,
                                grp_id VARCHAR(255)   NOT NULL,
                                reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP)");

    mysqli_query($con, "CREATE TABLE IF NOT EXISTS comment(
                                usr_id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                                usr_comment TEXT,
                                reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP )");

    mysqli_query($con, "CREATE TABLE IF NOT EXISTS chats(
                                usr_id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                                grp_id INT ,
                                usr_chat TEXT, 
                                reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP  )");

    mysqli_query($con, "CREATE TABLE IF NOT EXISTS editor(
                                usr_id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                                usr_codes TEXT, 
                                reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP  )");

    mysqli_query($con, "CREATE TABLE IF NOT EXISTS wiki(
                                usr_id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                                usr_wiki TEXT, 
                                reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP  )");

    mysqli_query($con, "CREATE TABLE IF NOT EXISTS results(
                                usr_id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                                usr_results TEXT, 
                                ureg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP )");


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

    $sql = 'DROP DATABASE teams_ss2021';
    $retval = mysqli_query($con,$sql);

    if(! $retval ) {
        die('Could not delete database db_test: ' . mysqli_error());
    }

    echo "Database deleted successfully\n";

    mysqli_close($con);
}
?>


</body>
</html>