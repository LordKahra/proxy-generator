<?php

require_once 'database_connection.php';

$name = trim($_REQUEST['name']);
$setname = trim($_REQUEST['setname']);

$insert_sql = sprintf("INSERT INTO cards " .
    "(name, setname) " .
    "VALUES ('%s', '%s');",
    mysql_real_escape_string($name),
    mysql_real_escape_string($setname));

mysql_query($insert_sql);

// Redirect.
header("Location: ../manage.php");
?>