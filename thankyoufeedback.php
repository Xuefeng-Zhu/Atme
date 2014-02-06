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

div.thankyoufeedback{
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






<div id="allCate_Left" class="allCate_Left">

<div id="photo_name_star" class="photo_name_star">
<div id="div_photo" class="div_photo">
<a id="img_photo" class="img_photo" href="myAccount.php"><img src="
_END;
?><?php echo "users/".$_SESSION['userid']."/personFace/".$facePicName;?>"
<?php echo <<<_END
width=110px height=110px alt="photo"/></a>
</div>

<table><tr><td id="hereIsSUername" width=105px height=70px style="word-break:break-all" >.....</td></tr></table>
<div id="div_level" class="div_level"><img id="img_level" class="img_level" src="systemPictures/level_1.png" width=100px height=35px alt="level"/></div>
</div>
<P></P>
<label>At Me Category</label><P></P>
<a id="category_study" class="category_study" href="categoryStudy.php"><img src="systemPictures/category_study.png" width=220px height=60px alt="category_study"/></a><P></P>
<a id="category_party" class="category_party" href="categoryParty.php"><img src="systemPictures/category_party.png" width=220px height=60px alt="category_party"/></a><P></P>
<a id="category_shopping" class="category_shopping" href="categoryShopping.php"><img src="systemPictures/category_shopping.png" width=220px height=60px alt="category_shopping"/></a><P></P>
<a id="category_travelling" class="category_travelling" href="categoryTravelling.php"><img src="systemPictures/category_travelling.png" width=220px height=60px alt="category_travelling"/></a><P></P>
<a id="category_dating" class="category_dating" href="categoryDating.php"><img src="systemPictures/category_dating.png" width=220px height=60px alt="category_dating"/></a><P></P>

</div>




<div id="thankyoufeedback" class="thankyoufeedback">
<div id="showThankyouMsg" class="showThankyouMsg">
<label>Thank You For Your Feedback!</label><p></p>
<label>We value your feedback as important and will improve our service with your advices!</label><p></p>
<a id="gobacktomyaccount" class="gobacktomyaccount" href="myAccount.php"><img src="systemPictures/gobacktomyaccount" width=110px height=30px alt="gobacktomyaccount"/></a>
<a id="gobacktoMyEvent" class="gobacktoMyEvent" href="myEvent.php"><img src="systemPictures/gobacktoMyEvent.png" width=110px height=30px alt="gobacktoMyEvent"/></a>
<a id="beginSearching" class="beginSearching" href="searchEvent.php"><img src="systemPictures/beginSearching.png" width=110px height=30px alt="beginSearching"/></a>
<a id="gobacktoHomepage" class="gobacktoHomepage" href="homepage.php"><img src="systemPictures/gobacktoHomepage.png" width=110px height=30px alt="gobacktoHomepage"/></a>

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














?>