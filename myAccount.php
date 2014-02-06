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
//
//get the face photo of this user 
$query_fetchPhotoname="Select photoname from userphoto where userid='".$_SESSION['userid']."'";
$result_fetchPhotoname=mysql_query($query_fetchPhotoname);
if(!$result_fetchPhotoname) die ("Database access failed! Please try again later.".mysql_error());
$row = mysql_fetch_row($result_fetchPhotoname);
$facePicName=$row[0];//$row[0]: 41500001face.png
//
$query_fetchmycurrentpassword="Select password from userinfo where userid='".$_SESSION['userid']."'";
$result_fetchmycurrentpassword=mysql_query($query_fetchmycurrentpassword);
if(!$result_fetchmycurrentpassword) die ("Database access failed! Please try again later.".mysql_error());
$oneRowpassword = mysql_fetch_array($result_fetchmycurrentpassword);
$getCurrentpassword = $oneRowpassword['password'];
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

div.myCountArea{
position:relative;
margin-left:5%;
margin-right:5%;
margin-top:1%;
border:solid;
border-color:#CCCCCC;
border-width:1px;
height:auto;
overflow:hidden;}

div.myAccountTopBar{
position:relative;
margin-left:5%;
margin-right:5%;
margin-top:1%;
border:solid;
border-color:#CCCCCC;
border-width:1px;
height:auto;
overflow:hidden;}

div.div_showGeneralInfo{
position:relative;
margin-left:5%;
margin-right:5%;
margin-top:1%;
border:solid;
border-color:#CCCCCC;
border-width:1px;
height:auto;
overflow:hidden;}

div.div_changepassword{
position:relative;
margin-left:5%;
margin-right:5%;
margin-top:1%;
border:solid;
border-color:#CCCCCC;
border-width:1px;
height:auto;
overflow:hidden;}

div.div_closeaccount{
position:relative;
margin-left:5%;
margin-right:5%;
margin-top:1%;
border:solid;
border-color:#CCCCCC;
border-width:1px;
height:auto;
overflow:hidden;}

</style>

<script language="JavaScript" type="text/javascript">
function showGeneralInfo()
{
  document.getElementById("div_showGeneralInfo").style.display="block";
  document.getElementById("div_changepassword").style.display="none";
  document.getElementById("div_closeaccount").style.display="none";
  document.getElementById("ifclickmustclose").style.display="none";
  document.getElementById("showGeneralInfo").parentNode.className="active";
  document.getElementById("changepassword").parentNode.className="";
  document.getElementById("closeaccount").parentNode.className="";

  
}
function changepassword()
{
  document.getElementById("ifclickmustclose").style.display="none";
  document.getElementById("div_showGeneralInfo").style.display="none";
  document.getElementById("div_changepassword").style.display="block";
  document.getElementById("div_closeaccount").style.display="none";
  document.getElementById("showGeneralInfo").parentNode.className="";
  document.getElementById("changepassword").parentNode.className="active";
  document.getElementById("closeaccount").parentNode.className="";


}
function closeaccount()
{
  document.getElementById("ifclickmustclose").style.display="none";
  document.getElementById("div_showGeneralInfo").style.display="none";
  document.getElementById("div_changepassword").style.display="none";
  document.getElementById("div_closeaccount").style.display="block";
  document.getElementById("showGeneralInfo").parentNode.className="";
  document.getElementById("changepassword").parentNode.className="";
  document.getElementById("closeaccount").parentNode.className="active";

}
function mustclose()
{
  document.getElementById("ifclickmustclose").style.display="block";
}
function resetpasswordchange()
{
  document.getElementById("currentpassword").value="";
  document.getElementById("newpassword").value="";
  document.getElementById("confirmpassword").value="";
}
function feedbackanduse()
{
   window.location.href="thankyoufeedback.php";
}
function logoutaccount()
{
   if(confirm("Are you sure to log out?"))
    {
       window.location.href="index.php";
    }
}
function button_finalfuckoff()
{
  var getpasswordtocloseaccount = "
_END;
?><?php echo $getCurrentpassword;?>";
<?php echo <<<_END
  if(document.getElementById("verifypasswordtoclose").value==getpasswordtocloseaccount)
  {
    if(confirm("Are you sure to colse your account? You will lose all your data!"))
    {
       form_readytofuckoff.submit();  
    }
  }
  else
    alert("Your Password is Invalid!");  
}
function submitpasswordchange()
{
  var fetchcurrPassword = "
_END;
?><?php echo $getCurrentpassword;?>";
<?php echo <<<_END
  if(document.getElementById("currentpassword").value==fetchcurrPassword)
  {
    if(document.getElementById("newpassword").value==document.getElementById("confirmpassword").value)
      form_changepassword.submit();
    else
      alert("Two Passwords Are Not The Same!");  
  }
  else
  {
    alert("Invalid Current Password! Please Input Again.");
  }  
}
</script>
<body onload="showGeneralInfo(); unreadMsg()" style="background-image:url(assets/images/amaranta_martinez_wallpaper.jpg); background-repeat:no-repeat;">




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




