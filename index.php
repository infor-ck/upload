<!DOCTYPE html>
<html>
<head>
	<title>會員登入</title>
	<meta charset="utf-8">
	<style type="text/css">
		table{
			font-size: 20px;
			background-color: white;
			text-align: center;
			border: 5px;
			border-style: double;
			width: 200px;
		}
		h1{

		}
	</style>
</head>
<body>
	<form name="form1" action="login.php" method="post" onsubmit="return subcheck();">
	<table align="center" class="">
		<tr><td><h1>登入</h1></td></tr>
		<tr><td><input id="acc"type="text" name="account" placeholder="帳號" required></td></tr>
		<tr><td><input id="pass" type="password" name="password" placeholder="密碼" required></td></tr>
		<tr><td><input type="submit" value="登入"></td></tr>
		<tr><td><a href="signup1.php">註冊</a></td></tr>
	</table>
</form>
<?php 
if(isset($_GET['errmsg'])){
	$errmsg=$_GET['errmsg'];
	if($errmsg==1){
		echo "<script>alert('帳號密碼錯誤');</script>";
	}
	elseif ($errmsg==0) {
		echo "<script>alert('帳號建立成功');</script>";
	}
	elseif ($errmsg==2) {
		echo "<script>alert('密碼更改成功   請再次登入');location.href='index.php';</script>";
	}
}
?>
<script type="text/javascript">
	function subcheck(){
		var blackli=/[@;%=$/#]/i;
		var text1=document.getElementById("acc").value;
		var text2=document.getElementById("pass").value;
		//alert(text1);
		//alert(text2);
		if(blackli.test(text1)){
			alert("帳號中不可含有@;%=$/#");
			return false;
			//location.href="index.php";
		}
		if(blackli.test(text2)){
			alert("密碼中不可含有@;%=$/#");
			return false;
			//location.href="index.php";
		}
	}
</script>

</body>
</html>