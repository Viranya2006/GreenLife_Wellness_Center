<?php
 //main dashboard page for a logged-in therapist.

 // Include necessary files and start the session.
include_once '../includes/session.php';
include_once '../includes/db_connect.php';

// Security Check: Make sure the user is logged in and is a therapist.
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'therapist') { 
    header("Location: /GreenLife%20Wellness%20Center/login.php"); 
    exit(); 
}

// Get the logged-in therapist's ID from the session.
$therapist_id = $_SESSION['user_id'];

// SQL query to fetch ONLY today's appointments for THIS therapist.
// CURDATE() gets the current date from the server.
$sql = "SELECT a.appointment_time, c.full_name AS client_name, s.service_name, a.status 
        FROM appointments a
        JOIN users c ON a.client_id = c.user_id
        JOIN services s ON a.service_id = s.service_id
        WHERE a.therapist_id = $therapist_id AND a.appointment_date = CURDATE()
        ORDER BY a.appointment_time";
$result = mysqli_query($conn, $sql);

include '../header.php';
?>
<title>Therapist Dashboard - GreenLife</title>
<main>
    <section class="page-header"><div class="container"><h1>Welcome, <?php echo htmlspecialchars($_SESSION['user_name']); ?>!</h1></div></section>
    <section class="content-section">
        <div class="container dashboard-grid">
             <aside class="dashboard-nav">
                <h3>Therapist Menu</h3>
                <ul>
                    <li><a href="index.php" class="active">Today's Schedule</a></li>
                    <li><a href="manage_appointments.php">All Appointments</a></li>
                    <li><a href="view_clients.php">My Clients</a></li>
                    <li><a href="inquiries.php">Client Inquiries</a></li>
                    <li><a href="../logout.php">Logout</a></li>
                </ul>
            </aside>
            <div class="dashboard-content">
                <h2>Today's Appointments</h2>
                <div class="table-container">
                    <table>
                        <thead><tr><th>Time</th><th>Client Name</th><th>Service</th><th>Status</th></tr></thead>
                        <tbody>
                            <?php if ($result && mysqli_num_rows($result) > 0): ?>
                                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                                    <tr>
                                        <td><?php echo date("g:i A", strtotime($row['appointment_time'])); ?></td>
                                        <td><?php echo htmlspecialchars($row['client_name']); ?></td>
                                        <td><?php echo htmlspecialchars($row['service_name']); ?></td>
                                        <td><span class="status-badge status-<?php echo htmlspecialchars($row['status']); ?>"><?php echo ucfirst(htmlspecialchars($row['status'])); ?></span></td>
                                    </tr>
                                <?php endwhile; ?>
                            <?php else: ?>
                                <tr><td colspan="4">You have no appointments scheduled for today.</td></tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</main>
<?php mysqli_close($conn); include '../footer.php'; ?>