<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Review Articles</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
    <style>
        :root {
            --primary-color: #2c3e50;
            --secondary-color: #3498db;
            --success-color: #2ecc71;
            --warning-color: #f1c40f;
            --danger-color: #e74c3c;
            --background-color: #f8f9fa;
            --text-color: #2c3e50;
            --border-color: #e9ecef;
        }

        body {
            background-color: var(--background-color);
            color: var(--text-color);
            font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
        }

        .navbar {
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .navbar-brand {
            font-weight: 600;
            font-size: 1.4rem;
        }

        .nav-link {
            position: relative;
            transition: all 0.3s ease;
            padding: 0.8rem 1.5rem !important;
            margin: 0 0.5rem;
        }

        .nav-link:hover {
            color: #fff !important;
            transform: translateY(-2px);
        }

        .nav-link::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: 0;
            left: 0;
            background-color: #fff;
            transition: width 0.3s ease;
        }

        .nav-link:hover::after {
            width: 100%;
        }

        .navbar-nav {
            gap: 1rem;
        }

        .page-title {
            color: var(--primary-color);
            font-weight: 700;
            margin-bottom: 30px;
            margin-top: 40px;
            position: relative;
            padding-bottom: 15px;
        }

        .page-title::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 60px;
            height: 4px;
            background-color: var(--secondary-color);
            border-radius: 2px;
        }

        .articles-container {
            padding: 20px 0;
        }

        .article-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            height: 100%;
            display: flex;
            flex-direction: column;
            overflow: hidden;
        }

        .article-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        }

        .article-thumbnail {
            position: relative;
            height: 200px;
            overflow: hidden;
        }

        .article-thumbnail img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .article-card:hover .article-thumbnail img {
            transform: scale(1.05);
        }

        .no-image {
            background-color: var(--border-color);
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #6c757d;
            font-size: 1.1em;
        }

        .article-content {
            padding: 20px;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
        }

        .article-title {
            font-size: 1.25rem;
            font-weight: 600;
            color: var(--primary-color);
            margin-bottom: 15px;
            line-height: 1.4;
        }

        .article-meta {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 15px;
            color: #6c757d;
            font-size: 0.9rem;
        }

        .meta-item {
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .article-footer {
            margin-top: auto;
            padding-top: 15px;
            border-top: 1px solid var(--border-color);
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 10px;
        }

        .btn-action {
            padding: 8px 15px;
            border-radius: 25px;
            transition: all 0.3s ease;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            gap: 5px;
            border: none;
            color: white;
        }

        .btn-view {
            background-color: var(--secondary-color);
        }

        .btn-view:hover {
            background-color: #2980b9;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(52, 152, 219, 0.3);
            color: white;
        }

        .btn-accept {
            background-color: var(--success-color);
        }

        .btn-accept:hover {
            background-color: #27ae60;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(46, 204, 113, 0.3);
            color: white;
        }

        .btn-reject {
            background-color: var(--danger-color);
        }

        .btn-reject:hover {
            background-color: #c0392b;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(231, 76, 60, 0.3);
            color: white;
        }

        .btn-comment {
            background-color: var(--warning-color);
        }

        .btn-comment:hover {
            background-color: #f39c12;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(241, 196, 15, 0.3);
            color: white;
        }

        .btn-enable-comment {
            background-color: var(--success-color);
        }

        .btn-enable-comment:hover {
            background-color: #27ae60;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(46, 204, 113, 0.3);
            color: white;
        }

        .btn-disable-comment {
            background-color: var(--danger-color);
        }

        .btn-disable-comment:hover {
            background-color: #c0392b;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(231, 76, 60, 0.3);
            color: white;
        }

        .status-badge {
            padding: 6px 12px;
            border-radius: 20px;
            font-weight: 500;
            font-size: 0.9rem;
        }

        .badge-pending {
            background-color: var(--warning-color);
            color: #fff;
        }

        .badge-approved {
            background-color: var(--success-color);
            color: #fff;
        }

        .badge-comments {
            background-color: var(--secondary-color);
            color: #fff;
        }

        footer {
            margin-top: 50px;
            padding: 20px 0;
            background-color: var(--primary-color);
            color: white;
            box-shadow: 0 -2px 10px rgba(0, 0, 0, 0.1);
        }

        @media (max-width: 768px) {
            .article-thumbnail {
                height: 180px;
            }
            
            .article-title {
                font-size: 1.1rem;
            }
            
            .article-meta {
                flex-wrap: wrap;
            }

            .article-footer {
                flex-direction: column;
                align-items: stretch;
            }

            .btn-action {
                width: 100%;
                justify-content: center;
            }
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-dark bg-dark navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="index.php?controller=dashboard&action=index">
                <i class="fas fa-newspaper me-2"></i>Editor Dashboard
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?controller=dashboard&action=index">
                            <i class="fas fa-home me-1"></i>Home
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="index.php?controller=review&action=index">
                            <i class="fas fa-tasks me-1"></i>Review Articles
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?controller=rss&action=index" target="_blank">
                            <i class="fas fa-rss me-1"></i>RSS Feed
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?controller=auth&action=logout">
                            <i class="fas fa-sign-out-alt me-1"></i>Logout
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <h2 class="page-title">Pending Articles for Review</h2>
        <div class="articles-container">
            <div class="row g-4">
                <?php if ($pending->num_rows > 0): ?>
                    <?php while ($row = $pending->fetch_assoc()): ?>
                        <div class="col-md-6 col-lg-4">
                            <div class="article-card">
                                <div class="article-thumbnail">
                                    <?php if ($row['thumb_url']): ?>
                                        <img src="/austro-asian-times/<?= htmlspecialchars($row['thumb_url']) ?>" alt="Article thumbnail" />
                                    <?php else: ?>
                                        <div class="no-image">
                                            <i class="fas fa-image me-2"></i>No image
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <div class="article-content">
                                    <h3 class="article-title"><?= htmlspecialchars($row['title']) ?></h3>
                                    <div class="article-meta">
                                        <span class="meta-item">
                                            <i class="fas fa-user"></i>
                                            <?= htmlspecialchars($row['author_name']) ?>
                                        </span>
                                        <span class="meta-item">
                                            <i class="far fa-calendar-alt"></i>
                                            <?= $row['created_at'] ?>
                                        </span>
                                    </div>
                                    <div class="article-footer">
                                        <span class="status-badge badge-pending">
                                            <i class="fas fa-clock me-1"></i>Pending Review
                                        </span>
                                        <div class="d-flex gap-2">
                                            <a href="index.php?controller=view&action=show&id=<?= $row['id'] ?>" class="btn-action btn-view">
                                                <i class="fas fa-eye"></i>View
                                            </a>
                                            <a href="index.php?controller=review&action=process&do=accept&id=<?= $row['id'] ?>" class="btn-action btn-accept">
                                                <i class="fas fa-check"></i>Accept
                                            </a>
                                            <a href="index.php?controller=review&action=process&do=reject&id=<?= $row['id'] ?>" class="btn-action btn-reject">
                                                <i class="fas fa-times"></i>Reject
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endwhile; ?>
                <?php else: ?>
                    <div class="col-12">
                        <div class="alert alert-info text-center py-4">
                            <i class="fas fa-info-circle me-2"></i>No pending articles to review
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <h2 class="page-title mt-5">Approved Articles</h2>
        <div class="articles-container">
            <div class="row g-4">
                <?php if ($approved->num_rows > 0): ?>
                    <?php while ($row = $approved->fetch_assoc()): ?>
                        <div class="col-md-6 col-lg-4">
                            <div class="article-card">
                                <div class="article-thumbnail">
                                    <?php if ($row['thumb_url']): ?>
                                        <img src="/austro-asian-times/<?= htmlspecialchars($row['thumb_url']) ?>" alt="Article thumbnail" />
                                    <?php else: ?>
                                        <div class="no-image">
                                            <i class="fas fa-image me-2"></i>No image
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <div class="article-content">
                                    <h3 class="article-title"><?= htmlspecialchars($row['title']) ?></h3>
                                    <div class="article-meta">
                                        <span class="meta-item">
                                            <i class="fas fa-user"></i>
                                            <?= htmlspecialchars($row['author_name']) ?>
                                        </span>
                                        <span class="meta-item">
                                            <i class="far fa-calendar-alt"></i>
                                            <?= $row['created_at'] ?>
                                        </span>
                                    </div>
                                    <div class="article-footer">
                                        <span class="status-badge badge-comments">
                                            <i class="fas <?= $row['comments_enabled'] ? 'fa-comments' : 'fa-comment-slash' ?> me-1"></i>
                                            <?= $row['comments_enabled'] ? 'Comments Enabled' : 'Comments Disabled' ?>
                                        </span>
                                        <div class="d-flex gap-2">
                                            <a href="index.php?controller=view&action=show&id=<?= $row['id'] ?>" class="btn-action btn-view">
                                                <i class="fas fa-eye"></i>View
                                            </a>
                                            <?php if ($row['comments_enabled']): ?>
                                                <a href="index.php?controller=review&action=process&do=disable_comment&id=<?= $row['id'] ?>" class="btn-action btn-disable-comment">
                                                    <i class="fas fa-comment-slash"></i>Disable Comments
                                                </a>
                                            <?php else: ?>
                                                <a href="index.php?controller=review&action=process&do=enable_comment&id=<?= $row['id'] ?>" class="btn-action btn-enable-comment">
                                                    <i class="fas fa-comments"></i>Enable Comments
                                                </a>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endwhile; ?>
                <?php else: ?>
                    <div class="col-12">
                        <div class="alert alert-secondary text-center py-4">
                            <i class="fas fa-info-circle me-2"></i>No approved articles found
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <footer class="text-center">
        <div class="container">
            <p class="mb-0">
                <i class="fas fa-copyright me-1"></i>All rights reserved by CDU @2025
            </p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
