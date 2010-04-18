<?php
/*
 * Unless otherwise noted, this code is licensed under the MIT license
 * http://changedmy.name/index.php?cat=messages&id=2#code
 */

// set defaults
$content = "";
// number of parts in a name (john doe has 2)
$parts = (isset($_GET[parts])) ? $_GET[parts] : 2;
// number of names to display
$names = (isset($_GET[names])) ? $_GET[names] : 10;
// number of elements in the database of names
$sql = "select count(*) from names";
$q = mysql_query($sql, $conn);
$r = mysql_fetch_array($q);
$count = $r[0];

// make an array same size as number of names we'll need to fetch
// and fill it with random numbers in the range corresponding to the names in the db
for($i=0; $i<$parts*$names; $i++){
    $random[i] = rand(1, $count);
}

$count = 0;
foreach($random as $key){
    if(($count % $parts) == 0){
        $content .= "<br />\n";
    }

    $sql = "select name from names where id=$key";
    $q = mysql_query($sql, $conn);
    $r = mysql_fetch_array($q);
    $content .= $r[0] . " ";
    $count++;
}
?>
