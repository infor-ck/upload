<?php
include("logincheck.php");?>
<!DOCTYPE html>
<html>
<head>
	<title>檔案</title>
	<meta charset="utf-8">
	<link rel="stylesheet" href="style.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</head>
<body>
<div>

</div>
<div class="text-center">
<div class="action-bar">
	<?php
	$acc=$_SESSION['user'];
	echo $acc;?>
	<form action="search.php" type="get" name="form2" onsubmit="return subcheck();" class="d-flex px-2">
		<input id="sea" type="text" name="searchdoc" placeholder="關鍵字" class="form-control">
		<input type="submit" value="搜尋" class="btn btn-primary">
	</form>
	<!--<div class="dropdown">
  		<button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    	設定
  		</button>
  		<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
  			<a class="dropdown-item" href="changepassword.php">更改密碼</a>
    		<a class="dropdown-item" href="logout.php">登出</a>
  		</div>
	</div>
	<div class="dropdown">
  		<button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    	新增
  		</button>
  		<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
    	<a class="dropdown-item" href="makefile.php">資料夾</a>
    	<a class="dropdown-item" href="upfile.php">檔案</a>
  		</div>
	</div>
	</div>-->




<button type="button" class="btn btn-primary mx-2" data-toggle="modal" data-target="#exampleModalCenter1">  
	更改密碼
</button>
<button type="button" class="btn btn-primary mx-2" data-toggle="modal" data-target="#exampleModalCenter2">
  登出
</button>
<button type="button" class="btn btn-primary mx-2" data-toggle="modal" data-target="#exampleModalCenter3">
  新增資料夾
</button>
<button type="button" class="btn btn-primary mx-2" data-toggle="modal" data-target="#exampleModalCenter4">
  新增檔案
</button>
</div>
</div>


