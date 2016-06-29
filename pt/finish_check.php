
<?php  include_once('include_file/TransmissionRPC.class.php')?>
    <?php  include_once('include_file/connectData.php')?>


<?php
function finishCheck()//检查下载是否完成
{


     $cnt=1;

    $username=' ';
    $password=' ';
    $url="http://127.0.0.1:9091/transmission/rpc";
    //$url="http://127.0.0.1:9091";
    $ret_array=true;
    $ids=array();

    $fields=array( "id", "name", "addedDate" ,"status",'haveValid',
        'totalSize','torrentFile','creator','downloadDir','fileStats','hashString');

    $transRPC=new TransmissionRPC($url,$username,$password,$ret_array);
    $getResult=$transRPC->get($ids,$fields);
    $torrents=$getResult['arguments']['torrents'];
    $count=count($torrents);


    for($i=0;$i<$count;$i++)
        //foreach($torrents as $iter=>$key)
    {
        $torrent_timestamp[]=$torrents[$i]['addedDate'];
        $torrent_id[]=$torrents[$i]['id'];
        echo "文件session id 编号：";
        echo $torrent_id[$i];echo "\n";
        $torrent_name[]=$torrents[$i]['name'];
        echo "文件名字：";
        echo $torrent_name[$i];echo "\n";
       // $torrent_isFinished[]=$torrents[$i]['isFinished'];
       // echo "是否完成下载：";
      //  echo $torrent_isFinished[$i];echo "<br/>";
        $torrent_status[]=$torrents[$i]['status'];
        echo "文件状态：";
        echo $transRPC->getStatusString($torrent_status[$i]);
        $torrent_hashString[]=$torrents[$i]['hashString'];
       //$sql=mysql_query("select * from table1 where isFinish='false' and title='$torrent_name' ");
        if($transRPC->getStatusString($torrent_status[$i])=="Seeding")
        {

            $sql=mysql_query("update table1 set isFinish='true' WHERE  hash='$torrent_hashString[$i]' ");
            //hash是唯一的，
        }

       // echo mysql_affected_rows();
       // echo $torrent_status[$i];
      /*  if($torrent_status[$i]==6)
            echo "下载完成。";
        else if($torrent_status[$i]==4)
            echo "正在下载。";
        else if($torrent_status[$i]==0)
            echo "暂停下载或上传。";*/
        echo "\n";

     //   $torrent_downloadDir[]=$torrents[$i]['downloadDir'];
      //  echo "下载的文件的位置";
      //  echo  $torrent_downloadDir[$i]; echo "\n";
      //  $torrent_torrentFile[]=$torrents[$i]['torrentFile'];
      //  echo "种子文件的位置";
      //  echo $torrent_torrentFile[$i] ;echo "\n";

      //  echo "创建者:";
       // echo   $torrents[$i]['creator'];echo "\n";




    }

   // array_multisort($torrent_timestamp, SORT_ASC,$torrent_id, SORT_ASC,$torrents);


//      for($i=0;$i<$count;$i++)
//      {
//              print "torrents id:[".$torrents[$i]['id']."],";
//              print "torrents name:[".$torrents[$i]['name']."],";
//              print "torrents addedDate:[".date(DATE_ATOM,$torrents[$i]['addedDate'])."]";
//              print "\n";
///     }

   /* for($i=0;$i<$cnt;$i++)
    {
        print "remove torrents:[".$torrents[$i]['name']."], addDate:".date(DATE_ATOM,$torrents[$i]['addedDate'])."\n";
        $transRPC->stop($torrents[$i]['id']);
        $transRPC->remove($torrents[$i]['id'],true);

    }*/
    sleep(6);
    include_once("delete.php");
    delete();


}


?>

