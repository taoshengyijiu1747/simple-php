<?php
$con = mysql_connect("localhost", "root", "root1");
if (!$con)
{
die('Could not connect: ' . mysql_error());

}
else {

$db_selected = mysql_select_db("mydate", $con);

if (!$db_selected)
{
die ("Can't use test_db : " . mysql_error());
}
else {
    mysql_query("set names utf8");
}}
?>