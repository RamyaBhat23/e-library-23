<?php
require_once('db_credentials.php');

function u($string=""){
    return urlencode($string);
}

// function raw_u($string=""){
//     return rawurlencode($string);
// }

function h($string=""){
    return htmlspecialchars($string);
}

function error_404(){
    header($_SERVER["SERVER_PROTOCOL"] . "404 not found");
    exit();
}

function error_500(){
    header($_SERVER["SERVER_PROTOCOL"] . "500 internal server error");
    exit();
}

function redirect($location){
    echo("<script>location.href ='$location';</script>");
    exit;
}

function isPostRequest(){
    return $_SERVER['REQUEST_METHOD']=='POST';
}

function isgetRequest(){
    return $_SERVER['REQUEST_METHOD']=='GET';
}

function db_connect()
{
    $connection = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME, '3308');
    confirm_db_connection();
    return $connection;
}

function db_disconnect($connection)
{
    if(isset($connection))
    {
        mysqli_close($connection);
    }
}

function confirm_db_connection()
{
    if(mysqli_connect_errno())
    {
        $msg="db connection failed: ";
        $msg .= mysqli_connect_error();
        $msg .="(".mysqli_connect_errno().")";
        exit($msg);
    }
}

function confirm_result_set($result_set)
{
    if(!$result_set)
    {
        exit("DB query failed");
    }
}

function db_escape($connection,$string)
{
    return mysqli_real_escape_string($connection, $string);
}    

?>