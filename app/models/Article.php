<?php
class Article
{
    private $db;

    public function __construct()
    {
        global $databaseConnection;
        $this->db = $databaseConnection;
    }

    public function getLatestAccepted($limit = 5)
    {
        $stmt = $this->db->prepare("
            SELECT a.*, u.name AS author_name,
                (SELECT COUNT(*) FROM articles a2 
                    WHERE a2.id = a.id 
                    AND JSON_CONTAINS(a2.comments, '{\"status\": \"approved\"}', '$[*]')) as comment_count
            FROM articles a 
            JOIN users u ON a.author_id = u.id 
            WHERE a.status = 'accepted' 
            ORDER BY a.created_at DESC 
            LIMIT ?
        ");
        if ($stmt === false) {

            $stmt = $this->db->prepare("
                SELECT a.*, u.name AS author_name,
                    (SELECT COUNT(*) FROM articles a2 
                        WHERE a2.id = a.id 
                        AND a2.comments IS NOT NULL 
                        AND a2.comments != '[]') as comment_count
                FROM articles a 
                JOIN users u ON a.author_id = u.id 
                WHERE a.status = 'accepted' 
                ORDER BY a.created_at DESC 
                LIMIT ?
            ");
        }
        if ($stmt === false) {

            $stmt = $this->db->prepare("
                SELECT a.*, u.name AS author_name, 0 as comment_count
                FROM articles a 
                JOIN users u ON a.author_id = u.id 
                WHERE a.status = 'accepted' 
                ORDER BY a.created_at DESC 
                LIMIT ?
            ");
        }
        if ($stmt === false) {
            throw new Exception("Failed to prepare statement: " . $this->db->error);
        }
        $stmt->bind_param("i", $limit);
        $stmt->execute();
        return $stmt->get_result();
    }
    public function addArticle($title, $body, $keywords, $thumb_url, $author_id)
    {
        $stmt = $this->db->prepare("INSERT INTO articles (title, body, keywords, thumb_url, author_id, status, created_at, updated_at) VALUES (?, ?, ?, ?, ?, 'pending', NOW(), NOW())");
        $stmt->bind_param("ssssi", $title, $body, $keywords, $thumb_url, $author_id);
        $stmt->execute();
    }
    public function getByStatus($status)
    {
        $stmt = $this->db->prepare("SELECT a.*, u.name AS author_name FROM articles a JOIN users u ON a.author_id = u.id WHERE a.status = ? ORDER BY a.created_at DESC");
        $stmt->bind_param("s", $status);
        $stmt->execute();
        return $stmt->get_result();
    }

    public function updateStatus($id, $status)
    {
        $stmt = $this->db->prepare("UPDATE articles SET status = ? WHERE id = ?");
        $stmt->bind_param("si", $status, $id);
        $stmt->execute();
    }

    public function toggleComment($id, $enabled)
    {
        $stmt = $this->db->prepare("UPDATE articles SET comments_enabled = ? WHERE id = ?");
        $stmt->bind_param("ii", $enabled, $id);
        $stmt->execute();
    }
    public function getById($id)
    {
        $stmt = $this->db->prepare("SELECT a.*, u.name AS author_name FROM articles a JOIN users u ON a.author_id = u.id WHERE a.id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }
    public function getByStatusLimit($status, $limit)
    {
        $stmt = $this->db->prepare("SELECT * FROM articles WHERE status = ? ORDER BY created_at DESC LIMIT ?");
        $stmt->bind_param("si", $status, $limit);
        $stmt->execute();
        return $stmt->get_result();
    }

    public function addComment($article_id, $user_id, $content)
    {

        $stmt = $this->db->prepare("SELECT comments FROM articles WHERE id = ?");
        $stmt->bind_param("i", $article_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $article = $result->fetch_assoc();


        $comments = $article['comments'] ? json_decode($article['comments'], true) : [];


        $comments[] = [
            'id' => uniqid(),
            'user_id' => $user_id,
            'content' => $content,
            'created_at' => date('Y-m-d H:i:s'),
            'status' => 'approved'
        ];


        $comments_json = json_encode($comments);
        $stmt = $this->db->prepare("UPDATE articles SET comments = ? WHERE id = ?");
        $stmt->bind_param("si", $comments_json, $article_id);
        return $stmt->execute();
    }

    public function getComments($article_id)
    {
        $stmt = $this->db->prepare("
        SELECT a.comments 
        FROM articles a 
        WHERE a.id = ?
    ");
        $stmt->bind_param("i", $article_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $article = $result->fetch_assoc();

        if (!$article['comments']) {
            return [];
        }

        $comments = json_decode($article['comments'], true);
        if (!$comments) {
            return [];
        }


        $user_ids = array_unique(array_column($comments, 'user_id'));


        $user_names = [];
        if (!empty($user_ids)) {
            $placeholders = str_repeat('?,', count($user_ids) - 1) . '?';
            $stmt = $this->db->prepare("
            SELECT id, name 
            FROM users 
            WHERE id IN ($placeholders)
        ");
            $stmt->bind_param(str_repeat('i', count($user_ids)), ...$user_ids);
            $stmt->execute();
            $result = $stmt->get_result();
            while ($row = $result->fetch_assoc()) {
                $user_names[$row['id']] = $row['name'];
            }
        }


        $comments_with_names = [];
        foreach ($comments as $comment) {
            $comment['user_name'] = $user_names[$comment['user_id']] ?? 'Unknown User';
            $comments_with_names[] = $comment;
        }

        return $comments_with_names;
    }

    public function updateCommentStatus($article_id, $comment_id, $status)
    {

        $stmt = $this->db->prepare("SELECT comments FROM articles WHERE id = ?");
        $stmt->bind_param("i", $article_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $article = $result->fetch_assoc();

        if (!$article['comments']) {
            return false;
        }

        $comments = json_decode($article['comments'], true);


        foreach ($comments as &$comment) {
            if ($comment['id'] === $comment_id) {
                $comment['status'] = $status;
                break;
            }
        }


        $comments_json = json_encode($comments);
        $stmt = $this->db->prepare("UPDATE articles SET comments = ? WHERE id = ?");
        $stmt->bind_param("si", $comments_json, $article_id);
        return $stmt->execute();
    }

    public function deleteComment($article_id, $comment_id)
    {

        $stmt = $this->db->prepare("SELECT comments FROM articles WHERE id = ?");
        $stmt->bind_param("i", $article_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $article = $result->fetch_assoc();

        if (!$article['comments']) {
            return false;
        }

        $comments = json_decode($article['comments'], true);


        $comments = array_filter($comments, function ($comment) use ($comment_id) {
            return $comment['id'] !== $comment_id;
        });

        $comments_json = json_encode(array_values($comments));
        $stmt = $this->db->prepare("UPDATE articles SET comments = ? WHERE id = ?");
        $stmt->bind_param("si", $comments_json, $article_id);
        return $stmt->execute();
    }
}
