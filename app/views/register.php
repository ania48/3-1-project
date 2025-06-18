<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register | Austro-Asian Times</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: #f5f5f5; }
        .form-container {
            margin-top: 5rem;
        }
        .card {
            border-radius: 15px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        }
        .card-header {
            background: linear-gradient(to right, #0b0133, #17025c);
            color: white;
        }
    </style>
</head>
<body>

<div class="container form-container">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            <div class="card">
                <div class="card-header text-center">
                    <h4>Create New Account</h4>
                </div>
                <div class="card-body">
                    <?php if (!empty($error)): ?>
                        <div class="alert alert-danger"><?= $error ?></div>
                    <?php elseif (!empty($success)): ?>
                        <div class="alert alert-success"><?= $success ?></div>
                    <?php endif; ?>

                    <form method="POST" action="index.php?controller=auth&action=register">
                        <div class="mb-3">
                            <label for="name" class="form-label">Username</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <div class="mb-3">
                            <label for="role" class="form-label">Role</label>
                            <select name="role" class="form-control" id="role" required>
                                <option value="editor">Editor</option>
                                <option value="journalist">Journalist</option>
                                <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
                                    <option value="admin">Admin</option>
                                    <option value="editor">Editor</option>
                                    <option value="journalist">Journalist</option>
                                <?php endif; ?>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary w-100">Register</button>
                    </form>

                    <div class="text-center mt-3">
                        Already have an account? <a href="index.php?controller=auth&action=login">Login</a>
                    </div>
                </div>
            </div>

            <footer class="text-center text-muted mt-4">
                &copy; <?= date('Y') ?> Austro-Asian Times
            </footer>
        </div>
    </div>
</div>

</body>
</html>
