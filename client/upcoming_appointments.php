<?php
 // displays a list of the client's upcoming appointments.

include_once '../includes/session.php';
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'client') { header("Location: /GreenLife%20Wellness%20Center/login.php"); exit(); }
include_once '../includes/db_connect.php';

// Get the ID of the currently logged-in client from the session.
$client_id = $_SESSION['user_id'];

// SQL query to get all appointments for this client that are on or after today's date.
// It joins with the 'users' and 'services' tables to get the names instead of just IDs.
$sql = "SELECT a.appointment_date, a.appointment_time, s.service_name, u.full_name AS therapist_name, a.status 
        FROM appointments a
        JOIN services s ON a.service_id = s.service_id
        JOIN users u ON a.therapist_id = u.user_id
        WHERE a.client_id = $client_id AND a.appointment_date >= CURDATE()
        ORDER BY a.appointment_date, a.appointment_time";
$result = mysqli_query($conn, $sql);

include '../header.php';
?>
<title>Upcoming Appointments - GreenLife</title>
<main>
    <section class="page-header"><div class="container"><h1>Your Upcoming Appointments</h1></div></section>
    <section class="content-section">
        <div class="container dashboard-grid">
            <aside class="dashboard-nav">
                <h3>Client Menu</h3>
                <ul>
                    <li><a href="index.php">Dashboard</a></li>
                    <li><a href="book_appointment.php">Book Appointment</a></li>
                    <li><a href="upcoming_appointments.php" class="active">Upcoming Appointments</a></li>
                    <li><a href="send_inquiry.php">Send Inquiry</a></li>
                    <li><a href="pending_inquiries.php">My Inquiries</a></li>
                    <li><a href="my_profile.php">My Profile</a></li>
                    <li><a href="../logout.php">Logout</a></li>
                </ul>
            </aside>
            <div class="dashboard-content">
                <h2>Appointment Schedule</h2>
                <div class="table-container">
                    <table>
                        <thead><tr><th>Date</th><th>Time</th><th>Service</th><th>Therapist</th><th>Status</th></tr></thead>
                        <tbody>
                            <?php if (mysqli_num_rows($result) > 0): ?>
                                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                                    <tr>
                                        <td><?php echo date("d M, Y", strtotime($row['appointment_date'])); ?></td>
                                        <td><?php echo date("g:i A", strtotime($row['appointment_time'])); ?></td>
                                        <td><?php echo htmlspecialchars($row['service_name']); ?></td>
                                        <td><?php echo htmlspecialchars($row['therapist_name']); ?></td>
                                        <td><span class="status-badge status-<?php echo htmlspecialchars($row['status']); ?>"><?php echo ucfirst(htmlspecialchars($row['status'])); ?></span></td>
                                    </tr>
                                <?php endwhile; ?>
                            <?php else: ?>
                                <tr><td colspan="5">You have no upcoming appointments.</td></tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</main>
<?php mysqli_close($conn); include '../footer.php'; ?>
