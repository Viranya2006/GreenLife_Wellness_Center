<?php
include_once 'session.php';
include_once 'functions.php';
check_admin();
include_once 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $service_id = mysqli_real_escape_string($conn, $_POST['service_id']);
    $service_name = mysqli_real_escape_string($conn, $_POST['service_name']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);

    if (empty($service_id) || empty($service_name) || empty($description)) {
        header("Location: ../admin/manage_services.php?error=fields_required"); exit();
    }

    if (isset($_FILES['service_image']) && $_FILES['service_image']['error'] == 0) {
        // New image was uploaded, so we handle the upload and update the path in the DB.
        $sql_old_img = "SELECT image_path FROM services WHERE service_id = $service_id";
        $result_old_img = mysqli_query($conn, $sql_old_img);
        if ($row = mysqli_fetch_assoc($result_old_img)) {
            if (file_exists('../' . $row['image_path'])) { unlink('../' . $row['image_path']); }
        }

        $target_dir = "../images/";
        $unique_file_name = uniqid('service-') . '.' . pathinfo($_FILES["service_image"]["name"], PATHINFO_EXTENSION);
        $target_file = $target_dir . $unique_file_name;
        move_uploaded_file($_FILES["service_image"]["tmp_name"], $target_file);
        $db_image_path = "images/" . $unique_file_name;

        $sql = "UPDATE services SET service_name = '$service_name', description = '$description', image_path = '$db_image_path' WHERE service_id = $service_id";
    } else {
        // No new image, just update the text fields.
        $sql = "UPDATE services SET service_name = '$service_name', description = '$description' WHERE service_id = $service_id";
    }

    if (mysqli_query($conn, $sql)) {
        header("Location: ../admin/manage_services.php?status=updated");
    } else {
        header("Location: ../admin/manage_services.php?error=update_failed");
    }
    exit();
}
mysqli_close($conn);
?>