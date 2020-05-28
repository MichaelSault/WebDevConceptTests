<?php

    if (isset($_POST['login-submit'])) {
        require 'dbh.php';
        $user = $_POST['uid'];
        $password = $_POST['pwd'];

        if (empty($userORemail)|| empty($password)) {
            header("Location: ../index.php?error=emptyfields");
            exit(); //stops the script if an error 
        }
        else {
            $sql = "SELECT * FROM users WHERE unameUsers=? OR emailUsers=?";
            $stmt = mysqli_stmt_init($conn);

            if (!mysqli_stmt_prepare($stmt, $sql)) {
                header("Location: ../index.php?error=sqlerror");
                exit();
            }
            else {
                mysqli_stmt_bind_param($stmt, "s", $user);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);

                if ($row = mysqli_fetch_assoc($result)) {
                    $passCheck = password_verify($password, $row['passUsers']);
                    if ($passCheck == false) {
                        header("Location: ../index.php?error=wrongpassword");
                        exit();
                    } 
                    else if ($passCheck == true) {
                        session_start();
                        $_SESSION['userID'] = $row['idUsers'];
                        $_SESSION['userName'] = $row['unameUsers'];

                        header("Location: ../signup.php?login=success");
                    }
                }
                else {
                    header("Location: ../index.php?error=usernotfound");
                    exit();
                }
            }
        }

    }
    else {
        header("Location:../index.php?error=notsignedin");
        exit();
    }









    //INSERT INTO users (unameUsers, emailUsers, passUsers)