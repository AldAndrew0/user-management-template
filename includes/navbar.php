<?php // Navigation bar — shown on every page ?>

<nav>
    <div class="nav-brand">
        <a href="/user-management-template/">Gestionale Template</a>
    </div>

    <ul class="nav-links">
        <li><a href="/user-management-template/">Dashboard</a></li>
        <li><a href="/user-management-template/pages/Users/">Users</a></li>

        <?php if (isset($_SESSION['user_id'])): ?>
            <!-- Show logout link if user is logged in -->
            <li><a href="/user-management-template/pages/auth/logout.php">Logout</a></li>
        <?php else: ?>
            <!-- Show login link if user is not logged in -->
            <li><a href="/user-management-template/pages/auth/login.php">Login</a></li>
        <?php endif; ?>
    </ul>
</nav>