<?php
// This view expects an optional $error variable for login errors.
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Login | Austro-Asian Times</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" />
    <style>
        .login-wrapper {
            margin-top: 5rem;
        }
        .card {
            border: none;
            border-radius: 20px;
            box-shadow: 20px 20px 20px rgba(0, 0, 0, 0.15);
        }
        .card-header {
            background: linear-gradient(to right, rgb(11, 1, 51), rgb(23, 2, 92));
        }
        .form-control {
            border-radius: 12px;
        }
        .btn-primary {
            border-radius: 12px;
            background: linear-gradient(to right, rgb(11, 1, 51), rgb(23, 2, 92));
            border: none;
        }
        .btn-primary:hover {
            background: linear-gradient(to right, rgb(50, 27, 141), rgb(50, 21, 145));
        }
        footer {
            font-size: 0.9rem;
            margin-top: 2rem;
        }
        .logo-area {
            text-align: center;
            margin-bottom: 1rem;
        }
        h2 {
            font-weight: bold;
        }
        .alert {
            border-radius: 10px;
        }
    </style>
</head>
<body>
<div class="container login-wrapper">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            <div class="card shadow">
                <div class="card-header text-center text-white py-4">
                    <div class="logo-area">
                        <h2>Austro-Asian Times</h2>
                        <p class="mb-0">Welcome Back</p>
                    </div>
                </div>
                <div class="card-body px-4">
                    <?php if (!empty($error)): ?>
                        <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
                    <?php endif; ?>
                    <form action="index.php?controller=auth&action=loginSubmit" method="POST" novalidate>
                        <div class="mb-3">
                            <label for="name" class="form-label">Username</label>
                            <input type="text" name="name" id="name" class="form-control" required autofocus />
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" name="password" id="password" class="form-control" required />
                        </div>
                        <button type="submit" class="btn btn-primary w-100 py-2">Login</button>
                    </form>
                    <div class="mt-3 text-center">
                        <small>
                            Not registered yet?
                            <a href="index.php?controller=auth&action=register" class="text-primary fw-semibold">Create an account</a>
                        </small>
                    </div>
                </div>
            </div>
            <footer class="text-center text-muted">
                &copy; <?= date("Y") ?> Austro-Asian Times
            </footer>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
