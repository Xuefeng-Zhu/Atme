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
echo<<<_END
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<metaname="viewport"content="width=device-width, initial-scale=1.0"]]>
<link rel="shortcut icon" href="assets/ico/favicon.png">
<link href="css/bootstrap.css" rel="stylesheet">
<link href="css/bootstrap-theme.css" rel="stylesheet">

<title>Sign Up Today</title>

<style type="text/css">

div.regSucc{display:none;
margin:auto;
width:60%;
height:auto;}

div.regFail{display:none;}

div.div_outerFrame_succ{margin:auto;
border:solid;
border-color:#CCCCCC;
border-width:1px;}

div.div_detailInfo_succ{margin:auto;
border:solid;
border-color:#CCCCCC;
border-width:2px;
width:85%;
height:auto;}

div.noEdge_onlyMargin{margin-left:10%;}

				
</style>

</head>
<body>

<div id="regSucc" class="regSucc">
<p id="signUpSuccess" class="signUpSuccess">Sign Up Successfully!</p>
<div id="div_outerFrame_succ" class="div_outerFrame_succ">
<label>Account Information</label><p></p>
<div id="div_detailInfo_succ" class="div_detailInfo_succ">
<div id="noEdge_onlyMargin" class="noEdge_onlyMargin">
<label id="userid" class="details"></label><p></p>
<label id="username" class="details"></label><p></p>
<label id="email" class="details"></label><p></p>
<label id="password" class="details"></label><p></p>
<label id="firstname" class="details"></label><p></p>
<label id="lastname" class="details"></label><p></p>
<label id="age" class="details"></label><p></p>
<label id="gender" class="details"></label><p></p>
<label id="phonenumber" class="details"></label><p></p>
<label id="address" class="details"></label>
</div></div>
<p></p><p></p>
<a id="gotoSignInButton" class="loginButton btn btn-primary" href="index.php">Back to Login Page</a>
</div>
</div>

<div id="regFail" class="regFail">
<label>The following email address has been registered! Please sign in directly, or use another one email address to register.</label>
<p></p><label id="thatEmail"></label><p></p>
<a id="gotoSignInButton" class="loginButton btn btn-primary" href="index.php">Back to Login Page</a>
<a id="gotoSignUpButton" class="signUpButton btn btn-info" href="signup.php">Try Again</a>
<p></p>
</div>

</body>
</html>

_END;
function recurse_copy($src,$dst)
{
	$dir = opendir($src);
	@mkdir($dst);
	while(false !== ( $file = readdir($dir)) ) {
		if (( $file != '.' ) && ( $file != '..' )) {
			if ( is_dir($src . '/' . $file) ) {
				recurse_copy($src . '/' . $file,$dst . '/' . $file);
			}
			else {
				copy($src . '/' . $file,$dst . '/' . $file);
			}
		}
	}
	closedir($dir);
}

$getUsername = $_POST['username'];
$getEmail = $_POST['email1'];
$getPassword = $_POST['password1'];
$getFirstname = $_POST['firstname'];
$getLastname = $_POST['lastname'];
$getAge = $_POST['age'];
$getGender=$_POST['radio_gender'];
$getPhonenumber = $_POST['phonenumber'];
$getAddress1 = $_POST['address1'];
$getAddress2 = $_POST['address2'];
$allAddress = $getAddress1.", ".$getAddress2;
//
$query_checkHasReg="Select * from userinfo where email='".$getEmail."'";
$result_checkHasReg=mysql_query($query_checkHasReg);
if(!$result_checkHasReg) die ("Database access failed! Please try again later.".mysql_error());
$numberOfRows=mysql_num_rows($result_checkHasReg);
if($numberOfRows ==0)//如果兩個人用相同的郵箱咋會導致插入兩個相同的email地址，所以增加打開郵箱link驗證法（哎呀呀最近累死了還沒做這個功能表著急哦~~）
{
	$query_insert="Insert into userinfo Values"."(NULL,'$getUsername','$getEmail','$getPassword','$getFirstname', '$getLastname', '$getAge', '$getGender[0]', '$getPhonenumber', '$allAddress')";
	if(!mysql_query($query_insert, $db_server))
	    echo "Insert data failed to UserInfo! <br/>".mysql_error().'<br/>';
	//show success msg
	$query_getID="Select userid from userinfo where email='".$getEmail."'";
	$result_getID=mysql_query($query_getID);
	$row = mysql_fetch_row($result_getID);
	$userid=$row[0];
	//设置默认头像文件夹
	mkdir("users/".$userid,0777);
    recurse_copy("systemPictures/defaultFace", "users/".$userid."/personFace");    
    //写入userphoto数据库
    $query_insertPhoto="Insert into userphoto Values"."('$userid','defaultFace.jpg')";
	if(!mysql_query($query_insertPhoto, $db_server))
	    echo "Insert to userphoto failed! Please check the connection of database! <br/>".mysql_error().'<br/>';
	//开始展示confirmation信息
echo<<<_END
<script language='javascript' type='text/javascript'>
    document.getElementById("regSucc").style.display="block";
var userid = "
_END;
?><?php echo $userid;?>";
<?php echo <<<_END
var username = "
_END;
?><?php echo $getUsername;?>";
<?php echo <<<_END
var email = "
_END;
?><?php echo $getEmail;?>";
<?php echo <<<_END
var password = "
_END;
?><?php echo $getPassword;?>";
<?php echo <<<_END
var firstname = "
_END;
?><?php echo $getFirstname;?>";
<?php echo <<<_END
var lastname = "
_END;
?><?php echo $getLastname;?>";
<?php echo <<<_END
var age = "
_END;
?><?php echo $getAge;?>";
<?php echo <<<_END
var gender = "
_END;
?><?php echo $getGender[0];?>";
<?php echo <<<_END
var phoneNumber = "
_END;
?><?php echo $getPhonenumber;?>";
<?php echo <<<_END
var address = "
_END;
?><?php echo $allAddress;?>";
<?php echo <<<_END
    document.getElementById("userid").innerHTML = "Unique UserID: "+userid;
    document.getElementById("username").innerHTML = "Username: "+username;
    document.getElementById("password").innerHTML = "Password: "+password;
    document.getElementById("email").innerHTML = "Email: "+email;
    document.getElementById("firstname").innerHTML = "First Name: "+firstname;
    document.getElementById("lastname").innerHTML = "Last Name: "+lastname;
    document.getElementById("age").innerHTML = "Age: "+age;
    document.getElementById("gender").innerHTML = "Gender: "+gender;
    document.getElementById("phonenumber").innerHTML = "Phone Number: "+phoneNumber;
    document.getElementById("address").innerHTML = "Address: "+address; 

</script>
_END;
}
else//this email addr has beed reg
{
echo<<<_END
<script language='javascript' type='text/javascript'>
   document.getElementById("regFail").style.display="block";
   var thatEmail = "
_END;
?><?php echo $getEmail;?>";
<?php echo <<<_END
       document.getElementById("thatEmail").innerHTML = thatEmail;      
</script>
_END;
}

?>