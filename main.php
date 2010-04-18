<?php
/*
 * Unless otherwise noted, this code is licensed under the MIT license
 * http://changedmy.name/index.php?cat=messages&id=2#code
 */

// set right div content
$r_content = "<b>recent updates</b><br />\n";
$sql = "select * from updates order by date desc";
$q = mysql_query($sql, $conn);
$i = 0;
while(($r = mysql_fetch_array($q)) && $i<10){ // display at most 10 results
   $r_content .= "<div><a href=\"$r[link]\">$r[title]</a></div>\n";
   $i++;
}

// override $content for special cases
if($id==2){ // if loading articles page
   // set main content
   $sql = "show tables";
   $content = "<p>\n";
   $q = mysql_query($sql, $conn);
   while($r = mysql_fetch_array($q)){
      if($r[0]!="main" && $r[0]!="messages" && $r[0]!="updates" && $r[0]!="thoughts" && $r[0]!="toys" && $r[0]!="names"){ // don't include the "other" tables
         $content .= "<a href=\"index.php?cat=$r[0]\">$r[0]</a><br />\n";
      }
   }
   $content .= "</p>\n";
} else if($id==3){ // thoughts page
   // set main content
   $content = "<p>\n";
   $sql = "select * from thoughts order by id desc";
   $q = mysql_query($sql, $conn);
   while($r = mysql_fetch_array($q)){
      $content .= "<a href=\"index.php?cat=thoughts&id=$r[id]\">$r[title]</a><br />\n";
   }
   $content .= "</p>";
} else if($id==6){
   // set main content
   $content = "<p>\n";
   $sql = "select * from toys order by title";
   $q = mysql_query($sql, $conn);
   while($r = mysql_fetch_array($q)){
      $content .= "<a href=\"index.php?cat=toys&id=$r[id]\">$r[title]</a><br />\n";
   }
   $content .= "</p>";
}
?>
