<?php

function uploadTorrent($torrent){

/*********info neede for login ***********************/
$username='';
$password='';
$loginurl='http://takelogin.php';//数据提交到takelogin.php

/*********info needed for upload**********************/
$uploadurl  = 'http:///takeupload.php';//数据上传到takeupload.php
$referurl='http:///upload.php';//从upload.php点击提交数据到takeupload.php





/*********dir for saving torrent when uploaded suceessfully******************/


$dest_host="http:///";
$dest_passkey="&passkey=ea0fa65d29f3d25657b74e2a3b2b669a";
//config target torrent save directory. path must be ended with '/';
$dl_torrent_dir='/var/www/torrents/';



/*************login *****************************/ 



$login['username']=$username;
$login['password']=$password;

$cookie_jar = tempnam('./cookie','xsyu');
//   dir 	必需。规定创建临时文件的目录。
//  prefix 	必需。规定文件名的开头。

setcookie('c_lang_folder','chs');//name and value
setcookie('c_secure_ssl','');
$ch = curl_init(); 
curl_setopt($ch, CURLOPT_URL, $loginurl); 
curl_setopt($ch, CURLOPT_POST, 1); 
//set post data 
curl_setopt($ch, CURLOPT_POSTFIELDS, $login); 
curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie_jar); 
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
curl_setopt($ch, CURLOPT_HEADER, false); 
curl_setopt($ch, CURLOPT_NOBODY, false); 
curl_exec($ch); 
curl_close($ch);

//get data after login 




/*************upload torrent *****************************/ 



$fields['file'] = '@'.$torrent["filename"];//种子文件的全名和路径（包括.torrent）
$fields['name'] = $torrent["name"];//种子文件的名字（不包括.torrent）

$fields['small_descr'] = $torrent["samll_descr"];//副标题
$fields['url'] = $torrent["imdb"];//imdb链接
//echo $fields['url'];
$fields['nfo'] = $torrent["nfo"];
$fields['descr'] = $torrent["descr"];//description
$fields['type'] = $torrent["type"];//电影或者电视剧等类型
echo "类型表示代码：".$fields['type'];echo "\n";

$fields['medium_sel'] =  $torrent["medium_sel"];
$fields['codec_sel'] =  $torrent["codec_sel"];
$fields['standard_sel'] =  $torrent["standard_sel"];
$fields['audiocodec_sel'] = $torrent["audiocodec_sel"];
$fields['team_sel'] = $torrent["team_sel"];
//$fields['uplver'] = 'yes';

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, $uploadurl );
curl_setopt($ch, CURLOPT_POST, 1 );
curl_setopt($ch, CURLOPT_POSTFIELDS, $fields );
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt ($ch, CURLOPT_REFERER, $referurl);
curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie_jar);
curl_setopt($ch,CURLOPT_FOLLOWLOCATION,1);//get redirect content
curl_setopt($ch, CURLOPT_NOBODY, false);
//curl_exec( $ch );
 $rs = curl_exec($ch);
// 执行给定的cURL会话。这个函数应该在初始化一个cURL会话并且全部的选项都被设置后被调用。
//成功时返回 TRUE， 或者在失败时返回 FALSE。
// 然而，如果 CURLOPT_RETURNTRANSFER选项被设置，函数执行成功时会返回执行的结果，失败时返回 FALSE 。

if ($error = curl_error($ch) ) { //返回错误信息或 '' (空字符串) 如果没有任何错误发生。
          die($error);
}
//unlink($cookie_jar);
$str=sprintf("%s",$rs);
curl_close($ch);
//print_r(htmlspecialchars($rs));


echo "\n";
/*************redownload  torrent *****************************/ 
echo "begin redownload torrent"."\n";
//echo $str."\n";

//$pattern='/userdetails\.php\?id=[0-9]+/';
$pattern='/download\.php\?id=[0-9]+/';
$count = preg_match_all($pattern,$str,$id,PREG_SET_ORDER);
if($count+0<=0)
{
	echo "no download url"."\n";
}

foreach ($id as  $item)
{
	//echo $item[0]."\n";
	$middle=$item[0];
	echo "middle=".$middle."\n";
}
$host=$dest_host;
$tail=$dest_passkey;
$torrent_dir=$dl_torrent_dir;//$dl_torrent_dir='/var/lib/transmission-daemon/watch/';

include_once('curl.download.php');
$torrent_url=$host.$middle.$tail;
echo "torrent url : ".$torrent_url."\n";

/*
include_once("include_file/TransmissionRPC.class.php");
$rpc=new TransmissionRPC();

            $result = $rpc->add($torrent_url,"/var/www/torrents/" );
            // echo "$test_title";echo "<br>";
            if ($result->result == success) {
                echo "向下载器添加种子成功";
                echo "<br/>";
                }

*/

 $needid=substr($middle,16);
$fn=curlTool::downloadFile($torrent_url,$torrent_dir.$needid.".torrent" );
echo "Grab file path =",$fn,"\n";echo "<br>";
//var_dump(CurlTool::$attach_info);
print_r(CurlTool::$attach_info);

return $fn;


}
?>

