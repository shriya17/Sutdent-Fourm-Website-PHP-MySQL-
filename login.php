<?php
	/*This is a php file which handles the login. It includes the core/init.php file which initializes the php files.It also includes
	  the overall header and footer ,so as the login errors or login message will be printed in between the overall header and footer	
	*/
     include 'core/init.php';
	 logged_in_redirect();
     include 'includes/overall/header.php';

      if(isset($_POST['username'])&&isset($_POST['password'])) {
        $username= $_POST['username'];
        $password= $_POST['password'];

	/*All the functions called below are defined in the users.php file. */	
      if(empty($username)===true || empty($password)===true) {
	  //Apppends the error to the errors array.	
	  $errors[]= 'You need to enter both username & password';
      } else if(user_exists($username)===false){
        $errors[]= 'We\'re unable to find the username. Have you registered yet ?';
      } else if(user_active($username)===false) {
		$errors[]= 'Please activate your account to login.';
	  }	else {
		
		if(strlen($password) >32) {
			$errors[]= 'Password too long';	 
		}
	  
        $login=login($username,$password);
        if($login===false) {
          $errors[]='Invalid Username and Password combination.';
        }else{
          $_SESSION['user_id']=$login;
          header('Location: index.php');
          exit();
        }
      }
    }else {
		$errors[]='No Data Received';
	}
	if(empty($errors) === false) {
	?>
		<h2>We tried to log you in, but... </h2>
	<?php
		//Calls the output_errors function in users.php with the array errors as the parameter.
		 echo output_errors($errors);	
		 //We've killed the page here because the footer of the page was shifting upwards when the error message(s) was getting printed 
		 //So, to make sure the footer doesn't appear along with the error message,we've killed the page after the error message(s) get
		 //printed.
		 die();	
		 }
?>
      include 'includes/overall/footer.php';
