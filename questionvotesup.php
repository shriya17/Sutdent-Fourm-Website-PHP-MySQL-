<?php
/*---------------------------------------------------Guddi------------------------------------------------------------------
This file handles what to do when the vote up button in the question is clicked. It runs the required queries and sends back
the data that is to be displayed in the corresponding div. It is called through the XMLHttpRequest Object in questionpost.php
23-09-14
*/
include 'core/init.php';
//$question_id=$_GET['id'];
//Passing a variable from one php file to another php file using $_SESSION variable.
$question_id = $_SESSION['id'];
$user_id = $session_user_id;
$query="SELECT * FROM `question_votes` WHERE `question_id`='$question_id' && `user_id`='$session_user_id'";
$result=mysql_query($query);
$row = mysql_fetch_assoc($result);

if($row != 0) 
{
	    decrement_vote($question_id,$user_id);
		//delete_user_id($question_id,$user_id);
}else 
{    
		increment_vote($question_id,$user_id);
		add_user_id_up($question_id,$user_id);

	/*
//query to insert into the the votes table
         $query2="INSERT INTO `question_votes` (`question_id`,`user_id`) values ('$question_id','$session_user_id')";
	     $result2=mysql_query($result2);
	 //query to increment the number of votes
	 //getting the table
	 
	     $query3="SELECT * FROM `forum`";
	 //fetching info
	     $result3=mysql_fetch_assoc($query3);
		 if(value up)
		 {
	     $inc=$result3['votes']+1;
		 $query4="UPDATE `forum` SET `votes`='$inc'";
		 }
	 
	     else if(value down)
		 {
	     $query4="UPDATE `forum` SET `votes`";
		 $dec=$result['votes']-1;
		 }
	*/
		 }

?>
