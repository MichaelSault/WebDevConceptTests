<!DOCTYPE HTML>
<html>
<head>
    <title>PHP Login</title>
</head>

<body>

<?php
    $db_connection = pg_connect("host=localhost dbname=postgres user=postgres password=selenagomez");
    $result = pg_query($db_connection, "SELECT * FROM Users");
?>

</body>
</html>