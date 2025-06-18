<?php
require_once __DIR__ . '/../models/Article.php';

class DashboardController {
    public function index() {
        if (!isset($_SESSION['user_id'])) {
            header("Location: index.php?controller=auth&action=login");
            exit;
        }

        $articleModel = new Article();
        $articles = $articleModel->getLatestAccepted(5); // Get last 5 accepted articles

        require __DIR__ . '/../views/dashboard.php';
    }
}
