<?php require_once('../private/initialize.php'); ?>

<?php
$id=$_GET['id'];
$sql="UPDATE LIBRARYDATA SET addstatus='0' WHERE id='".db_escape($db, $id)."'";
mysqli_query($db, $sql);
redirect(WWW_ROOT.'/mylib.php');
?>