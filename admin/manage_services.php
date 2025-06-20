<?php
//allows the admin to add and delete services.
    include_once '../includes/session.php';
    include_once '../includes/functions.php';
    check_admin();
    include_once '../includes/db_connect.php';

    // SQL to fetch all services to display in the table.
    $sql = "SELECT service_id, service_name, description, image_path FROM services ORDER BY service_name";
    $result = mysqli_query($conn, $sql);

    include '../header.php';
?>
<title>Manage Services - Admin</title>
<main>
    <section class="page-header"><div class="container"><h1>Manage Wellness Services</h1></div></section>
    <section class="content-section">
        <div class="container dashboard-grid">
            <aside class="dashboard-nav">
                <h3>Admin Menu</h3>
                <ul>
                    <li><a href="index.php">System Overview</a></li>
                    <li><a href="manage_appointments.php">Manage Appointments</a></li>
                    <li><a href="manage_clients.php">Manage Clients</a></li>
                    <li><a href="manage_therapists.php">Manage Therapists</a></li>
                    <li><a href="manage_services.php" class="active">Manage Services</a></li>
                    <li><a href="manage_inquiries.php">Manage Inquiries</a></li>
                    <li><a href="../logout.php">Logout</a></li>
                </ul>
            </aside>
            <div class="dashboard-content">
                <div class="form-container-small" style="margin-bottom: 40px;">
                    <h2>Add New Service</h2>
                    <?php 
                        if (isset($_GET['status']) && $_GET['status'] == 'success') { echo '<p class="form-message success">Service added successfully!</p>'; }
                        if (isset($_GET['status']) && $_GET['status'] == 'deleted') { echo '<p class="form-message success">Service deleted successfully!</p>'; }
                        if (isset($_GET['status']) && $_GET['status'] == 'updated') { echo '<p class="form-message success">Service updated successfully!</p>'; }
                        if (isset($_GET['error'])) { echo '<p class="form-message error">'.htmlspecialchars($_GET['error']).'</p>'; } 
                    ?>
                    <form id="addServiceForm" action="../includes/add_service_handler.php" method="POST" enctype="multipart/form-data">
                        <div class="form-group"><label for="service-name">Service Name</label><input type="text" id="service-name" name="service_name" required></div>
                        <div class="form-group"><label for="service-desc">Description</label><textarea id="service-desc" name="description" rows="4" required></textarea></div>
                        <div class="form-group"><label for="service-image">Service Image</label><input type="file" id="service-image" name="service_image" required></div>
                        <button type="submit" class="btn-primary btn-full-width">Add Service</button>
                    </form>
                </div>
                <!-- Table to display all existing services. -->
                <h2>All Services</h2>
                <div class="table-container">
                    <table>
                        <thead><tr><th>ID</th><th>Image</th><th>Service Name</th><th>Description</th><th>Actions</th></tr></thead>
                        <tbody>
                            <?php if (mysqli_num_rows($result) > 0): ?>
                                <?php while($row = mysqli_fetch_assoc($result)): ?>
                                <tr>
                                    <td><?php echo $row['service_id']; ?></td>
                                    <td><img src="../<?php echo htmlspecialchars($row['image_path']); ?>" alt="<?php echo htmlspecialchars($row['service_name']); ?>" width="100"></td>
                                    <td><?php echo htmlspecialchars($row['service_name']); ?></td>
                                    <td><?php echo htmlspecialchars(substr($row['description'], 0, 100)) . '...'; ?></td>
                                    <td>
                                        <a href="../includes/delete_service_handler.php?id=<?php echo $row['service_id']; ?>" class="action-delete" onclick="return confirm('Are you sure you want to delete this service?');">Delete</a>
                                    </td>
                                </tr>
                                <?php endwhile; ?>
                            <?php else: ?>
                                <tr><td colspan="5">No services found. Please add one using the form above.</td></tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</main>
<?php include '../footer.php'; ?>