<div id="myCountArea" class="col-md-9">

<div id="myAccountTopBar" class="nav nav-tabs">
<li class="active"><a id="showGeneralInfo" class="showGeneralInfo" onclick="javascript:showGeneralInfo()" data-toggle="tab">General Info</a></li>
<li class=""><a id="changepassword" class="changepassword" onclick="javascript:changepassword()" data-toggle="tab">Change Password</a></li>
<li class=""><a id="closeaccount" class="closeaccount" onclick="javascript:closeaccount()" data-toggle="tab">Close Account</a></li>
<li class=""><a id="logoutaccount" class="logoutaccount" onclick="javascript:logoutaccount()" data-toggle="tab">Log Out</a></li>
</div>




<div id="div_showGeneralInfo" class="">
<a id="img_photo" class="img_photo" href="changeMyPhoto.php"><img src="
_END;
?><?php echo "users/".$_SESSION['userid']."/personFace/".$facePicName;?>"
<?php echo <<<_END
width=220px height=220px alt="photo" class="img-rounded"/></a>
<p></p>
<label id="userid" class="details"></label><p></p>
<label id="username" class="details"></label><p></p>
<label id="email" class="details"></label><p></p>
<label id="firstname" class="details"></label><p></p>
<label id="lastname" class="details"></label><p></p>
<label id="age" class="details"></label><p></p>
<label id="gender" class="details"></label><p></p>
<label id="phonenumber" class="details"></label><p></p>
<label id="address" class="details"></label><p></p>
<label>AtMe Level</label>
<span class="glyphicon glyphicon-star" style="color:#bc2328"></span>
<span class="glyphicon glyphicon-star" style="color:#bc2328"></span>
<span class="glyphicon glyphicon-star" style="color:#bc2328"></span>
<span class="glyphicon glyphicon-star"></span>
<span class="glyphicon glyphicon-star"></span><br>
<a id="modifyMyInfo" class="modifyMyInfo btn btn-danger" href="modifyMyInfo.php"><span class="glyphicon glyphicon-pencil"></span>
Modify</a>
</div>




<div id="div_changepassword" class="">
<form id="form_changepassword" name="form_changepassword" method="post" action="myAccount.php" class="form-horizontal">
		<input type="hidden" name="actionCMR" value="form_changepassword" class="form-control">
		
<label>Change Password</label><p></p>
<label>Input Your Password</label><p></p>
<input type="text" id="currentpassword" name="currentpassword" class="form-control" style="width:200px"/>
<p></p>
<label>New Password</label><p></p>
<input type="text" id="newpassword" name="newpassword" class="form-control" style="width:200px"/>
<p></p>
<label>Confirm New Password</label><p></p>
<input type="text" id="confirmpassword" name="confirmpassword" class="form-control" style="width:200px"/><p></p>
<a id="submitpasswordchange" class="submitpasswordchange btn btn-primary" onclick="submitpasswordchange()">Submit</a>
<a id="resetpasswordchange" class="resetpasswordchange btn btn-default" onclick="resetpasswordchange()">Clear</a>
</form>
</div>




