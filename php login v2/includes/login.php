<?php

    if (isset($_POST['login-submit'])) {
        require 'dbh.php';
        $userORemail = $_POST['uid'];
        $password = $_POST['pwd'];

        if (empty($userORemail)|| empty($password)) {
            header("Location: ../signup.php?error=emptyfields");
            exit(); //stops the script if an error 
        }
        else {
            $sql = "SELECT * FROM users WHERE unameUsers=? OR emailUsers=?";
            $stmt = mysqli_stmt_init($conn);

            if (!mysqli_stmt_prepare($stmt, $sql)) {
                header("Location: ../signup.php?error=sqlerror");
                exit();
            }
            else {
                exit(); //will do something later, ran out of time for tonight...
            }
        }

    }
    else {
        header("Location:../index.php?error=notsignedin");
        exit();
    }









    //INSERT INTO users (unameUsers, emailUsers, passUsers)