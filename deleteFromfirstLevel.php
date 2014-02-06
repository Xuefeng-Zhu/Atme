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
//$linkResult['id'];

$id_getBack = rawurldecode($linkResult['id']);

//判断是哪个类别的，删除相应category表
if(substr($id_getBack,0,2)=="11")
{
	$query_deleteAStudyEnevt="Delete from event_study where eventid='".$id_getBack."'";
    if(!mysql_query($query_deleteAStudyEnevt,$db_server))
	  echo "Cannot Delete This event. Please check database connection!".mysql_error().'<br/>';
	else
	{
	  $url = "myEvent.php";
	  echo "<script language='javascript' type='text/javascript'>";
	  echo "window.location.href='$url'";
	  echo "</script>";
	}
}
else if(substr($id_getBack,0,2)=="12")//party
{
    $query_deleteAPartyEvent="Delete from event_party where eventid='".$id_getBack."'";
    if(!mysql_query($query_deleteAPartyEvent,$db_server))
	  echo "Cannot Delete This event. Please check database connection!".mysql_error().'<br/>';
	else
	{
	  $url = "myEvent.php";
	  echo "<script language='javascript' type='text/javascript'>";
	  echo "window.location.href='$url'";
	  echo "</script>";
	}
}
else if(substr($id_getBack,0,2)=="13")//shopping
{
	
}










?>