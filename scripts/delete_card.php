<?php

require_once 'database_connection.php';
$card_id = 0;

// Get card ID of the card to delete.
$card_id = $_REQUEST['card_id'];

// Build the DELETE statement.
$delete_query = sprintf("DELETE FROM cards WHERE card_id = %d", $card_id);

// Run the DELETE statement.
mysql_query($delete_query);

// Redirect back to manage.php, which confirms deletion.
header("Location: ../manage.php");
exit();
?>