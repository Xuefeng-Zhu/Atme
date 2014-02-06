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
//$_SESSION['userid']
//get the face photo of this user 
$query_fetchPhotoname="Select photoname from userphoto where userid='".$_SESSION['userid']."'";
$result_fetchPhotoname=mysql_query($query_fetchPhotoname);
if(!$result_fetchPhotoname) die ("Database access failed! Please try again later.".mysql_error());
$row = mysql_fetch_row($result_fetchPhotoname);
$facePicName=$row[0];//$row[0]: 41500001face.png
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

<title>My Events</title>
</head>
<style type="text/css">

div.allCate_Left{
float:left;
margin-left:5%;
margin-right:0%;
margin-top:1%;
border:solid;
border-color:#CCCCCC;
border-width:1px;
height:auto;
}

div.div_photo{
float:left;}

div.logo_bar{
margin-left:5%;
margin-right:5%;
margin-top:1%;
border:solid;
border-color:#CCCCCC;
border-width:1px;
height:auto;}

div.modifyMyinfoArea{
position:relative;
margin-left:5%;
margin-right:5%;
margin-top:1%;
border:solid;
border-color:#CCCCCC;
border-width:1px;
height:auto;
overflow:hidden;
}

div.showAllMyInfoTextbox{
position:relative;
margin-left:5%;
margin-right:5%;
margin-top:1%;
border:solid;
border-color:#CCCCCC;
border-width:1px;
height:auto;
overflow:hidden;
}
</style>
<script language="JavaScript" type="text/javascript">
function myinfo_modify_submit()
{
  if(confirm("Are you sure to submit your personal information?"))
     form_AllMyInfoTextbox.submit(); 
}
</script>
<body  onload="unreadMsg()" style="background-image:url(assets/images/amaranta_martinez_wallpaper.jpg); background-repeat:no-repeat;">

<nav class="navbar navbar-default" role="navigation">
	<div class="container">
		<div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
			<a id="logo" class="logo navbar-brand" href="homepage.php" style="padding: 0px 0px"><img src="assets/ico/atme.jpg" width=50px height=50px class="img-rounded" alt="thisislogo"/>Atme</a>
        </div>
		<div class="collapse navbar-collapse">
		<ul class="nav navbar-nav nav-tabs">
		  <li class=""><a id="myEvent" class="myEvent glyphicon glyphicon-list-alt" href="myEvent.php"> MyEvent</a>
</li>
		  <li class=""><a id="searchEvent" class="searchEvent glyphicon glyphicon-search" href="searchEvent.php"> SeachEvent</a>
</li>
		  <li class=""><a id="myAccount" class="myAccount glyphicon glyphicon-user" href="myAccount.php"> MyAccount</a>
</li>
		  <li class=""><a id="myMessage" class="myMessage glyphicon glyphicon-comment" href="myMessage.php"> MyMessage</a>
</li>
		</ul>
		</div>
         

	</div>
</nav>







<div class="container-fluid">
<div class="col-md-3">
<div id="allCate_Left" class="allCate_Left panel panel-info">
<div class="panel-heading">
<div id="photo_name_star" class="photo_name_star">
<div id="div_photo" class="div_photo">
<a id="img_photo" class="img_photo" href="myAccount.php"><img src="
_END;
?><?php echo "users/".$_SESSION['userid']."/personFace/".$facePicName;?>"
<?php echo <<<_END
width=110px height=110px alt="photo" class="img-circle"/></a>
</div>

<table><tr><td id="hereIsSUername" width=105px height=80px style="word-break:break-all" class="lead">.....</td></tr></table>
<span class="glyphicon glyphicon-star" style="color:#bc2328"></span>
<span class="glyphicon glyphicon-star" style="color:#bc2328"></span>
<span class="glyphicon glyphicon-star" style="color:#bc2328"></span>
<span class="glyphicon glyphicon-star"></span>
<span class="glyphicon glyphicon-star"></span>
</div>
</div>
<div class="well" style="margin-bottom:0px">
<P></P>
<label >At Me Category</label><P></P>
<div class="list-group">
<a id="category_study" class="category_study list-group-item" href="categoryStudy.php">Study</a><P></P>
<a id="category_party" class="category_party list-group-item" href="categoryParty.php">Party</a><P></P>
<a id="category_shopping" class="category_shopping list-group-item" href="categoryShopping.php">Shopping</a><P></P>
<a id="category_travelling" class="category_travelling list-group-item" href="categoryTravelling.php">Traveling</a><P></P>
<a id="category_dating" class="category_dating list-group-item" href="categoryDating.php">Dating</a>
</div>
</div>
</div>
</div>





