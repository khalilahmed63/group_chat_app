<?php 
	session_start();
	require_once("require/connection.php");
	date_default_timezone_set("Asia/Karachi");
	if(isset($_REQUEST['action']) && $_REQUEST['action'] == "show_messages"){

		$query = "SELECT * FROM chat,users WHERE users.user_id = chat.user_id";
		$messages = mysqli_query($con,$query);

		// print_r($messages);

		if($messages->num_rows){
			while ($message = mysqli_fetch_assoc($messages)) {
				?>
				<div class="individual_message">
					<?php 
					if($message['user_id'] == $_SESSION['user']['user_id']){
						?>
							<div class="chat-message-right mb-4">
								<div>
									<img src="<?= $_SESSION['user']['image_path']?>" class="rounded-circle mr-1" alt="img" width="40" height="40">
								</div>
								<div class="flex-shrink-1 bg-light rounded py-2 px-3 mr-3">
									<div class="font-weight-bold mb-1"><?php echo $message['first_name']." ".$message['last_name'].": "?></div>
									<?php echo '  '.$message['message']?> |  
									<span style="float:right;color:gray">  <?php echo  date("h:i A",$message['added_on'])?></span>
								</div>
							</div>

					
						<?php
					}
					else{
						
						?>
						<div class="chat-message-left mb-4">
								<div>
									<img src="<?php echo $message['image_path']?>" class="rounded-circle mr-1" alt="image" width="40" height="40">
							
								</div>
								<div class="flex-shrink-1 bg-light rounded py-2 px-3 mr-3">
									<div class="font-weight-bold mb-1"><?php echo $message['first_name']." ".$message['last_name'].": "?></div>
									<?php echo $message['message']?> | 
									<span style="float:right;color:gray"> <?php echo  date("h:i A",$message['added_on'])?></span>
								</div>
							</div>

					
						<?php
					}

					 ?>
				</div>
				<?php
			}
		}
	}
	elseif(isset($_REQUEST['action']) && $_REQUEST['action'] == "send_message"){
		$query = "INSERT INTO chat(message,user_id,added_on) VALUES ('".$_REQUEST['message_text']."',".$_SESSION['user']['user_id'].",'".time()."')";
		$result = mysqli_query($con,$query);
		// echo $result;
	}
	elseif(isset($_REQUEST['action']) && $_REQUEST['action'] == "show_users"){
		$users = mysqli_query($con,"SELECT * FROM users");

		if($users->num_rows){
			while ($user = mysqli_fetch_assoc($users)) {
				if($user['user_id'] != $_SESSION['user']['user_id']){
				?>


					
						<div class="d-flex align-items-start m-4">
							<img src="<?= $user['image_path']?>" class="rounded-circle mr-1" alt="Jennifer Chang" width="40" height="40">
							<div class="flex-grow-1 ml-3">
							<?= $user['first_name']." ".$user['last_name']?>
								<div class="small"> <span style="color: <?= ($user['is_online'])?'green':'red'?>">*</span></div>
							</div>
						</div>
				
				

			
				<?php
				}
				
			}
		}
	}


 ?>