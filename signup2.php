<?php
$user=$_POST['username'];
$pass1=md5($_POST['pass1']);
$pass2=md5($_POST['pass2']);
$mail=$_POST['mail'];
include("connserver.php");
if($pass1==$pass2){
	$sql3="SELECT username FROM account where username='$user';";
	//echo($sql3);
	$result=$mysqli->query($sql3);
	//echo $result->fetch_object();
	if($result->num_rows>0){
		//echo "帳號名重複";
		header("location:signup1.php?errmsg=1");
		//exit;
	}
	else{
		$sql="INSERT INTO `account`(`username`, `password`, `email`, `text`) VALUES ('$user','$pass1','$mail','1');";
		$sql2="CREATE TABLE ";
		$sql2.=$user;
		$sql2.="(docname varchar(25),updatedate text,filedir text, isfile boolean);";
		//echo $sql.$sql2;
		//echo "jizz";
		$mysqli->query($sql);
		$mysqli->query($sql2);
		mkdir("./upload/".$user);
		//echo "帳戶建立成功";
		header("location:index.php?errmsg=0");
	}
}
else{
header("location:signup1.php");

}
?>