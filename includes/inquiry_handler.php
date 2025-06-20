<?php
//  handles inquiries sent by logged-in clients.
include_once 'session.php';
include_once 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Gets the user's ID from their session.
    $user_id = $_SESSION['user_id'];
    $subject = mysqli_real_escape_string($conn, $_POST['subject']);
    $message = mysqli_real_escape_string($conn, $_POST['message']);

    if (empty($subject) || empty($message)) {
        header("Location: ../client/send_inquiry.php?error=empty_fields"); exit();
    }
// Gets the client's name and email from the database to save with the inquiry.
    $sql_user = "SELECT full_name, email FROM users WHERE user_id = $user_id";
    $result_user = mysqli_query($conn, $sql_user);
    $user = mysqli_fetch_assoc($result_user);

    if ($user) {
        $client_name = mysqli_real_escape_string($conn, $user['full_name']);
        $client_email = mysqli_real_escape_string($conn, $user['email']);
        
        // SQL to insert the inquiry into the database.
        $sql_insert = "INSERT INTO inquiries (client_name, client_email, subject, message, status) VALUES ('$client_name', '$client_email', '$subject', '$message', 'open')";
        
        if (mysqli_query($conn, $sql_insert)) {
            header("Location: ../client/send_inquiry.php?status=success");
        } else {
            header("Location: ../client/send_inquiry.php?error=db_error");
        }
    } else {
        header("Location: ../client/send_inquiry.php?error=user_not_found");
    }
}
mysqli_close($conn);
?>