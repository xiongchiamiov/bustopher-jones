<?php
/*
 * Unless otherwise noted, this code is licensed under the MIT license
 * http://changedmy.name/index.php?cat=messages&id=2#code
 */

require 'header.php';

// set defaults
$cat = ($_GET['cat']) ? $_GET['cat'] : "main"; // if not cat given, defaults to main
$id = ($_GET['id']) ? $_GET['id'] : 1; // defaults to id of 1
$r_content = "";

// get the main stuff
$sql = "select * from $cat where id=$id";
$q = mysql_query($sql, $conn);
$r = mysql_fetch_array($q);
if(!$r) { // if query didn't fetch anything
   $sql = "select * from messages where id=1"; // fetch the error page
   $q = mysql_query($sql, $conn);
   $r = mysql_fetch_array($q);
}

$content = $r['content'];
$title = $r['title'] . " @ changedmy.name";

if($cat == "main"){
   // split this off for filesize reasons
   // in here we'll put the recent updates into the sidebar
   // and also override $content for the "special" pages (articles, thoughts, toys)
   require 'main.php';
} else if($cat!="messages" && $cat!="thoughts" && $cat!="toys"){ // don't list updates in the sidebar on error pages
                                                                  // and the thoughts and toys don't have overarching titles
   $firsttime = true;
   // get stuff for right div
   $sql = "select * from $cat";
   $q = mysql_query($sql, $conn);
   while($r = mysql_fetch_array($q)){
      // since some of the titles are of form "series title - section title"
      // we're splitting them up
      $split = split(" - ", $r[title]);
      // at the top we always want the series title
      // so we print it out once
      if($firsttime){
         $r_content .= "<b>$split[0]</b><br>\n";
         $firsttime = false;
      }
      // and then we always print out the section titles
      $r_content .= "<a href=\"index.php?cat=$cat&id=$r[id]\">$split[1]</a><br />\n";
   }

   if($cat == "toys"){
      require 'toys.php';
   }
} else if($cat=="thoughts" || $cat=="toys"){
   $i = 0;
   // get stuff for right div
   $sql = "select * from $cat order by id desc";
   $q = mysql_query($sql, $conn);
   while(($r = mysql_fetch_array($q)) && $i<10){
      $r_content .= "<a href=\"index.php?cat=$cat&id=$r[id]\">$r[title]</a><br />\n";
      $i++;
   }
}

// get the template
$page = file_get_contents('template.html');
// then replace placeholders with content
$page = str_replace('{title}', $title, $page);
$page = str_replace('{r_content}', $r_content, $page);
$page = str_replace('{footer}', $footer, $page);
$page = str_replace('{content}', $content, $page);

echo $page;
?>
