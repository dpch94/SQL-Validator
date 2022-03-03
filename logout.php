<?php

session_start();

if(isset($_SESSION['user_id']))
{
	unset($_SESSION['user_id']);
	echo "Logging out";?>
	<script>setTimeout(function(){window.location =
		"login.php";}, 1000);
	</script>
	<?php
	//header("Location: index.php");

}else
{
	echo "You are already logged out";?>
	<script>setTimeout(function(){window.location =
		"login.php";}, 1000);
	</script>
	<?php
}

?>




