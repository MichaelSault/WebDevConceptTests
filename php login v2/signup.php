<?php
    require "header.php";
?>

<html>
<head>
    <title>PHP SignUp</title>
</head>

<main>
    <h1>Sign Up:</h1>
    <form action = "includes/signup.php" method = "post">
        <input type= "text" name = "userid" placeholder = "Username">
        <input type= "text" name = "email" placeholder = "E-Mail">
        <input type= "password" name = "pass1" placeholder = "Password">
        <input type= "password" name = "pass2" placeholder = "Confirm Password">
        <button type = "submit" name = "signup-submit"> Sign Up </button>
    </form>
</main>


</html>