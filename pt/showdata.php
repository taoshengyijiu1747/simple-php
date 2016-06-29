<!DOCTYPE html><html>
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta http-equiv="content-type" content="text/html;charset=utf-8">
    <link rel="stylesheet" href="sheet/sheet1.css" charset="utf-8">
	<?php include_once('include_file/connectData.php')    ?>
	<script type="text/javascript" src="js/jquery-2.2.0.min.js"></script>

      <title>影片信息</title>

</head>
<body>
<div>
	<?php include "head.php"?>
</div>

<?php

if(isset($_POST['submit1'])and $_POST['submit1']=="提交")
{
	$number= $_POST['span0'];
	$number=intval($number);
	$title=$_POST['span1'];
	$istransfer = $_POST['span2'];
	$isfinish =$_POST['span3'];
	$isforbid=$_POST['span4'];
	$isUpload=$_POST['span4_1'];
	$descriptionstr=$_POST['span6'];
	//  $str1=strpos($descriptionstr,"xmp>");
	//  $str2=strpos($descriptionstr,"</xmp");
	// $descriptionstr=mb_substr($descriptionstr,$str1+4,$str2,'utf8');
	if(strlen($title)>0 and is_numeric($number) )
	{
		$sql1=mysql_query("update table1 set isFinish='$isfinish',
      isTransfer='$istransfer' ,isForbid='$isforbid',description='$descriptionstr' ,
      isUpload='$isUpload', title='$title' WHERE ID= '$number'   ");

	}

}

?>
<script>
	function select_chechbox()
	{
		var isfinish=document.getElementById("box2");
		var box2=$("#box2").is(":checked")
		var box1=$("#box1").is(":checked")
		var box1=$("#box1").is(":checked")
		var url=""
		window.open()
	}
</script>
<div align="center">

<form method="post" action="search.php">
	<label><input type="checkbox" name="box2" id="box2" value="isTransfer"/> isTransfer</label>
    <label><input type="checkbox" name="box1" id="box1" value="isFinish"/> isFinish</label>

            <label><input type="checkbox" name="box3"  id="box3" value="isForbid"/>isForbid </label>
            <label><input type="submit" name="submit" value="提交"></label>
</form>
</div>


<script type="text/javascript">

	//得到行对象
	function getRowObj(obj)
	{

		while(obj.tagName.toLowerCase() != "tr"){
			obj = obj.parentNode;
			if(obj.tagName.toLowerCase() == "table")
				return null;
		}
		return obj;
	}

	//根据得到的行对象得到所在的行数 and data
	function getRowNo(obj,tableID){
		var trObj = getRowObj(obj);
		var trArr = trObj.parentNode.children;
		for(var trNo= 0; trNo < trArr.length; trNo++){
			if(trObj == trObj.parentNode.children[trNo]){

				var t = document.getElementById(tableID);	//alert(tableID);
				var span0 = t.rows[trNo].cells[0].innerHTML; //alert("OK");
				url="data.php?ID="+span0;
				window.open(url);
			}
		}
	}
</script>

<div id="partdiv" style="display:  ; width: 980px ">
	<div>
		<table border="2"  id="table4" style="height: 500px;"  >
			<tr >
				<th>序号</th>
				<th>名称</th>
				<th>类型</th>
				<th>简介</th>
				<th>是否已经传递种子</th>
				<th>是否下载完成</th>
				<th>是否禁止上传</th>
				<th>是否已经上传</th>
				<th>opreation</th>
			</tr>
			<?php
			$page=1;
			if($page) {
				$page = $_GET['page'];
				if($page=="")
					$page=1;
				$page_size = 3;
				$query = "select count(*) as total from table1  ";
				$result = mysql_query($query);
				$message_count = mysql_result($result, 0, "total");
				$page_count = ceil($message_count / $page_size);
				$offset = ($page - 1) * $page_size;
				$query = "select * from table1 limit $offset,$page_size";
				$result = mysql_query($query);

				for ($i = 0; $i < count($info = mysql_fetch_array($result)); $i++) {
					?>
					<tr>
						<td><?php echo $info['ID']; ?></td>
						<td style="width: 200px; overflow-x: auto;  word-break: break-all" width="120px">
							<?php echo $info['title'] ; ?>
						</td>
						<td><?php echo $info['category']   ;?></td>
						<td>
							<div style="  height: 180px; width: 400px;  overflow-y: scroll; overflow-x: scroll">
								<?php echo "<xmp>". $info['description']."</xmp>" ;?>
							</div>
						</td>

						<td><?php echo $info['isTransfer']; ?></td>
						<td><?php echo $info['isFinish']; ?></td>
						<td><?php echo $info['isForbid'] ;?></td>
						<td><?php echo $info['isUpload'] ;?></td>
						<td><input type="button" value="operation" onclick="getRowNo(this,'table4')"/></td>
					</tr>


					<?php
				}
			}
			?>

		</table>
		<table style="margin-top: 20px;text-align: center;" align="center">
			<tr>
				<td>页次<?php echo $page ?>/<?php  echo $page_count?>页  记录:<?php echo $message_count?>条</td>
				<td>分页:
					<?php

					if($page!=1)
					{
						echo "<a href='showdata.php?page=1'> 首页</a>";
						echo "<a href=showdata.php?page=".($page-1).">上一页 </a>";
					}
					else{
						echo "<a > 首页</a>";
						echo "<a>上一页 </a>";
					}




					if($page<$page_count)
					{
						echo "<a href=showdata.php?page=".($page+1).">下一页</a>";
						echo "<a href=showdata.php?page=". $page_count.">尾页</a>";
					}
					else
					{
						echo "<a>下一页</a>";
						echo "<a>尾页</a>";
					}
					?>


				</td>

			</tr>
		</table>

	</div>
</div>







</body>
</html>