<div id="modifyMyinfoArea" class="col-md-9">
<h2><label>Change Your Information</label></h2><p></p>
<form id="form_AllMyInfoTextbox" name="form_AllMyInfoTextbox" method="post" action="" class="form-horizontal">
		<input type="hidden" name="actionCMR" value="form_AllMyInfoTextbox">
<label id="username" class="details">Username: </label>
<input type="text" id="currUsername" name="currUsername" class="form-control" style="width:200px"/><p></p>
<label id="firstname" class="details">Firstname: </label>
<input type="text" id="currFirstname" name="currFirstname" class="form-control" style="width:200px"/><p></p>
<label id="lastname" class="details">Lastname</label>
<input type="text" id="currLastname" name="currLastname" class="form-control" style="width:200px"/><p></p>
<label id="age" class="details">Age: </label>
<input type="text" id="currAge" name="currAge" class="form-control" style="width:200px"/><p></p>
<label id="phonenumber" class="details">Phone Number: </label>
<input type="text" id="currPhonenumber" name="currPhonenumber" class="form-control" style="width:200px"/><p></p>
<label id="address" class="details">Address: </label>
<input type="text" id="currAddress" name="currAddress" class="form-control" style="width:400px"/><p></p>
<a id="myinfo_modify_submit" class="myinfo_modify_submit btn btn-primary" onclick="myinfo_modify_submit()"><span class="glyphicon glyphicon-check"></span>
Submit</a>
</form>


</div>






</div>
</body>
</html>

_END;
//
$query_fetchMyInfo="Select * from userinfo where userid='".$_SESSION['userid']."'";
$result_fetchMyInfo=mysql_query($query_fetchMyInfo);
if(!$result_fetchMyInfo) die ("Database access failed! Please try again later.".mysql_error());
$oneRow=mysql_fetch_array($result_fetchMyInfo);
$thisUsername=$oneRow['username'];

echo<<<_END
<script language='javascript' type='text/javascript'>
var username = "
_END;
?><?php echo $thisUsername;?>";
<?php echo <<<_END
document.getElementById("hereIsSUername").innerText = username;
</script>
_END;
//開始為每一個textbox賦值
echo<<<_END
<script language='javascript' type='text/javascript'>
var username = "
_END;
?><?php echo $oneRow['username'];?>";
<?php echo <<<_END
var firstname = "
_END;
?><?php echo $oneRow['firstname'];?>";
<?php echo <<<_END
var lastname = "
_END;
?><?php echo $oneRow['lastname'];?>";
<?php echo <<<_END
var age = "
_END;
?><?php echo $oneRow['age'];?>";
<?php echo <<<_END
var phonenumber = "
_END;
?><?php echo $oneRow['phonenumber'];?>";
<?php echo <<<_END
var address = "
_END;
?><?php echo $oneRow['address'];?>";
<?php echo <<<_END
document.getElementById("currUsername").value = username;
document.getElementById("currFirstname").value = firstname;
document.getElementById("currLastname").value = lastname;
document.getElementById("currAge").value = age;
document.getElementById("currPhonenumber").value = phonenumber;
document.getElementById("currAddress").value = address;
</script>
_END;
//点击提交修改的按钮啦啦啦
if($_POST[actionCMR]=="form_AllMyInfoTextbox")
{
	$username = $_POST['currUsername'];
	$firstname = $_POST['currFirstname'];
	$lastname = $_POST['currLastname'];
	$age = $_POST['currAge'];
	$phonenumber = $_POST['currPhonenumber'];
	$address = $_POST['currAddress'];
	$query_updateMyInfo="Update userinfo SET username='".$username."', firstname='".$firstname."', lastname='".$lastname."', age='".$age."', phonenumber='".$phonenumber."', address='".$address."' where userid='".$_SESSION['userid']."'";
	$result_updateMyInfo=mysql_query($query_updateMyInfo);
	if(!$result_updateMyInfo) die ("Can Not Update Personal Information!".mysql_error());
	//
	echo "<script language='javascript' type='text/javascript'>";
	echo "window.location.href='myAccount.php'";
	echo "</script>";
}












?>