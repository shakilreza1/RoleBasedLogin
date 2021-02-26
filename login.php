<?php 
	include('conn.php');
	session_start();
	
?>
<!DOCTYPE html>
<html>
<head>
<title>Untitled Document</title>
</head>

<body>
	<p align="right"><a href="admin_log.php">Admin Login</a></p>
	<form name="frn_login" action="<?php  $_SERVER['PHP_SELF'];?>" method="post">
		<table border="1" align="center" rules="groups" width="400">
			<tr bgcolor="#000000">
				<th colspan="2" style="color:#CCCCCC">Login Form</th>
			</tr>
			<tr>
				<td colspan="2"><?php echo $_SESSION['msg'];?></td>
			</tr>
			<tr>
				<td><b><u>E</u></b>mail</td>
				<td><input type="text" name="email" /></td>
			</tr>
			<tr>
				<td><b><u>P</u></b>assword</td>
				<td><input type="password" name="psw" /></td>
			</tr>
			<tr>
				<td colspan="2" align="center"><p>Not Registered yet?<a href="registration.php">Register Now!!!</a></p></td>
			</tr>
			<tr>
				<td colspan="2" align="right"><input type="submit" name="SUBMIT" value="Login" /></td>
			</tr>
		</table>
	</form>
</body>
</html>
<?php 

	if(isset($_POST['SUBMIT']) && $_POST['SUBMIT']=='Login')
	{
		$email=$_POST['email'];
		$psw=$_POST['psw'];
		
		$sel="SELECT * FROM login WHERE email='$email'";
		$res=mysql_query($sel) or mysql_error();
		$fet=mysql_fetch_array($res);
		$row=mysql_num_rows($res);
		if($row>0)
		{
			if($psw==$fet['psw'] )
			{
				if($fet['status'] == 'Active')
				{
					
					$_SESSION['email']=$email;
					echo "<script>alert('Logged In');
					window.location='home.php'
					</script>";
				}
				else
				{		
					echo "<script>alert('Your Account Is Not Activated');
					window.location='login.php'
					</script>";
				}		
			}
			else
			{	
				echo "<script>alert('Password is Incorrect');
					window.location='login.php'
				</script>";
			}
		}
		else
		{
			echo "<script>alert('You are not Registered');
				window.location='login.php'
			</script>";
		}
		
	}
?>