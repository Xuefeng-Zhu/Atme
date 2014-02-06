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
//
function filterParam($url, $paramArg)
{
	$result = array();
	$parts = parse_url($url);
	parse_str($parts['query'], $output);
	while (list($key, $val) = each($output))
	if($paramArg[$key]) $result[$key] = $val;
	return $result;
}
$url = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
$paramArg = array('id'=>true);
$linkResult= filterParam($url,$paramArg);
//
//$linkResult['id'];
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

div.sendMsgArea{
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
function sendMsgClick()
{
  form_sendMsgClick.submit();  
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



<div id="sendMsgArea" class="">

<form id="form_sendMsgClick" name="form_sendMsgClick" method="post" action="">
		<input type="hidden" name="actionCMR" value="form_sendMsgClick">	
<label>To:  </label><label id="receiver"></label><p></p>
<label>Message:</label><p></p>
<textarea id="msgContent" name="msgContent" style="width:400px; height: 300px" class="form-control"></textarea>
<p></p>
<a id="sndMsgButton" class="MsgButton btn btn-success" onclick="sendMsgClick()"><span class="glyphicon glyphicon-send"></span> Send</a>
<a id="gobackButton" class="MsgButton btn btn-default" href="javascript:history.go(-1);">Back</a>
</form>
</div>

</div>
</body>
</html>

_END;
//
$query_fetchUsername="Select username from userinfo where userid='".$_SESSION['userid']."'";
$result_fetchUsername=mysql_query($query_fetchUsername);
if(!$result_fetchUsername) die ("Database access failed! Please try again later.".mysql_error());
$row = mysql_fetch_row($result_fetchUsername);
$thisUsername = $row[0];

echo<<<_END
<script language='javascript' type='text/javascript'>
var username = "
_END;
?><?php echo $thisUsername;?>";
<?php echo <<<_END
document.getElementById("hereIsSUername").innerText = username;
</script>
_END;

//显示收件人姓名...
$query_fetchReceiver="Select username from userinfo where userid='".$linkResult['id']."'";
$result_fetchReceiver=mysql_query($query_fetchReceiver);
if(!$result_fetchReceiver) die ("Database access failed! Please try again later.".mysql_error());
$row1 = mysql_fetch_row($result_fetchReceiver);
$receiverName = $row1[0];
echo<<<_END
<script language='javascript' type='text/javascript'>
var receiverName= "
_END;
?><?php echo $receiverName;?>";
<?php echo <<<_END
    document.getElementById("receiver").innerHTML = receiverName;
</script>
_END;



if($_POST[actionCMR]=="form_sendMsgClick")
{
	$msgContent = $_POST['msgContent'];
	$senderName = $thisUsername;
	$senderID = $_SESSION['userid'];
	$receiverID = $linkResult['id'];
	$date = date("Y-n-j");
	$dateStemp = strtotime($date);
	//unread = 1 表示没有读，import=0表示不重要
	$query_insertMsg="Insert into message Values"."(NULL, '$senderName', '$receiverName', '$senderID', '$receiverID', '$dateStemp', '$msgContent',  '1', '0')";
	if(!mysql_query($query_insertMsg, $db_server))
	    echo "Insert message failed to Event_Party! <br/>".mysql_error().'<br/>';
	    
	  //$url = "seeHisProfile.php?id=".$linkResult['id'];
	  $url = "myMessage.php";
	  echo "<meta http-equiv='refresh' content=2;url='".$url."'>Sending...";
	  //echo "<script language='javascript' type='text/javascript'>";
	 //echo "window.location.href='$url'";
	  //echo "</script>";	
}













?>