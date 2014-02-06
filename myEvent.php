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
//get data so that we can put into table (study)
$query_showMyEvents="Select * from event_study where userid='".$_SESSION['userid']."'";
$result_showMyEvents=mysql_query($query_showMyEvents);
//
//get data so that we can put into table (party)
$query_showMyEvents_party="Select * from event_party where userid='".$_SESSION['userid']."'";
$result_showMyEvents_party=mysql_query($query_showMyEvents_party);
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

div.showMyEventArea{
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
function reallyDelete()
{
  if(confirm("Are you sure to delete this event?"))
  return true;
  else return false;
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

<table><tr><td id="hereIsUername" width=105px height=80px style="word-break:break-all" class="lead">.....</td></tr></table>
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

<div id="showMyEventArea" class="col-md-9">
<h2 class="text-center"><label>My Events</label></h2>
<a id="createEvent" class="createEvent btn btn-success" href="createEvent.php"><span class="glyphicon glyphicon-plus"></span>Create</a><P></P>
<div id="InIt" class="tableInIt">
<form name="form_showMyEvent_study" id="form_showMyEvent_study" method="post">
	   <input type="hidden" name="actionCMR" value="form_showMyEvent_study">
	   <table width=95% border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#FFFFFF" class="table table-striped">
        <tr>
         <td  width=5% bgcolor="#CCCCCC"><div align="center"><strong>¡Á</strong></div></td>
         <td  width=20% bgcolor="#CCCCCC"><div align="center"><strong>Event Category</strong></div></td>         
         <td  width=20% bgcolor="#CCCCCC"><div align="center"><strong>Course Number</strong></div></td>
         <td  width=20% bgcolor="#CCCCCC"><div align="center"><strong>Study Date</strong></div></td>
         <td  width=20% bgcolor="#CCCCCC"><div align="center"><strong>Start Time</strong></div></td>
         <td  width=10% bgcolor="#CCCCCC"><div align="center"><strong>Operation</strong></div></td>
        </tr>
_END;

        while($oneRow=mysql_fetch_array($result_showMyEvents))
		{
?>
		<tr>
         <td align="center"bgcolor="#FFFFFF"><a class="" data-toggle="modal" data-target="#sendEmail"><span class="glyphicon glyphicon-share"></span></a></td>
         <td style="word-break:break-all"  bgcolor="#FFFFFF"><div align="center"><?php echo "Study";?></div></td>
         <td style="word-break:break-all"  bgcolor="#FFFFFF"><div align="center"><?php echo $oneRow[course];?></div></td>
         <td style="word-break:break-all"  bgcolor="#FFFFFF"><div align="center"><?php echo date('Y-n-j',(int)$oneRow[date]);?></div></td>
         <td style="word-break:break-all" bgcolor="#FFFFFF"><div align="center"><?php echo $oneRow[starttime];?></div></td>
         <td align="center" bgcolor="#FFFFFF"><a href="viewEachEvent.php?id=<?php echo rawurlEncode( $oneRow[eventid] );?>"> View |  </a> 
         <a onclick="return reallyDelete()" href="deleteFromfirstLevel.php?id=<?php echo rawurlEncode( $oneRow[eventid] );?>">Delete</a></td>
        </tr> 
<?php
	    }
echo<<<_END
</table>
</form>








<form name="form_showMyEvent_party" id="form_showMyEvent_party" method="post" role="form">
	<input type="hidden" name="actionCMR" value="form_showMyEvent_party">
    <table width=95% border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#FFFFFF" class="table table-striped">
	    <tr>
	     <td  width=5% bgcolor="#CCCCCC"><div align="center"><strong>¡Á</strong></div></td>
	     <td  width=20% bgcolor="#CCCCCC"><div align="center"><strong>Event Category</strong></div></td>         
	     <td  width=20% bgcolor="#CCCCCC"><div align="center"><strong>Party Theme</strong></div></td>
	     <td  width=20% bgcolor="#CCCCCC"><div align="center"><strong>Party Date</strong></div></td>
	     <td  width=20% bgcolor="#CCCCCC"><div align="center"><strong>Start Time</strong></div></td>
	     <td  width=10% bgcolor="#CCCCCC"><div align="center"><strong>Operation</strong></div></td>
	    </tr>
_END;
	        while($oneRow_party = mysql_fetch_array($result_showMyEvents_party))
			{
?>
			<tr>
	         <td align="center"bgcolor="#FFFFFF"><a class="" data-toggle="modal" data-target="#sendEmail"><span class="glyphicon glyphicon-share"></span></a></td>
	         
	         <td style="word-break:break-all"  bgcolor="#FFFFFF"><div align="center"><?php echo "Party";?></div></td>
	         <td style="word-break:break-all"  bgcolor="#FFFFFF"><div align="center"><?php echo $oneRow_party[partycategory];?></div></td>
	         <td style="word-break:break-all"  bgcolor="#FFFFFF"><div align="center"><?php echo date('Y-n-j',(int)$oneRow_party[partydate]);?></div></td>
	         <td style="word-break:break-all" bgcolor="#FFFFFF"><div align="center"><?php echo $oneRow_party[partytime];?></div></td>
	         <td align="center" bgcolor="#FFFFFF"><a href="viewEachEvent.php?id=<?php echo rawurlEncode( $oneRow_party[eventid] );?>"> View |  </a> 
	             <a onclick="return reallyDelete()" href="deleteFromfirstLevel.php?id=<?php echo rawurlEncode( $oneRow_party[eventid] );?>">Delete</a></td>
	        </tr> 
<?php
		    }
echo<<<_END
</table>
</form>
</div>
</div>
</div>
<div class="modal fade" id="sendEmail" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">@Friends</h4>
      </div>
      <div class="modal-body">
        <input type="email" class="form-control" placeholder="Email">
        <p></p>
        <textarea class="form-control" rows="7" placeholder="Extra Message"></textarea>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" data-dismiss="modal"><span class="glyphicon glyphicon-send" ></span> Send</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="js/bootstrap.js"></script>
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
document.getElementById("hereIsUername").innerText = username;
</script>
_END;












?>