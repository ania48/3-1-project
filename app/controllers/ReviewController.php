<?php
require_once __DIR__ . '/../models/Article.php';

class ReviewController {
    public function index() {
        if (!isset($_SESSION['user_id']) || !in_array($_SESSION['role'], ['admin', 'editor'])) {
            header("Location: index.php?controller=dashboard&action=index");
            exit;
        }

        $article = new Article();
        $pending = $article->getByStatus('pending');
        $approved = $article->getByStatus('accepted');

        require __DIR__ . '/../views/review.php';
    }

    public function process() {
        if (!isset($_SESSION['user_id']) || !in_array($_SESSION['role'], ['admin', 'editor'])) {
            header("Location: index.php?controller=dashboard&action=index");
            exit;
        }

        $article = new Article();
        $id = (int)($_GET['id'] ?? 0);

        if (isset($_GET['do'])) {
            switch ($_GET['do']) {
                case 'accept':
                    $article->updateStatus($id, 'accepted');
                    break;
                case 'reject':
                    $article->updateStatus($id, 'rejected');
                    break;
                case 'enable_comment':
                    $article->toggleComment($id, 1);
                    break;
                case 'disable_comment':
                    $article->toggleComment($id, 0);
                    break;
            }
        }

        header("Location: index.php?controller=review&action=index#approved");
        exit;
    }
}
