<?php
 //adds a new therapist to the database.
include_once 'session.php';
include_once 'functions.php';
check_admin();// Only admins can access this script.
include_once 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Gets the details from the admin's form.
    $full_name = mysqli_real_escape_string($conn, $_POST['full_name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];

    if (empty($full_name) || empty($email) || empty($password)) {
        header("Location: ../admin/manage_therapists.php?error=empty"); exit();
    }
    // Hashes the password for security.
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Sets the role for the new user as 'therapist'.
    $role = 'therapist';

        // SQL to insert the new therapist into the users table.
    $sql = "INSERT INTO users (full_name, email, password, role) VALUES ('$full_name', '$email', '$hashed_password', '$role')";
    
    if (mysqli_query($conn, $sql)) {
        header("Location: ../admin/manage_therapists.php?status=therapist_added");
    } else {
        // Redirects with an error, for example if the email already exists.
        header("Location: ../admin/manage_therapists.php?error=" . urlencode(mysqli_error($conn)));
    }
}
mysqli_close($conn);
?>