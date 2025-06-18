-- Insert sample users
INSERT INTO users (name, email, password_hash, role)
VALUES 
('adminuser', 'admin@example.com', '$2y$10$abc123hashedpasswordforadmin', 'admin'),
('editoruser', 'editor@example.com', '$2y$10$def456hashedpasswordforeditor', 'editor'),
('journalist1', 'journalist1@example.com', '$2y$10$ghi789hashedpasswordforjournalist', 'journalist'),
('reader1', 'reader1@example.com', '$2y$10$jkl000hashedpasswordforreader', 'reader');

-- Insert sample tags
INSERT INTO tags (name)
VALUES ('Politics'), ('Technology'), ('Health'), ('Education');

-- Insert sample articles
INSERT INTO articles (author_id, title, body, thumb_url, keywords, created_at, updated_at, status, comments_enabled, content)
VALUES
(3, 'Sample Article 1', 'This is a test article body.', 'uploads/sample1.jpg', 'politics,news', NOW(), NOW(), 'pending', 1, 'Detailed content for article 1'),
(3, 'Sample Article 2', 'Another article example.', 'uploads/sample2.jpg', 'tech,ai', NOW(), NOW(), 'accepted', 1, 'Detailed content for article 2');

-- Assign tags to articles
INSERT INTO article_tag (article_id, tag_id)
VALUES
(1, 1),
(1, 4),
(2, 2);
