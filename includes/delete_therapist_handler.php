<?php
 // deletes a therapist from the database.
include_once 'session.php';
include_once 'functions.php';
check_admin();// Only admins can run this script.
include_once 'db_connect.php';

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: ../admin/manage_therapists.php?error=Invalid_ID"); exit();
}
// Gets the ID of the therapist to delete from the URL.
$user_id = $_GET['id'];

// SQL to delete the user who has the matching ID AND the role of 'therapist'.
$sql = "DELETE FROM users WHERE user_id = $user_id AND role = 'therapist'";

if (mysqli_query($conn, $sql)) {
    // Redirects back to the management page with a success message.
    if (mysqli_affected_rows($conn) > 0) {
        header("Location: ../admin/manage_therapists.php?status=deleted");
    } else {
        // Redirects with an error message if the deletion fails.
        header("Location: ../admin/manage_therapists.php?error=not_found");
    }
} else {
    header("Location: ../admin/manage_therapists.php?error=delete_failed");
}
mysqli_close($conn);
?>