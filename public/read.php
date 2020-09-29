<?php require_once('../private/initialize.php');
session_start();//cookies should be allowed
$pagetitle=$_SESSION["pagetitle"];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo WWW_ROOT.'/styles/read.css'?>">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    <title>e-Library</title>
</head>

<?php
if($_SESSION['username']==""){
        redirect(WWW_ROOT.'/login.php');
}
else {
?>

<body>
    <div class="flex">
        <nav class="navbar navbar-expand-lg navbar-dark menubar">
            <header class="navbar-brand appname" href="#"> e-Library </header>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active menu">
                        <a class="nav-link nav_buttons" style="padding-left: 20px;" href="<?php echo WWW_ROOT.'/home.php'?>"> Home </a>
                    </li>
                    <li class="nav-item active menu">
                        <a class="nav-link nav_buttons" href="<?php echo WWW_ROOT.'/mylib.php'?>"> MyLib </a>
                    </li>
                </ul>
            </div>
        </nav>

        <?php
            $id=$_GET['id'];//form tag is needed in previous page to do this
            $sql="SELECT * FROM BOOKDATA WHERE id='".db_escape($db, $id)."'";
            $result=mysqli_query($db, $sql);
            confirm_result_set($result);
            $book=mysqli_fetch_assoc($result);
        ?>

        <div id="viewerbox" class="flex1" style="overflow: hidden;">
            <div id="closediv">
                <?php
                if($pagetitle=="home") {
                ?>
                    <a href="<?php echo WWW_ROOT.'/home.php'?>"><button class="closebutton">X</button></a>
                <?php }
                else if($pagetitle=="mylib") {?>
                    <a href="<?php echo WWW_ROOT.'/mylib.php'?>"><button class="closebutton">X</button></a>
                <?php } ?>
            </div>
            <iframe src="<?php echo WWW_ROOT.$book['url']?>" id="viewer" class="text_center" style="overflow: hidden;
                                                            width: 100%;
                                                            height: 95%;
                                                            z-index: 1;">
            </iframe>
        </div>
    </div>
</body>
</html>
<?php //mysqli_free_result($result);
} ?>