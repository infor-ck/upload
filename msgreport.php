<?php
if(isset($_GET['msg'])){
	$msg=$_GET['msg'];
	switch ($msg) {
		//case '1':
		//	echo "<script>alert('密碼更改成功');</script>";
		//	break;
		case '2':
			echo "<script>alert('舊密碼錯誤');</script>";
			break;
		case '3':
			echo "<script>alert('資料夾已存在');</script>";
			break;
		case '4':
			echo "<script>alert('資料夾新增成功');</script>";
			break;
		case '5':
			echo "<script>alert('檔案上傳成功');</script>";
			break;
		case '6':
			echo "<script>alert('檔案上傳失敗');</script>";
			break;
		case '7':
			echo "<script>alert('資料刪除失敗');</script>";
			break;
		case '8':
			echo "<script>alert('資料刪除成功');</script>";
			break;
	}
	//exit;
	echo "<script>location.href='show.php?page=1';</script>";
}?>