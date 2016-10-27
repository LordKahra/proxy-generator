<?php

require_once 'database_connection.php';

$add_records = 	"INSERT INTO cards " .
					"(name, setname, buylist) " .
				"VALUES " .
					"('Demigod of Revenge', 'Shadowmoor', '0')," .
					"('Huntmaster of the Fells', 'Dark Ascension', '18.00');";
mysql_query($add_records);

?>