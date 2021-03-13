<?php 
include("logincheck.php");
if(isset($_GET['name'])){
	$name=$_GET['name'];
	$user=$_SESSION['user'];
	$ext=substr($name, strpos($name, "."),strlen($name)-1);
	$uploaddir="./upload/";
	$downdir=$uploaddir.$user."/";
	$filename=$downdir.$name;
	/*if($ext==".pdf"){
		header("Content-type:application/pdf");
		header("Content-Disposition:attachment;filename=$name");
		readfile($filename);
	}
	elseif ($ext==".jpg"||$ext==".jpeg") {
		header("Content-type:image/jpeg");
		header("Content-Disposition:attachment;filename=$name");
		readfile($filename);
	}
	elseif ($ext==".txt") {
		header("Content-type:text/plain");
		header("Content-Disposition:attachment;filename=$name");
		readfile($filename);
	}*/
	header("Content-type:application/octet-stream");
	header("Content-Disposition:attachment;filename=$name");
	//readfile($filename);
	$myfile = fopen($filename, "r") or die("Unable to open file!");
	echo fread($myfile,filesize($filename));
	fclose($myfile);
	header("location:show.php");
}