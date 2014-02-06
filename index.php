<?php
session_start();
//connect to mysql
require_once 'loginDB.php';
$db_server = mysql_connect($db_hostname,$db_username,$db_password);
if(!$db_server) die ("Unable to connect to MySQL database!!".mysql_error());
//select database
mysql_select_db($db_database)
or die ("Unable to select database! Please check the connection.".mysql_error());
mysql_query("set names 'gb2312'");
//
$_SESSION['userid']="";//used for log out
$_SESSION['query_study']="";
$_SESSION['query_party']="";
$_SESSION['query_range']="";
$_SESSION['query_zip']="";
//
echo<<<_END
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<metaname="viewport"content="width=device-width, initial-scale=1.0"]]>
<link rel="shortcut icon" href="assets/ico/favicon.png">
<link href="css/bootstrap.css" rel="stylesheet">
<link href="css/bootstrap-theme.css" rel="stylesheet">
<link href="css/signin.css" rel="stylesheet">


<title>Welcome to At Me</title>

<style type="text/css">

div.showInvalidMsg{display:none;}					
</style>
				
<script language="javascript" type="text/javascript">

function checkLogin()
{
 if(document.getElementById("username").value!="" && document.getElementById("password").value!="")
 {
	form_login.submit();
	
 }
 else
 {
	alert("Please enter valid informatin to login!");
 }
}
//
function signUp()
{
    window.location.assign("signup.php");
}
</script>

</head>

<body>
<div class ="container">
<form id="form_login" name="form_login" method="post" action="" class="form-signin">
<h2 class="form-signin-heading">Sign in</h2>
  <input type="hidden" name="actionCMR" value="form_login">
  <label>Username/Email:</label><input type="text" id="username" name="username" class="form-control"/><p></p>  
  <label>Password:</label> <input type="password" id="password" name="password" class="form-control"/>
  
  <a id="loginButton" class="loginButton btn btn-lg btn-primary btn-block" onclick="checkLogin()">Log in</a>
  <a id="signUpButton" class="signUpButton btn btn-lg btn-success btn-block" onclick="signUp()">Sign up</a>
</form>

<div id="showInvalidMsg" class="showInvalidMsg">
<p class="text-center"><label >Your login information cannot be varified! Please input again.</label></p>
</div>
</div>
</body>
</html>
_END;

if($_POST[actionCMR]=="form_login")
{
	$getUsernameEmail = $_POST['username'];
    $getPassword = $_POST['password'];
    //
    $query_checkLogin="Select * from userinfo where email='".$getUsernameEmail."' AND password = '".$getPassword."'";
    $result_checkLogin=mysql_query($query_checkLogin);
    if(!$result_checkLogin) die ("Database access failed! Please try again later.".mysql_error());
    $numberOfRows=mysql_num_rows($result_checkLogin);
	if($numberOfRows ==0)
	{
echo<<<_END
       <script language='javascript' type='text/javascript'>
       document.getElementById("showInvalidMsg").style.display="block";
       </script>
_END;
	}
	else 
	{
		$row = mysql_fetch_row($result_checkLogin);
		$_SESSION['userid']=$row[0];
		//
		$urlGoto = "homepage.php";
		echo "<script language='javascript' type='text/javascript'>";
		echo "window.location.href='$urlGoto'";
		echo "</script>";
	}
		

}







?>