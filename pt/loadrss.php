
<?php include_once("include_file/connectData.php")  ?>




<?php
include "include_file/html2ubb.php";

/**
 * @param $in_str
 * @return mixed
 */
function fixEncoding($in_str)
{

    $cur_encoding = mb_detect_encoding($in_str) ;

    /** @var TYPE_NAME $cur_encoding */
    if($cur_encoding == "UTF-8" && mb_check_encoding($in_str,"UTF-8"))

        return $in_str;

    else

        return utf8_encode($in_str);

} // fixEncoding


function replace_str($str)//replace char;
{
    $str1=str_replace("'","",$str);
    return  $str1;
}

 //下载信息存入mydate数据库
function check_rss($value)
{
    if (!is_numeric($value))
    {
        $value =  "''".mysql_real_escape_string($value)."''";
    }
    return $value;
}



function loadRss()
{


 $str4="http://pt.xsyu.edu.cn/torrentrss.php?rows=10&cat401=1&linktype=dl&passkey=ea0fa65d29f3d25657b74e2a3b2b669a";
        $doc = new DOMDocument();
        $doc->load($str4);
        $items = $doc->getElementsByTagName("item");

        $num=0;
        foreach ($items as $item) {
            $num++;
            $title = "";
            $link = "";
            $description = "";
            $category = $category_domain = "";
            $comments = "";
            $enclosure_length = $enclosure = $enclosure_type = $enclosure_url = "";

            $guid = $guid_isPermaLink = "";
            $pubDate = "";
            $isFinish = "false";$isTransfer="false";$isForbid="false";$isUpload="false";

            $titles = $item->getElementsByTagName("title");
            if ($titles->length != 0) {
                $title = $titles->item(0)->nodeValue;
               // echo "$title";echo "</br>";
            }

            $links = $item->getElementsByTagName("link");
            if ($links->length != 0) {
                $link = $links->item(0)->nodeValue;
                //  echo "<a href='$link' target='_blank'>".$link."</a></br>";

            }

            $descriptions = $item->getElementsByTagName("description");
            if ($descriptions->length != 0) {
                $description = $descriptions->item(0)->nodeValue;
                $description = replace_str($description);
               // $description = fixEncoding($description);

              //  {$description="error";}

               // echo fixEncoding($description);
                //echo "<div>".$description."</div></br>";
            }

            $authors = $item->getElementsByTagName("author");
            if ($authors->length != 0) {
                $author = $authors->item(0)->nodeValue;
                // echo  "<p>".$author."</p></br>";
            }

            $commentss = $item->getElementsByTagName("comments");
            if ($commentss->length != 0) {
                $comments = $commentss->item(0)->nodeValue;
                //echo  "<p>".$comments."</p></br>";
            }


            $guids = $item->getElementsByTagName("guid");
            if ($guids->length != 0) {
                $guid = $guids->item(0)->nodeValue;
                //  echo  "<p>".$guid."</p></br>";
                $guid_isPermaLink= $guids->item(0)->getAttribute('isPermaLink');
            }


            $pubDates = $item->getElementsByTagName("pubDate");
            if ($pubDates->length != 0) {
                $pubDate = $pubDates->item(0)->nodeValue;
                // echo  "<p>".$pubDate."</p></br>";
            }


            $categorys = $item->getElementsByTagName("category");
            if ($categorys->length != 0)
            {
                $category = $categorys->item(0)->nodeValue;
               // echo "<p>" . $category . "</p>";
               // $category="电影";
              //  if($category != "电影" && $category != "电视" && $category != "电视剧" && $category != "纪录片" && $category != "动漫" && $category != "综艺" && $category != "MV " && $category != "体育 " && $category != "音轨 " && $category != "高清电影 " )
               // {
                 //   echo "error";
               //     $category="其他";
               // }
               // else $category = $categorys->item(0)->nodeValue;

                $category_domain = $categorys->item(0)->getAttribute('domain');
                // echo "<p>".$category_domain."</p></br>";

            }
            
            $enclosures = $item->getElementsByTagName("enclosure");

            if ($enclosures->length != 0) {
                $enclosure = $enclosures->item(0)->nodeValue;
                // $rss_str.="<p>".$enclosure."</p>";
                $enclosure_url = $enclosures->item(0)->getAttribute('url');

                // echo "<a href='$enclosure_url' target='_blank'>".$enclosure_url."</a></br>";
                $enclosure_length = $enclosures->item(0)->getAttribute('length');

                //echo "<p>".$enclosure_length."</p></br>";

                $enclosure_type = $enclosures->item(0)->getAttribute('type');
                if($enclosure_type != "application/x-bittorrent")
                {
                   
                    $enclosure_length ="";
                    $enclosure_url ="";
                    $enclosure_type="";
                }

                // echo "<p>".$enclosure_type."</p></br>";
            }



           // $title=check_rss($title);
          //  $link=check_rss($link);

            $description=html2ubb($description);
          //  $description=check_rss($description);

          //  $author=check_rss($author);
          //  $category=check_rss($category);
         //   $category_domain=check_rss($category_domain);
         //   $comments=check_rss($comments);
          //  $enclosure_url=check_rss($enclosure_url);
          //  $enclosure_length=check_rss($enclosure_length);
         //   $enclosure_type=check_rss($enclosure_type);
         //   $guid=check_rss($guid);
         //   $guid_isPermaLink=check_rss($guid_isPermaLink);
          //  $pubDate=check_rss($pubDate);

            
            //echo "<hr/>";
           // mysql_query("SET NAMES utf8");
            if (!mysql_query("INSERT ignore INTO table1 (title, link, description,author,category,category_domain,comments,enclosure_url,enclosure_length,enclosure_type,guid,guid_isPermaLink,pubDate,isFinish,isTransfer,isForbid,isUpload)
        VALUES ('$title', '$link', '$description',' $author','$category','$category_domain','$comments','$enclosure_url','$enclosure_length','$enclosure_type','$guid','$guid_isPermaLink', '$pubDate','$isFinish','$isTransfer','$isForbid','$isUpload')"))
            {
                echo " insert fails";
                echo "\n";
                die(mysql_error());
            }
            else
            {
                echo "insert date OK".$num;
                echo "\n";
            }


        }



sleep(6);
    include_once("startload.php");
startLoad();
}


?>



