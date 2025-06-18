<?php
require_once __DIR__ . '/../models/Article.php';

class CommentController {
    public function add() {
        if (!isset($_SESSION['user_id'])) {
            header('Content-Type: application/json');
            echo json_encode(['success' => false, 'message' => 'Please login to comment']);
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $article_id = (int)$_POST['article_id'];
            $content = trim($_POST['content']);
            $user_id = $_SESSION['user_id'];

            $articleModel = new Article();
            $article = $articleModel->getById($article_id);

            if (!$article) {
                header('Content-Type: application/json');
                echo json_encode(['success' => false, 'message' => 'Article not found']);
                exit;
            }

            if ($article['status'] === 'pending') {
                header('Content-Type: application/json');
                echo json_encode(['success' => false, 'message' => 'Comments are not allowed on pending articles']);
                exit;
            }

            if (!$article['comments_enabled']) {
                header('Content-Type: application/json');
                echo json_encode(['success' => false, 'message' => 'Comments are disabled for this article']);
                exit;
            }

            if (empty($content)) {
                header('Content-Type: application/json');
                echo json_encode(['success' => false, 'message' => 'Comment cannot be empty']);
                exit;
            }

            if ($articleModel->addComment($article_id, $user_id, $content)) {
                header('Content-Type: application/json');
                echo json_encode([
                    'success' => true, 
                    'message' => 'Comment posted successfully',
                    'comment' => [
                        'user_name' => $_SESSION['name'],
                        'content' => $content,
                        'created_at' => date('Y-m-d H:i:s')
                    ]
                ]);
            } else {
                header('Content-Type: application/json');
                echo json_encode(['success' => false, 'message' => 'Failed to post comment']);
            }
            exit;
        }
    }

    public function getComments() {
        if (!isset($_GET['article_id'])) {
            header('Content-Type: application/json');
            echo json_encode(['success' => false, 'message' => 'Article ID is required']);
            exit;
        }

        $article_id = (int)$_GET['article_id'];
        $articleModel = new Article();

        $article = $articleModel->getById($article_id);
        if (!$article || $article['status'] === 'pending') {
            header('Content-Type: application/json');
            echo json_encode(['success' => true, 'comments' => []]);
            exit;
        }

        $comments = $articleModel->getComments($article_id);
        header('Content-Type: application/json');
        echo json_encode(['success' => true, 'comments' => $comments]);
    }

    public function process() {
        if (!isset($_SESSION['user_id']) || !in_array($_SESSION['role'], ['admin', 'editor'])) {
            header('Content-Type: application/json');
            echo json_encode(['success' => false, 'message' => 'Unauthorized']);
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $article_id = (int)$_POST['article_id'];
            $comment_id = $_POST['comment_id'];
            $action = $_POST['action'];

            $articleModel = new Article();
            $success = false;

            switch ($action) {
                case 'approve':
                    $success = $articleModel->updateCommentStatus($article_id, $comment_id, 'approved');
                    break;
                case 'reject':
                    $success = $articleModel->updateCommentStatus($article_id, $comment_id, 'rejected');
                    break;
                case 'delete':
                    $success = $articleModel->deleteComment($article_id, $comment_id);
                    break;
            }

            header('Content-Type: application/json');
            echo json_encode(['success' => $success]);
        }
    }
} 