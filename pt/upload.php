
<?php

include_once("include_file/connectData.php");
include_once("loadrss.php");
include_once("uploaddb.inc.php");
/**
 * Created by PhpStorm.
 * User: dong
 * Date: 16-1-18
 * Time: 下午8:13
 */


$sql=mysql_query("select * from table1 WHERE isFinish='true' and isForbid='false' and isUpload='false'");
$rownum=  mysql_num_rows($sql);
 if($rownum!=0)
 {
     for($i=0;$i=count($info=mysql_fetch_array($sql));$i++)
     {
         if($info["isFinish"]=="true" and $info["isUpload"]=="false")
         {
             $ID=$info['ID'];
             $file= $info["torrentFile"];
             $count=count(split("/",$file));
             $arr=split("/",$file);
             $filename=$arr[$count-1];
             //echo $filename;echo "<br>";

             // chmo($file,0677);

             //  $len=strlen($filename);
             // $name=mb_substr($filename,0,$len-25);
             $name= $info["title"];
             echo $name;echo "\n";

             $description=$info["description"];
             //$pattern='/download\.php\?id=[0-9]+/';
             $imdbpattern='/http\:\/\/www\.imdb\.com\/title\/[a-z]+[0-9]+\//';
             preg_match($imdbpattern,$description,$matches);
             $imdb= $matches[0];

             //echo $imdb;echo "<br>";

             // $descr="<![CDATA[".$description."]]>";

             $descr=$description;
             // echo $descr;echo "<br>";

             $type=$info["category"];
             switch($type)
             {

                 case "电影": $typeNum="401";break;
                 case "纪录片": $typeNum="404";break;
                 case "动漫": $typeNum="405";break;
                 case "电视剧": $typeNum="402";break;
                 case "综艺": $typeNum="403";break;
                 case "MV": $typeNum="406";break;
                 case "体育": $typeNum="407";break;
                 case "音乐": $typeNum="408";break;
                 case "其他": $typeNum="409";break;
                 default: $typeNum="0";break;

             }
             // $type1=trim($type);
             // echo $type;echo "<br>";

             $nfo="";
             $medium="";
             $codec="";
             $standard="";
             $audiocodec="";
             $team="";

             $torrent['filename']=$file;
             $torrent["name"]=$name;
             $torrent["small_descr"]=$name;
             $torrent["imdb"]=$imdb;
             $torrent["nfo"]=$nfo;
             $torrent["descr"]=$descr;
             $torrent["type"]=$typeNum;

             $torrent["medium_sel"]=$medium;
             $torrent["codec_sel"]=$codec;
             $torrent["standard_sel"]=$standard;
             $torrent["audiocodec_sel"]=$audiocodec;
             $torrent["team_sel"]=$team;


             $idnum=  uploadTorrent($torrent);echo "OK";
             $idpattern='/[0-9]+/';
             preg_match($idpattern,$idnum,$matches);
             $id= $matches[0];
             if(strlen($id)>0)//无论上传是否成功，都要跳转到loadrss.php
             {
                 mysql_query("update table1 set isUpload='true' WHERE ID='$ID' ");
                 echo "upload seccess ";
                 sleep(6);
                 loadRss();
             }
             else{
                 sleep(6);
                 loadRss();
             }
             echo "\n"."\n"."\n";
             // echo $torrent["0"];echo "<br>";
             //  echo $torrent["1"];echo "<br>";


             /*  $fields['file'] = '@'.$torrent['filename'];
               $fields['name'] = $torrent['name'];
               $fields['small_descr'] = $torrent['small_descr'];
               $fields['url'] = $torrent['imdb'];
               $fields['nfo'] = '';
               $fields['descr'] = $torrent['descr'];
               $fields['type'] =  $torrent['type'];
               $fields['medium_sel'] =  $torrent['medium'];
               $fields['codec_sel'] =  $torrent['codec'];
               $fields['standard_sel'] =  $torrent['standard'];
               $fields['audiocodec_sel'] = '';
               $fields['team_sel'] = '';
             */
         }
     }
     sleep(6);
     loadRss();
 }

else
{//没有符合上传条件的种子，直接跳转的到loadrss.php
    echo "no upload"."\n";
    sleep(6);
    loadRss();
}


// sleep(6);
//
// loadRss();
?>
