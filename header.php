<?php
/*
 * Unless otherwise noted, this code is licensed under the MIT license
 * http://changedmy.name/index.php?cat=messages&id=2#code
 */

ob_start("ob_gzhandler");
session_start();

/*
$styleSheets = array();

// DEFINE STYLESHEETS
$styleSheets[0]["sheet"]='<link href="test1.css" rel="stylesheet" type="text/css" />';
$styleSheets[1]["sheet"]='<link href="test2.css" rel="stylesheet" type="text/css" />';

// DEFAULT STYLESHEET
$defaultStyleSheet=0;

// SET STYLESHEET
 if(isset($_SESSION["STYLE"])){
  echo $styleSheets[$_SESSION["STYLE"]]["sheet"];
 }else{
  echo $styleSheets[$defaultStyleSheet]["sheet"];
 }
*/

// DB connection
$server = "tilde.db";
$user = "day2day";
$password = "JsxGsY4Axw5WQG8T";

$conn = mysql_connect($server, $user, $password)
  or die("dead!");
  //echo("alive!");
$db = @mysql_select_db("personal", $conn);

// set footer text
if(date("Y")=="2008"){
   $date = 2008;
} else {
   $date = "2008-" . date("Y");
}
$footer = "all text licensed $date".' by James Pearson under a <a href="http://creativecommons.org/licenses/by-nc/3.0/us/">Creative Commons by-nc 3.0</a> license,<br />';
$footer .= "all code licensed $date".' James Pearson under the <a href="http://www.opensource.org/licenses/mit-license.php">MIT License</a>,<br />';
$footer .= "and all images copyright $date Michael Cooper, except where otherwise noted."
?>
