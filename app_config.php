<?php
/*
// Database Connection Information.
*/
// Server Information.
define("SITE_ROOT", "proxies/");

// Debugging Switch.
define("DEBUG_MODE", true);

require_once("gath_definitions.php");

// Error Reporting.
if (DEBUG_MODE) {
	error_reporting(E_ALL); }
else {
	error_reporting(0); }

function handle_error($user_error_message, $system_error_message) {
	session_start();
	$_SESSION['error_message'] = $user_error_message;
	$_SESSION['system_error_message'] = $system_error_message;
	header("Location: " . get_web_path(SITE_ROOT) . "scripts/show_error.php");
}
	
?>