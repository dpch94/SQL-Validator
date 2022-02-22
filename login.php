<?php 

session_start();

	include("logic.php");
	include("functions.php");


	if($_SERVER['REQUEST_METHOD'] == "POST")
	{
		//something was posted
		$user_name = $_POST['user_name'];
		$password = $_POST['password'];
        #$auth = password_verify($_POST['password'], $password);
        #$password = password_hash($_POST['password'], PASSWORD_DEFAULT); //encrypt password

		if(!empty($user_name) && !empty($password) && !is_numeric($user_name))
		{

			//read from database
			$query = "select * from viewers where user_name = '$user_name' limit 1";
			$result = mysqli_query($conn, $query);

			if($result)
			{
				if($result && mysqli_num_rows($result) > 0)
				{

					$user_data = mysqli_fetch_assoc($result);
					
					if(password_verify($password,$user_data['password']))
                    

					{

						$_SESSION['user_id'] = $user_data['user_id'];
						echo "You are logged in";?>
						<script>setTimeout(function(){window.location =
							"index.php";}, 1000);
						</script>
						<?php
						//header("Location: index.php");
						
					}
					
				}
			}
		
			
		}else
		{
			echo "Please enter valid information to proceed!";?>
			<script>setTimeout(function(){window.location =
				"index.php";}, 1000);
			</script>
			<?php
		}
	}

?>


<!DOCTYPE html>
<html>
<head>
<link rel ="stylesheet" href="CSS/style.css">
<title>Login</title>
</head>
<body class="concenter" style =" background: #a8c4c4;">

	<style type="text/css">
	
	#text{

		height: 25px;
		border-radius: 5px;
		padding: 4px;
		border: solid thin #aaa;
		width: 100%;
	}

	#button{

		padding: 10px;
		width: 100px;
		color: white;
		background-color: lightblue;
		border: none;
	}

	#box{

		background-color: #a8c4c4;
		margin: auto;
		width: 300px;
		height:300px;
		padding: 20px;
	}

	</style>

	<div id="box">
		
		<form method="post">
			<div style="font-size: 20px;margin: 10px;color: white;">Login</div>

			<input id="text" type="text" name="user_name"><br><br>
			<input id="text" type="password" name="password"><br><br>

			<input id="button" type="submit" value="Login"><br><br>

			<a href="signup.php">Click to Signup</a><br><br>
		</form>
	</div>
</body>
</html>