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

<script type="text/javascript" src="calendar.js"></script>
<script type="text/javascript" src="My97DatePicker/WdatePicker.js"></script>
</head>
<style type="text/css">

div.allCate_Left{
float:left;
margin-left:5%;
margin-right:1%;
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

div.createEventArea{
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

div.beginCreateStudy{display:none;}
div.beginCreateParty{display:none;}

</style>

<script language="JavaScript" type="text/javascript">
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
function beforeSubmit()
{
  if(confirm("Are you sure you want to create this event?"))//here put verifacation. I am tired now and I will do it later :)
    form_beginCreateStudy.submit();
}
function beforePartySubmit()
{
   if(confirm("Are you sure you want to create this event?"))//here put verifacation. I am tired now and I will do it later :)
    form_beginCreateParty.submit();
}
function clearSheet()
{  
  document.getElementById("selectUniv").selectedIndex = 0;
  document.getElementById("classNumber").value = "";
  document.getElementById("topicType").selectedIndex = 0;
  document.getElementById("eventDetail").value = "";
  document.getElementById("studyDate").value = "";
  document.getElementById("beginTime").value = "";
  document.getElementById("selectHours").selectedIndex = 0;
  document.getElementById("selectMinutes").selectedIndex = 0;
  document.getElementById("selectBuilding").selectedIndex = 0;
  document.getElementById("selectRoom").selectedIndex = 0;
  document.getElementById("inputHereLocation").value = "";
  document.getElementById("comment").value = "";
}
function clearpartySheet()
{
  document.getElementById("partybeginTime").value = "";
  document.getElementById("partyDate").value = "";
  document.getElementById("partyselectHours").selectedIndex = 0;
  document.getElementById("partyselectMinutes").selectedIndex = 0;
  document.getElementById("whocometoparty").value = "";  
  document.getElementById("partyzipcode").value = "";
  document.getElementById("partyLocation").value = "";
  document.getElementById("Chinese").checked = false;
  document.getElementById("Japanese").checked = false;
  document.getElementById("Korean").checked = false;
  document.getElementById("American").checked = false;
  document.getElementById("Indian").checked = false;
  document.getElementById("Spanish").checked = false;
  document.getElementById("Muslim").checked = false;
  document.getElementById("Vegetarian").checked = false;
  document.getElementById("indoor").checked = false;
  document.getElementById("outdoor").checked = false;
}
function createStudy()
{
  document.getElementById("beginCreateStudy").style.display="block";
  document.getElementById("beginCreateParty").style.display="none";
  document.getElementById("createStudy").parentNode.className="active";
  document.getElementById("createParty").parentNode.className="";
  document.getElementById("createShopping").parentNode.className="";

}

function createParty()
{
  document.getElementById("beginCreateStudy").style.display="none";
  document.getElementById("beginCreateParty").style.display="block";
    document.getElementById("createStudy").parentNode.className="";
  document.getElementById("createParty").parentNode.className="active";
  document.getElementById("createShopping").parentNode.className="";
}

</script>

<body onload="changeRadiobutton(); unreadMsg()" style="background-image:url(assets/images/amaranta_martinez_wallpaper.jpg); background-repeat:no-repeat;">


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





<div id="createEventArea" class="col-md-9">
<label>Create New Event</label>

<div id="cate_bar" class="cate_bar nav nav-tabs">
<li class=""><a id="createStudy" class="createStudy" onclick="javascript:createStudy()">Create study</a></li>
<li class=""><a id="createParty" class="createParty" onclick="javascript:createParty()">Create party</a></li>
<li class=""><a id="createShopping" class="createShopping" onclick="javascript:createShopping()">Create shopping</a></li>
</div>












<div id="beginCreateStudy" class="beginCreateStudy">
<label>Create Study Event Now</label><p></p>
<form id="form_beginCreateStudy" name="form_beginCreateStudy" method="post" action="createStudySubmit.php" class="form">
		<input type="hidden" name="actionCMR" value="form_beginCreateStudy">
<label>Please select your university</label><p></p>
<select name="selectUniv" id="selectUniv" class="form-control" style="width:200px">
      <option selected="selected">-select your university-</option>
      <option>Univ of Illi Urban-Chanpaign</option>
      <option>Univ of Cali Berkeley</option>
      <option>Stanford Univ</option>
      <option>Univ of Cali Riverside</option>
    </select>
<p></p>        		
<label>Which course do you want to study</label><p></p>
<input type="text" id="classNumber" name="classNumber"  class="form-control" style="width:200px"/>
<p>Please select your topic type</p>  
<select name="topicType" id="topicType"  class="form-control" style="width:200px">
      <option selected="selected">-select your topic type-</option>
      <option>Homework</option>
      <option>Lab Assignments</option>
      <option>Machine Problem</option>
      <option>Discussion</option>
      <option>Coding Debugging</option>
      <option>Thesis</option>
    </select> 
<p></p>  
<label>Event Details</label><p></p><textarea id="eventDetail" name="eventDetail"  class="form-control" style="width:200px"></textarea>
<p></p>
<label>Please choose your study date</label><p></p><input id="studyDate" name="studyDate" class="studyDate form-control" type="text" onfocus="javascript:HS_setDate(this)"  style="width:200px">
<p></p>
<label>Please choose your begin time</label><p></p>
<input id="beginTime" name="beginTime" type="text" onclick="WdatePicker({dateFmt:'HH:mm'});"  class="form-control" style="width:200px"/>
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
    </select> 
    
    <select name="selectMinutes" id="selectMinutes">
      <option selected="selected">-minutes-</option>
       <option>0</option>
      <option>15</option>
      <option>30</option>
      <option>45</option>
    </select> 
<p></p>
<label>Which building will you study at</label>
<p></p>   
<input type="radio" name="radio_buildingRoom[]" id="choose" value="choose" checked="checked" onclick="changeRadiobutton()" /><label>Choose A Room</label>
<input type="radio" name="radio_buildingRoom[]" id="diyinput" value="diyinput" onclick="changeRadiobutton()"/><label>Input Directly</label>
<p></p> 
<div id="building_room_area">
    <select name="selectBuilding" id="selectBuilding" onclick="getCurrBuildingList()"  class="form-control" style="width:200px">
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
    <select name="selectRoom" id="selectRoom" onclick="getCurrRoomList()"  class="form-control" style="width:200px">
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
<textarea id="inputHereLocation" name="inputHereLocation"  class="form-control" style="width:200px"></textarea>
</div>
<p></p>
<label>Other description about your study event</label><p></p>
<textarea id="comment" name="comment"  class="form-control" style="width:200px"></textarea>
<p></p>
<a id="studyEvent_submit" class="studyEvent_submit btn btn-success" onclick="beforeSubmit()">Submit</a>
<a id="studyEvent_clear" class="studyEvent_clear btn btn-danger" onclick="clearSheet()">Reset</a>
<a id="gobacktomyevent_study" class="gobacktomyevent_study btn btn-default" href="myEvent.php">Back</a>
<p></p>
</form>		
</div>













<div id="beginCreateParty" class="beginCreateParty">
<label>Create Party Event Now</label><p></p>
<form id="form_beginCreateParty" name="form_beginCreateParty" method="post" action="createPartySubmit.php" class="form-inline">
		<input type="hidden" name="actionCMR" value="form_beginCreateParty">
<label>Please Select Party Date</label><p></p>
<input id="partyDate" name="partyDate" class="partyDate form-control" type="text" onfocus="javascript:HS_setDate(this)" style="width:200px">
<p></p>
<label>Please Select Party Begin Time</label><p></p>
<input id="partybeginTime" name="partybeginTime" type="text" onclick="WdatePicker({dateFmt:'HH:mm'});" class="form-control" style="width:200px"/>
<p></p><label>Please Select Party Theme</label>
<p></p>
<select name="selectPatryCate" id="selectPatryCate" class="form-control" style="width:200px">
      <option selected="selected">-select a theme-</option>
      <option>Have Fun</option>
      <option>Celebration</option>
      <option>Reunion</option>
      <option>Dating</option>
      <option>Watch Matches</option>
      <option>Drinking</option>
    </select> 
<p></p>    
<label>Who Do You Want To Invite</label><p></p>
<textarea id="whocometoparty" name="whocometoparty" class="form-control" style="width:200px"></textarea ><p></p>
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
<select name="partyselectHours" id="partyselectHours" class="form-control" style="width:200px">
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
    <select name="partyselectMinutes" id="partyselectMinutes" class="form-control" style="width:200px">
      <option selected="selected">-minutes-</option>
       <option>0</option>
      <option>15</option>
      <option>30</option>
      <option>45</option>
    </select> 
<p></p>
<label>Input Your Party Location</label><p></p>
<textarea id="partyLocation" name="partyLocation" class="form-control" style="width:200px"></textarea>
<p></p>
<label>Zip Code of Your Party Location</label><p></p>
<input id="partyzipcode" name="partyzipcode" class="form-control" style="width:200px"></input>
<p></p>
<a id="partyEvent_submit" class="partyEvent_submit btn btn-success" onclick="beforePartySubmit()">Submit</a>
<a id="partyEvent_clear" class="partyEvent_clear btn btn-danger" onclick="clearpartySheet()">Reset</a>
<a id="gobacktomyevent_party" class="gobacktomyevent_party btn btn-default" href="myEvent.php">Back</a>
<p></p>






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


?>