<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($article['title']) ?> - Austro-Asian Times</title>
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
            line-height: 1.6;
        }

        .article-container {
            background: white;
            border-radius: 15px;
            box-shadow: 0 5px 25px rgba(0, 0, 0, 0.1);
            padding: 30px;
            margin-top: 30px;
            margin-bottom: 30px;
        }

        .btn-back {
            background-color: var(--primary-color);
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 25px;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-weight: 500;
            margin-top: 20px;
        }

        .btn-back:hover {
            background-color: #34495e;
            color: white;
            transform: translateX(-5px);
            box-shadow: 0 4px 12px rgba(44, 62, 80, 0.2);
        }

        .article-header {
            margin-bottom: 25px;
        }

        .article-title {
            color: var(--primary-color);
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 15px;
            line-height: 1.3;
        }

        .article-meta {
            color: #6c757d;
            font-size: 1.1rem;
            display: flex;
            align-items: center;
            gap: 20px;
            margin-bottom: 20px;
        }

        .meta-item {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .article-thumbnail {
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            margin-bottom: 25px;
            max-width: 800px;
            margin-left: auto;
            margin-right: auto;
        }

        .article-thumbnail img {
            width: 100%;
            height: auto;
            max-height: 400px;
            object-fit: cover;
            display: block;
            transition: transform 0.3s ease;
        }

        .article-thumbnail:hover img {
            transform: scale(1.02);
        }

        .article-content {
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            font-size: 1.1rem;
            line-height: 1.8;
            color: #2c3e50;
        }

        .article-content p {
            margin-bottom: 1.5rem;
        }

        .article-status {
            margin-top: 25px;
            padding: 15px;
            background-color: #f8f9fa;
            border-radius: 10px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .status-badge {
            padding: 8px 16px;
            border-radius: 20px;
            font-weight: 500;
            font-size: 0.9rem;
            display: inline-flex;
            align-items: center;
            gap: 5px;
        }

        .badge-pending {
            background-color: var(--warning-color);
            color: #fff;
        }

        .badge-accepted {
            background-color: var(--success-color);
            color: #fff;
        }

        .badge-rejected {
            background-color: var(--danger-color);
            color: #fff;
        }

        /* Comment Section Styles */
        .comments-section {
            margin-top: 40px;
            padding-top: 30px;
            border-top: 1px solid var(--border-color);
        }

        .comments-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .comments-title {
            font-size: 1.5rem;
            color: var(--primary-color);
            font-weight: 600;
        }

        .comment-form {
            background: white;
            padding: 25px;
            border-radius: 15px;
            margin-bottom: 30px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
            border: 1px solid var(--border-color);
            transition: all 0.3s ease;
        }

        .comment-form:hover {
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.08);
            transform: translateY(-2px);
        }

        .comment-input {
            width: 100%;
            min-height: 120px;
            padding: 20px;
            border: 2px solid var(--border-color);
            border-radius: 12px;
            margin-bottom: 20px;
            resize: vertical;
            transition: all 0.3s ease;
            font-size: 1rem;
            line-height: 1.6;
            color: var(--text-color);
            background-color: #f8f9fa;
        }

        .comment-input:focus {
            border-color: var(--secondary-color);
            box-shadow: 0 0 0 4px rgba(52, 152, 219, 0.1);
            outline: none;
            background-color: white;
        }

        .comment-input::placeholder {
            color: #adb5bd;
            font-style: italic;
        }

        .comment-submit {
            background: var(--secondary-color);
            color: white;
            border: none;
            width: 45px;
            height: 45px;
            border-radius: 50%;
            cursor: pointer;
            font-weight: 600;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 15px rgba(52, 152, 219, 0.2);
            position: relative;
            overflow: hidden;
        }

        .comment-submit:hover {
            transform: translateY(-2px) scale(1.05);
            box-shadow: 0 6px 20px rgba(52, 152, 219, 0.3);
            background: #2980b9;
        }

        .comment-submit:active {
            transform: translateY(0) scale(0.95);
            box-shadow: 0 2px 10px rgba(52, 152, 219, 0.2);
        }

        .comment-submit i {
            font-size: 1.2rem;
            transition: transform 0.3s ease;
        }

        .comment-submit:hover i {
            transform: scale(1.1);
        }

        .comment-form-header {
            margin-bottom: 20px;
            color: var(--primary-color);
            font-size: 1.2rem;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .comment-form-header i {
            color: var(--secondary-color);
        }

        .comment-form-footer {
            display: flex;
            justify-content: flex-end;
            align-items: center;
            gap: 15px;
        }

        .comment-character-count {
            color: #6c757d;
            font-size: 0.9rem;
            margin-right: auto;
        }

        .comments-list {
            margin-top: 30px;
        }

        .comment {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
            margin-bottom: 20px;
            transition: all 0.3s ease;
            animation: fadeIn 0.5s ease-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .comment:hover {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transform: translateY(-2px);
        }

        .comment-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
            flex-wrap: wrap;
            gap: 10px;
        }

        .comment-author {
            font-weight: 600;
            color: var(--primary-color);
        }

        .comment-date {
            color: #6c757d;
            font-size: 0.9rem;
        }

        .comment-content {
            color: #2c3e50;
            line-height: 1.6;
            white-space: pre-wrap;
        }

        .comments-disabled {
            text-align: center;
            padding: 30px;
            background: #f8f9fa;
            border-radius: 10px;
            color: #6c757d;
        }

        .comments-disabled i {
            font-size: 2rem;
            margin-bottom: 10px;
            color: var(--danger-color);
        }

        .toast-container {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 1000;
        }

        footer {
            background-color: var(--primary-color);
            color: white;
            padding: 20px 0;
            margin-top: 50px;
            box-shadow: 0 -2px 10px rgba(0, 0, 0, 0.1);
        }

        @media (max-width: 768px) {
            .article-container {
                padding: 20px;
                margin-top: 20px;
            }

            .article-title {
                font-size: 2rem;
            }

            .article-meta {
                flex-direction: column;
                gap: 10px;
            }

            .article-content {
                padding: 20px;
                font-size: 1rem;
            }

            .article-thumbnail {
                max-width: 100%;
            }

            .article-thumbnail img {
                max-height: 300px;
            }
        }

        .pending-comment {
            opacity: 0.8;
            border-left: 3px solid #ffc107;
        }
        
        .pending-comment .badge {
            font-size: 0.8rem;
            padding: 0.25rem 0.5rem;
        }

        .badge {
            font-weight: 500;
            padding: 0.35em 0.65em;
        }
    </style>
</head>
<body>
    <div class="container">
        <a href="javascript:history.back()" class="btn btn-back">
            <i class="fas fa-arrow-left"></i>Back to Articles
        </a>

        <div class="article-container">
            <div class="article-header">
                <h1 class="article-title"><?= htmlspecialchars($article['title']) ?></h1>
                <div class="article-meta">
                    <span class="meta-item">
                        <i class="fas fa-user"></i>
                        <?= htmlspecialchars($article['author_name']) ?>
                    </span>
                    <span class="meta-item">
                        <i class="far fa-calendar-alt"></i>
                        <?= $article['created_at'] ?>
                    </span>
                </div>
            </div>

            <?php if ($article['thumb_url']): ?>
                <div class="article-thumbnail">
                    <img src="/austro-asian-times/<?= htmlspecialchars($article['thumb_url']) ?>" alt="Article thumbnail">
                </div>
            <?php endif; ?>

            <div class="article-content">
                <?= nl2br(htmlspecialchars($article['body'])) ?>
            </div>

            <div class="article-status">
                <i class="fas fa-info-circle"></i>
                <strong>Status:</strong>
                <span class="status-badge badge-<?= $article['status'] ?>">
                    <i class="fas <?= match($article['status']) {
                        'pending' => 'fa-clock',
                        'accepted' => 'fa-check-circle',
                        'rejected' => 'fa-times-circle',
                        default => 'fa-circle'
                    } ?>"></i>
                    <?= ucfirst($article['status']) ?>
                </span>
            </div>

            <!-- Comments Section -->
            <?php if ($article['status'] !== 'pending'): ?>
            <div class="comments-section">
                <div class="comments-header">
                    <h3 class="comments-title">
                        <i class="fas fa-comments me-2"></i>Comments
                    </h3>
                </div>

                <?php if ($article['comments_enabled']): ?>
                    <?php if (isset($_SESSION['user_id'])): ?>
                        <div class="comment-form">
                            <div class="comment-form-header">
                                <i class="fas fa-pen-fancy"></i>
                                Write a Comment
                            </div>
                            <textarea class="comment-input" id="commentInput" placeholder="Share your thoughts..." maxlength="1000"></textarea>
                            <div class="comment-form-footer">
                                <span class="comment-character-count">
                                    <span id="charCount">0</span>/1000 characters
                                </span>
                                <button class="comment-submit" onclick="submitComment()" title="Post Comment">
                                    <i class="fas fa-paper-plane"></i>
                                </button>
                            </div>
                        </div>
                    <?php else: ?>
                        <div class="alert alert-info">
                            <i class="fas fa-info-circle me-2"></i>Please <a href="index.php?controller=auth&action=login">login</a> to post a comment.
                        </div>
                    <?php endif; ?>

                    <div class="comments-list" id="commentsList">
                        <!-- Comments will be loaded here -->
                    </div>
                <?php else: ?>
                    <div class="comments-disabled">
                        <i class="fas fa-comment-slash"></i>
                        <h4>Comments are disabled for this article</h4>
                        <p>Comments have been turned off by the editor.</p>
                    </div>
                <?php endif; ?>
            </div>
            <?php endif; ?>
        </div>
    </div>

    <div class="toast-container">
        <div class="toast align-items-center text-white bg-success border-0" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body"></div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
            </div>
        </div>
    </div>

    <footer class="text-center">
        <div class="container">
            <p class="mb-0">
                <i class="fas fa-copyright me-1"></i><?= date("Y") ?> Austro-Asian Times
            </p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Load comments when page loads
        document.addEventListener('DOMContentLoaded', function() {
            loadComments();
        });

        function loadComments() {
            const articleId = <?= $article['id'] ?>;
            const commentsList = document.getElementById('commentsList');
            
            commentsList.innerHTML = `
                <div class="text-center py-3">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                    <p class="text-muted mt-2">Loading comments...</p>
                </div>
            `;

            fetch(`index.php?controller=comment&action=getComments&article_id=${articleId}`)
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        if (!data.comments || data.comments.length === 0) {
                            commentsList.innerHTML = `
                                <div class="text-muted text-center py-4">
                                    <i class="fas fa-comments fa-2x mb-3"></i>
                                    <p>No comments yet. Be the first to comment!</p>
                                </div>
                            `;
                            return;
                        }

                        
                        data.comments.sort((a, b) => new Date(b.created_at) - new Date(a.created_at));

                        commentsList.innerHTML = data.comments.map(comment => `
                            <div class="comment">
                                <div class="comment-header">
                                    <div class="d-flex align-items-center gap-2">
                                        <span class="comment-author">${comment.user_name}</span>
                                    </div>
                                    <span class="comment-date">${new Date(comment.created_at).toLocaleString()}</span>
                                </div>
                                <div class="comment-content">${comment.content}</div>
                            </div>
                        `).join('');
                    } else {
                        commentsList.innerHTML = `
                            <div class="alert alert-danger text-center">
                                <i class="fas fa-exclamation-circle me-2"></i>
                                ${data.message || 'Error loading comments'}
                            </div>
                        `;
                    }
                })
                .catch(error => {
                    console.error('Error loading comments:', error);
                    commentsList.innerHTML = `
                        <div class="alert alert-danger text-center">
                            <i class="fas fa-exclamation-circle me-2"></i>
                            Failed to load comments. Please try again later.
                        </div>
                    `;
                });
        }

        function submitComment() {
            const content = document.getElementById('commentInput').value.trim();
            if (!content) {
                showToast('Please enter a comment', 'danger');
                return;
            }

            const submitButton = document.querySelector('.comment-submit');
            const originalContent = submitButton.innerHTML;
            submitButton.disabled = true;
            submitButton.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';

            const formData = new FormData();
            formData.append('article_id', <?= $article['id'] ?>);
            formData.append('content', content);

            fetch('index.php?controller=comment&action=add', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showToast('Comment posted successfully', 'success');
                    document.getElementById('commentInput').value = '';
                    document.getElementById('charCount').textContent = '0';
                    
            
                    const commentsList = document.getElementById('commentsList');
                    const newComment = `
                        <div class="comment">
                            <div class="comment-header">
                                <div class="d-flex align-items-center gap-2">
                                    <span class="comment-author">${data.comment.user_name}</span>
                                </div>
                                <span class="comment-date">${new Date(data.comment.created_at).toLocaleString()}</span>
                            </div>
                            <div class="comment-content">${data.comment.content}</div>
                        </div>
                    `;
                    
                  
                    if (commentsList.querySelector('.text-muted')) {
                        commentsList.innerHTML = newComment;
                    } else {
                        commentsList.innerHTML = newComment + commentsList.innerHTML;
                    }
                } else {
                    showToast(data.message, 'danger');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showToast('An error occurred while posting the comment', 'danger');
            })
            .finally(() => {
                submitButton.disabled = false;
                submitButton.innerHTML = originalContent;
            });
        }

        function showToast(message, type = 'success') {
            const toast = document.querySelector('.toast');
            toast.classList.remove('bg-success', 'bg-danger');
            toast.classList.add(type === 'success' ? 'bg-success' : 'bg-danger');
            toast.querySelector('.toast-body').textContent = message;
            const bsToast = new bootstrap.Toast(toast);
            bsToast.show();
        }

        document.getElementById('commentInput').addEventListener('input', function() {
            const charCount = this.value.length;
            document.getElementById('charCount').textContent = charCount;
        });
    </script>
</body>
</html>
