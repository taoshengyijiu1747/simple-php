
    <?php  include_once('include_file/TransmissionRPC.class.php')?>
    <?php  include_once('include_file/connectData.php')?>

<?php
function delete()
{


    $username=' ';
    $password=' ';
    $url="http://127.0.0.1:9091/transmission/rpc";
    //$url="http://127.0.0.1:9091";
    $ret_array=true;
    $ids=array();

    $fields=array( "id", "name", "addedDate","hashString" );

    $transRPC=new TransmissionRPC($url,$username,$password,$ret_array);
    $getResult=$transRPC->get($ids,$fields);
    $torrents=$getResult['arguments']['torrents'];
    $count=count($torrents);
    $retainCount=3;//需要保留的种子个数

    for($i=0;$i<$count;$i++)
        //foreach($torrents as $iter=>$key)
    {
        $torrent_timestamp[]=$torrents[$i]['addedDate'];
        $torrent_id[]=$torrents[$i]['id'];
        $torrent_name[]=$torrents[$i]['name'];
        $torrent_hashString[]=$torrents[$i]['hashString'];//获取惟一的哈希值，
       // echo $torrent_hashString[$i];
       $sql= mysql_query("select * from table1 WHERE hash='$torrent_hashString[$i]'  ");
        $info=mysql_fetch_array($sql);
       // echo $info["isForbid"];
        if($info["isForbid"]=="true")//如果禁止上传的时候就删除掉种子和正在下载的任务
        {
            $transRPC->stop($torrents[$i]['id']);
            $transRPC->remove($torrents[$i]['id'],true);
            echo $torrents[$i]['id'];echo "\n";
           echo $torrents[$i]['name'];echo "\n";
        }

    }

function getDirectorySize($path)//计算文件下存储空间，如果硬盘使用太多，要及时删除资源
{
    $totalsize = 0;
    $totalcount = 0;
    $dircount = 0;
    if ($handle = opendir ($path))
    {
        while (false !== ($file = readdir($handle)))
        {
            $nextpath = $path . '/' . $file;
            if ($file != '.' && $file != '..' && !is_link ($nextpath))
            {
                if (is_dir ($nextpath))
                {
                    $dircount++;
                    $result = getDirectorySize($nextpath);
                    $totalsize += $result['size'];
                    $totalcount += $result['count'];
                    $dircount += $result['dircount'];
                }
                else if (is_file ($nextpath))
                {
                    $totalsize += filesize ($nextpath);
                    $totalcount++;
                }
            }
        }
    }
    closedir ($handle);
    $total['size'] = $totalsize;
    $total['count'] = $totalcount;
    $total['dircount'] = $dircount;
    return $total;
}

function sizeFormat($size)
{
    $sizeStr='';
    if($size<1024)
    {
        return $size." bytes";
    }
    else if($size<(1024*1024))
    {
        $size=round($size/1024,1);
        return $size." KB";
    }
    else if($size<(1024*1024*1024))
    {
        $size=round($size/(1024*1024),1);
        return $size." MB";
    }
    else
    {
        $size=round($size/(1024*1024*1024),1);
        return $size." GB";
    }

}

$path="/var/www/";
$ar=getDirectorySize($path);


echo $path."目录下文件的存储量：". sizeFormat($ar['size']);echo "\n";
echo $path."目录下所有子文件的数量：". $ar['count'];echo "\n";
echo $path."目录下子文件的数量：".$ar['dircount'];echo "\n";

$size=sizeFormat($ar['size']);
$length=$size;
if(substr($size,$length-2)=="GB")
{
    $sql= mysql_query("select * from table1 WHERE hash='$torrent_hashString[$i]'  ");
    $info=mysql_fetch_array($sql);
    if ($size>30.0  )//设置磁盘最大储存量
    {
        for($i=0;$i<$count-3;$i++)//移除过多的种子和资源，强制释放磁盘空间
            //foreach($torrents as $iter=>$key)
        {

            if($info["isForbid"]=="true")//如果禁止上传的时候就删除掉种子和正在下载的任务
            {
                $transRPC->stop($torrents[$i]['id']);
                $transRPC->remove($torrents[$i]['id'],true);
                echo $torrents[$i]['id'];echo "\n";
                echo $torrents[$i]['name'];echo "\n";
            }

        }
    }else if($size>20.0)//
    {
        for($i=0;$i<$count-2;$i++)//移除过多的种子，
            //foreach($torrents as $iter=>$key)
        {


                $transRPC->stop($torrents[$i]['id']);
                $transRPC->remove($torrents[$i]['id'],true);
            echo $torrents[$i]['id'];echo "\n";
            echo $torrents[$i]['name'];echo "\n";
            

        }
    }else if($size>40)
    {
        for($i=0;$i<$count-2;$i++)//移除过多的种子，
            //foreach($torrents as $iter=>$key)
        {
            if($info["isForbid"]=="true")//如果禁止上传的时候就删除掉种子和正在下载的任务
            {
                $transRPC->stop($torrents[$i]['id']);
                $transRPC->remove($torrents[$i]['id'],true);
                echo $torrents[$i]['id'];echo "\n";
                echo $torrents[$i]['name'];echo "\n";
            }
        }
    }
}



    $removepath="/var/www/torrents/";//trasmission watch contents
//移除后缀为.added的文件
    function removeTorrentAdded($path)//remove /var/wwww/torrents/  .torrent.added files
    {
        $matches=array();

        if ($handle = opendir ($path))
        {
            while (false !== ($file = readdir($handle))) {

                $torrent_added='/[0-9]+\.torrent\.added/';
                preg_match($torrent_added,$file,$matches);
                echo $matches[0]."\n";

                $pathAll=$path.$matches[0];

                if(unlink($pathAll))
                {
                    echo "delete OK\n";
                }

            }
        }


        closedir ($handle);

    }
    removeTorrentAdded($removepath);

/*
    for($i=0;$i<$count-$retainCount;$i++)//移除过多的种子，
    //foreach($torrents as $iter=>$key)
     {

        $transRPC->stop($torrents[$i]['id']);
        $transRPC->remove($torrents[$i]['id'],true);


     }
*/


   // array_multisort($torrent_timestamp, SORT_ASC,$torrent_id, SORT_ASC,$torrents);


//      for($i=0;$i<$count;$i++)
//      {
//              print "torrents id:[".$torrents[$i]['id']."],";
//              print "torrents name:[".$torrents[$i]['name']."],";
//              print "torrents addedDate:[".date(DATE_ATOM,$torrents[$i]['addedDate'])."]";
//              print "\n";
///     }




    sleep(6);
    include_once("upload.php");
    upLoad();


}



    ?>
