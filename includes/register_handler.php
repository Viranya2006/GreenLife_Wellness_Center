<?php
 //handles new client registrations.
include_once 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Gets the data from the registration form.
    $full_name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];
    $password_confirm = $_POST['password_confirm'];

    // Server-side validation.
    if (empty($full_name) || empty($email) || empty($password) || ($password !== $password_confirm)) {
        // Using header() is better than die() for user experience.
        header("location: ../register.php?error=empty_fields");
        exit();
    }

    //Check if the email already exists in the database.
    $sql_check = "SELECT user_id FROM users WHERE email = '$email'";
    $result_check = mysqli_query($conn, $sql_check);

    if (mysqli_num_rows($result_check) > 0) {
        // If a user with this email already exists, redirect back with an error message.
        header("location: ../register.php?error=email_exists");
        exit();
    }
    // If the email is unique, proceed with creating the new user.
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    
    $sql_insert = "INSERT INTO users (full_name, email, password, role) VALUES ('$full_name', '$email', '$hashed_password', 'client')";
    
    if (mysqli_query($conn, $sql_insert)) {
        // If registration is successful, redirect to the login page.
        header("location: ../login.php?status=reg_success");
        exit();
    } else {
        // Handle other database errors.
        header("location: ../register.php?error=db_error");
        exit();
    }
}
mysqli_close($conn);
?>
