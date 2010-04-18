<?php
//session.use_trans_sid = 1
//session.use_cookies = 0
//session.use_only_cookies = 0

session_start();

session_id($_GET['PHPSESSID']);

if(isset($_REQUEST["SETSTYLE"])){
  $_SESSION["STYLE"]=$_REQUEST["SETSTYLE"];
  //echo($_SESSION["STYLE"]);
}
// RETURN TO CALLER PAGE
if(ereg('PHPSESSID',$_SERVER["HTTP_REFERER"])){
   header("Location: ".$_SERVER["HTTP_REFERER"]);
}
elseif(ereg('\?',$_SERVER["HTTP_REFERER"])){
   header("Location: ".$_SERVER["HTTP_REFERER"]."&PHPSESSID=".$_GET['PHPSESSID']);
}
else{
   header("Location: ".$_SERVER["HTTP_REFERER"]."?PHPSESSID=".$_GET['PHPSESSID']);
}
?>
