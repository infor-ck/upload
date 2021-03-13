<?php
include("logincheck.php");
include("connserver.php");
if($_POST['oldpass']!=""){
	if($_POST['newpass1']!=""){
		if($_POST['newpass2']!=""){
			$oldpass=md5($_POST['oldpass']);
			$newpass1=md5($_POST['newpass1']);
			$newpass2=md5($_POST['newpass2']);
			$acc=$_SESSION['user'];
			//echo $acc;
			if($newpass1==$newpass2){
				$sql1="SELECT username FROM account WHERE username='$acc' and password='$oldpass'";
				//echo $sql1;
				$sql1r=$mysqli->query($sql1);
				$lastpage=$_SERVER['HTTP_REFERER'];
				if($sql1r->num_rows>0){
					$sql2="UPDATE account SET password='$newpass1' WHERE username='$acc' and password='$oldpass'";
					$mysqli->query($sql2);
					session_unset();
					session_destroy();
					header("location:index.php?errmsg=2");
				}
				else{
					$lastpage.="&msg=2";
					header("location:$lastpage");
				}
			}
		}
	}
}