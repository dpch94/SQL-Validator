<?php

    include "logic.php";

?>
<?php
if (isset($_GET['id'])) {
  $post = selectOne('data', ['id' => $_GET['id']]);
}

$posts = selectAll('data', ['subject' => $_GET['$subject']]);

?>