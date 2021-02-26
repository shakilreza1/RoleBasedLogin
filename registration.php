<?php 
	include 'conn.php';
 ?>
<!DOCTYPE html>
<html>
<head>
<title>Untitled Document</title>
<style type="text/css">@import 'validation.css';</style>
<style type="text/css">
	.button
	{
		margin-right:50px;
		height:30px;
		width:100px;
		background-color:#000000;
		color:#999999;
		border:#999999 solid 2px;
		border-radius:10px;
	}
	</style>
	<script type="text/javascript" language="javascript" src="js/liveValidation.js"></script>

<script type="text/javascript" language="javascript">

function emailCheck(strURL)
{
var xmlhttp;
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("email_check").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("POST",strURL,true);
xmlhttp.send();
}
function check_pwd()
{
	
	var pwd=document.getElementById('pwd').value;
	var cpwd=document.getElementById('cpwd').value;
	if(cpwd==pwd)
	{
		
		document.getElementById('error1').innerHTML='Password Matched';
	}
	else
	{
		document.getElementById('error1').innerHTML='Password Do Not Match';
	}
}
</script>
</head>
<body>
<form name="reg" action="<?php $_SERVER['PHP_SELF'];?>" method="post">
  <table border="1" align="center" rules="groups" width="550" height="500">
    <tr bgcolor="#000000">
      <th colspan="3" style="color:#CCCCCC">Registration Form</th>
    </tr>
    <tr>
      <td><b>Firstname </b> </td>
      <td><input type="text" name="fname" /></td>
	  <td></td>
    </tr>
    <tr>
      <td><b>Lastname </b> </td>
      <td><input type="text" name="lname" /></td>
	  <td></td>
    </tr>
    <tr>
      <td><b>Email </b> </td>
      <td><input type="text" name="email" onblur="emailCheck('email_check.php?e='+this.value);" />
        </td><td><div id="email_check"></div></td>
    </tr>
    <tr>
      <td><b>Password </b> </td>
      <td><input type="password" name="psw" id="pwd" /></td>
	  <td></td>
    </tr>
    <tr>
      <td><b>Confirm Password </b> </td>
      <td><input type="password" name="cpsw" id="cpwd" />
       </td>
	   <td><p id="error1"></p></td>
    </tr>
    <tr>
      <td><b>Gender </b> </td>
      <td><input type="radio" name="gender" value="Male" />
        Male
        <input type="radio" name="gender" value="Female" />
        Female</td>
		<td></td>
    </tr>
    <tr>
      <td><b>Hobby </b> </td>
      <td><input type="checkbox" name="hobby[]" value="Reading" />
        Read
        <input type="checkbox" name="hobby[]" value="Writing" />
        Write
        <input type="checkbox" name="hobby[]" value="Travel" />
        Travel </td>
    </tr>
    <tr>
      <td><b>City </b> </td>
      <td><select name="city_id">
          <option value="">Select City</option>
          <?php 
						$sel_city="SELECT * FROM city ORDER BY city_name";
						$res_city=mysql_query($sel_city);
						while($fet_city=mysql_fetch_array($res_city))
						{
					?>
          <option value="<?php echo $fet_city['city_id'];?>"><?php echo $fet_city['city_name'];?></option>
          <?php
						}
					 ?>
        </select></td>
    </tr>
    <tr>
      <td colspan="2" align="right"><input type="submit" name="SUBMIT" value="Register" class="button" /></td>
    </tr>
  </table>
</form>
<script type="text/javascript">
var pwd = new LiveValidation('pwd',{validMessage:"Correct"});

pwd.add( Validate.Presence );

pwd.add( Validate.Length, { minimum: 6, maximum: 15 } );

var cpwd = new LiveValidation('cpwd',{validMessage:"Correct"});

cpwd.add( Validate.Presence );

cpwd.add( Validate.Length, { minimum: 6, maximum: 15 } );

cpwd.add( Validate.Confirmation, { match: 'pwd' } );
</script>
</body>
</html>
<?php 
	if(isset($_POST['SUBMIT']) && $_POST['SUBMIT']=='Register')
	{		
		$fname=ucfirst(strtolower(trim($_POST['fname'])));
		$lname=ucfirst(strtolower(trim($_POST['lname'])));
		$email=$_POST['email'];
		$psw=$_POST['psw'];
		$cpsw=$_POST['cpsw'];
		$gender=$_POST['gender'];
		$hobby=implode(',',$_POST['hobby']); //The implode function is used to "join elements of an array with a string". The implode() function returns a string from elements of an array.
		$city_id=$_POST['city_id'];
		$status='Inactive';
		
		$chk_email="SELECT * FROM login WHERE email='$email'";
		$rce=mysql_query($chk_email) or mysql_error();
		$row=mysql_num_rows($rce);
		if($row==0)
		{
			
			if($psw==$cpsw)
			{
				echo $ins="INSERT INTO login(id,fname,lname,email,psw,gender,hobby,city_id,status) VALUES(NULL,'$fname','$lname','$email','$psw','$gender','$hobby','$city_id','$status')";
				
				mysql_query($ins);
				echo "<script>alert('Successfully Registered');
					window.location='index.php';
				</script>";
			}
			else
			{
				echo "<script>alert('Password and Confirm Password Are Not Same...');
				window.location='registration.php';
				</script>";
			}
		}
		else
		{
			echo "<script>alert('Some error Occured While Registration...');
				window.location='registration.php';
				</script>";
		}
	}
?>
