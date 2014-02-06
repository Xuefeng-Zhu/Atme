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

div.chooseFilePhoto{
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

div.div_chooseFile{
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
img.previewFace {
 height:300px;
width:300px;
position:relative;
}
div.previewOutline{display:none;}
</style>
<script language="JavaScript" type="text/javascript">

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
<a id="img_photo" class="img_photo" href="myAccount.php"><img id="picItSelf" src="
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




<div id="chooseFilePhoto" class="col-md-9">
<label>Please Choose Your Portrait</label><p></p>
<form id="form_chooseFile" name="form_chooseFile" method='post' enctype='multipart/form-data' class="form">
    <input type='file' name='MyFileName' size='50'class="form-control"/><p></p>
    <input type='submit' value = 'Change Portrait' class="btn btn-primary" />	
</form>
<label id="invalidEXT" class="invalidEXT"></label><p></p>
<label id="invalidEMPTY" class="invalidEMPTY"></label><p></p>
<div id="previewOutline" class="previewOutline">
<label>Preview Your Portrait</label><p></p>
<img src="" id="previewFace" name="previewFace" class="previewFace"></img><p></p>
<a id="gobacktomyAccount" class="gobacktomyAccount" href="myAccount.php"><img src="systemPictures/gobacktomyAccount.png" width=110px height=30px alt="gobacktomyAccount"/></a><P></P>


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

if($_FILES)//点击了上传按钮
{
	if(is_uploaded_file($_FILES['MyFileName']['tmp_name']))
	{
    	if ((($_FILES["MyFileName"]["type"] == "image/gif")
          || ($_FILES["MyFileName"]["type"] == "image/jpeg")
          || ($_FILES["MyFileName"]["type"] == "image/pjpeg")
          || ($_FILES["MyFileName"]["type"] == "image/png")
          || ($_FILES["MyFileName"]["type"] == "image/tiff")
          || ($_FILES["MyFileName"]["type"] == "image/jpg"))
          && ($_FILES["MyFileName"]["size"] < 10000000))//20000=20KB
	
    	{
    		if ($_FILES["MyFileName"]["error"] > 0)//6种数值，1为超过了ini里头的限制
    		{
    		  echo "Return Code: " . $_FILES["MyFileName"]["error"] . "<br />";
    		}
    		else
    		{
				$ext="";
				switch($_FILES['MyFileName']['type'])
				{
					case 'image/jpeg': $ext = '.jpg'; break;
					case 'image/pjpeg': $ext = '.jpg'; break;
					case 'image/gif':  $ext = '.gif'; break;
					case 'image/png':  $ext = '.png'; break;
					case 'image/tiff': $ext = '.tif'; break;
					default:		   $ext = '.png';    break;
				}
				//can assign unique pic name when saving to database
				$NewPicName=$_SESSION['userid']."_face_".time().$ext;
				//
				$NewPicName = preg_replace('/([^.a-z0-9]+)/i', '_', $NewPicName );
				$_FILES["MyFileName"]["name"] = $NewPicName;//41500001_face.jpg
				//begin insert into folder and mysql
                $thisUserID = $_SESSION['userid'];
				$query_fetchOldPicName="SELECT photoname FROM userphoto where userid='".$thisUserID."'";
				$result_fetchOldPicName=mysql_query($query_fetchOldPicName);				
				if(!$result_fetchOldPicName) die ("Database access failed. Cannot Fetch Old Photo Name!".mysql_error());
				$row_oldName = mysql_fetch_row($result_fetchOldPicName);
				$oldFace=$row_oldName[0];
				//录入数据库
				
				$query_putNewPicNameInDB="Update userphoto SET photoname='".$NewPicName."' where userid='".$thisUserID."'";
				$result_putNewPicNameInDB=mysql_query($query_putNewPicNameInDB);
				if(!$result_putNewPicNameInDB) die ("Database access failed. Cannot Put New Photo Name in DB!".mysql_error());
				//删除旧的，新头像进入文件夹
				$oldFaceURL = "users/".$thisUserID."/personFace/".$oldFace;
				if (file_exists($oldFaceURL)) 
				{
					if(unlink($oldFaceURL)==true)
					{//删除了旧face
						move_uploaded_file($_FILES["MyFileName"]["tmp_name"],"users/".$_SESSION['userid']."/personFace/".$_FILES["MyFileName"]["name"]);
						//sleep(10);
						//添加预览效果img_photo
						echo <<<_END
<script language="javascript" type="text/javascript">
						document.getElementById("invalidEMPTY").innerHTML="";
			            document.getElementById("invalidEXT").innerHTML="";
						document.getElementById("previewOutline").style.display="block";
						document.getElementById("previewFace").src="users/"+"
_END;
?><?php echo $thisUserID;?>"
<?php echo <<<_END
                      	+"/personFace/"+"
_END;
?><?php echo $_FILES["MyFileName"]["name"];?>";
<?php echo <<<_END


                        document.getElementById("picItSelf").src="users/"+"
_END;
?><?php echo $thisUserID;?>"
<?php echo <<<_END
                      	+"/personFace/"+"
_END;
?><?php echo $_FILES["MyFileName"]["name"];?>";
<?php echo <<<_END



</script>
_END;
					
					}
				}
				else{//如果文件不存在，则删去整个personFace文件夹，重做一个
				}
    		  }
    	}
    	else
    	{
echo <<<_END
			<script language="javascript" type="text/javascript">
			document.getElementById("invalidEXT").innerHTML="Invalid File Type! Only .jpg/.png/.gif/.pjpeg/.gif are allowed.";
			</script>
_END;
    	   	}
	}
	else 
	{
echo <<<_END
			<script language="javascript" type="text/javascript">
			document.getElementById("invalidEMPTY").innerHTML="Please select your photo first!";
			</script>
_END;
	}
}   	












?>