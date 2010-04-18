<?php
require 'header.php';

$cat = "html";

$date = date("Y-m-d");
$sql = "select * from $cat order by id desc";
$q = mysql_query($sql, $conn);
$row = mysql_fetch_array($q);
$id = $row[id];
$sql = "insert into updates (date, title, link) values (\"$date\", \"$title\", \"index.php?cat=$cat&id=$id\")";
// *** trim down to x num of entries
echo $sql;
$q = mysql_query($sql, $conn);
?>
