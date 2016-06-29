<!DOCTYPE html>
<html >
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet"  href="sheet/sheet1.css" type="text/css" charset="utf-8">
    <?php include_once('include_file/connectData.php')?>
    <title>设置rss链接</title>

</head>
<body>
<script>

    //得到行对象
    function getRowObj(obj)
    {
        var i = 0;
        while(obj.tagName.toLowerCase() != "tr"){
            obj = obj.parentNode;
            if(obj.tagName.toLowerCase() == "table")
                return null;
        }
        return obj;
    }

    //根据得到的行对象得到所在的行数 and data
    function getRowNo(obj,tableID,category){

        var trObj = getRowObj(obj);
        var trArr = trObj.parentNode.children;
        for(var trNo= 0; trNo < trArr.length; trNo++){
            if(trObj == trObj.parentNode.children[trNo]){

                var t=document.getElementById(tableID);
                //trNo+=1; //alert(tableID);

               // alert(span1);
               if(1==category)
               {
                   var  url=t.rows[trNo].cells[1].innerHTML;
                   var  id=t.rows[trNo].cells[0].innerHTML;
                 var td1= document.getElementById('td1');
                   td1.value=id;

                 var td2=  document.getElementById("td2");
                   td2.value=url;
                  // alert(url)
               }
                if(2==category)
                {
                    var  id=t.rows[trNo].cells[0].innerHTML;
                    location.href="settings_taken.php?id="+id;
                }

            }
        }
    }

</script>
<div>
    <?php include "head.php"?>
</div>
<div>
    <table id="table1" style="max-width: 980px;width: 970px;margin-left: auto;margin-right: auto" border="1">
        <tr>
            <th>序号</th>
            <th>RSS链接</th>
            <th colspan="2">操作</th>

        </tr>
        <?php
        $sql=mysql_query(" select * from rsslink ");
       // echo mysql_affected_rows();
        while($info = mysql_fetch_array($sql))
        {
            ?>
            <tr>
                <td ><?php echo $info["id"];?></td>
                <td style="width: 680px;" onclick="getRowNo(this,'table1',1)" class="fonthover point" ><?php echo base64_decode($info["url"]) ;?></td>
                <td><label  onclick="getRowNo(this,'table1',1)"  class="fonthover" >修改</label></td>
                <td><label onclick="getRowNo(this,'table1',2)" class="fonthover" >删除</label></td>
            </tr>
            <?php
        }

        ?>
    </table>
<script>
    function updateUrl(id)
    {
        document.getElementById(id)
       // location.href="settings_taken.php?id"=
    }
</script>
</div>
<div >
    <form method="post" action="settings_taken.php" >
        <table style="text-align: center;margin-left: auto;margin-right: auto;width: 970px;">
            <tr>
                <td>序号</td>
                <td>RSS网址</td>
            </tr>
            <tr>
                <td ><input type="text" id="td1" name="td1" class="shorter" readonly="readonly" ></td>
                <td ><label><textarea rows="5" cols="70"  id="td2" name="td2" style="font-size: 18px;" > </textarea></label></td>
            </tr>
        </table>
        <div>
            <input type="submit" name="add" value="add">
            <input type="submit" name=" update" value="update">
        </div>

    </form>
</div>
</body>
</html>
