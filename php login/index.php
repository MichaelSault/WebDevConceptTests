<!DOCTYPE HTML>

<?php
    if (isset($_POST['submitted'])){
        $db_connection = pg_connect("host=localhost dbname=postgres user=postgres password=selenagomez");

        $user = $_POST['user'];
        $pass = $_POST['pass'];

        $sqlinsert = "INSERT INTO usertable (username, password) VALUES ('$user', '$pass')";

        if (!pg_query($db_connection, $sqlinsert)) {
            die('error creating new user');
        }
        $newrecord = "1 record added to database";
    }
?>

<html>
<head>
    <title>PHP Login</title>
</head>

<body>


<h1> Create A User: </h1>

<form method = "post" action = "index.php">
<input type = "hidden" name = "submitted" value = "true"/>
<fieldset>
    <legend><b>Sign Up:</b></legend>
    <label>Username: <input type = "text" name = "user"/> </label>
    <label>Password: <input type = "text" name = "pass"/> </label>
</fieldset>
<br>
<input type = "submit" value = "Submit"/>
</form>

<?php
    echo $newrecord;
?>

</body>
</html>