<table class="my-2" align="center">
	<?php
	include("msgreport.php");
	if(isset($_GET['filename'])){
		$filename=$_GET['filename'];
		$_SESSION['uploaddir']=$filename;
	}
	else{
		$_SESSION['uploaddir']='0';
		$filename="0";
	}
	//echo($_SESSION['uploaddir']);
	include("connserver.php");	
	$sql="SELECT docname,updatedate,isfile FROM $acc WHERE filedir='$filename' order by isfile desc;";
	//echo $sql;
	$result=$mysqli->query($sql);
	//echo $result."jizz";
	if($result->num_rows>0){
		$docpage=ceil(($result->num_rows)/10);
		if(!isset($_GET['page'])){
			$nowpage=1;
		}
		else{
			if($_GET['page'] < 1){
				$lastpage=$_SERVER['HTTP_REFERER'];
				header("location:$lastpage");
			}
			elseif ($_GET['page'] > $docpage){
				$lastpage=$_SERVER['HTTP_REFERER'];
				header("location:$lastpage");
			}
			$nowpage=$_GET['page'];
		}
		$strt_row=($nowpage-1)*10;
		$sql2="SELECT docname,updatedate,filedir,isfile FROM $acc WHERE filedir='$filename' order by isfile desc LIMIT $strt_row,10;";
		//echo($sql2);
		$result2=$mysqli->query($sql2);
		echo "<tr><th>名稱    </th><th>修改日期</th></tr>";
		for($i=0 ;$i<10 ; $i++){
			if ($rows=$result2->fetch_assoc()) {
				if($rows['isfile']==true){
					echo "<tr><td><a href='show.php?filename=".$rows['docname']."'>".$rows['docname']."</a></td><td>".$rows['updatedate']."</td><td><a href='delfile.php?delname=".$rows['docname']."'>刪除</a></td></tr>";
				}
				else{
					echo "<tr><td><a href='./upload/".$acc."/".$rows['docname']."' target='_blank' rel='noopener noreferrer'>".$rows['docname']."</a></td><td>".$rows['updatedate']."</td><td><a href='view.php?name=".$rows['docname']."'>下載</a></td><td><a href='delfile.php?delname=".$rows['docname']."'>刪除</a></td></tr>";
					}
			}
		}
		echo "</table>";
		echo '<div class="text-center">';
		echo '<select name="page" size="1" onchange="pageChange()" id="sel">';
		for ($i=1; $i<$nowpage  ; $i++) { 
			echo '<option value="'.$i.'">第'.$i.'頁</option>';
		}
		echo '<option value="'.$nowpage.'" selected>第'.$nowpage.'頁</option>';
		for($i=$nowpage+1;$i<=$docpage;$i++){
			echo '<option value="'.$i.'">第'.$i.'頁</option>';
		}
		echo "</select>";
	}
	else{
		$nowpage=1;
		echo "目前無任何檔案";
		echo "</table>";
	}
	?>
		<a href="show.php?page=<?php echo $nowpage-1; ?>&filename=<?php echo $filename;?>">上一頁</a>
		<a href="show.php?page=<?php echo $nowpage+1; ?>&filename=<?php echo $filename;?>">下一頁</a>
	</div>
		<?php
		/*if($nowpage>1){
			if($nowpage<$docpage){
				echo "<a href='show.php?page=".$nowpage-1."'>上一頁</a>";
				echo "<a href='show.php?page=".$nowpage+1."'>下一頁</a>";
			}
			else{
				echo "<a href='show.php?page=".$nowpage-1."'>上一頁</a>";;
			}
		}
		elseif ($docpage>1) {
			echo echo "<a href='show.php?page=".$nowpage+1."'>下一頁</a>";
		}*/?>
		<script>
			function pageChange(){
				var page=document.getElementById("sel");
				location.href="show.php?page="+page.value;
			}
		</script>
		<script type="text/javascript">
		function subcheck(){
			var blackli=/[@;%=$/#]/i;
			var text1=document.getElementById("sea").value;
			//alert(text1);
			//alert(text2);
			if(blackli.test(text1)){
				alert("關鍵字中不可含有@;%=$/#");
				return false;
				//location.href="index.php";
			}
	}
</script>




<div class="modal fade" id="exampleModalCenter1" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">更改密碼</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        	<form name="form3" method="post" action="changpass.php" id="sub1" onsubmit="return subcheck1();">
				<table align="center">
					<tr><td><input id="in1" type="password" name="oldpass" placeholder="原密碼" required></td></tr>
					<tr><td><input id="in2" type="password" name="newpass1" placeholder="新密碼" required></td></tr>
					<tr><td><input id="in3" type="password" name="newpass2" placeholder="再次驗證密碼" required></td></tr>
					<!--<tr><td><input type="submit" value="送出"></td></tr>-->
				</table>
			</form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" form="sub1">送出</button>
      </div>
    </div>
  </div>
</div>



<div class="modal fade" id="exampleModalCenter2" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">登出</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        是否登出?
        <form action="logout.php" id="sub4"></form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" form="sub4">登出</button>
      </div>
    </div>
  </div>
</div>



<div class="modal fade" id="exampleModalCenter3" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">新增資料夾</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form name="form4" method="post" action="newfile.php" id="sub2" onsubmit="return subcheck2();">
			<input id="in4" type="text" name="newfile" placeholder="資料夾名稱" required>
		</form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" form="sub2">新增</button>
      </div>
    </div>
  </div>
</div>




<div class="modal fade" id="exampleModalCenter4" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">新增檔案</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        	<form method="post" action="newdoc.php" name="form5" enctype="multipart/form-data" id="sub3" onsubmit="return subcheck3();">
				<table>
					<tr><td>選擇檔案<input id="in5" type="file" name="newdoc" required></td></tr>
				</table>
			</form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" form="sub3" >新增</button>
      </div>
    </div>
  </div>
</div>




<script type="text/javascript">
	function subcheck1(){
		var blackli=/[@;%=$/#]/i;
		var text1=document.getElementById("in1").value;
		var text2=document.getElementById("in2").value;
		var text3=document.getElementById("in3").value;
		//var text4=document.getElementById("in4").value;
		//var text5=document.getElementById("in5").value;
		//alert(text1);
		//alert(text5);
		if(blackli.test(text1)){
			alert("密碼中不可含有@;%=$/#");
			return false;
			//location.href="index.php";
		}
		if(blackli.test(text2)){
			alert("密碼中不可含有@;%=$/#");
			return false;
			//location.href="index.php";
		}
		if(blackli.test(text3)){
			alert("密碼中不可含有@;%=$/#");
			return false;
			//location.href="index.php";
		}
		if(text2!=text3){
			alert("新密碼驗證錯誤");
			return false;
		}
		if (text1==text2) {
			alert("舊密碼與新密碼相同");
			return false;
		}
	}
	function subcheck2(){
		var text4=document.getElementById("in4").value;
		if(blackli.test(text4)){
			alert("資料夾名稱中不可含有@;%=$/#");
			return false;
			//location.href="index.php";
		}
	}
	function subcheck3(){
		var text5=document.getElementById("in5").value;
		//alert(text5);
		if(blackli.test(text5)){
			alert("檔案名稱中不可含有@;%=$/#");
			return false;
			//location.href="index.php";
		}
	}
</script>
</body>
</html>