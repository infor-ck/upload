<!DOCTYPE html>
<html>
<head>
	<title>搜尋結果</title>
	<meta charset="utf-8">
</head>
<body>
<?php
include("logincheck.php");
include("connserver.php");
if($_GET['searchdoc']!=""){
	$key=$_GET['searchdoc'];
	$acc=$_SESSION['user'];
	$sql="SELECT docname,updatedate,filedir FROM $acc WHERE docname like '%$key%' ;";
	echo($sql);
	$result=$mysqli->query($sql);
	//copy show.php
	if($result->num_rows>0){
			$docpage=ceil(($result->num_rows)/10);
			if(!isset($_GET['page'])){
				$nowpage=1;
			}
			else{
				$loc="search.php?searchdoc=".$key;
				if($_GET['page'] < 1){
					header("location:$loc");
				}
				elseif ($_GET['page'] > $docpage) {
					header("location:$loc");
				}
				$nowpage=$_GET['page'];
			}
			$strt_row=($nowpage-1)*10;
			$sql2="SELECT docname,updatedate,filedir,isfile FROM $acc WHERE docname like '%$key%' order by isfile LIMIT $strt_row,10;";
			echo($sql2);
			$result2=$mysqli->query($sql2);
			echo "<table><tr><td>    </td><td>檔案名稱</td><td>最後修改日期</td></tr>";
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
		echo "目前無任何檔案";
}
echo "<a href='show.php'>回主頁</a>";
//else{
	//header()
}?>
<script>
			function pageChange(){
				var page=document.getElementById("sel");
				location.href="search.php?page="+page.value;
			}
		</script>
<a href="search.php?page=<?php echo $nowpage-1; ?>&searchdoc=<?php echo($key); ?>">上一頁</a>
<a href="search.php?page=<?php echo $nowpage+1; ?>&searchdoc=<?php echo($key); ?>">下一頁</a>
</body>
</html>