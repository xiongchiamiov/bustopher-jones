<?php
/*
 * Unless otherwise noted, this code is licensed under the MIT license
 * http://changedmy.name/index.php?cat=messages&id=2#code
 */

require 'header.php';

if(!isset($_COOKIE['venice'])) { // if not logged-in
    header("Location: login.php?r=admin.php");
}

$content = "<p><a href=\"logout.php\">log out</a><br>\n";

if($_GET['cat']){
    $content .= "<a href=\"edit.php?cat=$_GET[cat]\">new page</a><br />\n";
    $content .= "<a href=\"admin.php\">back to main</a><br /><br />\n";
    $sql = "select * from $_GET[cat]";
    $q = mysql_query($sql, $conn);
    while($row = mysql_fetch_array($q)){
        $content .= "<a href=\"edit.php?cat=$_GET[cat]&id=$row[id]\">$row[title]</a>&nbsp;&nbsp;";
        $content .= "<a href=\"index.php?cat=$_GET[cat]&id=$row[id]\" target=\"_blank\"><small>[view]</small></a><br />\n";
    }
} else {
    $content .= "<br />\n";
    $sql = "show tables";
    $q = mysql_query($sql, $conn);
    while($row = mysql_fetch_array($q)){
        $content .= "<a href=\"admin.php?cat=$row[0]\">$row[0]</a><br />\n";
    }
}

$content .= "</p>";

// get stuff for right div
$r_content = "";
if($_GET[cat]){
    $sql = "show tables";
    $q = mysql_query($sql, $conn);
    while($row = mysql_fetch_array($q)){
        $r_content .= "<a href=\"admin.php?cat=$row[0]\">$row[0]</a><br />\n";
    }
}

// get the template
$page = file_get_contents('template.html');
// then replace placeholders with content
$page = str_replace('{title}', 'admin', $page);
$page = str_replace('{r_content}',$r_content, $page);
$page = str_replace('{footer}', $footer, $page);
$page = str_replace('{content}', $content, $page);

echo $page;
?>
