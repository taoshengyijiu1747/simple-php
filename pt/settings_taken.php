<?php
/**
 * Created by PhpStorm.
 * User: dong
 * Date: 16-6-26
 * Time: 下午6:04
 */
include 'include_file/connectData.php';
//echo $_POST["td2"];
if(isset($_POST['add'])and $_POST['add']=="add" )
{
    $url=$_POST["td2"];
    if(strlen($url)>10)
    {
        $url=base64_encode($url);echo "<script>alert(".$url.");</script>";
        $sql=mysql_query("insert into rsslink (url) VALUE ('$url')");
        if(mysql_affected_rows()>0)
        {
             echo "<script>alert(".$url.");</script>";
            echo "<script>alert('insert OK!');location.href='settings.php'</script>";

        }
    }
    else
    {
        echo "<script>alert('url is null!');location.href='settings.php'</script>";
    }

}
$id=$_GET["id"];
if(strlen($id)>0)
{
    $sql=mysql_query("delete from rsslink WHERE id='$id'");

    if(mysql_affected_rows()>0)
    {
        mysql_query("ALTER TABLE rsslink  DROP COLUMN id");
        mysql_query("alter table rsslink add id int(5)    PRIMARY KEY auto_increment");
        echo "<script>alert('delete OK!');location.href='settings.php'</script>";

    }
}

if(isset($_POST['update'])and $_POST['update']=="update" )
{
    $id=$_POST["td1"];
    $url=$_POST["td2"];
    if(strlen($url)>10 and strlen($id)>0)
    {
        $url=base64_encode($url);//echo "<script>alert(".$url.");</script>";
        mysql_query("update rsslink set url='$url' where id= '$id' ");
        if(mysql_affected_rows()>0)
        {
            //echo "<script>alert(".$url.");</script>";
            echo "<script>alert('update OK!');location.href='settings.php'</script>";
        }
    }
    else
    {
        echo "<script>alert('url is error!');location.href='settings.php'</script>";
    }

}

?>