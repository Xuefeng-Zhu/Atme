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

div.showThisEventArea{
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
div.showThisStudyEvent{display: none;}
div.showThisPartyEvent{display: none;}
div.showThisShoppingEvent{display: none;}

</style>
<script language="JavaScript" type="text/javascript">
function getparm1()
{
	var url=location.href;
	var tmp1=url.split("?")[1];
	var tmp2=tmp1.split("&")[0];
	var tmp3=tmp2.split("=")[1];
	var parm1=tmp3;
	//return parm1;
	if(parm1>=11000001 && parm1<=11999999)//study event 11...
	{
	  document.getElementById("showThisStudyEvent").style.display="block";
	  document.getElementById("showThisPartyEvent").style.display="none";
	  document.getElementById("showThisShoppingEvent").style.display="none";
	}
	else if(parm1>=12000001 && parm1<=12999999)//party event 12...
	{
	  document.getElementById("showThisStudyEvent").style.display="none";
	  document.getElementById("showThisPartyEvent").style.display="block";
	  document.getElementById("showThisShoppingEvent").style.display="none";
	}
	else if(parm1>=13000001 && parm1<=13999999)//shopping event 13...
	{
	  document.getElementById("showThisStudyEvent").style.display="none";
	  document.getElementById("showThisPartyEvent").style.display="none";
	  document.getElementById("showThisShoppingEvent").style.display="block";
	}
}

function deleteThisEvent_study()
{
  if(confirm("Are you sure to delete this event?"))
  {
     form_showThisStudyEvent.submit();  
  }
}
function deleteThisEvent_party()
{
  if(confirm("Are you sure to delete this event?"))
  {
     form_showThisPartyEvent.submit();  
  }
}

function modifyThisEvent()
{
var eventid = "
_END;
?><?php echo $linkResult['id'];?>";
<?php echo <<<_END
  var url = "modifyMyEvent.php?id="+eventid;
  window.location.href = url;
}
</script>
<body onload="getparm1(); unreadMsg()" style="background-image:url(assets/images/amaranta_martinez_wallpaper.jpg); background-repeat:no-repeat;">





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




<div id="showThisEventArea" class="">


<div id="showThisStudyEvent" class="col-md-9">
<form name="form_showThisStudyEvent" id="form_showThisStudyEvent" method="post" class="form">
	   <input type="hidden" name="actionCMR" value="form_showThisStudyEvent">
<label>Study Event</label>
<p></p>
<label id="eventid" class="showmsg"></label><p></p>
<label id="university" class="showmsg"></label><p></p>
<label id="course" class="showmsg"></label><p></p>
<label id="topicType" class="showmsg"></label><p></p>
<label id="detail" class="showmsg"></label><p></p>
<label id="date" class="showmsg"></label><p></p>
<label id="startTime" class="showmsg"></label><p></p>
<label id="length" class="showmsg"></label><p></p>
<label id="building" class="showmsg"></label><p></p>
<label id="room" class="showmsg"></label><p></p>
<label id="otherlocation" class="showmsg"></label><p></p>
<label id="comment" class="showmsg"></label><p></p>
<a id="modifyMyEvent" class="butt_showmsg btn btn-warning" onclick="modifyThisEvent()">Modify</a>
<a id="deleteMyEvent" class="butt_showmsg btn btn-danger" onclick="deleteThisEvent_study()">Delete</a>
</form>
</div>




<div id="showThisPartyEvent" class="col-md-9">
<form name="form_showThisPartyEvent" id="form_showThisPartyEvent" method="post">
	   <input type="hidden" name="actionCMR" value="form_showThisPartyEvent">
<label>Party Event</label>
<p></p>
<label id="eventid_party" class="showmsg"></label><p></p>
<label id="selectPatryCate" class="showmsg"></label><p></p>
<label id="partyDate" class="showmsg"></label><p></p>
<label id="partybeginTime" class="showmsg"></label><p></p>
<label id="whocometoparty" class="showmsg"></label><p></p>
<label id="partytype" class="showmsg"></label><p></p>
<label id="partylength" class="showmsg"></label><p></p>
<label id="partylocation" class="showmsg"></label><p></p>
<label id="partyzip" class="showmsg"></label><p></p>

<a id="modifyMyEvent" class="butt_showmsg btn btn-warning" onclick="modifyThisEvent()">Modify</a>
<a id="deleteMyEvent" class="butt_showmsg btn btn-danger" onclick="deleteThisEvent_study()">Delete</a>
</form>
</div>


<div id="showThisShoppingEvent" class="showThisShoppingEvent"></div>







</div>







</body>
</html>

_END;
//output username next to photo
$query_fetchUsername="Select username from userinfo where userid='".$_SESSION['userid']."'";
$result_fetchUsername=mysql_query($query_fetchUsername);
if(!$result_fetchUsername) die ("Database access failed! Please try again later.".mysql_error());
$row = mysql_fetch_row($result_fetchUsername);
$thisUsername = $row[0];
echo<<<_END
<script language='javascript' type='text/javascript'>
var username = "
_END;
?><?php echo $thisUsername;?>
";
<?php echo <<<_END
document.getElementById("hereIsSUername").innerText = username;
</script>
_END;




//**********BEGIN*************this is study****fetch data and show it in the <label>********************
//now get the eventID:$linkResult['id'].if is 11 then search event_study.
if(substr($linkResult['id'],0,2)=="11")
{
	$query_fetchAStudy="Select * from event_study where eventid='".$linkResult['id']."'";
	$result_fetchAStudy=mysql_query($query_fetchAStudy);
	if(!$result_fetchAStudy) die ("Database access failed! Please try again later.".mysql_error());
	$oneRow=mysql_fetch_array($result_fetchAStudy);
	
echo<<<_END
<script language='javascript' type='text/javascript'>
var eventid = "
_END;
?><?php echo $oneRow['eventid'];?>";
<?php echo <<<_END
var university = "
_END;
?><?php echo $oneRow['schoolname'];?>";
<?php echo <<<_END
var course = "
_END;
?><?php echo $oneRow['course'];?>";
<?php echo <<<_END
var topicType = "
_END;
?><?php echo $oneRow['topictype'];?>";
<?php echo <<<_END
var detail = "
_END;
?><?php echo $oneRow['detail'];?>";
<?php echo <<<_END
var date = "
_END;
?><?php echo date('Y-n-j',(int)$oneRow[date]);?>";
<?php echo <<<_END
var startTime = "
_END;
?><?php echo $oneRow['starttime'];?>";
<?php echo <<<_END
var length = "
_END;
?><?php echo $oneRow['length'];?>";
<?php echo <<<_END
var building = "
_END;
?><?php echo $oneRow['building'];?>";
<?php echo <<<_END
var room = "
_END;
?><?php echo $oneRow['room'];?>";
<?php echo <<<_END
var otherlocation = "
_END;
?><?php echo $oneRow['otherlocation'];?>";
<?php echo <<<_END
var comment = "
_END;
?><?php echo $oneRow['comment'];?>";
<?php echo <<<_END
    document.getElementById("eventid").innerHTML = "The Event ID: "+eventid;
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
}
//**********END*************this is study****fetch data and show it im the <label>********************

//**********BEGIN*************this is party****fetch data and show it im the <label>********************
else if(substr($linkResult['id'],0,2)=="12")
{
	$query_fetchAParty="Select * from event_party where eventid='".$linkResult['id']."'";
	$result_fetchAParty=mysql_query($query_fetchAParty);
	if(!$result_fetchAParty) die ("Database access failed! Please try again later.".mysql_error());
	$oneRow_party=mysql_fetch_array($result_fetchAParty);
	
echo<<<_END
<script language='javascript' type='text/javascript'>
var party_eventid = "
_END;
?><?php echo $oneRow_party['eventid'];?>";
<?php echo <<<_END
var partycategory = "
_END;
?><?php echo $oneRow_party['partycategory'];?>";
<?php echo <<<_END
var partytime = "
_END;
?><?php echo $oneRow_party['partytime'];?>";
<?php echo <<<_END
var partylength = "
_END;
?><?php echo $oneRow_party['partylength'];?>";
<?php echo <<<_END
var partydate = "
_END;
?><?php echo date('Y-n-j',(int)$oneRow_party['partydate']);?>";
<?php echo <<<_END
var whocome = "
_END;
?><?php echo $oneRow_party['whocome'];?>";
<?php echo <<<_END
var partytype = "
_END;
?><?php echo $oneRow_party['partytype'];?>";
<?php echo <<<_END
var partylocation = "
_END;
?><?php echo $oneRow_party['partylocation'];?>";
<?php echo <<<_END
var partyzip = "
_END;
?><?php echo $oneRow_party['partyzip'];?>";
<?php echo <<<_END

    document.getElementById("eventid_party").innerHTML = "The Event ID: "+party_eventid;
    document.getElementById("selectPatryCate").innerHTML = "Party Theme: "+partycategory;
    document.getElementById("partyDate").innerHTML = "Party Date: "+partydate;
    document.getElementById("partybeginTime").innerHTML = "Party Start Time: "+partytime;
    document.getElementById("whocometoparty").innerHTML = "Who Are Invited: "+ whocome;
    document.getElementById("partytype").innerHTML = "Party Type and Food Type:  "+partytype;
    document.getElementById("partylength").innerHTML = "Party Length: "+partylength+" mins";
    document.getElementById("partylocation").innerHTML = "Party Location: " + partylocation;
    document.getElementById("partyzip").innerHTML = "Location Zip: "+partyzip;
</script>
_END;
}


//如果这是一个shopping。。。把值付给render好的label。。。。。。。。。。。。。。。。。。。。。。




//


//现在开始写点击某个删除按钮，删除特定category的这个event
if($_POST[actionCMR]=="form_showThisStudyEvent")
{
	$query="Delete from event_study where eventid=".$linkResult['id'];
    if(!mysql_query($query,$db_server))
	  echo "Cannot Delete This event. Please check database connection!".mysql_error().'<br/>';
	  else
	  {
	  	$url = "myEvent.php";
	    echo "<script language='javascript' type='text/javascript'>";
	    echo "window.location.href='$url'";
	    echo "</script>";
	  }
}
//if是party的删除。。。
if($_POST[actionCMR]=="form_showThisPartyEvent")
{
	$query_delPartyEvent="Delete from event_party where eventid=".$linkResult['id'];
    if(!mysql_query($query_delPartyEvent,$db_server))
	  echo "Cannot Delete This event. Please check database connection!".mysql_error().'<br/>';
	  else
	  {
	  	$url = "myEvent.php";
	    echo "<script language='javascript' type='text/javascript'>";
	    echo "window.location.href='$url'";
	    echo "</script>";
	  }
}
// if 是 shopping的删除...




?>