<?php
 //processes the user login form.
include_once 'session.php';
include_once 'db_connect.php';

// Checks if the form was submitted.
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];

    // SQL to find a user with the matching email.
    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($conn, $sql);

    // Checks if one user was found.
    if ($result && mysqli_num_rows($result) == 1) {
        $user = mysqli_fetch_assoc($result);

        // Verifies if the submitted password matches the hashed password in the database.
        if (password_verify($password, $user['password'])) {
            // If correct, store user details in the session to log them in.
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['user_name'] = $user['full_name'];
            $_SESSION['user_role'] = $user['role'];

            // Redirects the user to their correct dashboard based on their role.
            if ($user['role'] == 'admin') { header("location: ../admin/index.php"); }
            elseif ($user['role'] == 'therapist') { header("location: ../therapist/index.php"); }
            else { header("location: ../client/index.php"); }
            exit();
        }
    }
    // If login fails, redirect back to the login page with an error.
    header("location: ../login.php?error=invalid_credentials");
    exit();
}
?>