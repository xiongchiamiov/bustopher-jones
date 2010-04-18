<?php
require 'header.php';

// set defaults
$cat = ($_GET['cat']) ? $_GET['cat'] : "main";
$id = ($_GET['id']) ? $_GET['id'] : 1;
$r_content = "";
$firsttime = true;

// get the main stuff
$sql = "select * from $cat where id=$id";
$q = mysql_query($sql, $conn);
$row = mysql_fetch_array($q);
if(!$row) { // if query didn't fetch anything
   $sql = "select * from messages where id=1"; // fetch the error page
   $q = mysql_query($sql, $conn);
   $row = mysql_fetch_array($q);
}

if($cat != "messages"){
   // get stuff for right div
   $sql = "select * from $cat";
   $q = mysql_query($sql, $conn);
   while($r = mysql_fetch_array($q)){
       $split = split(" - ", $r[title]);
       if($firsttime){
         $r_content .= "<b>$split[0]</b><br>\n";
         $firsttime = false;
       }
       $r_content .= "<a href=\"article.php?cat=$cat&id=$r[id]\">$split[1]</a><br>\n";
   }
}

// get the template
$page = file_get_contents('template.html');
// then replace placeholders with content
$page = str_replace('{title}', $row['title'], $page);
$page = str_replace('{r_content}',$r_content, $page);
$page = str_replace('{footer}', $footer, $page);
$page = str_replace('{content}', $row['content'], $page);

echo $page;
?>
