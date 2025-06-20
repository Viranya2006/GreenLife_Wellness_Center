<?php
 // updates an appointment's status (e.g., to 'confirmed' or 'cancelled').
include_once 'session.php';
include_once 'db_connect.php';

// Security check allows both therapists and admins to use this script.
if (!isset($_SESSION['user_id']) || !in_array($_SESSION['user_role'], ['therapist', 'admin'])) {
    header("Location: ../login.php"); exit();
}

if (!isset($_GET['id']) || !is_numeric($_GET['id']) || !isset($_GET['status'])) {
    $redirect_page = ($_SESSION['user_role'] == 'admin') ? '../admin/manage_appointments.php' : '../therapist/manage_appointments.php';
    header("Location: " . $redirect_page . "?error=invalid_request"); exit();
}

// Gets the appointment ID and the new status from the URL link.
$appointment_id = $_GET['id'];
$new_status = mysqli_real_escape_string($conn, $_GET['status']);
$user_id = $_SESSION['user_id'];
$user_role = $_SESSION['user_role'];
$redirect_page = ($user_role == 'admin') ? '../admin/manage_appointments.php' : '../therapist/manage_appointments.php';

$allowed_statuses = ['confirmed', 'cancelled'];
if (!in_array($new_status, $allowed_statuses)) {
    header("Location: " . $redirect_page . "?error=invalid_status"); exit();
}

// SQL to update the status. It's different for an admin versus a therapist.
$sql = "";
if ($user_role == 'admin') {
    // Admins can update any appointment.
    $sql = "UPDATE appointments SET status = '$new_status' WHERE appointment_id = $appointment_id";
} elseif ($user_role == 'therapist') {
    // Therapists can only update appointments assigned to them (an extra security check).
    $sql = "UPDATE appointments SET status = '$new_status' WHERE appointment_id = $appointment_id AND therapist_id = $user_id";
}

// Executes the correct SQL query.
if (!empty($sql)) {
    if (mysqli_query($conn, $sql)) {
        header("Location: " . $redirect_page . "?status=updated");
    } else {
        header("Location: " . $redirect_page . "?error=db_error");
    }
}
mysqli_close($conn);
?>