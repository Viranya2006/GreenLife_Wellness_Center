<?php
// This script handles the user logout process.

include_once 'includes/session.php';

// Clear all session variables.
$_SESSION = array();

// Destroy the session completely.
session_destroy();

// Redirect the user back to the homepage.
header("location: index.html");
exit();
?>