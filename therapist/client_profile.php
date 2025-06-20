<?php
  // shows the details for a single client.
include_once '../includes/session.php';
include_once '../includes/db_connect.php';
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'therapist') {
     header("Location: /GreenLife%20Wellness%20Center/login.php");
      exit(); }



// Check if a client ID was provided in the URL (e.g., client_profile.php?id=4)
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) { die("Invalid Client ID."); }
$client_id = $_GET['id'];

// SQL query to fetch the details for this specific client.
$client_sql = "SELECT full_name, email, created_at FROM users WHERE user_id = $client_id AND role = 'client'";
$client_result = mysqli_query($conn, $client_sql);
$client = mysqli_fetch_assoc($client_result);

// If no client is found, stop the script.
if (!$client) { die("Client not found."); }

include '../header.php';
?>
<title>Client Profile - GreenLife</title>
<main>
    <section class="page-header"><div class="container"><h1>Client Profile: <?php echo htmlspecialchars($client['full_name']); ?></h1></div></section>
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
                <h2>Client Details</h2>
                <p><strong>Name:</strong> <?php echo htmlspecialchars($client['full_name']); ?></p>
                <p><strong>Email:</strong> <?php echo htmlspecialchars($client['email']); ?></p>
                <p><strong>Member Since:</strong> <?php echo date("d M, Y", strtotime($client['created_at'])); ?></p>
                <h2 style="margin-top: 40px;">Appointment History</h2>
                </div>
        </div>
    </section>
</main>
<?php mysqli_close($conn); include '../footer.php'; ?>