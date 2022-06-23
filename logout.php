<?php 
	session_start();
	require_once("require/connection.php");
	
	$query = "UPDATE users SET is_online = 0 WHERE user_id=".$_SESSION['user']['user_id'];

	$result = mysqli_query($con,$query);

	if($result){
		session_destroy();
		header("location:index.php?msg=Logout Successfully&color=green");
	}


?>