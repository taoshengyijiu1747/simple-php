
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
<div align="center">

    <form method="post" action="search.php">
        <label><input type="checkbox" name="box2" id="box2" value="isTransfer"/> isTransfer</label>
        <label><input type="checkbox" name="box1" id="box1" value="isFinish"/> isFinish</label>

        <label><input type="checkbox" name="box3"  id="box3" value="isForbid"/>isForbid </label>
        <label><input type="submit" name="submit" value="提交"></label>
    </form>
</div>
<div>
    <?php
    if(isset($_POST['submit']) and $_POST['submit']=="提交")
    {
        //echo $_POST['box1'];



        if($_POST['box2']=="isTransfer")
        {
            $box2="true";

        }
        else $box2="false";

        if($_POST['box1']=="isFinish")
        {
            $box1="true"; $box2="true";
        }
        else  $box1="false";

        if($_POST['box3']=="isForbid")
            $box3="true";
        else $box3="false";
        $sql1=mysql_query("select * FROM   table1 WHERE isFinish='$box1' AND isTransfer ='$box2' AND isForbid='$box3'");

        ?>
        <table border="2" style="width: 980px;" id="table1" >
            <tr>
                <th>ID</th>
                <th >tilte</th>
                <th>isTransfer</th>
                <th>isFinish</th>
                <th>isForbid</th>
                <th>operation</th>
            </tr>

            <?php
            for($num=0;$num<count($info=mysql_fetch_array($sql1));$num++)
            {
                ?>
                <tr>
                    <td><?php  echo $info['ID'] ?></td>
                    <td ><?php  echo $info['title'] ?></td>
                    <td><?php  echo $info['isTransfer'] ?></td>
                    <td><?php  echo $info['isFinish'] ?></td>
                    <td><?php  echo $info['isForbid'] ?></td>
                    <td><input type="button" value="operation" onclick="getRowNo(this,'table1')"/></td>
                </tr>
                <?php
            }
            ?>

        </table>
        <?php


    }
    ?>
</div>

<?php
/**
 * Created by PhpStorm.
 * User: dong
 * Date: 16-6-29
 * Time: 下午5:43
 */?>
</body>
</html>

