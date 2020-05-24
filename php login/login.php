<!DOCTYPE HTML>

<?php
    if (isset($_POST['submitted'])){
        $db_connection = pg_connect("host=localhost dbname=postgres user=postgres password=selenagomez");

        $user = $_POST['user'];
        $pass = $_POST['pass'];

        $sqlquery = "SELECT username FROM usertable WHERE username = '$user' AND password = '$pass'";
        $result = pg_query($sqlquery);

        if (!pg_query($db_connection, $sqlquery)) {
            die('error loging in');
        }

        $result = pg_query($db_connection, $sqlquery);
        $result_array = pg_fetch_assoc($result);

        if ($result_array == null){
            $newrecord = "login failed";
        } else $newrecord = "login successful";
    }
?>

<html>
<head>
    <title>PHP Login</title>
</head>

<body>


<h1> Login: </h1>

<form method = "post" action = "index.php">
<input type = "hidden" name = "submitted" value = "true"/>
<fieldset>
    <legend><b>Login:</b></legend>
    <label>Username: <input type = "text" name = "user"/> </label>
    <label>Password: <input type = "text" name = "pass"/> </label>
</fieldset>
<br>
<input type = "submit" value = "Submit"/>
</form>

<?php
    print_r($result_array);
    echo $newrecord;
?>

</body>
</html>