<?php
    session_start();
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset = "utf-8">
        <meta name = "description" content = "This is the description that will show up in search results.">
        <meta name =  viewpoint content = "width = device-width, inital-scale = 1">
        <title></title>
        <!--<link rel = "stylesheet" href="style.css>-->
    </head>
    <body>
        <header>
            <nav>
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="#">Portfolio</a></li>
                    <li><a href="#">About</a></li>
                    <li><a href="#">Contact</a></li>
                </ul>

                <div>
                    <?php
                        if (isset($_SESSION['userID'])) { //changes page content if you are logged in
                            echo '<form action = "includes/logout.php" method="post">
                            <button type = "submit" name = "logout-submit"> Logout </button>
                            </form>';  
                        }   

                        else {
                            echo '<form action = "includes/login.php" method="post"> <!--use post method for sensitive data, get method is less secure-->
                                <input type = "text" name = "uid" placeholder = "Username">
                                <input type = "password" name = "pwd" placeholder = "Password">
                                <button type = "submit" name = "login-submit"> Login </button>
                            </form>
                            <a href = "signup.php">SignUp</a>';
                    } 
                    ?>
                    
                    
                </div>
            </nav>
        </header>