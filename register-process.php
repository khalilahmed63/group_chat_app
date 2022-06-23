

<?php






	session_start();
	require_once 'require/connection.php';
	date_default_timezone_set("Asia/Karachi");
	if (isset($_POST['register'])) {

		$first_name = $_POST['first_name'];
		$last_name = $_POST['last_name'];
		$email = $_POST['email'];
		$password = md5($_POST['password']);
		$confirm_password = md5($_POST['confirm_password']);
		

		if ($first_name === '') {
			header('location:../register.php?msg=first Name is empty');
		}

		if ($email === '') {
			header('location:../register.php?msg=email is Empty');
		}

		if ($password === '') {
			header('location:../register.php?msg=password is empty');
			
		}
		if ($confirm_password === '') {
			header('location:../register.php?msg=Confirm Password is Empty');
			
		}
		
		

		$filename = $_FILES["image"]["name"];

		$time_stamp = date("Y-m-d h:i:s");
		if ($first_name !== '' &&  $email !== ''  && $password !== '' && $confirm_password !== '') {
			

			$query = "INSERT INTO users (`first_name`, `last_name`, `email`, `password`, `is_online`, `image_path`) VALUES ('$first_name', '$last_name', '$email', '$password', '0', 'images/$filename')";
			
			$result = mysqli_query($con, $query);

			

			$dir = "images";
			if (!is_dir($dir)) 
			{
				mkdir($dir);
				// echo "Directory Created";
			}   
		    else
		    {
		    	// echo "Not Created";
		    }
	   
	   
	   		
			
			$tempname = $_FILES['image']['tmp_name'];
			
			$dir = "images";
	   
			if (move_uploaded_file($tempname,$dir.'/'.$filename)){
					 // echo "profile Uploaded...!";
				 }
			else{
				// echo "Not Working";
			}	



		
			if($result){
				echo "Success fully add user";
				
				header('location:index.php?reg_msg=Registered Successfully');
			} 
			else{
				echo "else part";
				header('location:../Register.php?msg=Registeration Failed');
			}
			

		}
		else {
			header('location:../Register.php?msg=Please Enter Valid Information.');
		}	

			




	}

?>