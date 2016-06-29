
<!DOCTYPE html>
<html >
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet"  href="sheet/sheet1.css" type="text/css" charset="utf-8">
    <link rel="stylesheet" href="sheet/Home.css" type="text/css">
    <?php include_once('include_file/connectData.php')?>
    <title>首页</title>

</head>
<body>
<div>
    <?php include "head.php"?>
</div>
<?php  mysql_query("select * from table1 where category='电影' ");
      $fime=mysql_affected_rows();

mysql_query("select * from table1 where category='动漫' ");
$cartoon=mysql_affected_rows();
mysql_query("select * from table1 where category='电视剧' ");
$TV=mysql_affected_rows();
mysql_query("select * from table1 where category='综艺' ");
$variety=mysql_affected_rows();
mysql_query("select * from table1 where category='MV' ");
$MV=mysql_affected_rows();

mysql_query("select * from table1 where category='体育' ");
$sport=mysql_affected_rows();
mysql_query("select * from table1 where category='音乐' ");
$music=mysql_affected_rows();
mysql_query("select * from table1 where category='其它' ");
$others=mysql_affected_rows();



?>
<div style="margin-left: 0px; text-align: center">
   <ul style="margin-left: 0px;" >
       <li class="height_odd"><span class="position">电影数量 </span><span class="position"><?php echo $fime ?></span></li>
       <li class="height_even"><span class="position">电视剧数量 </span> <span class="position"><?php  echo $TV ?></span></li>
       <li class="height_odd"><span class="position">动漫数量 </span><span class="position"><?php echo $cartoon ?></span></li>
       <li class="height_even"><span class="position">综艺数量 </span> <span class="position"><?php  echo $variety ?></span></li>
       <li class="height_odd"><span class="position">MV数量 </span><span class="position"><?php echo $MV ?></span></li>
       <li class="height_even"><span class="position">体育数量 </span> <span class="position"><?php  echo $sport ?></span></li>
       <li class="height_odd"><span class="position">音乐数量 </span><span class="position"><?php echo $music ?></span></li>
       <li class="height_even"><span class="position">其它数量 </span> <span class="position"><?php  echo $others ?></span></li>
   </ul>
</div>


<?php
/**
 * Created by PhpStorm.
 * User: dong
 * Date: 16-6-27
 * Time: 下午4:57
 */
?>
</body>
</html>
