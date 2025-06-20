<?php
include_once 'session.php';
include_once 'db_connect.php';

if (!isset($_SESSION['user_id'])) { header("Location: ../login.php"); exit(); }

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_SESSION['user_id'];
    $full_name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $new_password = $_POST['new_password'];

    $sql_details = "UPDATE users SET full_name = '$full_name', email = '$email' WHERE user_id = $user_id";
    mysqli_query($conn, $sql_details);
    $_SESSION['user_name'] = $_POST['name'];

    if (!empty($new_password)) {
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
        $sql_pass = "UPDATE users SET password = '$hashed_password' WHERE user_id = $user_id";
        mysqli_query($conn, $sql_pass);
    }

    header("Location: ../client/my_profile.php?status=updated");
    exit();
}
mysqli_close($conn);
?>
