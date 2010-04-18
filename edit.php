<?php
/*
 * Unless otherwise noted, this code is licensed under the MIT license
 * http://changedmy.name/index.php?cat=messages&id=2#code
 */

require 'header.php';

if(!isset($_COOKIE['venice'])) { // if not logged-in
   (isset($_GET[id]))
   ? header("Location: login.php?r=edit.php?id=$_GET[id]")
   : header("Location: login.php?r=edit.php");
}

$cat = ($_GET[cat]) ? $_GET[cat] : "main";

$self = $_SERVER['PHP_SELF'] . "?cat=$cat&id=$_GET[id]";
$title = $_POST['title'];
$content = $_POST['content'];
//$newpagepost = $_POST['newpage'];
//$id = $_POST['id'];
$id = $_GET[id];

if($title and $content){
   if($_POST['newpage']){
      $sql = "insert into $cat (title, content) values (\"$title\", \"$content\")";
   } else {
      $sql = "update $cat set content=\"$content\", title=\"$title\" where id=$_GET[id]";
   }
   $q = mysql_query($sql, $conn);
   if($_POST['newpage']){
      $date = date("Y-m-d");
      $sql = "select * from $cat order by id desc";
      $q = mysql_query($sql, $conn);
      $row = mysql_fetch_array($q);
      $id = $row[id];
      $sql = "insert into updates (date, title, link) values (\"$date\", \"$title\", \"index.php?cat=$cat&id=$id\")";
      // *** trim down to x num of entries
      $q = mysql_query($sql, $conn);
   }
   //if($q){ echo ("Record added: $title <br> $date <br> $content");}
}

$newpage = false;

if(isset($_GET[id])){
   $sql = "select * from $cat where id=$id";
   $q = mysql_query($sql, $conn);
   $row = mysql_fetch_array($q);
} else { // if no page is selected
   $newpage = true; // we'll create a new one
}
if(!$row) { // if query didn't fetch anything
   $newpage = true; // we make a new page
}

$pagecontent = "<a href=\"admin.php?cat=$cat\">back to admin page</a><br><br>";
$pagecontent .= <<<HTML
<form action="{action}" method="post">
<input type="hidden" name="newpage" value="{newpage}">
<input type="hidden" name="id" value="{id}">
Title: <input type="text" name="title" size="30" value="{title}"><br>
Content: <br><textarea name="content" cols="70" rows="15">{content}</textarea><br>
<input type="submit" value="Submit">
</form>
HTML;


$pagecontent = str_replace('{action}', $self, $pagecontent);
$pagecontent = str_replace('{newpage}', $newpage, $pagecontent);
$pagecontent = str_replace('{id}', $_GET['id'], $pagecontent);
if($newpage){
   $pagecontent = str_replace('{content}', '', $pagecontent);
   $pagecontent = str_replace('{title}', '', $pagecontent);
} else {
   $pagecontent = str_replace('{content}', $row['content'], $pagecontent);
   $pagecontent = str_replace('{title}', $row['title'], $pagecontent);
}

// get the template
$page = file_get_contents('template.html');
// then replace placeholders with content
$page = str_replace('{title}', "edit pages", $page);
$page = str_replace('{r_content}',"", $page);
$page = str_replace('{footer}', $footer, $page);
$page = str_replace('{content}', $pagecontent, $page);

echo $page;


?>