<div id="div_closeaccount" class="">
<label>Close Account</label><p></p>
<label>We value you as important, we are improving our service. Please give us your feedback and suggestion.</label><p></p>
<label>We will take your suggestion seriously.</label><p></p>
<textarea id="feedback" class="feedback form-control" rows="10" style="width:400px"></textarea><p></p>
<a id="feedbackanduse" class="feedbackanduse btn btn-success" onclick="feedbackanduse()"><span class="glyphicon glyphicon-send"></span>
Send feedback</a>
<a id="mustclose" class="mustclose btn btn-danger" onclick="mustclose()">Close anyway</a>

<div id="ifclickmustclose" class="ifclickmustclose">
<form id="form_readytofuckoff" name="form_readytofuckoff" method="post" action="" class="form-horizontal">
		<input type="hidden" name="actionCMR" value="form_readytofuckoff">
<label>Please input your password to close your account.</label><p></p>
<label>When you close your account, all your event will lose!</label><p></p>
<label>Password </label>
<input type="password" id="verifypasswordtoclose" name="verifypasswordtoclose" class="form-control" style="width:200px"/><p></p>
<a id="button_finalfuckoff" class="button_finalfuckoff btn btn-warning btn-lg" onclick="button_finalfuckoff()"><span class="glyphicon glyphicon-warning-sign"></span>
Close account</a>
</form>
</div>

</div>




</div>
</div>
</body>
</html>

_END;

//顯示個人信息
$query_fetchmyinfo="Select * from userinfo where userid='".$_SESSION['userid']."'";
$result_fetchmyinfo=mysql_query($query_fetchmyinfo);
if(!$result_fetchmyinfo) die ("Database access failed! Please try again later.".mysql_error());
$oneRow=mysql_fetch_array($result_fetchmyinfo);
//开始显示自己的信息
echo<<<_END
<script language='javascript' type='text/javascript'>
var userid= "
_END;
?><?php echo $_SESSION['userid'];?>";
<?php echo <<<_END
var username= "
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
var gender = "
_END;
?><?php echo $oneRow['gender'];?>";
<?php echo <<<_END
var age = "
_END;
?><?php echo $oneRow['age'];?>";
<?php echo <<<_END
var phonenumber = "
_END;
?><?php echo $oneRow['phonenumber'];?>";
<?php echo <<<_END
var email = "
_END;
?><?php echo $oneRow['email'];?>";
<?php echo <<<_END
var address = "
_END;
?><?php echo $oneRow['address'];?>";
<?php echo <<<_END
    document.getElementById("userid").innerHTML = "AtMe ID: "+userid;
    document.getElementById("username").innerHTML = "Username: "+username;
    document.getElementById("firstname").innerHTML = "First Name: "+firstname;
    document.getElementById("lastname").innerHTML = "Last Name: "+lastname;
    document.getElementById("gender").innerHTML = "Gender: "+gender;
    document.getElementById("age").innerHTML = "Age: "+age;
    document.getElementById("email").innerHTML = "Email: "+ email;
    document.getElementById("phonenumber").innerHTML = "Cell Phone: "+phonenumber;
    document.getElementById("address").innerHTML = "Address: "+address;
    document.getElementById("hereIsSUername").innerText = username;

</script>
_END;

//修改密碼部分：
if($_POST['actionCMR']=="form_changepassword")
{	
	$getNewpassword = $_POST['newpassword'];
	//$getCurrentpassword = $getNewpassword;
    $query_updatepassword="Update userinfo SET password='".$getNewpassword."' where userid='".$_SESSION['userid']."'";
	$result_updatepassword=mysql_query($query_updatepassword);
	if(!$result_updatepassword) die ("Can Not Update the Password!".mysql_error());
	echo "<script language='javascript' type='text/javascript'>";
	echo "window.location.href='myAccount.php'";
	echo "</script>";
}
//如果確定要註銷了
if($_POST['actionCMR']=="form_readytofuckoff")
{
	$query_closeaccount="Delete from userinfo where userid=".$_SESSION['userid'];
    if(!mysql_query($query_closeaccount,$db_server))
	  echo "Cannot close this account. Please check database connection!".mysql_error().'<br/>';
	  else
	  {
	  	$url = "index.php";
	    echo "<script language='javascript' type='text/javascript'>";
	    echo "window.location.href='$url'";
	    echo "</script>";
	  }
}






?>