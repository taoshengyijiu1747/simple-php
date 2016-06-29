


<?php
/**
 * Created by PhpStorm.
 * User: dong
 * Date: 15-12-28
 * Time: 下午9:54
 */
function startLoad()
{


require_once('include_file/TransmissionRPC.class.php' );
require_once('include_file/connectData.php');
//$test_torrent = "http://www.slackware.com/torrents/slackware64-13.1-install-dvd.torrent";
$test_torrent = "http://pt.xsyu.edu.cn/download.php?id=33606&passkey=d52a3134d7a5091632b99aed35de29fb";

$username='';
$password='';
$url="http://127.0.0.1:9091/transmission/rpc";
$ret_array=true;

$rpc = new TransmissionRPC();

$sql = mysql_query("select * from table1 WHERE isTransfer = 'false' AND isForbid='false' limit 0,1");
if ($sql)
{

    for($num=0;$num<count($info=mysql_fetch_array($sql));$num++)
    {

        $ID=$info["ID"];
        $test_title = $info["title"];
        $test_torrent = $info["enclosure_url"];
       // echo $ID.base64_decode($test_title)."<br>";

        //  $result = $rpc->add($urlOfTorrents,'/var/www/torrents');
        echo "$num";  echo "\n";

        try {

            $result = $rpc->sstats();
            print "GET SESSION STATS... [{$result->result}]";
            echo "</br>";
            sleep(3);

            $result = $rpc->add($test_torrent,"/var/www/torrents/" );
            // echo "$test_title";echo "<br>";
            if ($result->result == success) {
                echo "向下载器添加种子成功";
                echo "\n";

                try {
                    $sql1 = mysql_query("update table1 set isTransfer='true' WHERE title = '$test_title'  ");
                    if ($sql1) {
                        echo "isTransfer 字段设置成功";
                        echo "\n";
                    }
                } catch (Exception $e2) {
                    echo $e2->getMessage();
                }


            }

            $id = $result->arguments->torrent_added->id;

            print "ADD TORRENT TEST... [{$result->result}] (id=$id)";
            echo "\n";
            sleep(2);

            $result = $rpc->set( $id, array('uploadLimit' => 10) );
            print "SET TORRENT INFO TEST... [{$result->result}]\n";
            echo "\n";
            sleep( 2 );
            $rpc->return_as_array = true;//为true返回的是数组
            $result = $rpc->get( $id, array( 'uploadLimit' ) );
            print "GET TORRENT INFO AS ARRAY TEST... [{$result['result']}]\n";
            echo "\n";
            $rpc->return_as_array = false;//为false是返回的是对象
            sleep( 2 );
            $result = $rpc->get( $id, array( 'uploadLimit','name','torrentFile',' hashString','downloadDir') );
            print "GET TORRENT INFO AS OBJECT TEST... [{$result->result}]\n";
            echo "\n";
            sleep( 2 );

          //  $result2 = $result->arguments->torrents[0]->uploadLimit == 10 ? 'success' : 'failed';
           // print "VERIFY TORRENT INFO SET/GET... [{$result2}] (".$result->arguments->torrents[0]->uploadLimit.")\n";
           // echo "</br>";
            echo "资源的哈希值：".$hashString=$result->arguments->torrents[0]->hashString; echo "\n";
            echo "种子文件的位置";
            $torrentFile=$result->arguments->torrents[0]->torrentFile ;
            echo $torrentFile;echo "\n";
            mysql_query("update table1 set hash='$hashString',torrentFile='$torrentFile' WHERE title = '$test_title' ");

           // echo "种子文件的名字:";
           // echo $result->arguments->torrents[0]->name ;echo "\n";
           // echo "创建者:";
           // echo  $result->arguments->torrents[0]->creator ;echo "\n";
            echo "下载的路径:";
              $downloadDir=$result->arguments->torrents[0]->downloadDir ;
            echo $downloadDir;echo "\n";

           // $sql=mysql_query("select 'isFinish' from table1 WHERE  isFinish='false' ");
           // $result = $rpc->stop( $id );
            // print "STOP TORRENT TEST... [{$result->result}]\n";echo "</br>";
            //sleep( 2 );iletatsfil
            $result = $rpc->verify($id);
            print "VERIFY TORRENT TEST... [{$result->result}]\n";
            echo "\n";
            sleep(10);
            //$result = $rpc->start($id);
          //  print "START TORRENT TEST... [{$result->result}]\n";
           // echo "</br>";
          //  sleep(2);
            $result = $rpc->reannounce($id);
            print "REANNOUNCE TORRENT TEST... [{$result->result}]\n";
            echo "\n";
            sleep(2);
          //  $result = $rpc->move( $id, '/var/www/downloads/', true );
          //  print "MOVE TORRENT TEST... [{$result->result}]\n";echo "</br>";
           // sleep( 2 );
         //  $result = $rpc->remove( $id, false );
         //   print "REMOVE TORRENT TEST... [{$result->result}]\n";echo "</br>";
          // echo "<hr/>";


        } catch (Exception $e) {
            $e->getMessage();
        }
    }

}
    sleep(6);
    include_once("finish_check.php");
    finishCheck();
}
?>


