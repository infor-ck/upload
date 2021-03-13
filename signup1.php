<!DOCTYPE html>
<html>
<head>
	<title>會員註冊</title>
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
	</style>
</head>
<body>
<form name="form2" action="signup2.php" method="post" onsubmit="return subcheck();">
	<table align="center">
		<tr><td><h1>註冊</h1></td></tr>
		<tr><td><input type="text" name="mail" placeholder="Email" required></td></tr>
		<tr><td><input id="acc" type="text" name="username" placeholder="帳號" required></td></tr>
		<tr><td><input id="pass1" type="password" name="pass1" placeholder="密碼" required></td></tr>
		<tr><td><input id="pass2" type="password" name="pass2" placeholder="再次驗證密碼" required></td></tr>
		<tr><td><input type="submit" value="註冊"></td></tr>
		<tr><td><a href="index.php">登入</a></td></tr>
	</table>
</form>
<?php 
if(isset($_GET['errmsg'])){
	$errmsg=$_GET['errmsg'];
	if($errmsg==1){
		echo "<script>alert('帳號名已存在');</script>";
	}
}
?>
<script type="text/javascript">
	function subcheck(){
		var blackli=/[@;%=$/#]/i;
		var text1=document.getElementById("acc").value;
		var text2=document.getElementById("pass1").value;
		var text3=document.getElementById("pass2").value;
		//alert(text3);
		//alert(text2);
		if(blackli.test(text1)){
			alert("帳號中不可含有@;%=$/#");
			return false;
			//location.href="index.php";
		}
		if(blackli.test(text2)||blackli.test(text3)){
			alert("密碼中不可含有@;%=$/#");
			return false;
			//location.href="index.php";
		}
		if (text2!=text3) {
			alert("密碼驗證錯誤");
			return false;
		}
	}
</script>
</body>
</html>