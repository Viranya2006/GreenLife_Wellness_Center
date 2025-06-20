<?php
 //allows a therapist to view and manage all their assigned appointments.
include_once '../includes/session.php';
include_once '../includes/db_connect.php';

if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'therapist') {
     header("Location: /GreenLife%20Wellness%20Center/login.php");
      exit();
     }

// Get the therapist's ID from the session.
$therapist_id = $_SESSION['user_id'];

// SQL query to get ALL appointments (past and future) assigned to this therapist.
$sql = "SELECT a.appointment_id, a.appointment_date, a.appointment_time, c.full_name AS client_name, s.service_name, a.status 
        FROM appointments a
        JOIN users c ON a.client_id = c.user_id
        JOIN services s ON a.service_id = s.service_id
        WHERE a.therapist_id = $therapist_id
        ORDER BY a.appointment_date DESC, a.appointment_time DESC";
$result = mysqli_query($conn, $sql);

include '../header.php';
?>
<title>Manage Appointments - GreenLife</title>
<main>
    <section class="page-header"><div class="container"><h1>Manage All Appointments</h1></div></section>
    <section class="content-section">
        <div class="container dashboard-grid">
            <aside class="dashboard-nav">
                <h3>Therapist Menu</h3>
                <ul>
                    <li><a href="index.php">Today's Schedule</a></li>
                    <li><a href="manage_appointments.php" class="active">All Appointments</a></li>
                    <li><a href="view_clients.php">My Clients</a></li>
                    <li><a href="inquiries.php">Client Inquiries</a></li>
                    <li><a href="../logout.php">Logout</a></li>
                </ul>
            </aside>
            <div class="dashboard-content">
                <h2>Complete Appointment History</h2>
                <?php if (isset($_GET['status']) && $_GET['status'] == 'updated') { echo '<p class="form-message success">Appointment status updated successfully!</p>'; } ?>
                <div class="table-container">
                    <table>
                        <thead><tr><th>Date</th><th>Time</th><th>Client</th><th>Service</th><th>Status</th><th>Action</th></tr></thead>
                        <tbody>
                            <?php if ($result && mysqli_num_rows($result) > 0): ?>
                                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                                    <tr>
                                        <td><?php echo date("d M, Y", strtotime($row['appointment_date'])); ?></td>
                                        <td><?php echo date("g:i A", strtotime($row['appointment_time'])); ?></td>
                                        <td><?php echo htmlspecialchars($row['client_name']); ?></td>
                                        <td><?php echo htmlspecialchars($row['service_name']); ?></td>
                                        <td><span class="status-badge status-<?php echo htmlspecialchars($row['status']); ?>"><?php echo ucfirst(htmlspecialchars($row['status'])); ?></span></td>
                                        <td>
                                            <?php if ($row['status'] == 'pending'): ?>
                                                <a href="../includes/appointment_status_handler.php?id=<?php echo $row['appointment_id']; ?>&status=confirmed">Confirm</a> |
                                                <a href="../includes/appointment_status_handler.php?id=<?php echo $row['appointment_id']; ?>&status=cancelled" class="action-delete">Cancel</a>
                                            <?php else: ?>
                                                -
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endwhile; ?>
                            <?php else: ?>
                                <tr><td colspan="6">No appointments found.</td></tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</main>
<?php mysqli_close($conn); include '../footer.php'; ?>