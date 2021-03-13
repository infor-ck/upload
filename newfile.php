<?php
include("connserver.php");
include("logincheck.php");
$acc=$_SESSION['user'];
$lastpage=$_SERVER['HTTP_REFERER'];
$newfile=$_POST['newfile'];
$upfiledir=$_SESSION['uploaddir'];
$sql2="SELECT docname FROM $acc WHERE filedir='$upfiledir' and isfile=true";
//echo($sql2);
//exit;
$result=$mysqli->query($sql2);
if($result->num_rows >0){
	$lastpage.="&msg=3";
	header("location:$lastpage");
}
else{
	if($_POST['newfile']!=""){
		//mkdir($upfiledir.$_POST['newfile']);
		$date=date_create("now");
		$TIME=date_format($date,"Y/m/d");
		//echo($TIME);
		$sql="INSERT INTO ".$acc."(docname,updatedate,filedir,isfile) VALUES ('".$newfile."','".$TIME."','".$upfiledir."',true);";
		//echo $sql;
		//exit;
		$mysqli->query($sql);
		$lastpage.="&msg=4";
		header("location:$lastpage");
}
}

?>