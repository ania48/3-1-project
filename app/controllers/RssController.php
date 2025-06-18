<?php
require_once __DIR__ . '/../models/Article.php';

class RssController {
    public function index() {

        if (!isset($_SESSION['user_id'])) {
            header("Location: index.php?controller=auth&action=login");
            exit;
        }

        header("Content-Type: application/rss+xml; charset=UTF-8");
        $article = new Article();
        $articles = $article->getByStatusLimit('accepted', 10);

        ob_start();
        ?>
<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<rss version="2.0">
<channel>
    <title>Austro-Asian Times - Latest Articles</title>
    <link>http://yourwebsite.com/</link>
    <description>Latest articles from Austro-Asian Times</description>
    <language>en-us</language>
    <lastBuildDate><?= date(DATE_RSS) ?></lastBuildDate>

    <?php while ($row = $articles->fetch_assoc()): 
        $articleUrl = "http://yourwebsite.com/index.php?controller=view&action=show&id=" . $row['id'];
    ?>
    <item>
        <title><?= htmlspecialchars($row['title']) ?></title>
        <link><?= $articleUrl ?></link>
        <description><?= htmlspecialchars($row['keywords']) ?></description>
        <pubDate><?= date(DATE_RSS, strtotime($row['created_at'])) ?></pubDate>
        <guid><?= $articleUrl ?></guid>
    </item>
    <?php endwhile; ?>
</channel>
</rss>
        <?php
        $xml = ob_get_clean();
        echo $xml;
    }
}
