<?php

include 'core/init.php';

$fetch_not= mysql_query("SELECT * FROM `notifications` WHERE `to_user_id` = '$session_user_id' AND `seen` = 0 ORDER BY `date` DESC");
$number= mysql_num_rows($fetch_not);

while($result = mysql_fetch_assoc($fetch_not)) {
	$date = $result['date'];
	$from_user = $result['from_user_id'];
	$question_id = $result['notification'];
	$from_username = fetch_user_answer($question_id,$from_user); 
	$question_subject = fetch_question_subject($question_id);
	$notification = $from_username ." answered on" . "<a href=\"question.php?id=".$question_id."\">". $question_subject ."</a>".$date;
?>

<div class="notification_ui" >
<div class="notification_text">
<a href="question.php?id=<?php echo $question_id; ?>"><div class = "notification_act_text"><?php echo $notification; ?> </div> </a>
</div>
</div>


<?php }

$query = mysql_query("UPDATE `notifications` SET `seen` = 1 WHERE `to_user_id` = '$session_user_id'");

?>
