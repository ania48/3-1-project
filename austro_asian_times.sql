-- USERS TABLE
CREATE TABLE users (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    password_hash TEXT NOT NULL,
    role ENUM('admin', 'editor', 'journalist', 'reader') NOT NULL
) ENGINE = InnoDB;

-- ARTICLES TABLE
CREATE TABLE articles (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    author_id INT UNSIGNED NOT NULL,
    title VARCHAR(255) NOT NULL,
    body TEXT NOT NULL,
    content TEXT NOT NULL,
    thumb_url VARCHAR(255),
    keywords TEXT,
    comments_enabled TINYINT(1) DEFAULT 1,
    comments JSON DEFAULT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    status ENUM('pending', 'accepted', 'rejected') NOT NULL,
    
    FOREIGN KEY (author_id) REFERENCES users(id) ON DELETE CASCADE
) ENGINE = InnoDB;

-- TAGS TABLE
CREATE TABLE tags (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL UNIQUE
) ENGINE = InnoDB;

-- ARTICLE_TAG PIVOT TABLE
CREATE TABLE article_tag (
    article_id INT UNSIGNED NOT NULL,
    tag_id INT UNSIGNED NOT NULL,
    
    PRIMARY KEY (article_id, tag_id),
    
    FOREIGN KEY (article_id) REFERENCES articles(id) ON DELETE CASCADE,
    FOREIGN KEY (tag_id) REFERENCES tags(id) ON DELETE CASCADE
) ENGINE = InnoDB;

