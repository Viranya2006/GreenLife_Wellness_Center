<?php
    include_once '../includes/session.php';
    include_once '../includes/functions.php';
    check_admin();// Security check
    include_once '../includes/db_connect.php';

    // SQL query to fetch all appointments and join with other tables to get names.
    $sql = "SELECT a.appointment_date, a.appointment_time, c.full_name AS client_name, t.full_name AS therapist_name, s.service_name, a.status 
            FROM appointments a
            JOIN users c ON a.client_id = c.user_id
            JOIN users t ON a.therapist_id = t.user_id
            JOIN services s ON a.service_id = s.service_id
            ORDER BY a.appointment_date DESC, a.appointment_time DESC";
    $result = mysqli_query($conn, $sql);

    include '../header.php';
?>
<title>Manage Appointments - Admin</title>
<main>
    <section class="page-header"><div class="container"><h1>Manage All Appointments</h1></div></section>
    <section class="content-section">
        <div class="container dashboard-grid">
            <aside class="dashboard-nav">
                <h3>Admin Menu</h3>
                <ul>
                    <li><a href="index.php">System Overview</a></li>
                    <li><a href="manage_appointments.php" class="active">Manage Appointments</a></li>
                    <li><a href="manage_clients.php">Manage Clients</a></li>
                    <li><a href="manage_therapists.php">Manage Therapists</a></li>
                    <li><a href="manage_services.php">Manage Services</a></li>
                    <li><a href="manage_inquiries.php">Manage Inquiries</a></li>
                    <li><a href="../logout.php">Logout</a></li>
                </ul>
            </aside>
            <div class="dashboard-content">
                <h2>Appointment Log</h2>
                <div class="table-container">
                    <table>
                        <thead><tr><th>Date & Time</th><th>Client</th><th>Therapist</th><th>Service</th><th>Status</th></tr></thead>
                        <tbody>
                            <?php while($row = mysqli_fetch_assoc($result)): ?>
                            <tr>
                                <td><?php echo date("d M Y, g:i A", strtotime($row['appointment_date'] . ' ' . $row['appointment_time'])); ?></td>
                                <td><?php echo htmlspecialchars($row['client_name']); ?></td>
                                <td><?php echo htmlspecialchars($row['therapist_name']); ?></td>
                                <td><?php echo htmlspecialchars($row['service_name']); ?></td>
                                <td><span class="status-badge status-<?php echo htmlspecialchars($row['status']); ?>"><?php echo ucfirst(htmlspecialchars($row['status'])); ?></span></td>
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