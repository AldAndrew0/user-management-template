<?php
require_once '../../config/database.php';
require_once '../../includes/header.php';
require_once '../../includes/navbar.php';

$error = '';
$success = '';

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

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $role = $_POST['role'];
    $password = $_POST['password'];

    // Check if email already exists for another user
    $stmt = mysqli_prepare($connection, "SELECT id FROM users WHERE email = ? AND id != ?");
    mysqli_stmt_bind_param($stmt, 'si', $email, $id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);

    if (mysqli_stmt_num_rows($stmt) > 0) {
        $error = 'Email already exists.';
    } else {
        // Update with or without new password
        if (!empty($password)) {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $stmt = mysqli_prepare($connection, "UPDATE users SET name = ?, email = ?, password = ?, role = ? WHERE id = ?");
            mysqli_stmt_bind_param($stmt, 'ssssi', $name, $email, $hashed_password, $role, $id);
        } else {
            $stmt = mysqli_prepare($connection, "UPDATE users SET name = ?, email = ?, role = ? WHERE id = ?");
            mysqli_stmt_bind_param($stmt, 'sssi', $name, $email, $role, $id);
        }

        if (mysqli_stmt_execute($stmt)) {
            $success = 'User updated successfully.';
            // Refresh user data
            $user['name'] = $name;
            $user['email'] = $email;
            $user['role'] = $role;
        } else {
            $error = 'Something went wrong. Please try again.';
        }
    }
}
?>

<main>
    <div class="container">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
            <h1>Edit User</h1>
            <a href="/pages/Users/" class="btn btn-primary">← Back to Users</a>
        </div>

        <div class="card" style="max-width: 500px;">

            <?php if ($error): ?>
                <div class="alert alert-error"><?php echo $error; ?></div>
            <?php endif; ?>

            <?php if ($success): ?>
                <div class="alert alert-success"><?php echo $success; ?></div>
            <?php endif; ?>

            <form method="POST">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" id="name" name="name" value="<?php echo $user['name']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" value="<?php echo $user['email']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="password">New Password</label>
                    <input type="password" id="password" name="password" placeholder="Leave empty to keep current password">
                </div>
                <div class="form-group">
                    <label for="role">Role</label>
                    <select id="role" name="role">
                        <option value="user" <?php echo $user['role'] === 'user' ? 'selected' : ''; ?>>User</option>
                        <option value="admin" <?php echo $user['role'] === 'admin' ? 'selected' : ''; ?>>Admin</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Update User</button>
            </form>
        </div>
    </div>
</main>

<?php require_once '../../includes/footer.php'; ?>