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

div.createEventSubmitArea{
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

div.showDetailEventInfoInner{
margin-left:5%;
margin-right:5%;
margin-top:1%;
border:solid;
border-color:#CCCCCC;
border-width:1px;
height:auto;}












</style>
<script language="JavaScript" type="text/javascript">
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






<div id="createEventSubmitArea" class="col-md-9">
<div class="alert alert-success"><p>Event has been created successfully!</p></div>
<h2 class="text-center"><label>Event Information</label></h2>

<div id="showDetailEventInfoInner" class="">
<label id="university" class="university"></label><p></p>
<label id="course" class="course"></label><p></p>
<label id="topicType" class="topicType"></label><p></p>
<label id="detail" class="detail"></label><p></p>
<label id="date" class="date"></label><p></p>
<label id="startTime" class="startTime"></label><p></p>
<label id="length" class="length"></label><p></p>
<label id="building" class="building"></label><p></p>
<label id="room" class="room"></label><p></p>
<label id="otherlocation" class="otherlocation"></label><p></p>
<label id="comment" class="comment"></label><p></p>

<a id="gotoMyEvent" class="gotoMyEvent btn btn-default" href="myEvent.php">Back</a>
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

//
$university = $_POST['selectUniv'];
$course = $_POST['classNumber'];
$topicType = $_POST['topicType'];
$detail = $_POST['eventDetail'];
$dateOriginal = $_POST['studyDate'];
$date = strtotime($dateOriginal);
$startTime = $_POST['beginTime'];
$length = $_POST['selectHours']*60+$_POST['selectMinutes'];//use minutes to store
//
if($_POST['radio_buildingRoom'][0]=="choose")
{
	$building = $_POST['selectBuilding'];
	$room = $_POST['selectRoom'];
	$otherlocation ="Has Been Specified";
}
else if ($_POST['radio_buildingRoom'][0]=="diyinput")
{
	$building = "N/A";
	$room = "N/A";
	$otherlocation =$_POST['inputHereLocation'];
}
$comment = $_POST['comment'];
//save in database
$userid = $_SESSION['userid'];
$query_insert="Insert into event_study Values"."(NULL,'$userid','$university','$course','$topicType', '$detail', '$date', '$startTime', '$length', '$building', '$room', '$otherlocation', '$comment')";
	if(!mysql_query($query_insert, $db_server))
	    echo "Insert data failed to eventInfo! <br/>".mysql_error().'<br/>';
//show them onthe screen
echo<<<_END
<script language='javascript' type='text/javascript'>
var university = "
_END;
?><?php echo $university;?>";
<?php echo <<<_END
var course = "
_END;
?><?php echo $course;?>";
<?php echo <<<_END
var topicType = "
_END;
?><?php echo $topictype;?>";
<?php echo <<<_END
var detail = "
_END;
?><?php echo $detail;?>";
<?php echo <<<_END
var date = "
_END;
?><?php echo $dateOriginal;?>";
<?php echo <<<_END
var startTime = "
_END;
?><?php echo $startTime;?>";
<?php echo <<<_END
var length = "
_END;
?><?php echo $length;?>";
<?php echo <<<_END
var building = "
_END;
?><?php echo $building;?>";
<?php echo <<<_END
var room = "
_END;
?><?php echo $room;?>";
<?php echo <<<_END
var otherlocation = "
_END;
?><?php echo $otherlocation;?>";
<?php echo <<<_END
var comment = "
_END;
?><?php echo $comment;?>";
<?php echo <<<_END

    document.getElementById("university").innerHTML = "University: "+university;
    document.getElementById("course").innerHTML = "Course Number: "+course;
    document.getElementById("topicType").innerHTML = "What to do: "+topicType;
    document.getElementById("detail").innerHTML = "Topic Details: "+ detail;
    document.getElementById("date").innerHTML = "Date: "+date;
    document.getElementById("startTime").innerHTML = "Start Time: "+startTime;
    document.getElementById("length").innerHTML = "Lengh of Study: "+length+" mins";
    document.getElementById("building").innerHTML = "Building Name: "+building;
    document.getElementById("room").innerHTML = "Room Number: "+ room;
    document.getElementById("otherlocation").innerHTML = "Specific Location: "+otherlocation;
    document.getElementById("comment").innerHTML = "Other Comment: "+ comment; 

</script>
_END;



















?>