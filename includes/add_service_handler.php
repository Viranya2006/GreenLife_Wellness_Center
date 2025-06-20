<?php
 // adds a new service with an image to the database.
include_once 'session.php';
include_once 'functions.php';
check_admin();
include_once 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $service_name = mysqli_real_escape_string($conn, $_POST['service_name']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);

    if (empty($service_name) || empty($description) || !isset($_FILES['service_image']) || $_FILES['service_image']['error'] != 0) {
        header("Location: ../admin/manage_services.php?error=fields_required"); exit();
    }

    // This section handles the image upload.
    $target_dir = "../images/";
    $file_extension = pathinfo($_FILES["service_image"]["name"], PATHINFO_EXTENSION);
    // Creates a unique name for the file to prevent overwriting existing files.
    $unique_file_name = uniqid('service-') . '.' . $file_extension;
    $target_file = $target_dir . $unique_file_name;
    
    // Moves the uploaded file from a temporary location to our /images/ folder.
    if (move_uploaded_file($_FILES["service_image"]["tmp_name"], $target_file)) {
        // The path that will be stored in the database.
        $db_image_path = "images/" . $unique_file_name;
        // SQL to insert the new service details into the database.
        $sql = "INSERT INTO services (service_name, description, image_path) VALUES ('$service_name', '$description', '$db_image_path')";
        
        if (mysqli_query($conn, $sql)) {
            header("Location: ../admin/manage_services.php?status=success");
        } else {
            header("Location: ../admin/manage_services.php?error=db_error");
        }
    } else {
        header("Location: ../admin/manage_services.php?error=upload_failed");
    }
}
mysqli_close($conn);
?>