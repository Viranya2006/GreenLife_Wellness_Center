<?php
 //shows a list of all clients assigned to the logged-in therapist.
include_once '../includes/session.php';
include_once '../includes/db_connect.php';
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'therapist') { 
    header("Location: /GreenLife%20Wellness%20Center/login.php"); 
    exit(); 
}


$therapist_id = $_SESSION['user_id'];

// SQL query to get a unique list of clients this therapist has had appointments with.
// DISTINCT prevents the same client from showing up multiple times.
$sql = "SELECT DISTINCT c.user_id, c.full_name, c.email 
        FROM users c
        JOIN appointments a ON c.user_id = a.client_id
        WHERE a.therapist_id = $therapist_id
        ORDER BY c.full_name";
$result = mysqli_query($conn, $sql);

include '../header.php';
?>
<title>My Clients - GreenLife</title>
<main>
    <section class="page-header"><div class="container"><h1>My Clients</h1></div></section>
    <section class="content-section">
        <div class="container dashboard-grid">
            <aside class="dashboard-nav">
                <h3>Therapist Menu</h3>
                <ul>
                    <li><a href="index.php">Today's Schedule</a></li>
                    <li><a href="manage_appointments.php">All Appointments</a></li>
                    <li><a href="view_clients.php" class="active">My Clients</a></li>
                    <li><a href="inquiries.php">Client Inquiries</a></li>
                    <li><a href="../logout.php">Logout</a></li>
                </ul>
            </aside>
            <div class="dashboard-content">
                <h2>Client List</h2>
                <div class="table-container">
                    <table>
                        <thead><tr><th>Name</th><th>Email</th><th>Action</th></tr></thead>
                        <tbody>
                            <?php if ($result && mysqli_num_rows($result) > 0): ?>
                                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($row['full_name']); ?></td>
                                        <td><?php echo htmlspecialchars($row['email']); ?></td>
                                        <td><a href="client_profile.php?id=<?php echo $row['user_id']; ?>">View Profile</a></td>
                                    </tr>
                                <?php endwhile; ?>
                            <?php else: ?>
                                <tr><td colspan="3">No clients found.</td></tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</main>
<?php mysqli_close($conn); include '../footer.php'; ?>