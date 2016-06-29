<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet"  href="sheet/sheet1.css" type="text/css" charset="utf-8">
    <link rel="stylesheet"  href="sheet/data.css" type="text/css" charset="utf-8">
    <script type="text/javascript" src="js/bbcode.js"></script>
    <script type="text/javascript" src="js/jquery-2.2.0.min.js"></script>
	<script type="text/javascript"  src="js/bbToHtml.js"></script>
    <?php include_once('include_file/connectData.php');
    require_once('include_file/bbcodetohtml.php');?>
    <title>修改数据</title>
    <style>
        img{
            max-width: 980px;
            max-height: 980px;
        }
    </style>
</head>
<body>

<?php $ID= $_GET["ID"];
 $sql=mysql_query("select * from table1 where ID='$ID' ");

 $info=mysql_fetch_array($sql);

?>

<div style="text-align: center;">
    <form action="showdata.php" method="post" style="text-align: center">
        <table border='2' id="table3" style="margin-left: auto;margin-right: auto">
            <tr>
                <th>序号</th>
                <th><div align="center">title</div></th>
                <th><div align="center">isTransfer</div></th>
                <th><div align="center">isFinish</div></th>
                <th><div align="center">isForbid</div></th>
                <th><div align="center">isUpload</div></th>
            </tr>

            <tr> <td><input id="span0" name="span0" class="shorter" readonly="readonly" value="<?php echo $info["ID"];  ?> "   /></td>
                <td><textarea id="span1" name="span1" style="width: 350px;padding-left: 0px;padding-right: 0px;margin: 0px;"><?php echo $info["title"];   ?></textarea></td>
                <td><select id="span2" name="span2">//isTransfer
                        <?php if($info["isTransfer"]=="false" )
                            echo "<option value='false'>false</option>";
                        else echo "<option>true</option>";

                            ?>

                        <option value="true">true</option>
                        <option value="false">false</option>
                    </select>
                </td>
                <td>
                    <select id="span3" name="span3">//isFinish
                        <option><?php echo $info["isFinish"];  ?>  </option>
                        <option value="true">true</option>
                        <option value="false">false</option>
                    </select>
                </td>
                <td>
                    <select id="span4" name="span4">//isForbid
                        <option><?php echo $info["isForbid"];  ?>  </option>
                        <option value="true">true</option>
                        <option value="false">false</option>
                    </select>
                </td>
                <td>
                    <select id="span4_1" name="span4_1">//isUpload
                        <option><?php echo $info["isUpload"];  ?>  </option>
                        <option value="true">true</option>
                        <option value="false">false</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>类型</td>
                <td colspan="5">
                    <input class="shorter" type="text" id="span5" name="span5" value="<?php echo $info['category']  ?>"/>

                </td>
            </tr>
            <tr>
                <td valign="top">简介</td>
                <td  colspan="5">

						<textarea style="width: 850px;height: 600px; padding: 5px;"  id="span6" name="span6">
                       <?php echo $info['description']  ?>
					</textarea>

                </td>
            </tr>
        </table>

        <div style="text-align: center">
            <input type="submit" name="submit1" value="提交" />
            <input type="reset" value="重置"/>
        </div>
    </form>
</div>
<div>

    <script>

       // function outputBBCode(textarea)
       // {
            //var out = document.getElementById("out");
        //    var out_html = document.getElementById("out_html");
          //  var html = convertBBCode(textarea.value);
            // if(!out.firstChild)
            // out.appendChild(document.createTextNode(html));
            // else    outputBBCode(document.getElementById(&quot;span6&quot;))
            // out.replaceChild(document.createTextNode(html), out.firstChild);
         //   out_html.innerHTML = html;

       // }

        function out(text)
        {
            //alert(bbToHtml(text));
            text=bbToHtml(text);
            document.getElementById("out_html").innerHTML=convertBBCode(text);
        }

    </script>

    <a href="#out_html">
        <input type="button" value="测试简介" onclick="out(document.getElementById('span6').innerHTML)" />
    </a>

</div>

<div id="out_html" style="border: 1px solid #777; margin: 1em auto; padding: 5px 3px; min-width: 980px;">&nbsp;</div>



</body>
</html>