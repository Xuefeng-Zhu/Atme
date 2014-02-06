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

div.modifyEventArea{
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

div.modifyThisStudyEvent{display:none;}
div.modifyThisPartyEvent{display:none;}
div.modifyThisShoppingEvent{display:none;}
</style>


<script language="JavaScript" type="text/javascript">
function getparm1()
{
	var url=location.href;
	var tmp1=url.split("?")[1];
	var tmp2=tmp1.split("&")[0];
	var tmp3=tmp2.split("=")[1];
	var parm1=tmp3;
	if(parm1>=11000001 && parm1<=11999999)//study event 11...
	{
	  document.getElementById("modifyThisStudyEvent").style.display="block";
	  document.getElementById("modifyThisPartyEvent").style.display="none";
	  document.getElementById("modifyThisShoppingEvent").style.display="none";
	}
	else if(parm1>=12000001 && parm1<=12999999)//party event 12...
	{
	  document.getElementById("modifyThisStudyEvent").style.display="none";
	  document.getElementById("modifyThisPartyEvent").style.display="block";
	  document.getElementById("modifyThisShoppingEvent").style.display="none";
	}
	else if(parm1>=13000001 && parm1<=13999999)//shopping event 13...
	{
	  document.getElementById("modifyThisStudyEvent").style.display="none";
	  document.getElementById("modifyThisPartyEvent").style.display="none";
	  document.getElementById("modifyThisShoppingEvent").style.display="block";
	}
}
function getCurrBuildingList()
{
  if(document.getElementById("selectUniv").options[document.getElementById("selectUniv").selectedIndex].text=="Univ of Illi Urban-Chanpaign")
  {
    document.getElementById("selectBuilding").options[1].text="Thomas Siebel Center";
    document.getElementById("selectBuilding").options[2].text="Engineering Hall";
    document.getElementById("selectBuilding").options[3].text="Armory Center";
    document.getElementById("selectBuilding").options[4].text="Bionology Research Center";
    document.getElementById("selectBuilding").options[5].text="Burrill Hall";
    document.getElementById("selectBuilding").options[6].text="Illinois Union Hall";
    document.getElementById("selectBuilding").options[7].text="Krannater Center";
    document.getElementById("selectBuilding").options[8].text="Grainger Library";
  }
  else if(document.getElementById("selectUniv").options[document.getElementById("selectUniv").selectedIndex].text=="Univ of Cali Riverside")
  {
    document.getElementById("selectBuilding").options[1].text="Bell Tower";
    document.getElementById("selectBuilding").options[2].text="Rivera Library";
    document.getElementById("selectBuilding").options[3].text="International Village";
    document.getElementById("selectBuilding").options[4].text="Bear Book Store";
    document.getElementById("selectBuilding").options[5].text="Extension Center";
    document.getElementById("selectBuilding").options[6].text="Boyan Hall for ECE";
    document.getElementById("selectBuilding").options[7].text="JiangT Arts Building";
    document.getElementById("selectBuilding").options[8].text="Meizi Hall";
  }
}
//
function getCurrRoomList()
{
  if(document.getElementById("selectUniv").options[document.getElementById("selectUniv").selectedIndex].text=="Univ of Illi Urban-Chanpaign"
  && document.getElementById("selectBuilding").options[document.getElementById("selectBuilding").selectedIndex].text=="Thomas Siebel Center")
  {
    document.getElementById("selectRoom").options[1].text="Rm 0207";
    document.getElementById("selectRoom").options[2].text="Rm 0222";
    document.getElementById("selectRoom").options[3].text="Rm 0224";
    document.getElementById("selectRoom").options[4].text="Rm 1404";
    document.getElementById("selectRoom").options[5].text="Rm 1210";
    document.getElementById("selectRoom").options[6].text="Rm 2018";
    document.getElementById("selectRoom").options[7].text="Rm 2114";
    document.getElementById("selectRoom").options[8].text="Rm 3112";
    document.getElementById("selectRoom").options[9].text="Rm 3205";
    document.getElementById("selectRoom").options[10].text="Rm 4117";
    document.getElementById("selectRoom").options[11].text="Rm 4223";
    document.getElementById("selectRoom").options[12].text="Rm 4405";
    document.getElementById("selectRoom").options[13].text="basement open area";
    document.getElementById("selectRoom").options[14].text="basement white board";
  }
  else if(document.getElementById("selectUniv").options[document.getElementById("selectUniv").selectedIndex].text=="Univ of Cali Riverside"
  && document.getElementById("selectBuilding").options[document.getElementById("selectBuilding").selectedIndex].text=="Rivera Library")
  {
    document.getElementById("selectRoom").options[1].text="Rm UC101";
    document.getElementById("selectRoom").options[2].text="Rm UC103";
    document.getElementById("selectRoom").options[3].text="Rm UC445";
    document.getElementById("selectRoom").options[4].text="Rm UC393";
    document.getElementById("selectRoom").options[5].text="Rm UC65";
    document.getElementById("selectRoom").options[6].text="Rm UC0098";
    document.getElementById("selectRoom").options[7].text="Rm UC880";
    document.getElementById("selectRoom").options[8].text="Rm UC415";
    document.getElementById("selectRoom").options[9].text="Rm UC530";
    document.getElementById("selectRoom").options[10].text="Rm UC778";
    document.getElementById("selectRoom").options[11].text="Rm UC778";
    document.getElementById("selectRoom").options[12].text="Rm UC787";
    document.getElementById("selectRoom").options[13].text="Open Area";
    document.getElementById("selectRoom").options[14].text="DIS Area";
  }
}
function changeRadiobutton()
{
  if(document.getElementById("choose").checked){
   document.getElementById("building_room_area").style.display="block";
   document.getElementById("diyinput_area").style.display="none";}
  else if(document.getElementById("diyinput").checked){
   document.getElementById("diyinput_area").style.display="block";
   document.getElementById("building_room_area").style.display="none";} 
}
function beforeSubmitStudy()
{
  if(confirm("Are you sure you want to modify this study event?"))
    form_beginModifyStudy.submit();
}
function beforeSubmitParty()
{
  if(confirm("Are you sure you want to modify this party event?"))
    form_beginModifyParty.submit();
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





<div id="modifyEventArea" class="modifyEventArea">


<div id="modifyThisStudyEvent" class="modifyThisStudyEvent">
<label>Mofdify Your Study Event</label><p></p>
<form id="form_beginModifyStudy" name="form_beginModifyStudy" method="post" action="">
		<input type="hidden" name="actionCMR" value="form_beginModifyStudy">
<label>Please select your university</label><p></p>
<select name="selectUniv" id="selectUniv">
      <option selected="selected">-select your university-</option>
      <option>Univ of Illi Urban-Chanpaign</option>
      <option>Univ of Cali Berkeley</option>
      <option>Stanford Univ</option>
      <option>Univ of Cali Riverside</option>
    </select>
<p></p>        		
<label>Which course do you want to study</label><p></p>
<input type="text" id="classNumber" name="classNumber" />
<p>Please select your topic type</p>  
<select name="topicType" id="topicType">
      <option selected="selected">-select your topic type-</option>
      <option>Homework</option>
      <option>Lab Assignments</option>
      <option>Machine Problem</option>
      <option>Discussion</option>
      <option>Coding Debugging</option>
      <option>Thesis</option>
    </select> 
<p></p>  
<label>Event Details</label><p></p><textarea id="eventDetail" name="eventDetail"></textarea>
<p></p>
<label>Please choose your study date</label><p></p><input id="studyDate" name="studyDate" class="studyDate" type="text" onfocus="javascript:HS_setDate(this)">
<p></p>
<label>Please choose your begin time</label><p></p>
<input id="beginTime" name="beginTime" type="text" onclick="WdatePicker({dateFmt:'HH:mm'});" />
<p></p>
<label>How long will you study</label><p></p>		
<select name="selectHours" id="selectHours">
      <option selected="selected">-hours-</option>
      <option>0</option>
      <option>1</option>
      <option>2</option>
      <option>3</option>
      <option>4</option>
      <option>5</option>
      <option>6</option>
      <option>7</option>
      <option>8</option>
      <option>9</option>
      <option>10</option>
    </select><label>hour</label> 
    
    <select name="selectMinutes" id="selectMinutes">
      <option selected="selected">-minutes-</option>
       <option>0</option>
      <option>15</option>
      <option>30</option>
      <option>45</option>
    </select><label>minutes</label>  
<p></p>
<label>Which building will you study at</label>
<p></p>   
<input type="radio" name="radio_buildingRoom[]" id="choose" value="choose" checked="checked" onclick="changeRadiobutton()"/><label>Choose A Room</label>
<input type="radio" name="radio_buildingRoom[]" id="diyinput" value="diyinput" onclick="changeRadiobutton()"/><label>Input Directly</label>
<p></p> 
<div id="building_room_area">
    <select name="selectBuilding" id="selectBuilding" onclick="getCurrBuildingList()">
      <option selected="selected">---select your building---</option>
       <option>____________________</option>
      <option></option>
      <option></option>
      <option></option>
      <option></option>
      <option></option>
      <option></option>
      <option></option>
      <option></option>       
    </select> 
<p></p>    
<label>Which room in the building</label><p></p>   
    <select name="selectRoom" id="selectRoom" onclick="getCurrRoomList()">
      <option selected="selected">-select your room-</option>
      <option>_____________</option>
      <option></option>
      <option></option>
      <option></option>
      <option></option>
      <option></option>
      <option></option>
      <option></option>
      <option></option>
      <option></option>
      <option></option>
      <option></option>
      <option></option>
      <option></option>
      <option></option>            
    </select>   
</div><p></p>
<div id="diyinput_area">
<label>Please input your location</label><p></p>
<textarea id="inputHereLocation" name="inputHereLocation"></textarea>
</div>
<p></p>
<label>Other description about your study event</label><p></p>
<textarea id="comment" name="comment"></textarea>
<p></p>
<a id="studyEvent_modify_submit" class="modify_submit" onclick="beforeSubmitStudy()"><img src="systemPictures/studyEvent_modify_submit.png" width=150px height=50px alt="studyEvent_modify_submit"/></a>
_END;
?>
<a id="studyEvent_cancelModify" class="studyEvent_cancelModify" href="viewEachEvent.php?id=<?php echo $linkResult['id'];?>"><img src="systemPictures/studyEvent_cancelModify.png" width=150px height=50px alt="studyEvent_cancelModify"/></a>
<?php
echo<<<_END
<p></p>
</form>	
</div>













<div id="modifyThisPartyEvent" class="modifyThisPartyEvent">
<label>Mofdify Your Party Event</label><p></p>
<form id="form_beginModifyParty" name="form_beginModifyParty" method="post" action="">
		<input type="hidden" name="actionCMR" value="form_beginModifyParty">
<label>Please Select Party Date</label><p></p>
<input id="partyDate" name="partyDate" class="partyDate" type="text" onfocus="javascript:HS_setDate(this)">
<p></p>
<label>Please Select Party Begin Time</label><p></p>
<input id="partybeginTime" name="partybeginTime" type="text" onclick="WdatePicker({dateFmt:'HH:mm'});" />
<p></p><label>Please Select Party Theme</label>
<p></p>
<select name="selectPatryCate" id="selectPatryCate">
      <option selected="selected">-select a theme-</option>
      <option>Have Fun</option>
      <option>Celebration</option>
      <option>Reunion</option>
      <option>Dating</option>
      <option>Watch Matches</option>
      <option>Drinking</option>
    </select> 
<p></p>    
<label>Who Do You Want To Invite<label><p></p>
<textarea id="whocometoparty" name="whocometoparty"></textarea><p></p>
<label>Please Select Party Type (choose ALL that apply)</label>
<p>Please Select Location Type:</p>
<input id="indoor" name="indoor" type="checkbox" value="Indoor"/><label>Indoor</label>
<input id="outdoor" name="outdoor" type="checkbox" value="Outdoor"/><label>Outdoor</label>
<p>Please Select Food Type You Offer</p>
<input id="Chinese" name="Chinese" type="checkbox" value="Chinese Style"/><label>Chinese Style</label>
<input id="Japanese" name="Japanese" type="checkbox" value="Japanese Style"/><label>Japanese Style</label>
<input id="Indian" name="Indian" type="checkbox" value="Indian Style"/><label>Indian Style</label>
<input id="American" name="American" type="checkbox" value="American Style"/><label>American Style</label>
<p></p>
<input id="Korean" name="Korean" type="checkbox" value="Korean Style"/><label>Korean Style</label>
<input id="Spanish" name="Spanish" type="checkbox" value="Spanish Style"/><label>Spanish Style</label>
<input id="Muslim" name="Muslim" type="checkbox" value="Muslim Style"/><label>Muslim Style</label>
<input id="Vegetarian" name="Vegetarian" type="checkbox" value="Vegetarian Diet"/><label>Vegetarian Diet</label>
<p></p>
<label>How Long Is Your Party</label><p></p>		
<select name="partyselectHours" id="partyselectHours">
      <option selected="selected">-hours-</option>
      <option>0</option>
      <option>1</option>
      <option>2</option>
      <option>3</option>
      <option>4</option>
      <option>5</option>
      <option>6</option>
      <option>7</option>
      <option>8</option>
      <option>9</option>
      <option>10</option>
    </select>    
    <select name="partyselectMinutes" id="partyselectMinutes">
      <option selected="selected">-minutes-</option>
       <option>0</option>
      <option>15</option>
      <option>30</option>
      <option>45</option>
    </select> 
<p></p>
<label>Input Your Party Location</label><p></p>
<textarea id="partyLocation" name="partyLocation"></textarea>
<p></p>
<label>Zip Code of Your Party Location</label><p></p>
<input id="partyzipcode" name="partyzipcode"></input>
<p></p>
<a id="partyEvent_modify_submit" class="modify_submit" onclick="beforeSubmitParty()"><img src="systemPictures/studyEvent_modify_submit.png" width=150px height=50px alt="studyEvent_modify_submit"/></a>
_END;
?>
<a id="partyEvent_cancelModify" class="cancelModify" href="viewEachEvent.php?id=<?php echo $linkResult['id'];?>"><img src="systemPictures/partyEvent_submit.png" width=150px height=50px alt="partyEvent_cancelModify"/></a>
<?php
echo<<<_END
<p></p>
</form>	
</div>














<div id="modifyThisShoppingEvent" class="modifyThisShoppingEvent"></div>


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
//上面通过传来的event id判断了需要显示哪种表格，现在把值附上去。

//如果是study类的，则把每一项填上现有值****************************study*****************************
if(substr($linkResult['id'],0,2)=="11")
{
	$query_fetchAStudy="Select * from event_study where eventid='".$linkResult['id']."'";
	$result_fetchAStudy=mysql_query($query_fetchAStudy);
	if(!$result_fetchAStudy) die ("Database access failed! Please try again later.".mysql_error());
	$oneRow=mysql_fetch_array($result_fetchAStudy);
	
echo<<<_END
<script language='javascript' type='text/javascript'>
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

for(var i=0;i<document.getElementById("selectUniv").length;i++)
{
   var temp=document.getElementById("selectUniv").options[i].text;
   if(university==temp)
    {document.getElementById("selectUniv").options[i].selected=true;break;}
} 
//设置下面的building和room下拉菜单的内容 ,让他们显示默认值 
getCurrBuildingList();
for(var i=0;i<document.getElementById("selectBuilding").length;i++)
{
   var temp=document.getElementById("selectBuilding").options[i].text;
   if(building==temp)
    {document.getElementById("selectBuilding").options[i].selected=true; break;}
}
getCurrRoomList();
for(var i=0;i<document.getElementById("selectRoom").length;i++)
{
   var temp=document.getElementById("selectRoom").options[i].text;
   if(room==temp)
    {document.getElementById("selectRoom").options[i].selected=true;break;}
}

document.getElementById("classNumber").value = course;

for(var i=0;i<document.getElementById("topicType").length;i++)
{
   var temp=document.getElementById("topicType").options[i].text;
   if(topicType==temp)
    {document.getElementById("topicType").options[i].selected=true;break;}
}

document.getElementById("eventDetail").value = detail;
document.getElementById("studyDate").value = date;
document.getElementById("beginTime").value = startTime;

var hour = Math.floor(length/60);
var min = length%60; 
for(var i=0;i<document.getElementById("selectHours").length;i++)
{
   var temp=document.getElementById("selectHours").options[i].text;
   if(hour==temp)
    {document.getElementById("selectHours").options[i].selected=true;break;}
}
for(var i=0;i<document.getElementById("selectMinutes").length;i++)
{
   var temp=document.getElementById("selectMinutes").options[i].text;
   if(min==temp)
    {document.getElementById("selectMinutes").options[i].selected=true;break;}
}

if(building=="N/A")
{
  document.getElementById("choose").checked=false;
  document.getElementById("diyinput").checked=true;
  changeRadiobutton();
  //
  document.getElementById("inputHereLocation").innerHTML = otherlocation;
}
else{
document.getElementById("choose").checked=true;
document.getElementById("diyinput").checked=false;
changeRadiobutton();
document.getElementById("inputHereLocation").innerHTML ="";
}
document.getElementById("comment").innerHTML = comment; 

</script>
_END;
}
//*******************END*****************study*****************************
//****************************beign Party的赋值***************************************
else if(substr($linkResult['id'],0,2)=="12")
{
	$query_fetchAParty="Select * from event_party where eventid='".$linkResult['id']."'";
	$result_fetchAParty=mysql_query($query_fetchAParty);
	if(!$result_fetchAParty) die ("Database access failed! Please try again later.".mysql_error());
	$oneRow_party=mysql_fetch_array($result_fetchAParty);
echo<<<_END
<script language='javascript' type='text/javascript'>
var partytime = "
_END;
?><?php echo $oneRow_party['partytime'];?>";
<?php echo <<<_END
var partycategory = "
_END;
?><?php echo $oneRow_party['partycategory'];?>";
<?php echo <<<_END
var partylength = "
_END;
?><?php echo $oneRow_party['partylength'];?>";
<?php echo <<<_END
var whocome = "
_END;
?><?php echo $oneRow_party['whocome'];?>";
<?php echo <<<_END
var partydate = "
_END;
?><?php echo date('Y-n-j',(int)$oneRow_party['partydate']);?>";
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
for(var i=0;i<document.getElementById("selectPatryCate").length;i++)
{
   var temp=document.getElementById("selectPatryCate").options[i].text;
   if(partycategory==temp)
    {document.getElementById("selectPatryCate").options[i].selected=true;break;}
} 
document.getElementById("partybeginTime").value = partytime;
document.getElementById("partyDate").value = partydate;
document.getElementById("whocometoparty").value = whocome;
document.getElementById("partyselectHours").value = Math.floor(partylength/60);
document.getElementById("partyselectMinutes").value = partylength%60;
document.getElementById("partyLocation").value = partylocation;
document.getElementById("partyzipcode").value = partyzip;
//
var typeArray = partytype.split(",");
for(var i=0; i<typeArray.length-1; i++)
{
  if(typeArray[i].trim()=="Chinese Style")
    document.getElementById("Chinese").checked = true;
  else if(typeArray[i].trim()=="Japanese Style")
    document.getElementById("Japanese").checked = true;
  else if(typeArray[i].trim()=="Korean Style")
    document.getElementById("Korean").checked = true;
  else if(typeArray[i].trim()=="Indian Style")
    document.getElementById("Indian").checked = true;
  else if(typeArray[i].trim()=="Spanish Style")
    document.getElementById("Spanish").checked = true;
  else if(typeArray[i].trim()=="American Style")
    document.getElementById("American").checked = true;
  else if(typeArray[i].trim()=="Muslim Style")
    document.getElementById("Muslim").checked = true;
  else if(typeArray[i].trim()=="Vegetarian Diet")
    document.getElementById("Vegetarian").checked = true;
  else if(typeArray[i].trim()=="Indoor")
    document.getElementById("indoor").checked = true;
  else if(typeArray[i].trim()=="Outdoor")
    document.getElementById("outdoor").checked = true;
}
</script>
_END;
}
//********END****************************Party*****************************


//*******BEGIN*********************SHopping****************************
//******END****************************SHopping*****************************



//都完了之后这里是确认提交了修改，插入数据库
//如果是study那页对应的提交按钮提交的。。。
if($_POST[actionCMR]=="form_beginModifyStudy")
{
	$university = $_POST['selectUniv'];
    $course = $_POST['classNumber'];
    $topicType = $_POST['topicType'];
    $detail = $_POST['eventDetail'];
    $dateOriginal = $_POST['studyDate'];
    $date = strtotime($dateOriginal);
    $startTime = $_POST['beginTime'];
    $length = $_POST['selectHours']*60+$_POST['selectMinutes'];//use minutes to store
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
    $query_updateStudy="Update event_study SET schoolname='".$university."', course='".$course."', topictype='".$topicType."', detail='".$detail."', date='".$date."', starttime='".$startTime."', length='".$length."', building='".$building."', room='".$room."', otherlocation='".$otherlocation."', comment='".$comment."' where eventid='".$linkResult['id']."'";
	$result_updateStudy=mysql_query($query_updateStudy);
	if(!$result_updateStudy) die ("Can Not Update the Modification!".mysql_error());
	//
	$url = "viewEachEvent.php?id=".$linkResult['id'];
	echo "<script language='javascript' type='text/javascript'>";
	echo "window.location.href='$url'";
	echo "</script>";
}

//如果是party那页对应的提交按钮提交的。。。
if($_POST[actionCMR]=="form_beginModifyParty")
{
	$partyDate = $_POST['partyDate'];
	$partybeginTime = $_POST['partybeginTime'];
	$whocometoparty = $_POST['whocometoparty'];
	$selectPatryCate = $_POST['selectPatryCate'];
	$partyType="";
	if($_POST['indoor']!="")
	$partyType=$partyType.$_POST['indoor']." , ";
	if($_POST['outdoor']!="")
	$partyType=$partyType.$_POST['outdoor']." , ";
	if($_POST['Chinese']!="")
	$partyType=$partyType.$_POST['Chinese']." , ";
	if($_POST['Japanese']!="")
	$partyType=$partyType.$_POST['Japanese']." , ";
	if($_POST['American']!="")
	$partyType=$partyType.$_POST['American']." , ";
	if($_POST['Indian']!="")
	$partyType=$partyType.$_POST['Indian']." , ";
	if($_POST['Spanish']!="")
	$partyType=$partyType.$_POST['Spanish']." , ";
	if($_POST['Korean']!="")
	$partyType=$partyType.$_POST['Korean']." , ";
	if($_POST['Muslim']!="")
	$partyType=$partyType.$_POST['Muslim']." , ";
	if($_POST['Vegetarian']!="")
	$partyType=$partyType.$_POST['Vegetarian']." , ";
	//
	$partylength = $_POST['partyselectHours']*60+$_POST['partyselectMinutes'];//use minutes to store
	$partyLocation = $_POST['partyLocation'];
	$partyzipcode = $_POST['partyzipcode'];
	$partdateStemp = strtotime($partyDate);
	//
    $query_updateParty="Update event_party SET partycategory='".$selectPatryCate."', partydate='".$partdateStemp."', partytime='".$partybeginTime."', partylength='".$partylength."', whocome='".$whocometoparty."', partytype='".$partyType."', partylocation='".$partyLocation."', partyzip='".$partyzipcode."' where eventid='".$linkResult['id']."'";
		$result_updateParty=mysql_query($query_updateParty);
	if(!$result_updateParty) die ("Can Not Update the Modification!".mysql_error());
	//
	$url = "viewEachEvent.php?id=".$linkResult['id'];
	echo "<script language='javascript' type='text/javascript'>";
	echo "window.location.href='$url'";
	echo "</script>";
}
//如果是shopping那页对应的提交按钮提交的。。。



?>