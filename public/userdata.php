<?php require_once('../private/initialize.php');
session_start();?>

<?php
    $username=$_POST["myusername"];//name attribute
    $email=$_POST["myemail"];
    $password=$_POST["mypassword"];
    $sql1="SELECT * FROM USERDATA WHERE username='$username' OR email='$email'";
    $result1=mysqli_query($db, $sql1);
    confirm_result_set($result1);
    $count=mysqli_num_rows($result1);
    if($count==0)
    {
        $sql2="INSERT INTO USERDATA VALUES ('$username', '$email', '$password')";//use ''
        $result2=mysqli_query($db, $sql2);
        confirm_result_set($result2);
        $_SESSION['username']=$username;
        redirect(WWW_ROOT.'/home.php');
    }
    else
    {
        redirect(WWW_ROOT.'/login.php');
    }
?>

<?php //mysqli_free_result($result1);
//mysqli_free_result($result2);?>