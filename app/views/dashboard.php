<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
    <style>
        :root {
            --primary-color: #2c3e50;
            --secondary-color: #3498db;
            --hover-color: #2980b9;
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

        .keywords-container {
            margin: 15px 0;
            display: flex;
            flex-wrap: wrap;
            gap: 5px;
        }

        .keyword-badge {
            background-color: #e9ecef;
            color: #495057;
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 0.85rem;
            transition: all 0.3s ease;
        }

        .keyword-badge:hover {
            background-color: var(--secondary-color);
            color: white;
        }

        .article-footer {
            margin-top: auto;
            padding-top: 15px;
            border-top: 1px solid var(--border-color);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .comments-status {
            display: flex;
            align-items: center;
            gap: 5px;
            font-size: 0.9rem;
        }

        .btn-view {
            background-color: var(--secondary-color);
            color: white;
            border: none;
            padding: 8px 20px;
            border-radius: 25px;
            transition: all 0.3s ease;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            gap: 5px;
        }

        .btn-view:hover {
            background-color: var(--hover-color);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(52, 152, 219, 0.3);
            color: white;
        }

        .badge {
            padding: 6px 12px;
            font-weight: 500;
            border-radius: 20px;
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
        }

        .comments-preview {
            background-color: #f8f9fa;
            border-radius: 8px;
            padding: 10px;
            font-size: 0.9rem;
        }

        /* Search Form Styles */
        .search-container {
            background: white;
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
        }

        .search-form {
            margin: 0;
        }

        .search-input {
            border: 2px solid var(--border-color);
            border-radius: 25px 0 0 25px;
            padding: 12px 20px;
            font-size: 1rem;
            transition: all 0.3s ease;
            border-right: none;
        }

        .search-input:focus {
            border-color: var(--secondary-color);
            box-shadow: 0 0 0 0.2rem rgba(52, 152, 219, 0.25);
            outline: none;
        }

        .search-btn {
            border-radius: 0 25px 25px 0;
            padding: 12px 20px;
            background: linear-gradient(135deg, var(--secondary-color), var(--hover-color));
            border: 2px solid var(--secondary-color);
            border-left: none;
            transition: all 0.3s ease;
        }

        .search-btn:hover {
            background: linear-gradient(135deg, var(--hover-color), var(--secondary-color));
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(52, 152, 219, 0.3);
        }

        .btn-outline-secondary {
            border-radius: 25px;
            margin-left: 10px;
            padding: 12px 20px;
            border: 2px solid var(--border-color);
            color: #6c757d;
            transition: all 0.3s ease;
        }

        .btn-outline-secondary:hover {
            background-color: #6c757d;
            border-color: #6c757d;
            color: white;
            transform: translateY(-1px);
        }

        .input-group {
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            border-radius: 25px;
            overflow: hidden;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-dark bg-dark navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="index.php?controller=dashboard&action=index">
                <i class="fas fa-newspaper me-2"></i>Dashboard
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <?php if ($_SESSION['role'] === 'journalist'): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?controller=article&action=add">
                            <i class="fas fa-plus-circle me-1"></i>Add Article
                        </a>
                    </li>
                    <?php endif; ?>
                    
                    <?php if ($_SESSION['role'] === 'editor' || $_SESSION['role'] === 'admin'): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?controller=review&action=index">
                            <i class="fas fa-tasks me-1"></i>Review Articles
                        </a>
                    </li>
                    <?php endif; ?>
                    
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
        <?php if (!empty($_GET['search'])): ?>
            <h2 class="page-title">
                <i class="fas fa-search me-2"></i>
                Search Results for "<?= htmlspecialchars($_GET['search']) ?>"
            </h2>
        <?php else: ?>
            <h2 class="page-title">Latest 5 Approved Articles</h2>
        <?php endif; ?>
        
        <!-- Search Form -->
        <div class="search-container mb-4">
            <form method="GET" action="index.php" class="search-form">
                <input type="hidden" name="controller" value="dashboard">
                <input type="hidden" name="action" value="index">
                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <div class="input-group">
                            <input 
                                type="text" 
                                name="search" 
                                class="form-control search-input" 
                                placeholder="Search articles by title or keywords..." 
                                value="<?= htmlspecialchars($_GET['search'] ?? '') ?>"
                                aria-label="Search articles"
                            >
                            <button class="btn btn-primary search-btn" type="submit">
                                <i class="fas fa-search"></i>
                            </button>
                            <?php if (!empty($_GET['search'])): ?>
                                <a href="index.php?controller=dashboard&action=index" class="btn btn-outline-secondary">
                                    <i class="fas fa-times"></i> Clear
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        
        <div class="articles-container">
            <div class="row g-4">
                <?php if ($articles && $articles->num_rows > 0): ?>
                    <?php while ($row = $articles->fetch_assoc()): ?>
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
                                            <i class="far fa-calendar-alt"></i>
                                            <?= $row['created_at'] ?>
                                        </span>
                                        <span class="meta-item">
                                            <i class="far fa-clock"></i>
                                            <?= $row['updated_at'] ?>
                                        </span>
                                    </div>
                                    <div class="keywords-container">
                                        <?php
                                        $keywords = explode(',', $row['keywords']);
                                        foreach ($keywords as $keyword) {
                                            echo '<span class="keyword-badge">' . htmlspecialchars(trim($keyword)) . '</span>';
                                        }
                                        ?>
                                    </div>
                                    <div class="article-footer">
                                        <div class="d-flex flex-column gap-2 w-100">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div class="d-flex align-items-center gap-2">
                                                    <span class="comments-status">
                                                        <i class="fas <?= $row['comments_enabled'] ? 'fa-comments' : 'fa-comment-slash' ?>"></i>
                                                        <span class="badge <?= $row['comments_enabled'] ? 'bg-success' : 'bg-secondary' ?>">
                                                            <?= $row['comments_enabled'] ? 'Enabled' : 'Disabled' ?>
                                                        </span>
                                                    </span>
                                                    <?php if ($row['comments_enabled'] && isset($row['comment_count']) && $row['comment_count'] > 0): ?>
                                                        <span class="text-muted small">
                                                            <i class="fas fa-comments text-primary"></i>
                                                            <?= $row['comment_count'] ?> comment<?= $row['comment_count'] > 1 ? 's' : '' ?>
                                                        </span>
                                                    <?php endif; ?>
                                                </div>
                                                <a href="index.php?controller=view&action=show&id=<?= $row['id'] ?>" class="btn btn-view">
                                                    <i class="fas fa-eye"></i>View Article
                                                </a>
                                            </div>
                                            <?php if ($row['comments_enabled'] && isset($row['comment_count']) && $row['comment_count'] > 0): ?>
                                                <div class="comments-preview mt-2" id="comments-<?= $row['id'] ?>">
                                                    <div class="text-center text-muted small">
                                                        <i class="fas fa-spinner fa-spin"></i> Loading comments...
                                                    </div>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endwhile; ?>
                <?php else: ?>
                    <div class="col-12">
                        <div class="alert alert-info text-center py-4">
                            <?php if (!empty($_GET['search'])): ?>
                                <i class="fas fa-search me-2"></i>
                                No articles found matching "<?= htmlspecialchars($_GET['search']) ?>"
                                <br>
                                <small class="mt-2 d-block">
                                    <a href="index.php?controller=dashboard&action=index" class="text-decoration-none">
                                        <i class="fas fa-arrow-left me-1"></i>View all articles
                                    </a>
                                </small>
                            <?php else: ?>
                                <i class="fas fa-info-circle me-2"></i>No approved articles found
                            <?php endif; ?>
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

    <script>
        // Load comments for this article
        <?php if ($row['comments_enabled'] && isset($row['comment_count']) && $row['comment_count'] > 0): ?>
        fetch(`index.php?controller=comment&action=getComments&article_id=<?= $row['id'] ?>`)
            .then(response => response.json())
            .then(data => {
                if (data.success && data.comments.length > 0) {
                    const commentsContainer = document.getElementById('comments-<?= $row['id'] ?>');
                    const latestComments = data.comments.slice(0, 2);
                    commentsContainer.innerHTML = latestComments.map(comment => `
                        <div class="comment-preview mb-2">
                            <div class="d-flex justify-content-between align-items-start">
                                <span class="comment-author small fw-bold">${comment.user_name}</span>
                                <span class="comment-date small text-muted">${new Date(comment.created_at).toLocaleDateString()}</span>
                            </div>
                            <p class="comment-content small mb-0 text-truncate">${comment.content}</p>
                        </div>
                    `).join('');
                } else {
                    document.getElementById('comments-<?= $row['id'] ?>').innerHTML = 
                        '<div class="text-muted small">No comments yet</div>';
                }
            })
            .catch(error => {
                console.error('Error loading comments:', error);
                document.getElementById('comments-<?= $row['id'] ?>').innerHTML = 
                    '<div class="text-danger small">Error loading comments</div>';
            });
        <?php endif; ?>
    </script>

</body>

</html>