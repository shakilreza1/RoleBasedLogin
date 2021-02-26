<?php 
	include('conn.php');
	session_start();
	if(!isset($_SESSION['email']))
	{
		header('location:index.php');
	}
?>
<!DOCTYPE html>
<html>
<head>
<title>Untitled Document</title>
<link rel="stylesheet" type="text/css" href="css/user_style.css" />
</head>

<body>

<div id="main">
	<div id="header">
		<div id="logo">My Logo</div>
		<div id="right_head">
			<p class="right">
			<?php 
			$sel="SELECT * FROM login WHERE email='".$_SESSION['email']."'";
			$res=mysql_query($sel);
			$fet=mysql_fetch_array($res);
			echo $fet['fname']." ".$fet['lname'];
			?> | <a href="logout.php">Logout</a></p>
		</div>
	</div>
	
</body>
</html>
