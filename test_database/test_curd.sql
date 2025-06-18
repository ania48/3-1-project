-- Create: Add new user
INSERT INTO users (name, email, password_hash, role)
VALUES ('testuser', 'testuser@example.com', '$2y$10$123456dummyhashforuser', 'reader');

-- Read: Get inserted user
SELECT * FROM users WHERE name = 'testuser';

-- Update: Update user email
UPDATE users SET email = 'updated@example.com' WHERE name = 'testuser';

-- Delete: Remove test user
DELETE FROM users WHERE name = 'testuser';

-- Create: Add new article
INSERT INTO articles (author_id, title, body, thumb_url, keywords, created_at, updated_at, status, comments_enabled, content)
VALUES (3, 'CRUD Test Article', 'Test article body', 'uploads/test_crud.jpg', 'test,crud', NOW(), NOW(), 'pending', 1, 'Full article content');

-- Read: Get test article
SELECT * FROM articles WHERE title = 'CRUD Test Article';

-- Update: Accept the article
UPDATE articles SET status = 'accepted' WHERE title = 'CRUD Test Article';

-- Delete: Remove the article
DELETE FROM articles WHERE title = 'CRUD Test Article';

-- Toggle comments
UPDATE articles SET comments_enabled = 0 WHERE id = 2;

-- Join test: Get article with tags and author
SELECT a.title, u.name AS author, t.name AS tag
FROM articles a
JOIN users u ON a.author_id = u.id
JOIN article_tag at ON a.id = at.article_id
JOIN tags t ON at.tag_id = t.id;
