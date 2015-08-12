<h1 class="header1"> Answers !</h1>	


<?php
if(empty($_POST)===false) {
		$required_fields = array('answer');
		/*foreach($_POST as $key=>$value) 
		{
			if(empty($value) && in_array($key,$required_fields)===true) 
			    {
					$errors[] = 'All fields must be entered.';
					break;					
				}
	
		}*/
		
		if(empty($errors) === true) {
		
		
		}
	}
if (isset($_GET['success']) && empty($_GET['success'])){
		echo '<br>'.'Your answer has been posted successfully!'.'<br>';
	}else {
	
	if(empty($_POST) === false && empty($errors) === true) {
	
		

		$answer_data = array(
			'answer' 	=> $_POST['answer'],
			'question_id'=> $_GET['id'],
			'user_id'	=> $session_user_id,
			'date'		=> date("Y-m-d H:i:s")
		);
		
		$from_user = $session_user_id;
		$_SESSION['from_user_name'] = $from_user;
		answer_post($answer_data);
		$question_id = $_GET['id'];
		post_notification($session_user_id,$question_id);
		header('Location: question.php?id='.$_GET['id']);
		exit();
	}else if(empty($errors) === false) {
		echo output_errors($errors);
	}
	}
	?>
	
		<?php
	$question_id = $_GET['id'];
	$query= mysql_query("SELECT * FROM `answers` WHERE `question_id`='$question_id'") ;

	while($row = mysql_fetch_assoc($query)) 
	{
	$user_name = username_from_user_id($row['user_id']);

echo "<div class=\"anss\"> <button type=\"button\" class=\"votesbutton\" onClick=\"ansOnClick('counting_ans','answervotesup.php')\"><a class=\"votebtn\"><img src=\"css/like.png\"/>
		</a></button><br />
		
		<div class=\"counting_ans\">
			<strong> Votes: ". $row['votes'] ."</strong>
		</div>";


echo "<button type=\"button\" class=\"votesbutton\" onClick=\"ansOnClick('counting_ans','answervotesdown.php')\"><a class=\"votebtn\"><img src=\"css/dislike.png\"/>
		</a></button>";
echo "<p>". $row['answer'] ."</p>
<div class=\"post\">
<a><u>Posted By:</u></a><br />
<a href=\"profile.php?username=". $user_name ."\"><b>". $user_name ."</b></a><br /><br />
<a> on <strong>". $row['date'] ."</strong> </a></div>
</div>";
echo "<div class =\"edit\"> <a href=\"edit.php?answer=". $row['id'] ."\">Edit</a></div>";			
	}
	?>



</div>
<div id="form"><form action="" method="post">
<ul>
     <li> 
	     Answer:<br />
            <textarea rows="2" cols="50" name="answer"> </textarea><br />
		
   </div><br />
	 </li>
	 <li>
	     <input type="submit" value="Enter the Answer">
	 </li>
</ul>
</form>
</div>
</div>
