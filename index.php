<?php
    session_start();

    if (!isset($_SESSION['username'])) {
        $_SESSION['message'] = 'You must logged in first';
        header('location: login.php');
    }
    if (isset($_GET['logout'])) {
        unset($_SESSION['username']); //Remove all session variable
        session_destroy(); //Destroy the session
        header('location: login.php');
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
</head>
<body>
    <header>
        <h2 class="text-center">Home Page</h2>
    </header>
    <div class="container">
        <!-- notification message -->
        <?php if (isset($_SESSION['logged_in'])) : ?>
            <div class="alert alert-success" >
                <?php 
                    echo $_SESSION['logged_in']; 
                    unset($_SESSION['logged_in']);
                ?>
            </div>
        <?php endif ?>

        <!-- logged in user information -->
        <?php  if (isset($_SESSION['username'])) : ?>
            <p>Welcome <strong><?php echo $_SESSION['username']; ?></strong></p>
            <p> <a href="index.php?logout='1'" style="color: red;">logout</a> </p>
        <?php endif ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>
</html>