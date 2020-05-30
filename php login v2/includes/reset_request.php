<?php

    if (isset($_POST["request-submit"])) {

        $selector = bin2hex(random_bytes(8));
        $token = random_bytes(32);

        $url = "http://localhost/php%20login%20v2/forgottenpass.php/create-new-password.php?selector=" . $selector . "&validator=" . bin2hex($token);

        $expires = date("U") + 1800; //the current datetime + 1 hour

        //next step is to add the selector and token into the database

    } else {
        header("Location: ../index.php");
    }


?>