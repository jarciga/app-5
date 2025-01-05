<?php
		include('dbcon.php');
		session_start();
		$username = $_POST['username'];
		$password = $_POST['password'];

		$encryptedPass= sha1($password);
				
		$query = mysql_query("SELECT * FROM users WHERE username='$username' AND password='$encryptedPass'")or die(mysql_error());
		$count = mysql_num_rows($query);
		$row = mysql_fetch_array($query);


		if ($count > 0){
		
		$_SESSION['id']=$row['user_id'];
		
		echo 'true';
		
		mysql_query("insert into user_log (username,login_date,user_id)values('$username',NOW(),".$row['user_id'].")")or die(mysql_error());
		 }else{ 
		echo 'false';
		}	
				
		?>