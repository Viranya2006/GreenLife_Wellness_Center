<?php
// ensures a session is active. It's included on pages that need to remember user info.

// This checks if a session has already been started. If not, it starts one.
// This allows us to use the $_SESSION variable to store login information.
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>