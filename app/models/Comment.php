<?php
class Comment {
    private $db;

    public function __construct() {
        global $databaseConnection;
        $this->db = $databaseConnection;
    }

    public function addComment($article_id, $user_id, $content) {
        $stmt = $this->db->prepare("INSERT INTO comments (article_id, user_id, content) VALUES (?, ?, ?)");
        $stmt->bind_param("iis", $article_id, $user_id, $content);
        return $stmt->execute();
    }

    public function getCommentsByArticle($article_id) {
        $stmt = $this->db->prepare("
            SELECT c.*, u.name as user_name 
            FROM comments c 
            JOIN users u ON c.user_id = u.id 
            WHERE c.article_id = ? AND c.status = 'approved'
            ORDER BY c.created_at DESC
        ");
        $stmt->bind_param("i", $article_id);
        $stmt->execute();
        return $stmt->get_result();
    }

    public function updateStatus($id, $status) {
        $stmt = $this->db->prepare("UPDATE comments SET status = ? WHERE id = ?");
        $stmt->bind_param("si", $status, $id);
        return $stmt->execute();
    }

    public function getPendingComments() {
        $stmt = $this->db->prepare("
            SELECT c.*, u.name as user_name, a.title as article_title 
            FROM comments c 
            JOIN users u ON c.user_id = u.id 
            JOIN articles a ON c.article_id = a.id 
            WHERE c.status = 'pending'
            ORDER BY c.created_at DESC
        ");
        $stmt->execute();
        return $stmt->get_result();
    }

    public function deleteComment($id) {
        $stmt = $this->db->prepare("DELETE FROM comments WHERE id = ?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
} 