<?php
// handles a new appointment request from a client.
include_once 'session.php';
include_once 'db_connect.php';

if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'client' || $_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: ../login.php"); exit();
}
// Get all the data from the booking form.
$client_id = $_SESSION['user_id'];
$service_id = mysqli_real_escape_string($conn, $_POST['service_id']);
$therapist_id = mysqli_real_escape_string($conn, $_POST['therapist_id']);
$appointment_date = mysqli_real_escape_string($conn, $_POST['appointment_date']);
$appointment_time = mysqli_real_escape_string($conn, $_POST['appointment_time']);

if (empty($service_id) || empty($therapist_id) || empty($appointment_date) || empty($appointment_time)) {
    header("Location: ../client/book_appointment.php?error=empty_fields"); exit();
}
// SQL to insert the new appointment into the database with a 'pending' status.
$sql = "INSERT INTO appointments (client_id, service_id, therapist_id, appointment_date, appointment_time, status) VALUES ('$client_id', '$service_id', '$therapist_id', '$appointment_date', '$appointment_time', 'pending')";

if (mysqli_query($conn, $sql)) {
    header("Location: ../client/book_appointment.php?status=success");
} else {
    echo "Error: " . mysqli_error($conn);
}
mysqli_close($conn);
?>
