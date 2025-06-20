<?php
 // holds shared PHP functions that can be used across the project.

 // This function checks if the current user is an administrator.
// It's used at the top of every page in the /admin/ folder to protect it.
function check_admin() {
    // Make sure a session has been started.
    if (session_status() == PHP_SESSION_NONE) { session_start(); }
    // If the user is not logged in OR their role is not 'admin', they are redirected away.
    if (!isset($_SESSION['user_id']) || !isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'admin') {
        header("Location: /GreenLife%20Wellness%20Center/login.php");
        exit();// Stops the rest of the page from loading.
    }
}
?>