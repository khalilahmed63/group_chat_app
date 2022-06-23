<?php
	session_start();
if (!(isset($_SESSION['user']))) {
	header('location:index.php');
}

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">


    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">


  <!-- fontawesome icon link -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


<?php 

	$full_name = $_SESSION['user']['first_name']." ".$_SESSION['user']['last_name'];
 ?>

		<title>Group Chat Application</title>
		<style>
			input[type=submit],input[type=reset]{
				color: white;
				border: none;
				padding: 5px;

			}
			h2{
				background-color: teal;
				color: white;
				padding: 3px;
			}
			img{
				width: 30px;
				height: 30px;
				border-radius: 50%;
			}
			#chat_window{
				height: 400px;
				margin-top: -20px;
				overflow-y: auto;
			}
			.individual_message p{
				background-color: white;
				border-radius: 30px;
				padding: 5px;
				width: 70%;
				margin-left: 10px;
			}
		</style>
		<link rel="stylesheet" href="style.css">
	</head>
	<body>
		<h3 style="text-align: center;color:teal">Group Chat Application</h3>

		<main class="content">
    <div class="container p-0">

		<!-- <h1 class="h3 mb-3">Messages</h1> -->

		<div class="card">
			<div class="row g-0">
				<div class="col-12 col-lg-5 col-xl-3 border-right">

					<div class="px-4 d-none d-md-block">
						<div class="d-flex align-items-center">
							<div class="flex-grow-1">
								<input type="text" class="form-control my-3" placeholder="Search...">
							</div>
						</div>
					</div>

					<div id="all_users">
					

					</div>
			

					<hr class="d-block d-lg-none mt-1 mb-0">
				</div>
				<div class="col-12 col-lg-7 col-xl-9" id="chat_side">
					<div class="py-2 px-4 border-bottom d-none d-lg-block">
						<div class="d-flex align-items-center py-1">
							<div class="position-relative">
								<img src="<?= $_SESSION['user']['image_path']?>" class="rounded-circle mr-1" alt="image" width="40" height="40">
							</div>
							<div class="flex-grow-1 pl-3">
								<strong class="text-white"><?php echo $full_name; ?></strong>
							</div>
							<div>
								<span><a href="logout.php" class='fw-bold ' style="color:red;font-size:15px;"><h4>Logout</h4></a></span>
								<!-- <button class="btn btn-primary btn-lg mr-1 px-3"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-phone feather-lg"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg></button>
								<button class="btn btn-info btn-lg mr-1 px-3 d-none d-md-inline-block"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-video feather-lg"><polygon points="23 7 16 12 23 17 23 7"></polygon><rect x="1" y="5" width="15" height="14" rx="2" ry="2"></rect></svg></button>
								<button class="btn btn-light border btn-lg px-3"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-horizontal feather-lg"><circle cx="12" cy="12" r="1"></circle><circle cx="19" cy="12" r="1"></circle><circle cx="5" cy="12" r="1"></circle></svg></button> -->
							</div>
						</div>
					</div>

					<div class="position-relative">
						<div class="chat-messages  p-4" id="chat_window">

						

						
						

						
						</div>
					</div>

					<div class="flex-grow-0 py-3 px-4 border-top">
						<div class="input-group">
							<input type="text" id="message_text" class="form-control" placeholder="Type your message">
							<button onclick="send_message()" class="btn btn-primary">Send</button>
						</div>
					</div>

				</div>
			</div>
		</div>
	</div>
</main>
	
		<script>
			var set_interval_message = null;
			var set_interval_user = null;
			show_messages();
			show_users();

			function show_messages(){
				// alert("Interval");
				var ajax_request = null;
				if(window.XMLHttpRequest){
					ajax_request = new XMLHttpRequest();
				}
				else{
					ajax_request = new ActiveXObject("Microsoft.XMLHTTP")
				}

				ajax_request.onreadystatechange = function(){
					if(this.readyState == 4 && this.status == 200){
						// alert(this.responseText);
						document.getElementById("chat_window").innerHTML = this.responseText;
					}
				}

				ajax_request.open("GET","ajax_processing.php?action=show_messages");
				ajax_request.send();
			}
			function show_users(){

				var ajax_request = null;
				if(window.XMLHttpRequest){
					ajax_request = new XMLHttpRequest();
				}
				else{
					ajax_request = new ActiveXObject("Microsoft.XMLHTTP")
				}

				ajax_request.onreadystatechange = function(){
					if(this.readyState == 4 && this.status == 200){
						// alert(this.responseText);
						document.getElementById("all_users").innerHTML = this.responseText;
					}
				}

				ajax_request.open("GET","ajax_processing.php?action=show_users");
				ajax_request.send();

			}
			function send_message(){
				var message_text = document.getElementById("message_text").value;
				// alert(message_text);
				var ajax_request = null;
				if(window.XMLHttpRequest){
					ajax_request = new XMLHttpRequest();
				}
				else{
					ajax_request = new ActiveXObject("Microsoft.XMLHTTP")
				}

				ajax_request.onreadystatechange = function(){
					if(this.readyState == 4 && this.status == 200){
						// alert(this.responseText);
						document.getElementById("message_text").value = "";
					}	show_messages();
				}

				ajax_request.open("POST","ajax_processing.php");
				ajax_request.setRequestHeader("content-type","application/x-www-form-urlencoded");
				ajax_request.send("action=send_message&message_text="+message_text);
			}
			set_interval_message = setInterval(show_messages,1000);
			set_interval_user = setInterval(show_users,1000);
		</script>
	</body>
</html>