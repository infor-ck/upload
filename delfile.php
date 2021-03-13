<?php
include("logincheck.php");
if(isset($_GET['delname'])){
	$delname=$_GET['delname'];
	$acc=$_SESSION['user'];
	$dir="./upload/".$acc."/";
	include("connserver.php");
	$sql="DELETE FROM $acc WHERE docname='$delname'";
	if($mysqli->query($sql)){
		unlink($dir.$delname);
		header("location:show.php?page=1&msg=8");
	}
	else{
		//exit;
		header("location:show.php?page=1&msg=7");
	}
}?>