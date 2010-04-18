<?php
/*
 * Unless otherwise noted, this code is licensed under the MIT license
 * http://changedmy.name/index.php?cat=messages&id=2#code
 */

require 'header.php';

$pagecontent = "";
if($_POST['check']) { // if there's a username/pass combo we need to check
    if($_POST['pass']=='Fr33as1nsp1t' && $_POST['username']=='alpaca') { // if inputted pass matches one in db
        setcookie(venice);
        if($_GET[r]) {
            header("Location: $_GET[r]");
        } else {
            header("Location: index.php");
        }
    } else {
        $pagecontent .= "incorrect username/password combination\n";
    }
}

$self = $_SERVER['PHP_SELF'];
if($_GET[r]){
    $self .= "?r=$_GET[r]";
}
$username = $_POST['username'];
$pass = $_POST['pass'];

$pagecontent .= <<<HTML
<p>
<form action="{action}" method="post">
<input type="hidden" name="check" value="true">
username: <input type="text" name="username" size="30" value="{username}"><br>
password: <input type="password" name="pass" size="30" value="{pass}"><br>
<input type="submit" value="Submit">
</form>
</p>
HTML;

$pagecontent = str_replace('{action}', $self, $pagecontent);
$pagecontent = str_replace('{username}', $username, $pagecontent);
$pagecontent = str_replace('{pass}', $pass, $pagecontent);

// get the template
$page = file_get_contents('template.html');
// then replace placeholders with content
$page = str_replace('{title}', "log in", $page);
$page = str_replace('{r_content}',"", $page);
$page = str_replace('{footer}', $footer, $page);
$page = str_replace('{content}', $pagecontent, $page);

echo $page;
?>
