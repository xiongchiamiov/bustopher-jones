<?php
/*
 * make 10 a variable
 * save said variable through session
 */

require 'header.php';

$rs = @mysql_select_db("personal", $conn);
$sql = 'SELECT *  FROM `articles` ORDER BY id';
$rs = mysql_query($sql, $conn);
if (!rs) {  //check the result of mysql_query()
    die("SQL Error! ".mysql_error());
    }
?>

<?php
   for($i=0; $i; $i++){

      }
   while("$rs"!=0){}
?>
