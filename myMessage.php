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
//check unread msg
$query_receiveUnread = "Select * from message where receiverID='".$_SESSION['userid']."' AND unread='1'";
$result_receiveUnread = mysql_query($query_receiveUnread);
if(!$result_receiveUnread) die ("Database access failed - Unread! Please try again later.".mysql_error());
$numberOfUnread = mysql_num_rows($result_receiveUnread);
//
//message I received
$query_showMyMsg="Select * from message where receiverID='".$_SESSION['userid']."'";
$result_showMyMsg=mysql_query($query_showMyMsg);
//message I sent
$query_showMyMsg_msgISENT="Select * from message where senderID='".$_SESSION['userid']."'";
$result_showMyMsg_msgISENT=mysql_query($query_showMyMsg_msgISENT);
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

div.myMessageShowArea{
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
div.showmyreceivedmessagearea{display:block;}
div.showmysentmessagearea{display:none;}
</style>

<script language="JavaScript" type="text/javascript">
function showmySentMsg()
{
   document.getElementById("showmysentmessagearea").style.display = "block";
   document.getElementById("showmyreceivedmessagearea").style.display = "none";
   document.getElementById("mySentMsg").parentNode.className="active";
   document.getElementById("myReceivedMsg").parentNode.className="";

}
function showmyReceivedMsg()
{
   document.getElementById("showmysentmessagearea").style.display = "none";
   document.getElementById("showmyreceivedmessagearea").style.display ="block";
   document.getElementById("mySentMsg").parentNode.className="";
   document.getElementById("myReceivedMsg").parentNode.className="active";

}


function unreadMsg()
{
 var numUNread= "
_END;
?><?php echo $numberOfUnread;?>";
<?php echo <<<_END
if(numUNread==0)
{
    document.getElementById("myMessage").innerHTML=" MyMessage";

}
else
{
     document.getElementById("myMessage").innerHTML=" MyMessage("+numUNread+")";
}

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
<a id="category_study" class="category_study list-group-item" href="categoryStudy.php">Study</a><P></P>
<a id="category_party" class="category_party list-group-item" href="categoryParty.php">Party</a><P></P>
<a id="category_shopping" class="category_shopping list-group-item" href="categoryShopping.php">Shopping</a><P></P>
<a id="category_travelling" class="category_travelling list-group-item" href="categoryTravelling.php">Traveling</a><P></P>
<a id="category_dating" class="category_dating list-group-item" href="categoryDating.php">Dating</a>
</div>
</div>
</div>
</div>



<div id="myMessageShowArea" class="col-md-9">
<h2 class="text-center"><label>Message Wall</label></h2>


<div id="searchArea" class="cate_bar nav nav-tabs">
<li class=""><a id="mySentMsg" class="mySentMsg" onclick="showmySentMsg()">My Sent</a></li>
<li class="active"><a id="myReceivedMsg" class="mySentMsg" onclick="showmyReceivedMsg()">My Receive</a></li>
</div>

<p></p>

<div id="showListArea">


<div id="showmyreceivedmessagearea" class="showmyreceivedmessagearea">
<p>Messages You Received</p>
<form name="form_showMyEvent_study" id="form_showMyEvent_study" method="post">
	   <input type="hidden" name="actionCMR" value="form_showMyEvent_study">
	   <table width=95% border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#FFFFFF" class="table table-striped">
        <tr>
         <td  width=5% bgcolor="#CCCCCC"><div align="center"><strong>¡Á</strong></div></td>
         <td  width=5% bgcolor="#CCCCCC"><div align="center"><strong>¡ó</strong></div></td>
         <td  width=10% bgcolor="#CCCCCC"><div align="center"><strong>Sender</strong></div></td>         
         <td  width=15% bgcolor="#CCCCCC"><div align="center"><strong>Message Date</strong></div></td>
         <td  width=5% bgcolor="#CCCCCC"><div align="center"><strong>¡î</strong></div></td>
         <td  width=40% bgcolor="#CCCCCC"><div align="center"><strong>Message Content</strong></div></td>
         <td  width=20% bgcolor="#CCCCCC"><div align="center"><strong>Operation</strong></div></td>
        </tr>
_END;

        while($oneRow=mysql_fetch_array($result_showMyMsg))
		{
?>
		<tr>
         <td align="center"bgcolor="#FFFFFF"><input type="checkbox" name="chk[]" id="chk" value=<?php echo rawurlencode($oneRow[dopingID])."|".rawurlencode($oneRow[dopingAlias])."|".rawurlencode($oneRow[existForm]);?>></td>
         <td style="word-break:break-all"  bgcolor="#FFFFFF"><div align="center"><a id="mySentMsg" class="mySentMsg""><img id="<?php echo "envelop".$oneRow[id];?>" src="" width=20px height=18px alt="unread"/></a></div></td>
         <td style="word-break:break-all"  bgcolor="#FFFFFF"><div align="center"><?php echo $oneRow[senderName];?></div></td>
         <td style="word-break:break-all"  bgcolor="#FFFFFF"><div align="center"><?php echo date('Y-n-j',(int)$oneRow[date]);?></div></td>
         <td style="word-break:break-all"  bgcolor="#FFFFFF"><div align="center"><a id="flagid" class="flagid""><img id="<?php echo "flag".$oneRow[id];?>" src="" width=18px height=18px alt="flag"/></a></div></td>
         <td style="word-break:break-all"  bgcolor="#FFFFFF"><div align="center"><?php echo $oneRow[content];?></div></td>  
               
         <td align="center" bgcolor="#FFFFFF">
         <a href="viewMessage.php?id=<?php echo rawurlEncode( $oneRow[id] );?>"> View |  </a>

         <a href="sendMsg.php?id=<?php echo rawurlEncode( $oneRow[senderID] );?>"> Reply |  </a> 
         <a onclick="return reallyDelete()" href="deleteFromfirstLevel.php?id=<?php echo rawurlEncode( $oneRow[eventid] );?>">Delete</a>
         </td>
        
        </tr> 
<?php

			if($oneRow[unread]=="1")
			{
echo<<<_END
<script language="JavaScript" type="text/javascript">
var id= "
_END;
?><?php echo $oneRow[id];?>";
<?php echo <<<_END
document.getElementById("envelop"+id).src="systemPictures/unread.png";
</script>
_END;
			}
            else if($oneRow[unread]=="0")
            {
echo<<<_END
<script language="JavaScript" type="text/javascript">
var id= "
_END;
?><?php echo $oneRow[id];?>";
<?php echo <<<_END
document.getElementById("envelop"+id).src="systemPictures/read.png";
</script>
_END;
            }
//............................................        
		if($oneRow[important]=="1")
			{
echo<<<_END
<script language="JavaScript" type="text/javascript">
var id= "
_END;
?><?php echo $oneRow[id];?>";
<?php echo <<<_END
document.getElementById("flag"+id).src="systemPictures/manflag.png";
</script>
_END;
			}
            else if($oneRow[unread]=="0")
            {
echo<<<_END
<script language="JavaScript" type="text/javascript">
var id= "
_END;
?><?php echo $oneRow[id];?>";
<?php echo <<<_END
document.getElementById("flag"+id).src="systemPictures/empty.png";
</script>
_END;
            }
        //............................................     
	    }//while
echo<<<_END
</table>
</form>
</div>







<div id="showmysentmessagearea" class="showmysentmessagearea">
<p>Messages You Sent</p>
<form name="form_showMyEvent_study" id="form_showMyEvent_study" method="post">
	   <input type="hidden" name="actionCMR" value="form_showMyEvent_study">
	   <table width=95% border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#FFFFFF" class="table table-striped">
        <tr>
         <td  width=5% bgcolor="#CCCCCC"><div align="center"><strong>¡Á</strong></div></td>
         <td  width=15% bgcolor="#CCCCCC"><div align="center"><strong>Receiver</strong></div></td>         
         <td  width=15% bgcolor="#CCCCCC"><div align="center"><strong>Message Date</strong></div></td>
         <td  width=50% bgcolor="#CCCCCC"><div align="center"><strong>Message Content</strong></div></td>
         <td  width=15% bgcolor="#CCCCCC"><div align="center"><strong>Operation</strong></div></td>
        </tr>
_END;

        while($oneRow_ISENT=mysql_fetch_array($result_showMyMsg_msgISENT))
		{
?>
		<tr>
         <td align="center"bgcolor="#FFFFFF"><input type="checkbox" name="chk[]" id="chk" value=<?php echo rawurlencode($oneRow[dopingID])."|".rawurlencode($oneRow[dopingAlias])."|".rawurlencode($oneRow[existForm]);?>></td>
         <td style="word-break:break-all"  bgcolor="#FFFFFF"><div align="center"><?php echo $oneRow_ISENT[receiverName];?></div></td>
         <td style="word-break:break-all"  bgcolor="#FFFFFF"><div align="center"><?php echo date('Y-n-j',(int)$oneRow_ISENT[date]);?></div></td>
         <td style="word-break:break-all"  bgcolor="#FFFFFF"><div align="center"><?php echo $oneRow_ISENT[content];?></div></td>
         <td align="center" bgcolor="#FFFFFF"><a href="sendMsg.php?id=<?php echo rawurlEncode( $oneRow_ISENT[senderID] );?>"> View |  </a> 
         <a onclick="return reallyDelete()" href="deleteFromfirstLevel.php?id=<?php echo rawurlEncode( $oneRow_ISENT[eventid] );?>">Delete</a></td>
        
        </tr> 
<?php
	    }
echo<<<_END
</table>
</form>
</div>






</div>
</div>
</div>
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
document.getElementById("hereIsSUername").innerText = username;
</script>
_END;














?>