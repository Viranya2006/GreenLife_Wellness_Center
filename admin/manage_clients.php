<?php
// Shows a list of all registered clients.
    include_once '../includes/session.php';
    include_once '../includes/functions.php';
    check_admin();
    include_once '../includes/db_connect.php';

    // SQL query to fetch all users with the 'client' role.
    $sql = "SELECT user_id, full_name, email, created_at FROM users WHERE role = 'client' ORDER BY full_name";
    $result = mysqli_query($conn, $sql);

    include '../header.php';
?>
<title>Manage Clients - Admin</title>
<main>
    <section class="page-header"><div class="container"><h1>Manage Clients</h1></div></section>
    <section class="content-section">
        <div class="container dashboard-grid">
            <aside class="dashboard-nav">
                <h3>Admin Menu</h3>
                <ul>
                    <li><a href="index.php">System Overview</a></li>
                    <li><a href="manage_appointments.php">Manage Appointments</a></li>
                    <li><a href="manage_clients.php" class="active">Manage Clients</a></li>
                    <li><a href="manage_therapists.php">Manage Therapists</a></li>
                    <li><a href="manage_services.php">Manage Services</a></li>
                    <li><a href="manage_inquiries.php">Manage Inquiries</a></li>
                    <li><a href="../logout.php">Logout</a></li>
                </ul>
            </aside>
            <div class="dashboard-content">
                <h2>All Client Accounts</h2>
                <div class="table-container">
                    <table>
                        <thead><tr><th>ID</th><th>Full Name</th><th>Email</th><th>Registered On</th></tr></thead>
                        <tbody>
                            <?php // Loop through each client and display their details.
                             while($row = mysqli_fetch_assoc($result)): ?>
                            <tr>
                                <td><?php echo $row['user_id']; ?></td>
                                <td><?php echo htmlspecialchars($row['full_name']); ?></td>
                                <td><?php echo htmlspecialchars($row['email']); ?></td>
                                <td><?php echo date('Y-m-d', strtotime($row['created_at'])); ?></td>
                            </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</main>
<?php include '../footer.php'; ?>