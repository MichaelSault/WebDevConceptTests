<?php
    require "header.php";
?>

<html>
<head>
    <title>Create New Password</title>
</head>

<main>
    <?php
        $selector = $_GET["selector"];
        $validator = $_GET["validator"];

        if(empty($selector)||empty($validator)) {
            echo "Could not validate request.";
        }
        else {
            if (ctype_xdigit($selector) !== false && ctype_xdigit($validator) !== false) {
                ?>

                <form action = "includes/reset-password.php" method = "post">
                    <input type = "hidden" name = "selector" value = "<?php echo $selector; ?>">
                    <input type = "hidden" name = "validator" value = "<?php echo $validator; ?>">
                    <input type = "password" name = "password" value = "Enter a new password...">
                    <input type = "password" name = "repeatPassword" value = "Repeat the new password">
                    <button type = "submit" name = "reset-password-submit">Reset Password</button>
                </form>
                <?php
            }
        }
    ?>


    </main>


</html>