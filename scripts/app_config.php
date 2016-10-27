<?php

// Database Connection Information.
define("DATABASE_HOST", "localhost");
define("DATABASE_USERNAME", "root");
define("DATABASE_PASSWORD", "");
define("DATABASE_NAME", "test_binder");

// Server Information.
define("SITE_ROOT", "proxy-generator/");

// Debugging Switch.
define("DEBUG_MODE", true);

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