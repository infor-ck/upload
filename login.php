<?php
session_start();
include("connserver.php");
echo($_POST['account']);
if($_POST['account']!=""){
	$acc=$_POST['account'];
	if($_POST['password']!=""){
		$pass=md5($_POST['password']);
		//echo $acc.$pass;
		/*$stmt=mysqli_stmt_init($mysqli);
		//if (mysqli_stmt_prepare($stmt,"SELECT password FROM account WHERE username=?"))
  			{
  			//echo "jizz";
  			// Bind parameters
  			//mysqli_stmt_bind_param($stmt,"s",$acc);
  			// Execute query
  			//mysqli_stmt_execute($stmt);
  			// Bind result variables
  			//mysqli_stmt_bind_result($stmt,$result);*/
  			$sql="SELECT username FROM account WHERE username='$acc' and password='$pass'";
  			//echo($sql);
  			//exit;
  			$sql2=$mysqli->query($sql);
  			$result=$sql2->fetch_object();
  			// Fetch value
 			if($sql2->num_rows>0){
 				$uploaddir="0";
 				//echo $uploaddir;
 				$_SESSION['uploaddir']=$uploaddir;
 				$_SESSION['user']=$acc;
 				//exit;
 				header("location:show.php?page=1");
 				//$_SESSION['pass']=$pass;
 			}
 			else{
 				//echo "jizz";
 				//exit;
 				header("location:index.php?errmsg=1");
 			}
  			//mysqli_stmt_close($stmt);
 			//}
		//mysqli_close($mysqli);
	}
	else{
		header("location:index.php");
	}
}
else{
	//exit;
	header("location:index.php");
}
//exit;
?>