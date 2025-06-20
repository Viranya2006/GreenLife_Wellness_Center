<?php
// allows a therapist to view and reply to open inquiries.
    include_once '../includes/session.php';
    if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'therapist') { header("Location: /GreenLife%20Wellness%20Center/login.php"); exit(); }
    include_once '../includes/db_connect.php';

// SQL query to fetch all inquiries that are still 'open'.
    $sql = "SELECT inquiry_id, client_name, subject, message, submitted_at FROM inquiries WHERE status = 'open' ORDER BY submitted_at DESC";
    $result = mysqli_query($conn, $sql);
    
    include '../header.php';
?>
<title>Client Inquiries - GreenLife</title>
<main>
    <section class="page-header"><div class="container"><h1>Open Client Inquiries</h1></div></section>
    <section class="content-section">
        <div class="container dashboard-grid">
            <aside class="dashboard-nav">
                <h3>Therapist Menu</h3>
                <ul>
                    <li><a href="index.php">Today's Schedule</a></li>
                    <li><a href="manage_appointments.php">All Appointments</a></li>
                    <li><a href="view_clients.php">My Clients</a></li>
                    <li><a href="inquiries.php" class="active">Client Inquiries</a></li>
                    <li><a href="../logout.php">Logout</a></li>
                </ul>
            </aside>
            <div class="dashboard-content">
                <h2>Pending Inquiries</h2>
                <?php if (isset($_GET['status']) && $_GET['status'] == 'replied') { echo '<p class="form-message success">Reply sent successfully!</p>'; } ?>
                <div class="table-container">
                    <table>
                        <thead><tr><th>Date</th><th>From</th><th>Subject</th><th>Message</th><th>Your Reply</th></tr></thead>
                        <tbody>
                            <?php if (mysqli_num_rows($result) > 0): ?>
                                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                                    <tr>
                                        <td><?php echo date("d M, Y", strtotime($row['submitted_at'])); ?></td>
                                        <td><?php echo htmlspecialchars($row['client_name']); ?></td>
                                        <td><?php echo htmlspecialchars($row['subject']); ?></td>
                                        <td><?php echo htmlspecialchars($row['message']); ?></td>
                                        <td>
                                            <form action="../includes/reply_handler.php" method="POST">
                                                <input type="hidden" name="inquiry_id" value="<?php echo $row['inquiry_id']; ?>">
                                                <div class="form-group">
                                                    <textarea name="reply_message" rows="3" required></textarea>
                                                </div>
                                                <button type="submit" class="btn-primary btn-small">Send Reply</button>
                                            </form>
                                            </td>
                                    </tr>
                                <?php endwhile; ?>
                            <?php else: ?>
                                <tr><td colspan="5">No open inquiries found.</td></tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</main>
<?php include '../footer.php'; ?>
