<?php 
	session_start();
	unset($_SESSION['email']);
	echo $_SESSION['msg']="Logged Out Successfully";
	header('location:index.php');
?>