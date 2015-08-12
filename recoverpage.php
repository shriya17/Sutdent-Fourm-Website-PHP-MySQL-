<?php 
	include'core/init.php'; 
	logged_in_redirect();
	include'includes/overall/header.php';
     if(empty($_POST)===false) 
	    {
	//if none of the posts are empty the fields are stored
		$required_fields = array('password','password_again');
		//storng the posts in the array
		foreach($_POST as $key=>$value) 
		{
			if(empty($value) && in_array($key,$required_fields)===true) 
			    {
					$errors[] = 'Fields marked with asterisk must be entered.';
					break;					
				}
		}
		
		}
		$password=$_POST['password'];
		$password_again=$_POST['password_again'];
	    if(isset($password)===true && isset($password_again)===true && empty($password)=== false && empty($password_again)=== false)	
		{
		    if($_POST['password']!==$_POST['password_again'])
			{
			 $errors[]='the passwords do not match';
			}
			//checking for the password length if greater than 6
			else if(strlen($_POST['password'])<6)
			{
			 $errors[]="The password length must be six characters long";
			}
			else
			{
			
			}
		}
		else
		{
		 $errors[]='enter all the fields given';
		}
	
	
if (isset($_GET['success']) && empty($_GET['success']))
	{
echo 'Your password has been changed';
}
	
else
    {
     //if any of the posts are not empty and there are no errors
     if(empty($_POST)=== false && empty($errors)=== true)
    {
		$email_code = $_GET['email'];
		$query=mysql_query("SELECT (`email`) FROM `Login` WHERE `email_code` = '$email_code'");
		while($result = mysql_fetch_assoc($query)) {
			$email = $result['email'];
		}
		change_password(user_id_from_email($email),$_POST['password']);
		header('Location:recoverpage.php?success');
	}
	else if(empty($errors)!== true)
	{
		echo output_errors($errors);
    }
	
	?>
	
	 <form action="" method="post">
<ul>
    <h1>Change your password here</h1>
	<li>
	New password:<br>
	<input type="password" name="password">
	</li>
	<li>
	New password again:<br>
	<input type="password" name="password_again">
	</li>
	<li>
	<input type="submit" value="change your password">
	</li>
	
</ul>


</form>

<?php
}
?>
