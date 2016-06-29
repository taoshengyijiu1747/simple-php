<!DOCTYPE html><html>
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta http-equiv="content-type" content="text/html;charset=utf-8">
    <link rel="stylesheet" href="sheet/sheet1.css" charset="utf-8">

    <?php include_once('include_file/connectData.php')    ?>
    <script type="text/javascript" src="js/jquery-2.2.0.min.js"></script>

</head>
<body>
<div style="background-color: #90EE90; border: #87b3ff;border-width: 1px; width: 980px; padding-bottom: 10px;padding-top: 10px; border: solid 1px; margin-bottom: 40px" >
    <span class="navigation" onmouseover="this.style.backgroundColor='#1F7000'" onmouseout="this.style.backgroundColor='#1F7099'" onclick="changeHome()"  ><label>Home</label></span>
    <span class="navigation" onmouseover="this.style.backgroundColor='#1F7000'" onmouseout="this.style.backgroundColor='#1F7099'" onclick="changeRSS()"  ><label>RSS</label></span>
    <span class="navigation" onmouseover="this.style.backgroundColor='#1F7000'" onmouseout="this.style.backgroundColor='#1F7099'" onclick="changeManage()"> <label>DATA</label>  </span>

</div>

    <script type="text/javascript" language="javascript">
        function  changeRSS()
        {
            location.href="settings.php";
        }
        function  changeManage()
        {
            location.href="showdata.php";
        }
        function  changeHome()
        {
            location.href="Home.php";
        }

    </script>

