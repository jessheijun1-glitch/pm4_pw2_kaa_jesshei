<h2>Login</h2>
<?php if (!empty($error)): ?>
    <p><?= htmlspecialchars($error) ?></p>
<?php endif; ?>
<form action="/login" method="POST">
    <div>
        <label>Username</label>
        <input type="text" name="username" required>
    </div>

    <div>
        <label>Password</label>
        <input type="password" name="password" required>
    </div>

    <button type="submit">Login</button>
</form>