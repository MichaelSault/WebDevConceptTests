<?php
    require "header.php";
?>

<html>
<head>
    <title>PHP Login</title>
</head>

<main>
    <?php
        if (isset($_SESSION['userID'])) { //changes page content if you are logged in
            echo '<p>You are logged in!</p>';
        } 
        else {
            echo '<p>You are logged out!</p>';
        }
    ?>
    </main>


</html>