<?php
//saves a therapist's reply to an inquiry.
include_once 'session.php';
include_once 'db_connect.php';

// Security check allows therapists to reply.
if (!isset($_SESSION['user_id']) || !in_array($_SESSION['user_role'], ['therapist', 'admin'])) {
    header("Location: ../login.php"); exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!isset($_POST['inquiry_id']) || !is_numeric($_POST['inquiry_id']) || empty($_POST['reply_message'])) {
        header("Location: ../therapist/inquiries.php?error=missing_data"); exit();
    }

    $inquiry_id = $_POST['inquiry_id'];
    $reply_message = mysqli_real_escape_string($conn, $_POST['reply_message']);
    $new_status = 'closed';// When a reply is sent, the inquiry is marked as closed.

    // SQL to update the inquiry with the reply text and new status.
    $sql = "UPDATE inquiries SET therapist_reply = '$reply_message', status = '$new_status' WHERE inquiry_id = $inquiry_id";
    if (mysqli_query($conn, $sql)) {
        header("Location: ../therapist/inquiries.php?status=replied");
    } else {
        header("Location: ../therapist/inquiries.php?error=db_error");
    }
}
mysqli_close($conn);
?>