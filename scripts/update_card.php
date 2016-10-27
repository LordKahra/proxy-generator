<?php

require_once 'database_connection.php';

$card_id = 0;

$name = trim($_REQUEST['name']);
$setname = trim($_REQUEST['setname']);
$card_id = trim($_REQUEST['card_id']);

$update_sql = sprintf("UPDATE cards " .
    "SET name='%s', setname='%s' " .
    "WHERE card_id='%d';",
    mysql_real_escape_string($name),
    mysql_real_escape_string($setname),
    mysql_real_escape_string($card_id));

mysql_query($update_sql);

// Redirect.
header("Location: ../manage.php");
?>