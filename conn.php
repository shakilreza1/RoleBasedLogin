<?php 
	$hostname="localhost";
	$username="root";
	$password="";
	
	$conn=mysql_connect($hostname,$username,$password) or die('MYSQL CONNECTION ERROR');
	
	$db=mysql_select_db("accountActivation",$conn) or die('MYSQL DATABASE ERROR');
	error_reporting('E_ALL ^ E_NOTICE');
?>