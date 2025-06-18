<?php
require_once __DIR__ . '/../models/Article.php';

class ViewController {
    public function show() {
        if (!isset($_GET['id'])) {
            echo "Invalid article ID.";
            return;
        }

        $id = (int)$_GET['id'];
        $articleModel = new Article();
        $article = $articleModel->getById($id);

        if (!$article) {
            echo "Article not found.";
            return;
        }

        require __DIR__ . '/../views/view_article.php';
    }
}
