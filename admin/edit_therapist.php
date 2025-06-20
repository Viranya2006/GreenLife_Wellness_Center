<?php
//displays a form to edit the details of a specific therapist.

include_once '../includes/session.php';
include_once '../includes/functions.php';
check_admin();
include_once '../includes/db_connect.php';

// Check if an ID was passed in the URL, e.g., edit_therapist.php?id=2  
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) { die("Invalid Therapist ID."); }
$therapist_id = $_GET['id'];

// SQL to fetch the current details of this specific therapist.
$sql = "SELECT full_name, email FROM users WHERE user_id = $therapist_id AND role = 'therapist'";
$result = mysqli_query($conn, $sql);
$therapist = mysqli_fetch_assoc($result);

// If no therapist is found with that ID, stop the script.
if (!$therapist) {
     die("Therapist not found.");
     }

include '../header.php';
?>
<title>Edit Therapist - Admin</title>
<main>
    <section class="page-header"><div class="container"><h1>Edit Therapist</h1></div></section>
    <section class="content-section">
        <div class="container form-container-small">
            <h2>Editing: <?php echo htmlspecialchars($therapist['full_name']); ?></h2>
             <!-- This form sends the updated data to the edit_therapist_handler.php script. -->
            <form action="../includes/edit_therapist_handler.php" method="POST">
            <!-- A hidden field is used to pass the therapist's ID to the handler. -->
                <input type="hidden" name="user_id" value="<?php echo $therapist_id; ?>">
                <div class="form-group"><label>Full Name</label><input type="text" name="full_name" value="<?php echo htmlspecialchars($therapist['full_name']); ?>" required></div>
                <div class="form-group"><label>Email Address</label><input type="email" name="email" value="<?php echo htmlspecialchars($therapist['email']); ?>" required></div>
                <hr><p><strong>Update Password (optional)</strong></p>
                <div class="form-group"><label>New Password</label><input type="password" name="password"><small>Leave blank to keep current password.</small></div>
                <button type="submit" class="btn-primary btn-full-width">Update Therapist</button>
            </form>
        </div>
    </section>
</main>
<?php include '../footer.php'; ?>