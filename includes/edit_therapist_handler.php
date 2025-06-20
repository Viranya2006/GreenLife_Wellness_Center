<?php
//  updates a therapist's details in the database.
include_once 'session.php';
include_once 'functions.php';
check_admin();// Only admins can run this script.
include_once 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Gets the therapist's ID and new details from the form.
    $user_id = mysqli_real_escape_string($conn, $_POST['user_id']);
    $full_name = mysqli_real_escape_string($conn, $_POST['full_name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $new_password = $_POST['password'];

    if (empty($user_id) || empty($full_name) || empty($email)) {
        header("Location: ../admin/manage_therapists.php?error=fields_required"); exit();
    }

    // SQL to update the therapist's name and email.
    $sql_details = "UPDATE users SET full_name = '$full_name', email = '$email' WHERE user_id = $user_id AND role = 'therapist'";
    mysqli_query($conn, $sql_details);

    if (!empty($new_password)) {
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
        $sql_pass = "UPDATE users SET password = '$hashed_password' WHERE user_id = $user_id AND role = 'therapist'";
        mysqli_query($conn, $sql_pass);
    }

// Redirect back to the management page with a success message.
    header("Location: ../admin/manage_therapists.php?status=updated");
    exit();
}
mysqli_close($conn);
?>