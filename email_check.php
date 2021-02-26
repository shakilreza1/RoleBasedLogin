<?php 
	include "conn.php";
	
	
	$email=$_REQUEST['e'];
	
	$sel=mysql_query("SELECT * FROM login WHERE email='$email'");
	
	$row=mysql_num_rows($sel);
	
	if($row>0)
	{
		echo "Email Already Exist.";
	}
	
?> 