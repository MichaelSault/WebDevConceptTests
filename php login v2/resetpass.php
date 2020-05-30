<?php
    require "header.php";
?>

<html>
<head>
    <title>PHP SignUp</title>
</head>

<main>
    <h1>Password Reset:</h1>
    <p> You will receive an email where you can reset your password.</p>

    <form action = "includes/reset_request.php" method = "post">
        <input type= "text" name = "email" placeholder = "Recovery E-Mail">
        <button type = "submit" name = "request-submit"> Request recovery email </button>
    </form>


    <a href = "resetpass.php">Forgot your password?</a>
</main>


</html>