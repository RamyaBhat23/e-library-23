<?php require_once('../private/initialize.php');
session_start();?>

<?php
$username=$_POST['myusername'];
$password=$_POST['mypassword'];
$sql1="SELECT * FROM USERDATA WHERE username='$username'";//wrong password case
$result1=mysqli_query($db, $sql1);
confirm_result_set($result1);
$count1=mysqli_num_rows($result1);

$sql2="SELECT * FROM USERDATA WHERE username='$username' AND password='$password'";
$result2=mysqli_query($db, $sql2);
confirm_result_set($result2);
$count2=mysqli_num_rows($result2);
if($count1==0)//username doesn't exists
{
    redirect(WWW_ROOT.'/signup.php');
}
else//username exists
{
    if($count2==0)//wrong password, right username
    {
        redirect(WWW_ROOT.'/login.php');
    }
    else//both right
    {
        $_SESSION['username']=$username;
        redirect(WWW_ROOT.'/home.php');
    }
}
?>

<?php mysqli_free_result($result1);
mysqli_free_result($result2); ?>