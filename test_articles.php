<?php
/*
 * make 10 a variable
 * save said variable through session
 * maybe use wordwrap() for text-trimming
 */

require 'header.php';

$rs = @mysql_select_db("personal", $conn);
$sql = "SELECT *  FROM `articles` ORDER BY id";
$rs = mysql_query($sql, $conn);
if (!rs) {  //check the result of mysql_query()
    die("SQL Error! ".mysql_error());
    }
?>

<?php
//check to see if we're on a page of results already
if(ereg("page=", $_SERVER['PHP_SELF'])){
   //strip out the page number we're on
   $start = strpos($_SERVER['PHP_SELF'],'page=') + 5; //+5 to account for page=
   $end = strpos($_SERVER['PHP_SELF'], '&');
   $page = substr($_SERVER['PHP_SELF'], $start, $end-$start);
}
else{
   $page = 1;
}

//display title and blurb of 10 results
for($i=(10*$page)-10; ($i<(10*$page)) and $row=mysql_fetch_array(mysql_query("SELECT *  FROM `articles` WHERE id>$i ORDER BY id",$conn)); $i++){
   echo($row["title"] . "<br>");
   echo(substr($row["text"],0,500) . "<br><br>"); //first 500 chars of text
}

if(!($i%4)){ //*** THIS NEEDS TO GO BACK TO 10
   $j = $page + 1;
   echo $j;

   $i = 1;
   $sql = "SELECT * FROM `articles` WHERE id=$i";
   echo($sql);
   $rs = mysql_query($sql,$conn);
   echo("$rs");
   for($i=10; "$rs"!=0; $i+=10 and $j++){
      echo("444444");
      if($j==$page){
         echo $j; //so we can see which page we're on, this one's not linked
      }
      else{
         echo "53545";
      }
   }
}
?>
