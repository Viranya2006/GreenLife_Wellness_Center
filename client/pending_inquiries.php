<?php
 // Shows the client a list of all inquiries they have submitted.
include_once '../includes/session.php';
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'client') { header("Location: /GreenLife%20Wellness%20Center/login.php"); exit(); }
include_once '../includes/db_connect.php';

// First, get the email of the logged-in user.
$user_id = $_SESSION['user_id'];
$sql_user = "SELECT email FROM users WHERE user_id = $user_id";
$result_user = mysqli_query($conn, $sql_user);
$user = mysqli_fetch_assoc($result_user);

// Then, use that email to find all inquiries they have sent.
$user_email = mysqli_real_escape_string($conn, $user['email']);
$sql_inquiries = "SELECT subject, message, status, submitted_at, therapist_reply FROM inquiries WHERE client_email = '$user_email' ORDER BY submitted_at DESC";
$result_inquiries = mysqli_query($conn, $sql_inquiries);

include '../header.php';
?>
<title>My Inquiries - GreenLife</title>
<main>
    <section class="page-header"><div class="container"><h1>Your Inquiries</h1></div></section>
    <section class="content-section">
        <div class="container dashboard-grid">
            <aside class="dashboard-nav">
                <h3>Client Menu</h3>
                <ul>
                    <li><a href="index.php">Dashboard</a></li>
                    <li><a href="book_appointment.php">Book Appointment</a></li>
                    <li><a href="upcoming_appointments.php">Upcoming Appointments</a></li>
                    <li><a href="send_inquiry.php">Send Inquiry</a></li>
                    <li><a href="pending_inquiries.php" class="active">My Inquiries</a></li>
                    <li><a href="my_profile.php">My Profile</a></li>
                    <li><a href="../logout.php">Logout</a></li>
                </ul>
            </aside>
            <div class="dashboard-content">
                <h2>Submitted Inquiries</h2>
                <div class="table-container">
                    <table>
                        <thead><tr><th>Date</th><th>Your Message</th><th>Status</th><th>Therapist Reply</th></tr></thead>
                        <tbody>
                             <?php if (mysqli_num_rows($result_inquiries) > 0): ?>
                                <?php while ($row = mysqli_fetch_assoc($result_inquiries)): ?>
                                    <tr>
                                        <td><?php echo date("d M, Y", strtotime($row['submitted_at'])); ?></td>
                                        <td><strong><?php echo htmlspecialchars($row['subject']); ?></strong><br><?php echo htmlspecialchars($row['message']); ?></td>
                                        <td><span class="status-badge status-<?php echo htmlspecialchars($row['status']); ?>"><?php echo ucfirst(htmlspecialchars($row['status'])); ?></span></td>
                                        <td><?php echo !empty($row['therapist_reply']) ? htmlspecialchars($row['therapist_reply']) : '<i>Awaiting reply...</i>'; ?></td>
                                    </tr>
                                <?php endwhile; ?>
                            <?php else: ?>
                                <tr><td colspan="4">You have not submitted any inquiries.</td></tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</main>
<?php mysqli_close($conn); include '../footer.php'; ?>