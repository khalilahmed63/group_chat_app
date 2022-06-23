<?php 
	session_start();
	require_once("require/connection.php");
	if(isset($_REQUEST['login'])){

		$query = "SELECT * FROM users WHERE email = '".$_REQUEST['email']."' AND password = '".md5($_REQUEST['password'])."'";

		$result = mysqli_query($con,$query);
		if($result->num_rows){
			$user = mysqli_fetch_assoc($result);
			$_SESSION['user'] = $user;


			//Now Update is_online status of user
			$query = "UPDATE users SET is_online = 1 WHERE user_id=".$_SESSION['user']['user_id'];
			$result = mysqli_query($con,$query);

			if($result)
				header("location:chat.php");
		}
		else{
			header("location:index.php?msg=Invalid Email/password&color=red");
		}

		
	}
	else{
		header("location:index.php?msg=Access Denied&color=red");
	}


 ?>