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
if($_SESSION['query_study']=="")
    $_SESSION['query_study'] ="select * from event_study";
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

<title>Search A Event</title>
<script type="text/javascript" src="calendar.js"></script>
<script type="text/javascript" src="My97DatePicker/WdatePicker.js"></script>
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

div.generalSearchEventArea{
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
div.showAllStudyByThisCondition{
position:relative;
margin-left:2%;
margin-right:2%;
margin-top:1%;
border:solid;
border-color:#CCCCCC;
border-width:1px;
height:auto;
overflow:hidden;
}
</style>
<script language="JavaScript" type="text/javascript">
function beforeBeginGeneralSearch()
{
   if(true)//put confirm check here later...
     form_showAllStudyByThisCondition.submit();
}
function reinputSearch()
{
  document.getElementById("selectUniv").selectedIndex = 0;
  document.getElementById("courseNumber").value = "";
  document.getElementById("fromDate").value = "";
  document.getElementById("toDate").value = "";
}
</script>
<body onload="unreadMsg()" style="background-image:url(assets/images/amaranta_martinez_wallpaper.jpg); background-repeat:no-repeat;">



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
<a id="category_study" class="category_study list-group-item active" href="categoryStudy.php">Study</a><P></P>
<a id="category_party" class="category_party list-group-item" href="categoryParty.php">Party</a><P></P>
<a id="category_shopping" class="category_shopping list-group-item" href="categoryShopping.php">Shopping</a><P></P>
<a id="category_travelling" class="category_travelling list-group-item" href="categoryTravelling.php">Traveling</a><P></P>
<a id="category_dating" class="category_dating list-group-item" href="categoryDating.php">Dating</a>
</div>
</div>
</div>
</div>



<div id="generalSearchEventArea" class="col-md-9">
<form id="form_showAllStudyByThisCondition" name="form_showAllStudyByThisCondition" method="post" action="" class="form-inline" role="form">
		<input type="hidden" name="actionCMR" value="form_showAllStudyByThisCondition">
		
<label>Select Your Search Information</label><p></p>
<label>Select A University</label><p></p>
<select name="selectUniv" id="selectUniv" class="form-control" style="width:400px">
      <option selected="selected">-select your university-</option>
      <option>Univ of Illi Urban-Chanpaign</option>
      <option>Univ of Cali Berkeley</option>
      <option>Stanford Univ</option>
      <option>Univ of Cali Riverside</option>
    </select>
<p></p>
<label>Input Your Course Number</label>
<input type="text" id="courseNumber" name="courseNumber" class="form-control" style="width:400px"/>
<p></p>              		
<label>Select A Date Range</label><p></p>
<label>From</label><input id="fromDate" name="fromDate" class="fromDate form-control" type="text" onfocus="javascript:HS_setDate(this)" style="width:200px">
<label>To</label><input id="toDate" name="toDate" class="toDate form-control" type="text" onfocus="javascript:HS_setDate(this)" style="width:200px">
<p></p>
<a id="beginGeneralSearch" class="beginGeneralSearch btn btn-primary" onclick="beforeBeginGeneralSearch()">Search</a>
<a id="reinputSearch" class="reinputSearch btn btn-danger" onclick="reinputSearch()">Clear</a>
</form>

<label>Search Result</label><p></p>
<div id="showAllStudyByThisCondition" class="">

<form name="form_showHisEvent" id="form_showHisEvent" method="post" action="">
	   <input type="hidden" name="actionCMR" value="form_showHisEvent">
	   <table width=100% border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#FFFFFF" class="table table-striped">
        <tr>
         <td  width=15% bgcolor="#CCCCCC"><div align="center">Creator</div></td>
         <td  width=15% bgcolor="#CCCCCC"><div align="center">Event Category</div></td>         
         <td  width=20% bgcolor="#CCCCCC"><div align="center">Course Number</div></td>
         <td  width=20% bgcolor="#CCCCCC"><div align="center">Study Date</div></td>
         <td  width=15% bgcolor="#CCCCCC"><div align="center">Start Time</div></td>
         <td  width=15% bgcolor="#CCCCCC"><div align="center">Operation</div></td>
        </tr>
_END;
        $result_showStudyEvents=mysql_query($_SESSION['query_study']);
        while($oneRow=mysql_fetch_array($result_showStudyEvents))
		{
			$query_getUsername = "select username from userinfo where userid='".$oneRow[userid]."'";
			$result_getUsername = mysql_query($query_getUsername);
			    if(!$result_getUsername) die ("Database access failed! Please try again later.".mysql_error());
			$fetchThisUsername = mysql_fetch_array($result_getUsername);
?>
		<tr>
		<td style="word-break:break-all"  bgcolor="#FFFFFF"><div align="center"><?php echo $fetchThisUsername[username];?></div></td>         
         <td style="word-break:break-all"  bgcolor="#FFFFFF"><div align="center"><?php echo "Study";?></div></td>
         <td style="word-break:break-all"  bgcolor="#FFFFFF"><div align="center"><?php echo $oneRow[course];?></div></td>
         <td style="word-break:break-all"  bgcolor="#FFFFFF"><div align="center"><?php echo date('Y-n-j',(int)$oneRow[date]);?></div></td>
         <td style="word-break:break-all" bgcolor="#FFFFFF"><div align="center"><?php echo $oneRow[starttime];?></div></td>
         <td align="center" bgcolor="#FFFFFF"><a href="viewHisEvent.php?id=<?php echo rawurlEncode( $oneRow[eventid] );?>">View Detail</a></td>
        </tr> 
<?php
	    }
echo<<<_END
</table>
</form>
</div>
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


//����ύ��search����������session
if($_POST[actionCMR]=="form_showAllStudyByThisCondition")
{
	$schoolname = $_POST['selectUniv'];
	$course = $_POST['courseNumber'];
	$fromDate = $_POST['fromDate'];
	$toDate = $_POST['toDate'];
	//����
	if($schoolname!="-select your university-" && $course!="")
	{
		if($fromDate=="")
		    $fromDate=0;
		else 
		    $fromDate= strtotime($fromDate);
		if($toDate=="")
		    $toDate=999999999999999;
		else 
		    $toDate= strtotime($toDate);    
		$_SESSION['query_study']="Select * from event_study where schoolname='".$schoolname."' AND course='".$course."' AND date >=".$fromDate." AND date <=".$toDate; 
	}
	else if ($schoolname!="-select your university-" && $course=="")
	{
		if($fromDate=="")
		    $fromDate=0;
		else 
		    $fromDate= strtotime($fromDate);
		if($toDate=="")
		    $toDate=999999999999999;
		else 
		    $toDate= strtotime($toDate);    
		$_SESSION['query_study']="Select * from event_study where schoolname='".$schoolname."' AND date >=".$fromDate." AND date <=".$toDate; 
	
	}
	else if($schoolname=="-select your university-" && $course!="")
	{
		if($fromDate=="")
		    $fromDate=0;
		else 
		    $fromDate= strtotime($fromDate);
		if($toDate=="")
		    $toDate=999999999999999;
		else 
		    $toDate= strtotime($toDate);    
		$_SESSION['query_study']="Select * from event_study where course='".$course."' AND date >=".$fromDate." AND date <=".$toDate; 
	
	}
	else if($schoolname=="-select your university-" && $course=="")
	{
		if($fromDate=="")
		    $fromDate=0;
		else 
		    $fromDate= strtotime($fromDate);
		if($toDate=="")
		    $toDate=999999999999999;
		else 
		    $toDate= strtotime($toDate);    
		$_SESSION['query_study']="Select * from event_study where date >=".$fromDate." AND date <=".$toDate; 
	
	}

	$urlGoto = "categoryStudy.php";
	echo "<script language='javascript' type='text/javascript'>";
    echo "window.location.href='$urlGoto'";
	echo "</script>";
}






?>