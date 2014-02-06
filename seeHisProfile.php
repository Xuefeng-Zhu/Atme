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
div.his_div_photo{
float:left;}

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

div.hisInfoShowArea{
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

div.his_photo_name_star{
margin-right:2%;
margin-left:2%;
margin-top:2%;
height:150px;}


div.his_info{
border:solid;
border-color:#CCCCCC;
border-width:2px;
position:relative;
margin-left:5%;
margin-right:5%;
margin-top:1%;}




</style>
<script language="JavaScript" type="text/javascript">
function sendMsg()
{
  var receiverID = "
_END;
?><?php echo $linkResult['id'];?>";
<?php echo <<<_END
  var url = "sendMsg.php?id="+receiverID;
  window.location.href = url;
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
		  <li class=""><a id="myMessage" class="myMessage glyphicon glyphicon-list-alt" href="myMessage.php"> MyMessage</a>
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





<div id="hisInfoShowArea" class="hisInfoShowArea">

<div id="his_photo_name_star" class="his_photo_name_star">
<div id="his_div_photo" class="his_div_photo"><a id="his_img_photo" class="his_img_photo"><img id="imgITSELF" src="" width=150px height=150px alt="his_photo"/></a>
</div>
<table><tr><td id="hereIsHisUername" width=105px height=70px style="word-break:break-all" >.....</td></tr></table>
<div id="his_div_level" class="his_div_level"><img id="his_img_level" class="his_img_level" src="systemPictures/level_1.png" width=100px height=35px alt="his_level"/></div>
</div>

<div id="his_info" class="his_info">

<label>Personal Information</label><p></p>
<label id="hisusername" class="hisusername"></label><p></p>
<label id="hisfirstname" class="hisfirstname"></label><p></p>
<label id="hislastname" class="hislastname"></label><p></p>
<label id="hisgender" class="hisgender"></label><p></p>
<label id="hisage" class="hisage"></label><p></p>
<label>Contact Information</label><p></p>
<label id="hisemail" class="hisemail"></label><p></p>
<label id="hisphonenumber" class="hisphonenumber"></label><p></p>
<label id="hisaddress" class="hisaddress"></label><p></p>

<a id="sendMsg" class="sendMsg" onclick="sendMsg()"><img src="systemPictures/sendMsg.png" width=150px height=50x alt="sendMsg"/></a>       
<a id="leaveHispage" class="leaveHispage" onclick="history.go(-1)"><img src="systemPictures/leaveHispage.png" width=150px height=50x alt="leaveHispage"/></a>
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

//开始显示个人信息的数据
//
$query_fetchHisInfo="Select * from userinfo where userid='".$linkResult['id']."'";
$result_fetchHisInfo=mysql_query($query_fetchHisInfo);
if(!$result_fetchHisInfo) die ("Database access failed! Please try again later.".mysql_error());
$oneRow=mysql_fetch_array($result_fetchHisInfo);
//
//get the face photo of HIS user 
$query_fetchHISPhotoname="Select photoname from userphoto where userid='".$oneRow['userid']."'";
$result_fetchHISPhotoname=mysql_query($query_fetchHISPhotoname);
if(!$result_fetchHISPhotoname) die ("Database access failed! Please try again later.".mysql_error());
$rowHIS = mysql_fetch_row($result_fetchHISPhotoname);
$hisfacePicName=$rowHIS[0];//$row[0]: 41500001face.png
//
//
echo<<<_END
<script language='javascript' type='text/javascript'>
var hisuserID= "
_END;
?><?php echo $oneRow['userid'];?>";
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
var hisphotoname= "
_END;
?><?php echo $hisfacePicName;?>";
<?php echo <<<_END

    document.getElementById("hisusername").innerHTML = "Username: "+username;
    document.getElementById("hisfirstname").innerHTML = "First Name: "+firstname;
    document.getElementById("hislastname").innerHTML = "Last Name: "+lastname;
    document.getElementById("hisgender").innerHTML = "Gender: "+gender;
    document.getElementById("hisage").innerHTML = "Age: "+age;
    document.getElementById("hisemail").innerHTML = "Email: "+ email;
    document.getElementById("hisphonenumber").innerHTML = "Cell Phone: "+phonenumber;
    document.getElementById("hisaddress").innerHTML = "Address: "+address;
    document.getElementById("hereIsHisUername").innerHTML = username;    
    document.getElementById("imgITSELF").src ="users/"+hisuserID+"/personFace/"+hisphotoname;
</script>
_END;
//










?>