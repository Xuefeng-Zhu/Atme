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
//get detail info about this message
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
//$linkResult['id'];

$query_showMyMsg="Select * from message where id='".$linkResult['id']."'";
$result_showMyMsg=mysql_query($query_showMyMsg);
if(!$result_showMyMsg) die ("Database access failed - view this message! Please try again later.".mysql_error());
$row_eachMsgInfo = mysql_fetch_row($result_showMyMsg);
//mark this message as unread
if($row_eachMsgInfo[7]=="1")
{
	$query_changeUnread="Update message SET unread='0' where id='".$linkResult['id']."'";
	$result_changeUnread=mysql_query($query_changeUnread);
	if(!$result_changeUnread) die ("Can Not change to readed!".mysql_error());
}






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

div.viewthismessage{
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
function replyHere()
{
var senderID= "
_END;
?><?php echo $row_eachMsgInfo[3];?>";
<?php echo <<<_END

  var url = "sendMsg.php?id="+senderID;
  window.location.href= url;

}
function changeImportant()
{
    form_importantChange.submit();
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



<div id="viewthismessage" class="">
<h2 class="text-center"><label>View Message</label></h2>

<label>Sender Name:  </label><label id="senderName"></label>
<p></p>
<label>Sender ID:  </label><label id="senderID"></label>
<p></p>
<label>Receiver Name:  </label><label id="receiverName"></label>
<p></p>
<label>Sent Date:  </label><label id="date"></label>
<p></p>
<label>Message Content:  </label><label id="content"></label>
<p></p>
<label>Mark As:  </label><label id="important"></label>
<p></p>
<form name="form_importantChange" id="form_importantChange" method="post">
	   <input type="hidden" name="actionCMR" value="form_importantChange">
<label>Change to </label><a id="changeImportant" class="changeImportant" onclick="changeImportant()"><img id="img_changeImportant" src="systemPictures/im.png" width=20px height=20px alt="changeImportant"/></a>
<p></p>
</form>
<a id="replyHere" class="replyHere btn btn-success" onclick="replyHere()">Reply</a>

<a id="goacktoMymessage" class="goacktoMymessage btn btn-default" href="myMessage.php">Back</a>

<p></p>

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


var senderName= "
_END;
?><?php echo $row_eachMsgInfo[1];?>";
<?php echo <<<_END
var senderID= "
_END;
?><?php echo $row_eachMsgInfo[3];?>";
<?php echo <<<_END
var receiverName= "
_END;
?><?php echo $row_eachMsgInfo[2];?>";
<?php echo <<<_END
var date= "
_END;
?><?php echo date('Y-n-j',(int)$row_eachMsgInfo[5]);?>";
<?php echo <<<_END
var content= "
_END;
?><?php echo $row_eachMsgInfo[6];?>";
<?php echo <<<_END
var important= "
_END;
?><?php echo $row_eachMsgInfo[8];?>";
<?php echo <<<_END
document.getElementById("senderName").innerHTML = " "+senderName;
document.getElementById("senderID").innerHTML = "  "+senderID;
document.getElementById("receiverName").innerHTML = "  "+receiverName;
document.getElementById("date").innerHTML = "  "+date;
document.getElementById("content").innerHTML = "  "+content;
if(important=="0")
{
  important="Not Important";
  document.getElementById("img_changeImportant").src="systemPictures/manflag.png";
}
else 
{
  important="Important";
  document.getElementById("img_changeImportant").src="systemPictures/kongflag.png";
}
document.getElementById("important").innerHTML = "  "+important;

</script>
_END;


if($_POST[actionCMR]=="form_importantChange")
{
	if($row_eachMsgInfo[8]==1)
	{
		$query_changeImp="Update message SET important='0' where id='".$linkResult['id']."'";
	    $result_changeImp=mysql_query($query_changeImp);
	    if(!$result_changeImp) die ("Can Not change to imp!".mysql_error());
	}
	else
	{
		$query_changeImp="Update message SET important='1' where id='".$linkResult['id']."'";
	    $result_changeImp=mysql_query($query_changeImp);
	    if(!$result_changeImp) die ("Can Not change to imp!".mysql_error());
	}
	
	$url = "viewMessage.php?id=".$linkResult['id'];
	echo "<script language='javascript' type='text/javascript'>";
	echo "window.location.href='$url'";
	echo "</script>";
}











?>