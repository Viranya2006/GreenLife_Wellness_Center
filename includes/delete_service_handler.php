<?php
 //  deletes a service and its associated image file.
include_once 'session.php';
include_once 'functions.php';
check_admin();
include_once 'db_connect.php';

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: ../admin/manage_services.php?error=Invalid_ID"); exit();
}
$service_id = $_GET['id'];
// First, get the path of the image file from the database.
$sql_select = "SELECT image_path FROM services WHERE service_id = $service_id";
$result_select = mysqli_query($conn, $sql_select);

if ($row = mysqli_fetch_assoc($result_select)) {
    $image_path = $row['image_path'];
        // Then, delete the service record from the database.
    $sql_delete = "DELETE FROM services WHERE service_id = $service_id";
    if (mysqli_query($conn, $sql_delete)) {
// If the database record is deleted, also delete the actual image file from the server.
        if (file_exists('../' . $image_path)) { unlink('../' . $image_path); }
        header("Location: ../admin/manage_services.php?status=deleted"); exit();
    }
}
header("Location: ../admin/manage_services.php?error=delete_failed");
mysqli_close($conn);
?>