<?php
    if(isset($_POST['signup-submit'])) { //check if the user got here via sign up button

        require 'dbh.php';

        $username = $_POST['userid'];
        $email = $_POST['email'];
        $password1 = $_POST['pass1'];
        $password2 = $_POST['pass2'];

        if (empty($username) || empty($email) || empty($password1) || empty($password2)) {
            header("Location: ../signup.php?error=emptyfields&userid=".$username."&email=".$email); //sends back the username and email in case of missing field error
            exit(); //stops the script if an error 
        }
        else if ((!filter_var($email, FILTER_VALIDATE_EMAIL))&&(!preg_match("/^[a-zA-Z0-9]*$/", $username))) {
            header("Location: ../signup.php?error=invalidusernameandemail");
            exit();
        }
        else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            header("Location: ../signup.php?error=invalidemail&userid=".$username); //sends back the username in case of invalid email
            exit();
        }
        else if (!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
            header("Location: ../signup.php?error=invalidusername&email=".$email); //sends back the email in case of invalid username
            exit();
        }
        else if ($password1 !== $password2) {
            header("Location: ../signup.php?error=passwordcheck&userid=".$username."&email=".$email); //sends back both if passwords don't match
            exit();
        }
        
        else {
            $sql = "SELECT unameUsers FROM users WHERE unameUsers=?"; //we will pass the uservar later to prevent sql injection vulnerabilities
            $stmt = mysqli_stmt_init($conn);

            if(!mysqli_stmt_prepare($stmt, $sql)) {
                header("Location: ../signup.php?error=sqlerror");
                exit();
            }
            else {
                mysqli_stmt_bind_param($stmt, "s", $username); //fills the placeholder after execution
                mysqli_stmt_execute($stmt);
                mysqli_stmt_store_result($stmt);
                $resultCheck = mysqli_stmt_num_rows($stmt); //will return the number of results in the db matching the query (matching the username)

                if ($resultCheck > 0) {
                    header("Location: ../signup.php?error=usertaken&email=".$email);
                    exit();
                }
                else {
                    $sql = "INSERT INTO users (unameUsers, emailUsers, passUsers) VALUES (?, ?, ?)"; //placeholders again to fight sql injection
                    $stmt = mysqli_stmt_init($conn);

                    if(!mysqli_stmt_prepare($stmt, $sql)) {
                        header("Location: ../signup.php?error=sqlerror");
                        exit();
                    }
                    else {

                        $hashedPassword = password_hash($password1, PASSWORD_DEFAULT);


                        mysqli_stmt_bind_param($stmt, "sss", $username, $email, $hashedPassword); //fills the placeholders after execution
                        mysqli_stmt_execute($stmt);

                        header("Location: ../signup.php?signup=success");
                        exit();
                    }
                }
            }
        }
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
    }

    else {
        header("Location: ../signup.php");

    }
?>