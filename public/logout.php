<?php require_once('../private/initialize.php');
session_start();?>

<?php
$_SESSION['username']="";
redirect(WWW_ROOT.'/login.php');
session_destroy();?>