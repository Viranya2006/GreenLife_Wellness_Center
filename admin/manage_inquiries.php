<?php
//shows a list of all inquiries submitted through the website.
    include_once '../includes/session.php';
    include_once '../includes/functions.php';
    check_admin();
    include_once '../includes/db_connect.php';

// SQL to fetch all inquiries along with any replies.
    $sql = "SELECT client_name, subject, submitted_at, message, therapist_reply FROM inquiries ORDER BY submitted_at DESC";
    $result = mysqli_query($conn, $sql);

    include '../header.php';
?>
<title>Manage Inquiries - Admin</title>
<main>
    <section class="page-header"><div class="container"><h1>Manage Inquiries</h1></div></section>
    <section class="content-section">
        <div class="container dashboard-grid">
            <aside class="dashboard-nav">
                <h3>Admin Menu</h3>
                <ul>
                    <li><a href="index.php">System Overview</a></li>
                    <li><a href="manage_appointments.php">Manage Appointments</a></li>
                    <li><a href="manage_clients.php">Manage Clients</a></li>
                    <li><a href="manage_therapists.php">Manage Therapists</a></li>
                    <li><a href="manage_services.php">Manage Services</a></li>
                    <li><a href="manage_inquiries.php" class="active">Manage Inquiries</a></li>
                    <li><a href="../logout.php">Logout</a></li>
                </ul>
            </aside>
            <div class="dashboard-content">
                <h2>All Client Inquiries</h2>
                <div class="table-container">
                    <table>
                        <thead><tr><th>Date</th><th>From</th><th>Subject</th><th>Message</th><th>Therapist Reply</th></tr></thead>
                        <tbody>
                            <?php if (mysqli_num_rows($result) > 0): ?>
                                <?php while($row = mysqli_fetch_assoc($result)): ?>
                                <tr>
                                    <td><?php echo date("d M Y", strtotime($row['submitted_at'])); ?></td>
                                    <td><?php echo htmlspecialchars($row['client_name']); ?></td>
                                    <td><?php echo htmlspecialchars($row['subject']); ?></td>
                                    <td><?php echo htmlspecialchars($row['message']); ?></td>
                                    <td>
                                        <?php 
                                            if (!empty($row['therapist_reply'])) {
                                                echo htmlspecialchars($row['therapist_reply']);
                                            } else {
                                                echo "<i>No reply yet.</i>";
                                            }
                                        ?>
                                    </td>
                                </tr>
                                <?php endwhile; ?>
                            <?php else: ?>
                                <tr><td colspan="5">No inquiries found.</td></tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</main>
<?php include '../footer.php'; ?>
