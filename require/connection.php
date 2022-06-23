<?php 
	mysqli_report(false);
	$con = mysqli_connect("localhost","root","","group_chat_application");

	if(!$con){
		die("<span style='color:red'>Connection Failed</span>");
	}

?>