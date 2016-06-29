<?php

include_once('include_file/connectData.php');
if($_POST['submit']!="")
{

    $username=$_POST['name'];
    $password=$_POST['password'];


    $sql = mysql_query("select * from login WHERE username='$username'AND password='$password' ");
    $info=mysql_fetch_array($sql);

    if($info)
    {
        ?>
        <script>
            window.location.href="Home.php";
        </script>
        <?php
    }
    else
    {
        ?>
        <script>
            alert("sorry, your name or password is worry");
            window.location.href="login.php";
        </script>
        <?php
    }
}
?>
