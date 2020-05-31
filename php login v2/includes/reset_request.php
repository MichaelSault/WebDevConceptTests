<?php

    if (isset($_POST["request-submit"])) {

        $selector = bin2hex(random_bytes(8));
        $token = random_bytes(32);

        $url = "http://localhost/php%20login%20v2/create-new-password.php?selector=" . $selector . "&validator=" . bin2hex($token);

        $expires = date("U") + 1800; //the current datetime + 1 hour

        require 'dbh.php';
        $userEmail = $_POST["email"];

        $sql = "DELETE FROM pwdReset WHERE passResetEmail=?;";
        $stmt = mysqli_stmt_init($conn);

        if(!mysqli_stmt_prepare($stmt, $sql)){
            echo "An error occured!";
            exit();
        }
        else {
            mysqli_stmt_bind_param($stmt, 's', $userEmail);
            mysqli_stmt_execute($stmt);
        }

        $sql = "INSERT INTO pwdReset (passResetEmail, passResetSelector, passResetToken, passResetExpires) VALUES (?,?,?,?);";
        $stmt = mysqli_stmt_init($conn);

        if(!mysqli_stmt_prepare($stmt, $sql)){
            echo "An error occured!";
            exit();
        }
        else {
            $hashedToken = password_hash($token, PASSWORD_DEFAULT);
            mysqli_stmt_bind_param($stmt, 'ssss', $userEmail, $selector, $hashedToken, $expires);
            mysqli_stmt_execute($stmt);
        }

        mysqli_stmt_close($stmt);
        mysqli_close($conn);


        //now to send the recovery email
        $sendTo = $userEmail;
        $subject = 'Reset your password for pirate clicker';
        $message = '<p> We received a password request.  Click the link below to reset your password.  If you did not make this request, please ignore this email.</p>
        <p> Here is your password reset link: </br>
        <a href = "'. $url . '">' . $url . '</a></p>';

        $headers = "From: Michael <thealmightyhope@gmail.com>\r\n";
        $headers .= "Reply-To: thealmightyhope@gmail.com\r\n"
        $headers .= "Content-type: text/html\r\n";

        mail($to, $subject, $message, $headers);

        header("Location: ../resetpass.php?reset=success");

    } else {
        header("Location: ../index.php");
    }


?>