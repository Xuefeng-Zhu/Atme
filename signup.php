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

echo <<<_END
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<metaname="viewport"content="width=device-width, initial-scale=1.0"]]>
<link rel="shortcut icon" href="assets/ico/favicon.png">
<link href="css/bootstrap.css" rel="stylesheet">
<link href="css/bootstrap-theme.css" rel="stylesheet">
<link href="css/signin.css" rel="stylesheet">

<title>Sing Up Today</title>

<style type="text/css">
div.div_signupInner { LINE-HEIGHT: 10%; }

div.div_signupOuter{ 
margin:auto;
border:solid;
border-color:#CCCCCC;
border-width:2px;
width:60%;
height:auto;
}
div.div_signupInner{ 
margin-left:16%;
}
</style>

<script language="JavaScript" type="text/javascript">

function checkSignUpInfo()
{
  if(document.getElementById("username").value=="" ||
     document.getElementById("email1").value=="" ||
     document.getElementById("email2").value=="" ||
     document.getElementById("password1").value=="" ||
     document.getElementById("password2").value=="")
     {
       alert("Please enter all information marked by *");
     }
  else
  {
     if( document.getElementById("email1").value !=  document.getElementById("email2").value)
     {
        document.getElementById("email2_warning").innerHTML = "   The emails are not the same!";
        return;
     }
     if( document.getElementById("password1").value !=  document.getElementById("password2").value)
     {
        document.getElementById("password2_warning").innerHTML = "   The passwords are not the same!";
        return;
     }
     if(confirm("Submit your signup?"))
        form_signUp.submit();    
  }

}
function clearSignUp()
{
    document.getElementById("username").value="";
    document.getElementById("email1").value="";
    document.getElementById("email2").value="";
    document.getElementById("password1").value="";
    document.getElementById("password2").value="";
    document.getElementById("firstname").value="";
    document.getElementById("lastname").value="";
    document.getElementById("age").value="";
    document.getElementById("phonenumber").value="";
    document.getElementById("address1").value="";
    document.getElementById("address2").value="";
}

</script>

</head>
<body>
<div class="container">
<h2 class="text-center"><label>Sign Up Today!</label></h2>
<div id="div_signupOuter" class="div_signupOuter">
<div id="div_signupInner" class="div_signupInner">
<p></p>
<form id="form_signUp" name="form_signUp" method="post" action="registerSuccess.php" role="form">
  <input type="hidden" name="actionCMR" value="form_signUp">
  <div class="form-group">
  <label>Choose Your Username:</label><p></p><input type="text" id="username" name="username" style="width:70%;" class="form-control"/><p></p>
  <label>Enter Your Email:</label><p></p>
  <input type="text" id="email1" name="email1" style="width:70%;" class="form-control"/><p></p>
  <label>Comfirm Your Email:</label><label id="email2_warning"></label><p></p>
  <input type="text" id="email2" name="email2" style="width:70%;" class="form-control"/><p></p>
  <label>Choose Your Password:</label><label id="password2_warning"></label><p></p>
  <input type="password" id="password1" name="password1" style="width:70%;" class="form-control"/><p></p>
  <label>Comfirm Your Password:</label><p></p>
  <input type="password" id="password2" name="password2" style="width:70%;" class="form-control"/>
  </div>
  <div class="form-group">
  <p></p><p class="text-info">Tell Us More About You!</p>
  <label>First Name:</label><p></p><input type="text" id="firstname" name="firstname" style="width:70%;" class="form-control"/><p></p>
  <label>last Name:</label><p></p><input type="text" id="lastname" name="lastname" style="width:70%;" class="form-control"/><p></p>
  <label>Age:</label><p></p><input type="text" id="age" name="age" style="width:70%;" class="form-control"/><p></p>  
  <label>Gender:</label><p></p><input type="radio" name="radio_gender[]" id="male" value="Male" /><label>Male</label>
  <input type="radio" name="radio_gender[]" id="female" value="Female" /><label>Female</label><p></p>  
  <label>Phone Number:</label><p></p><input type="text" id="phonenumber" name="phonenumber" style="width:70%;" class="form-control"/><p></p>
  <label>Address Line 1:</label><p></p><input type="text" id="address1" name="address1" style="width:70%;" class="form-control"/><p></p>
  <label>Address Line 2:</label><p></p><input type="text" id="address2" name="address2" style="width:70%;" class="form-control"/>
  <p></p><p></p><p></p>
  </div>
  <div style="width:70%;">
  <a id="signUpButton" class="signUpButton btn btn-success" onclick="checkSignUpInfo()">Sign up</a>
  <a id="ClearButton" class="ClearButton btn btn-danger" onclick="clearSignUp()"> Reset </a>
  <a id="gotologin" class="gotologin btn btn-default pull-right" href="index.php">Back</a>
  </div>
  <p></p><p></p><p></p>
</form>
</div></div>
</div>
</body>
</html>

_END;




?>