<?php

require_once '../scripts/database_connection.php';

$drop_table = "DROP TABLE cards;";
$create_table = "CREATE TABLE cards(" .
					"card_id 	INT				NOT NULL AUTO_INCREMENT PRIMARY KEY, " .
					"name		VARCHAR(50) 	NOT NULL, " .
					"setname	VARCHAR(50)		NOT NULL  " .
				");";

mysql_query($drop_table);
mysql_query($create_table);
?>