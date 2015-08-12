<?php
include 'core/init.php';

$question_id = $_SESSION['id'];
$user_id = $session_user_id;
$query="SELECT * FROM `answer_votes` WHERE `question_id`='$question_id' && `user_id`='$session_user_id'";
$result=mysql_query($query);
$row = mysql_fetch_assoc($result);

if($row != 0) 
{        increment_vote($question_id);
	     delete_user_id($question_id,$user_id);
}
     else 
    {   
	    decrement_vote($question_id);
		add_user_id($question_id,$user_id);
	}
?>
