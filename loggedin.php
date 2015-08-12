<div class="widget">
     <h2>Hello, <?php echo $user_data['first name']; ?></h2>
    
	
	
	
		<div class="inner">
			<div class ="profile">
				<?php
					if(isset($_FILES['profile']) === true) {
						if(empty($_FILES['profile']['name']) === true) {
							echo 'Please choose a file.';
						} else if ($_FILES['profile']['size'] > 250000){
							echo 'File size must be less than 200kB.';
						} else {
							$allowed = array('jpg','jpeg','gif','png');
							
							$file_name = $_FILES['profile']['name'];
							$file_extn = strtolower(end(explode('.', $file_name)));
							$file_temp = $_FILES['profile']['tmp_name'];
							//Add size constraint to the image.
							$file_size = $_FILES['profile']['size'];
							
							if(in_array($file_extn,$allowed) === true){
								change_profile_image($session_user_id, $file_temp,$file_extn);
								
								header('Location: '. $current_file);
								exit();
							} else {
								echo 'Incorrect file type ! You can only upload ';
								echo implode(', ', $allowed);	
							}
							
						}
					}
					if(empty($user_data['profile']) === false) {
						echo '<img src="', $user_data['profile'],'" alt="', $user_data['first name'], '\'s Profile Image">';
					}
				?>
				<form action="" method="post" enctype="multipart/form-data">
					<input type="file" name="profile"> <input type="submit">
				</form>
			</div>
			<ul>
				<li><a href=logout.php> Logout</a></li>
				<li><?php echo "<a href=\"profile.php?username=" .$user_data['username']. "\"> Profile</a>" ?></li>
				<li><a href=changepassword.php> Change password</a></li>
				<li><a href=settings.php> User Settings</a></li>
			</ul>
	  </div>
</div>


