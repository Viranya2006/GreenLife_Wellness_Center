<?php
// allows the admin to add, view, edit, and delete therapist accounts.
    include_once '../includes/session.php';
    include_once '../includes/functions.php';
    check_admin();
    include_once '../includes/db_connect.php';

    // SQL to fetch all existing therapists to display in the table.
    $sql = "SELECT user_id, full_name, email, created_at FROM users WHERE role = 'therapist' ORDER BY full_name";
    $result = mysqli_query($conn, $sql);

    include '../header.php';
?>
<title>Manage Therapists - Admin</title>
<main>
    <section class="page-header"><div class="container"><h1>Manage Therapists</h1></div></section>
    <section class="content-section">
        <div class="container dashboard-grid">
            <aside class="dashboard-nav">
                <h3>Admin Menu</h3>
                <ul>
                    <li><a href="index.php">System Overview</a></li>
                    <li><a href="manage_appointments.php">Manage Appointments</a></li>
                    <li><a href="manage_clients.php">Manage Clients</a></li>
                    <li><a href="manage_therapists.php" class="active">Manage Therapists</a></li>
                    <li><a href="manage_services.php">Manage Services</a></li>
                    <li><a href="manage_inquiries.php">Manage Inquiries</a></li>
                    <li><a href="../logout.php">Logout</a></li>
                </ul>
            </aside>
            <div class="dashboard-content">
                <!-- Form for adding a new therapist account. -->
                <div class="form-container-small" style="margin-bottom: 40px;">
                    <h2>Add New Therapist</h2>
                    <!-- Display success or error messages from the handler scripts. -->
                    <?php 
                        if (isset($_GET['status']) && $_GET['status'] == 'therapist_added') { echo '<p class="form-message success">Therapist added successfully!</p>'; }
                        if (isset($_GET['status']) && $_GET['status'] == 'deleted') { echo '<p class="form-message success">Therapist deleted successfully!</p>'; }
                        if (isset($_GET['status']) && $_GET['status'] == 'updated') { echo '<p class="form-message success">Therapist updated successfully!</p>'; }
                        if (isset($_GET['error'])) { echo '<p class="form-message error">'.htmlspecialchars($_GET['error']).'</p>'; } 
                    ?>
                    <form id="addTherapistForm" action="../includes/add_therapist_handler.php" method="POST">
                        <div class="form-group"><label for="therapist-name">Full Name</label><input type="text" id="therapist-name" name="full_name" required></div>
                        <div class="form-group"><label for="therapist-email">Email Address</label><input type="email" id="therapist-email" name="email" required></div>
                        <div class="form-group"><label for="therapist-password">Password</label><input type="password" id="therapist-password" name="password" required></div>
                        <button type="submit" class="btn-primary btn-full-width">Add Therapist</button>
                    </form>
                </div>
                <!-- Table to display all existing therapists. -->
                <h2>All Therapist Accounts</h2>
                <div class="table-container">
                    <table>
                        <thead><tr><th>ID</th><th>Full Name</th><th>Email</th><th>Registered On</th><th>Actions</th></tr></thead>
                        <tbody>
                            <?php if ($result && mysqli_num_rows($result) > 0): ?>
                                <?php while($row = mysqli_fetch_assoc($result)): ?>
                                <tr>
                                    <td><?php echo $row['user_id']; ?></td>
                                    <td><?php echo htmlspecialchars($row['full_name']); ?></td>
                                    <td><?php echo htmlspecialchars($row['email']); ?></td>
                                    <td><?php echo date('Y-m-d', strtotime($row['created_at'])); ?></td>
                                    <td>
                                        <!-- These links allow the admin to edit or delete a therapist. -->
                                        <a href="edit_therapist.php?id=<?php echo $row['user_id']; ?>">Edit</a> | 
                                        <a href="../includes/delete_therapist_handler.php?id=<?php echo $row['user_id']; ?>" class="action-delete" onclick="return confirm('Are you sure you want to delete this therapist?');">Delete</a>
                                    </td>
                                </tr>
                                <?php endwhile; ?>
                            <?php else: ?>
                                <tr><td colspan="5">No therapists found.</td></tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</main>
<?php include '../footer.php'; ?>
