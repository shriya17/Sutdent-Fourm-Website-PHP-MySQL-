<div id="CONT">
<div id="Q_A">
		
	<script type="text/javascript">

	/*
		------------------------------------------------Sunny--------------------------------------------------------
		This script file is called when the button is clicked. It uses AJAX to get data from the php file and display
		in the div when the button is clicked. The whole page isn't refreshed. Rather, only the div where the data is
		posted is reloaded. 23-09-14	*/
	
	
		function onClick(div,file){
		
		/* We pass the div and the php file to the function. This way we can use the same function for different divs and files 
	       without having to rewrite the function.	*/
			
			if(window.XMLHttpRequest) {
				xmlhttp = new XMLHttpRequest();	
				} else {
				xmlhttp = new ActiveXObject('Microsoft.XMLHTTP');
				}
			//	document.getElementById("counting_ques").innerHTML = xmlhttp.responseText;
			 xmlhttp.onreadystatechange = function() {
			 //console.log(xmlhttp.readyState); For Debugging purpose
 			if(xmlhttp.readyState == 4 && xmlhttp.status == 200) {
				//console.log(xmlhttp.status); //Added for debugging purpose
				document.getElementById(div).innerHTML = xmlhttp.responseText;
				}
			} 
			
			//passing true in the parameters means setting it to asynchronous,passing false means setting it to synchronous
			xmlhttp.open("GET",file,true);
			xmlhttp.send();
			//passese the file through GET method i.e. passes through the url and fetches the data from the php file.
		};
		

	</script>	
		
	<?php 	
          $question_id=$_GET['id'];
		  $_SESSION['id'] = $question_id;
     //echo '$question_id'; For Debugging purpose
	
	if(isset($_GET['id']) === false || empty($_GET['id']) === true) {
		
	?>
		<a href="question.php"> </a>
	<?php 
	} else {
		
		$question_id = $_GET['id'];
		
		$query = "SELECT * FROM `forum` WHERE `id` = '$question_id'";
		$result = mysql_query($query);
		$row = mysql_fetch_assoc($result);
		
		$user_id = $row['user_id'];	
		$query1 = "SELECT * FROM `Login` WHERE `id` ='$user_id'";
		$result1 = mysql_query($query1);
		$row1 = mysql_fetch_assoc($result1);
		
		echo "<h1 class=\"header1\">". $row['question']."</h1>";
	}	
		?>
		
	<button type="button" class="votesbutton" onClick="onClick('counting_ques','questionvotesup.php')"><a class="votebtn"><img src="css/like.png"/>
		</a></button><br />
		
	
	<!-- Sunny: div where the php data fetched by the AJAX request is posted. -->	
	
		<div id="counting_ques">
			<?php echo "<strong> Votes: ". $row['votes'] ."</strong>"; ?>
		</div>

		<button type="button" class="votesbutton" onClick="('counting_ques','questionvotesdown.php')"><a class="votebtn"><img src="css/dislike.png"/>
		</a></button>
		<?php
		echo "<p>". $row['content'] . "</p>";
		?>

</div>


<div id="cat">
<?php echo "<a href=\"category.php\" class=\"cat-btn\">". $row['category'] ."</a>" ?>
</div>

<div class="post">
<?php

echo "<a><u>Posted By:</u></a><br />
<a href=\"profile.php?username=".$row1['username']."\"><b>". $row1['username'] ."</b></a><br /><br />
<a> on <strong>". $row['date'] ."</strong> </a>";

?>
</div>
