<?php
include 'logic.php';
?>
<!DOCTYPE html>
<html>
<br>
<br>
<a href="index.php" class="button">Home</a>


<h2>DB Creation </h2>
        <form method="post">

            <div>
                <input type="submit" name="createDB" class="button" value="Create DB"  style="font-size: 20px"/>
            </div>
            <br>
        </form>

        <form method="post">
            <h2> Table Creation</h2>
            <div>
                <input type="submit" name="createTables" class="button" value="Create Tables" style="font-size: 20px" />
            </div>
            <br>
        </form>

<!--<form method="post">-->
<!--    <h2>DB Deletion</h2>-->
<!--    <div>-->
<!--        <input type="submit" name="dropDB" class="button" value="Drop DB" style="font-size: 20px"/>-->
<!--    </div>-->
<!--</form>-->





</body>
</html>