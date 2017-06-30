<?php

/*
   Sidepress  
   Scriptol.com
   GPL 2.0 Licence.  

   Sidepress is a publisher of news as a plugin for Wordpress.
   It displays the summary of last articles of the blog into a frame on a static page.

   Copyright 2008 Denis Sureau  (email : webmaster@scriptol.net)

   This program is free software; you can redistribute it and/or modify
   it under the terms of the GNU General Public License as published by
   the Free Software Foundation; either version 2 of the License, or
   (at your option) any later version.

   This program is distributed in the hope that it will be useful,
   but WITHOUT ANY WARRANTY; without even the implied warranty of
   MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
   GNU General Public License for more details.

   You should have received a copy of the GNU General Public License
   along with this program; if not, write to the Free Software
   Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/


include("path.php");

$SIDEPRESS_SIZE = 15;
$SIDEPRESS_TITLE = false;
$SIDEPRESS_DATE = false;
$SIDEPRESS_DESC = true;
$SIDEPRESS_DESCSIZE = 250;


function loadIni()
{
  global $SIDEPRESS_SIZE;
  global $SIDEPRESS_TITLE;
  global $SIDEPRESS_DATE;
  global $SIDEPRESS_DESC;
  global $SIDEPRESS_DESCSIZE;
  global $SIDEPRESS_PATH;
    
  $x = file("$SIDEPRESS_PATH/sidepress.ini");

  foreach($x as $y)
  {
     $i = strpos($y, "=");
     if($i == 0) continue;
     $key = trim(substr($y, 0, $i));
     $value = intval(trim(substr($y, $i + 1)));
     switch($key)
     {
      case "SIDEPRESS_SIZE": $SIDEPRESS_SIZE = $value; break;
      case "SIDEPRESS_TITLE": $SIDEPRESS_TITLE = $value; break;
      case "SIDEPRESS_DATE": $SIDEPRESS_DATE = $value; break;
      case "SIDEPRESS_DESC": $SIDEPRESS_DESC = $value; break;
      case "SIDEPRESS_DESCSIZE": $SIDEPRESS_DESCSIZE = $value; break;
     }
  }

}



// convert the format to UTF-8  
function makeUTF($desc)
{  
  $desc = UTF8_encode($desc);
  $desc = stripslashes($desc);
  return($desc);
}  

$extList=array(".jpg",".gif",".png");
function isImage($url)
{
   $ext=Path::getExtension($url);
   global $extList;
   return in_array($ext,$extList);
}

function buildDesc($description)
{
    global $SIDEPRESS_DESCSIZE;

    $x = strpos(strtolower($description), "<!--more-->");
    if ($x == false || $x < 4)
    { 
      if($x !== false) $x += 11;
        
      $x = strlen($description) -1;
    }  

    $description = preg_replace('@<script[^>]*?>.*?</script>@si', '', $description);  
    $description = preg_replace('@<![\s\S]*?--[ \t\n\r]*>@', '', $description);  
    $description = strip_tags($description);

    if($SIDEPRESS_DESCSIZE < 50) $SIDEPRESS_DESCSIZE = 50;
    if($x > $SIDEPRESS_DESCSIZE) $x = $SIDEPRESS_DESCSIZE;
    
    if($description[$x] != ".")
    {
      $y = $SIDEPRESS_DESCSIZE / 2;
      while(
        ($x > $y) && 
        (ord($description[$x]) != 32) && 
        ($description[$x] != ".")
      ) $x--;
    }   
    
    $description = trim(substr($description, 0, $x)) . "...";

    return (makeUTF($description ));
}


  // Configuration

  loadIni();
  

  $args=$_SERVER;
  if($args == false)
  {
    $args=$HTTP_SERVER_VARS;
  }
  $root=$args["DOCUMENT_ROOT"];
  
  include_once("$root/wp-config.php");
  
  // Connection

  $connection=mysql_connect(DB_HOST,DB_USER,DB_PASSWORD);
  if (!$connection) die('Connect error: '.mysql_error());

  $res =  mysql_select_db(DB_NAME,$connection);
  if(!$res) 
    echo DB_USER," not available<br>";
  
  // Optional title

  if($SIDEPRESS_TITLE)
  {
	 $summary .= '<h2><a href="http://www.scriptol.com"> My Web Site</a></h2>'."<br>\n";
	 $summary .= '<p>Sidepress</p>'."<br>\n<br>\n";
  }

  // Building summary

  $command="SELECT guid, post_title, post_modified, post_content FROM ".$wpdb->posts." WHERE (post_type = 'post') ORDER BY post_date DESC LIMIT $SIDEPRESS_SIZE";

  $items  = mysql_query($command, $connection);
  if(!$items) die("Select error: ".mysql_error()); 

  while($article = mysql_fetch_assoc($items))
  {
    $title = makeUTF($article["post_title"]);
    $url = $article["guid"];
    if(isImage($url)) continue;
 
    $summary .= "<h3><a href='$url'>$title</a>";
    if($SIDEPRESS_DATE)
    { 
      $summary .= "<span class='sidedate'>".$article["post_modified"]."</span><br>\n";
    } 
    $summary .=  "</h3>\n";
    if($SIDEPRESS_DESC)
    { 
        $description = $article["post_content"];
        $description = buildDesc($description);
        $summary .= "<p>$description </p>\n";
    }    
  }

  mysql_close($connection);

  echo $summary;
 

?> 
