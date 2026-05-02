<?php
require_once '../../config/database.php';
require_once '../../includes/auth.php';
require_once '../../includes/header.php';
require_once '../../includes/navbar.php';

$error = '';
$success = '';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    $surname = trim($_POST['surname']);
    $nickname = trim($_POST['nickname']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $role = $_POST['role'];

    // Validation
    if (empty($name)) {
        $error = 'Name is required.';
    } elseif (strlen($name) < 2) {
        $error = 'Name must be at least 2 characters.';
    } elseif (empty($surname)) {
        $error = 'Surname is required.';
    } elseif (strlen($surname) < 2) {
        $error = 'Surname must be at least 2 characters.';
    } elseif (empty($email)) {
        $error = 'Email is required.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = 'Invalid email format.';
    } elseif (empty($password)) {
        $error = 'Password is required.';
    } elseif (strlen($password) < 8) {
        $error = 'Password must be at least 8 characters.';
    } elseif (!in_array($role, ['user', 'admin'])) {
        $error = 'Invalid role.';
    } else {
        try {
            // Check if email already exists
            $stmt = mysqli_prepare($connection, "SELECT id FROM users WHERE email = ?");
            mysqli_stmt_bind_param($stmt, 's', $email);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);

            if (mysqli_stmt_num_rows($stmt) > 0) {
                $error = 'Email already exists.';
            } else {
                // Hash the password before saving
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);

                // Insert the new user
                $stmt = mysqli_prepare($connection, "INSERT INTO users (name, surname, nickname, email, password, role) VALUES (?, ?, ?, ?, ?, ?)");
                mysqli_stmt_bind_param($stmt, 'ssssss', $name, $surname, $nickname, $email, $hashed_password, $role);
                mysqli_stmt_execute($stmt);
                $success = 'User created successfully.';
            }
        } catch (Exception $e) {
            $error = 'Database error. Please try again.';
        }
    }
}
?>

<main>
    <div class="container">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
            <h1>Add User</h1>
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
                    <input type="text" id="name" name="name" required>
                </div>
                <div class="form-group">
                    <label for="surname">Surname</label>
                    <input type="text" id="surname" name="surname" required>
                </div>
                <div class="form-group">
                    <label for="nickname">Nickname</label>
                    <input type="text" id="nickname" name="nickname">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <div class="form-group">
                    <label for="role">Role</label>
                    <select id="role" name="role">
                        <option value="user">User</option>
                        <option value="admin">Admin</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-success">Create User</button>
            </form>
        </div>
    </div>
</main>

<?php require_once '../../includes/footer.php'; ?>