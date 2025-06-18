<?php
require_once __DIR__ . '/../models/Article.php';

class ArticleController {
    

    public function add() {
        if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'journalist') {
            header("Location: index.php?controller=dashboard&action=index");
            exit;
        }

        $success = $_GET['success'] ?? null;
        require __DIR__ . '/../views/add_article.php';
    }

    public function store() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = $_POST['title'] ?? '';
            $body = $_POST['body'] ?? '';
            $keywords = $_POST['keywords'] ?? '';
            $author_id = $_SESSION['user_id'];
            $thumb_url = null;

            if (!empty($_FILES['image']['name'])) {
                $uploadDir = __DIR__ . '/../../uploads/';
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0777, true);
                }
                $imageName = time() . '_' . basename($_FILES['image']['name']);
                $targetFile = $uploadDir . $imageName;
                if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {
                    $thumb_url = 'uploads/' . $imageName;
                }
            }

            $articleModel = new Article();
            $articleModel->addArticle($title, $body, $keywords, $thumb_url, $author_id);

            header("Location: index.php?controller=article&action=add&success=1");
            exit;
        }
    }
}
