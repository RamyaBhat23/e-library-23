<?php require_once('../private/initialize.php');
session_start();
$_SESSION["pagetitle"]="home";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo WWW_ROOT.'/styles/home.css'?>">
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
                    <li class="nav-item active menu">
                        <a class="nav-link nav_buttons" href="<?php echo WWW_ROOT.'/logout.php'?>"> Logout </a>
                    </li>
                </ul>
            </div>
        </nav>

        <?php
            $sql1="SELECT * FROM BOOKDATA";
            $result1=mysqli_query($db, $sql1);
            confirm_result_set($result1);
            $count=mysqli_num_rows($result1);
            for($i=0; $i<$count; $i++){
                $book=mysqli_fetch_assoc($result1);
        ?>

        <div class="row container-fluid">
            <div class="col-sm-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title bookname"> <?php echo h($book['bookname']);?> </h5>
                        <br>
                        <br>
                        <form action="<?php echo WWW_ROOT.'/read.php?id='.h(u($book['id']))?>" method="POST"> 
                            <button class="btn btn-primary button1"> Read </button>
                        </form>
                        <form action="<?php echo WWW_ROOT.'/home.php?id='.h(u($book['id']))?>" method="POST">
                            <button class="btn btn-primary button2" style="float:right"><?php echo add($book['id']);?></button>
                            <!--add() executes all the time irrespective of click status-->
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <?php } ?>
    </div>

    <?php
    //function can't be defined within conditional statements
    function add($id)
    {
        global $db;//make it global becz within function. within if statement we can use it without global (if it's outside function)
        if(isset($_GET['id']))
        {
            $id1=$_GET['id'];
            $sql2="UPDATE LIBRARYDATA SET addstatus='1' WHERE id='".db_escape($db, $id1)."'";
            $result2=mysqli_query($db, $sql2);
            confirm_result_set($result2);
        }

        $sql3="SELECT * FROM LIBRARYDATA WHERE id='".db_escape($db, $id)."'";
        $result3=mysqli_query($db, $sql3);
        confirm_result_set($result3);
        $book=mysqli_fetch_assoc($result3);
        if($book['addstatus']=='0')
        {
            return "Add to MyLib";
        }
        else
        {
            return "Added";
        }
    }  
    ?>
</body>   
</script>
</html>
<?php 
    // mysqli_free_result($result1);
    // mysqli_free_result($result2);
    // mysqli_free_result($result3);
?>