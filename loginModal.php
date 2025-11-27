<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<div class="modal fade" id="loginModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="border-radius: 15px; padding: 10px;">

            <div class="modal-header border-0">
                <h5 class="modal-title">Account</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <?php if (!empty($_SESSION['login_error'])): ?>
                    <div class="alert alert-danger p-2 mb-2">
                        <?= htmlspecialchars($_SESSION['login_error']) ?>
                    </div>
                <?php endif; ?>

                <form action="login.php" method="POST">
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" placeholder="you@example.com" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" placeholder="••••••••" required>
                    </div>

                    <button type="submit" class="btn w-100"
                            style="background:#76eec6; font-weight:bold;">
                        Login
                    </button>
                </form>
            </div>

            <div class="modal-footer border-0">
                <a href="signup.php">Sign Up</a>
            </div>

        </div>
    </div>
</div>
//Loads again if info is wrong
<?php if (!empty($_SESSION['login_error'])): ?>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const loginModal = new bootstrap.Modal(document.getElementById('loginModal'));
            loginModal.show();
        });
    </script>
    <?php unset($_SESSION['login_error']); ?>
<?php endif; ?>
