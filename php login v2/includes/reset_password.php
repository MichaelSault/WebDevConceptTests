<?php

    if (isset($_POST["reset-password-submit"])) {

        $selector = $_POST["selector"];
        $validator = $_POST["validator"];
        $password = $_POST["password"];
        $repeatPassword = $_POST["repeatPassword"];

        if(empty($password) || empty($repeatPassword)) {
            header("Location: ../create-new-password.php?newpassword=empty&selector=" . $selector . "&validator=" . $validator);
            exit();
        } else if ($password != $repeatPassword) {
            header("Location: ../create-new-password.php?newpassword=dontmatch&selector=" . $selector . "&validator=" . $validator);
            exit();
        }

        $currentDate = date("U");

        require 'dbh.php';

        $sql = "SELECT * FROM pwdreset WHERE passResetSelector = ? AND passResetExpires >= ?";
        $stmt = mysqli_stmt_init($conn);

        if(!mysqli_stmt_prepare($stmt, $sql)){
            echo "An error occured!";
            exit();
        }
        else {
            mysqli_stmt_bind_param($stmt, 'ss', $selector, $currentDate);
            mysqli_stmt_execute($stmt);

            $result = mysqli_stmt_get_result($stmt);
            if (!$row = mysqli_fetch_assoc()) { //grabs the data and puts it into an accoiative array, targetable with col names from the db
                echo "You will need to resubmit your reset request.";
                exit();
            } else {
                $tokenBin = hex2bin($validator);
                $tokenCheck = password_verify($tokenBin, $row["passResetToken"]);

                if ($tokenCheck === false) {
                    echo "You will need to resubmit your reset request.";
                    exit();
                } else if ($tokenCheck === true) {
                    $tokenEmail = $row["passResetEmail"];

                    $sql = "SELECT * FROM users WHERE emailUsers=?;";

                    $stmt = mysqli_stmt_init($conn);

                    if(!mysqli_stmt_prepare($stmt, $sql)){ //can't connect to db
                        echo "An error occured!";
                        exit();
                    } else {
                        mysqli_stmt_bind_param($stmt, "s", $tokenEmail);
                        mysqli_stmt_execute($stmt);
                        $result = mysqli_stmt_get_result($stmt);
                        if (!$row = mysqli_fetch_assoc()) { //grabs the data and puts it into an accoiative array, targetable with col names from the db
                            echo "An error occured!";
                            exit();
                        } else {
                            $sql = "UPDATE users SET passUsers=? WHERE emailUsers=?";
                            $stmt = mysqli_stmt_init($conn);

                            if(!mysqli_stmt_prepare($stmt, $sql)){ //can't connect to db
                                echo "An error occured!";
                                exit();
                            } else {
                                $newPassHash = password_hash($password, PASSWORD_DEFAULT); //always hash the password

                                mysqli_stmt_bind_param($stmt, "ss", $newPassHash, $tokenEmail);
                                mysqli_stmt_execute($stmt);

                                $sql = "DELETE FROM pwdReset WHERE passResetEmail = ?";
                                $stmt = mysqli_stmt_init($conn);

                                if(!mysqli_stmt_prepare($stmt, $sql)){ //can't connect to db
                                    echo "An error occured!";
                                    exit();
                                } else {
                                    mysqli_stmt_bind_param($stmt, "s" $tokenEmail);
                                    mysqli_stmt_execute($stmt);
                                    header("Location: ../signup.php?newpass=passwordupdated");
                                }

                            }
                        }
                    }
                }
            }
        }


    } else {
        header("Location: ../index.php");
    }


?>