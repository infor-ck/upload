<?php
$mysqli=new mysqli("localhost","root","","user");
if($mysqli -> connect_error){
	die("連接錯誤訊息:".$mysqli -> connect_error."<br>");
}
$mysqli->query("set names utf8");
?>