<?php
require_once '../../config/database.php';
require_once '../../includes/header.php';
require_once '../../includes/navbar.php';

// Get user id from URL
$id = $_GET['id'] ?? null;

// If no id, redirect to users list
if (!$id) {
    header('Location: /pages/Users/');
    exit;
}

// Fetch the user from the database
$stmt = mysqli_prepare($connection, "SELECT * FROM users WHERE id = ?");
mysqli_stmt_bind_param($stmt, 'i', $id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$user = mysqli_fetch_assoc($result);

// If user not found, redirect to users list
if (!$user) {
    header('Location: /pages/Users/');
    exit;
}

// Handle confirmation
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = mysqli_prepare($connection, "DELETE FROM users WHERE id = ?");
    mysqli_stmt_bind_param($stmt, 'i', $id);

    if (mysqli_stmt_execute($stmt)) {
        header('Location: /pages/Users/');
        exit;
    } else {
        $error = 'Something went wrong. Please try again.';
    }
}
?>

<main>
    <div class="container">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
            <h1>Delete User</h1>
            <a href="/pages/Users/" class="btn btn-primary">← Back to Users</a>
        </div>

        <div class="card" style="max-width: 500px;">
            <p style="margin-bottom: 1.5rem;">Are you sure you want to delete <strong><?php echo $user['name']; ?></strong>? This action cannot be undone.</p>

            <form method="POST">
                <button type="submit" class="btn btn-danger">Yes, delete</button>
                <a href="/pages/Users/" class="btn btn-primary" style="margin-left: 0.5rem;">Cancel</a>
            </form>
        </div>
    </div>
</main>

<?php require_once '../../includes/footer.php'; ?>