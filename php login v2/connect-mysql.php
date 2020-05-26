<?php
    DEFINE ('DB_USER', 'postgres');
    DEFINE ('DB_PSWD', 'selenagomez');
    DEFINE ('DB_HOST', 'localhost');
    DEFINE ('DB_NAME', 'postgres');

    $db_connection = pg_connect(DB_HOST, DB_USER, DB_PSWD, DB_NAME);
?>