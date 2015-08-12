<?php 
	include 'core/init.php';
	logged_in_redirect();
	include 'includes/overall/header.php'; 
	
	if(empty($_POST)===false) {
		$required_fields = array('username','password','password_again','reg_no','firstname','lastname','gender','email');
		foreach($_POST as $key=>$value) {
			if(empty($value) && in_array($key,$required_fields)===true) {
					$errors[] = 'Fields marked with asterisk must be entered.';
					break;					
				}
	
		}
		if(empty($errors) === true) {
			if(user_exists($_POST['username']) === true) {
				$errors[] = 'Sorry, the username \'' . $_POST['username'] . '\' is already taken.';
			}
			if(preg_match("/\\s/", $_POST['username']) == true){
				$errors[] = 'Username must not contain any spaces.';
			}
			if(strlen($_POST['password']) < 6 && strlen($_POST['password']) > 15) {
				$errors[] = 'Password must be between 6-15 characters.';
			}
			if($_POST['password'] !== $_POST['password_again']) {
				$errors[] = 'Passwords do not match.';
			}
			if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)=== false){
				$errors[] = 'Enter a valid email address.';
			}
			if(email_exists($_POST['email']) === true) {
				$errors[] = 'Sorry, the email \'' . $_POST['email'] . '\' is already registered.';
			}	
		}
	}
	
	?>
      <h1>Register</h1>
	  
	  <?php
		if (isset($_GET['success']) && empty($_GET['success'])){
			echo 'You\'ve been registered successfully. Please check your email to activate your account';
		}else {
	  
	  
		if(empty($_POST) === false && empty($errors) === true) {
			$register_data = array(
				'username' 				=> $_POST['username'],
				'password'				=> $_POST['password'],
				'first name' 			=> $_POST['firstname'],
				'last name' 			=> $_POST['lastname'],
				'registration number' 	=> $_POST['reg_no'],
				'gender' 				=> $_POST['gender'],
				'email' 				=> $_POST['email'],
				'email_code' 			=> md5($_POST['username'] + microtime()) 
				);
				
		register_user($register_data);
		header('Location: register.php?success');
		exit();
		}else if(empty($errors)===false){
			echo output_errors($errors);
		}
	  ?>
	  
      <form action="" method="post">
		<ul>
			<li>
				Username* :<br>
				<input type="text" name="username">
			</li>
			<li>
				Password* :<br>
				<input type="password" name="password">
			</li>
			<li>
				Enter your password again* :<br>
				<input type="password" name="password_again">
			</li>
			<li>
				Registration Number* :<br>
				<input type="number" name="reg_no">
			</li>
			<li>
				First Name* :<br>
				<input type="text" name="firstname">
			</li>
			<li>
				Last Name* :<br> 
				<input type="text" name="lastname"> 
			</li>
			<lI>	
				Gender* :<br>
				<select name="gender">
				<option value="Male">Male</option>
				<option value="Female">Female</option>
				</select>
			</li>
			<li>
				Email* :<br>
				<input type="text" name="email">
			</li>	
			<li>
				<input id="register" type="submit" value="Register">
			</li>
		</ul>
	  </form>
    </div>
<?php
	}
	die();
 include 'includes/overall/footer.php'; ?>
