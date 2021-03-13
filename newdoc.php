<?php 
include("connserver.php");
include("logincheck.php");
	if($_SESSION['uploaddir']!=""){
		$uploaddir=$_SESSION['uploaddir'];
		$tmpfile=$_FILES['newdoc']['tmp_name'];
		$filename=$_FILES['newdoc']['name'];
		$date=date_create("now");
		$TIME=date_format($date,"Y/m/d");
		$acc=$_SESSION['user'];
		$sql="INSERT INTO ".$acc."(docname,updatedate,filedir,isfile) VALUES ('".$filename."','".$TIME."','".$uploaddir."',false);";
		$mysqli->query($sql);
		//echo $sql;
		$dir="./upload/".$acc."/";
		if(move_uploaded_file($tmpfile,$dir.$filename)){
			header("location:show.php?page=1&msg=5");
		}
		else{
			header("location:show.php?page=1&msg=6");
		}
	}
?>