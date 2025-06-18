<?php
require_once __DIR__ . '/../models/Article.php';

class DashboardController {
    public function index() {
        if (!isset($_SESSION['user_id'])) {
            header("Location: index.php?controller=auth&action=login");
            exit;
        }

        $articleModel = new Article();
        
        // Get search query from GET parameters
        $search = $_GET['search'] ?? '';
        
        if (!empty($search)) {
            // If search is provided, get filtered articles
            $articles = $articleModel->searchArticles($search, 5);
        } else {
            // Otherwise get latest accepted articles
            $articles = $articleModel->getLatestAccepted(5);
        }

        require __DIR__ . '/../views/dashboard.php';
    }
}
