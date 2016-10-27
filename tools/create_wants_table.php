<?php

require_once '../scripts/database_connection.php';

$drop_table = "DROP TABLE wants;";
$create_table = "CREATE TABLE wants(" .
					"card_id 	INT				NOT NULL AUTO_INCREMENT PRIMARY KEY, " .
					"name		VARCHAR(50) 	NOT NULL, " .
					"setname	VARCHAR(50)		NOT NULL, " .
					"buylist	DECIMAL(10,2)	" .
				");";

mysql_query($drop_table);
mysql_query($create_table);
?>