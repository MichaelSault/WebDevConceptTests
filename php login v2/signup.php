<?php
    require "header.php";
?>

<html>
<head>
    <title>Sign Up</title>
</head>

<main>
    <h1>Sign Up:</h1>

    <?php
        if (isset($_GET['error'])) {
            if ($_GET['error'] == "emptyfields") {
                echo '<p>Please fill in all fields!</p>';
            } else if ($_GET['error'] == "invalidusernameandemail") {
                echo '<p>Invalid username and email!</p>';
            } else if ($_GET['error'] == "invalidemail") {
                echo '<p>Invalid email!</p>';
            } else if ($_GET['error'] == "invalidusername") {
                echo '<p>Invalid username!</p>';
            } else if ($_GET['error'] == "passwordcheck") {
                echo '<p>Passwords do not match!</p>';
            } else if ($_GET['error'] == "usertaken") {
                echo '<p>Username not available!</p>';
            } 
        } else if (isset($_GET['signup'])){
            if ($_GET["signup"] == "success"){
                echo '<p>Signup successful!</p>';
            }
            else echo '<p>Error loging in, please try again!</p>'; //just incase something unexpected happens
        }
    ?>

    <form action = "includes/signup.php" method = "post">
        <input type= "text" name = "userid" placeholder = "Username">
        <input type= "text" name = "email" placeholder = "E-Mail">
        <input type= "password" name = "pass1" placeholder = "Password">
        <input type= "password" name = "pass2" placeholder = "Confirm Password">
        <button type = "submit" name = "signup-submit"> Sign Up </button>
    </form>


    <?php
        if(isset($_GET["newpass"])) {
            if ($_GET["newpass"] == "passwordupdated") {
                echo '<p>Your password has been updated!<p>';
            }
        }
    ?>

    <a href = "resetpass.php">Forgot your password?</a>
</main>


</html>