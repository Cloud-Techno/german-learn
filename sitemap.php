<?php
/**
 * Sitemap Generator
 * Dynamically generates sitemap.xml for all pages and content
 */

header('Content-Type: application/xml; charset=utf-8');

// Load configuration
if (!defined('ROOT_PATH')) {
    define('ROOT_PATH', dirname(__DIR__));
}
require_once ROOT_PATH . '/config/config.php';
require_once ROOT_PATH . '/app/Core/Autoloader.php';
spl_autoload_register(['Autoloader', 'load']);

$db = Database::getInstance();
$languages = SUPPORTED_LANGUAGES;

echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"' . "\n";
echo '        xmlns:xhtml="http://www.w3.org/1999/xhtml">' . "\n";

// Homepage for each language
foreach ($languages as $langCode => $lang) {
    echo '  <url>' . "\n";
    echo '    <loc>' . htmlspecialchars(BASE_URL . '/' . $langCode) . '</loc>' . "\n";
    echo '    <changefreq>daily</changefreq>' . "\n";
    echo '    <priority>1.0</priority>' . "\n";
    
    // Add hreflang alternatives
    foreach ($languages as $altLang => $altLangData) {
        echo '    <xhtml:link rel="alternate" hreflang="' . $altLang . '" href="' . htmlspecialchars(BASE_URL . '/' . $altLang) . '"/>' . "\n";
    }
    
    echo '  </url>' . "\n";
}

// Static pages (grammar index, words index, etc.)
$staticPages = [
    'grammar',
    'words',
    'daily-conversations',
    'exam-preparation',
    'exams/telc',
    'exams/goethe',
    'school'
];

foreach ($staticPages as $page) {
    foreach ($languages as $langCode => $lang) {
        echo '  <url>' . "\n";
        echo '    <loc>' . htmlspecialchars(BASE_URL . '/' . $langCode . '/' . $page) . '</loc>' . "\n";
        echo '    <changefreq>weekly</changefreq>' . "\n";
        echo '    <priority>0.8</priority>' . "\n";
        echo '  </url>' . "\n";
    }
}

// Grammar topics (dynamically from database)
try {
    $grammarModel = new GrammarModel();
    $levels = $grammarModel->getLevels();
    
    foreach ($levels as $level) {
        $topics = $grammarModel->getTopicsByLevel($level['id']);
        
        foreach ($topics as $topic) {
            foreach ($languages as $langCode => $lang) {
                $content = $grammarModel->getContentByTopic($topic['id'], $langCode);
                if ($content) {
                    echo '  <url>' . "\n";
                    echo '    <loc>' . htmlspecialchars(BASE_URL . '/' . $langCode . '/grammar/' . $level['code'] . '/' . $topic['slug']) . '</loc>' . "\n";
                    echo '    <changefreq>monthly</changefreq>' . "\n";
                    echo '    <priority>0.7</priority>' . "\n";
                    echo '  </url>' . "\n";
                }
            }
        }
    }
} catch (Exception $e) {
    // Skip if database not available
}

// Word pages
try {
    $wordModel = new WordModel();
    $wordLevels = $wordModel->getLevels();
    
    foreach ($wordLevels as $level) {
        foreach ($languages as $langCode => $lang) {
            echo '  <url>' . "\n";
            echo '    <loc>' . htmlspecialchars(BASE_URL . '/' . $langCode . '/words/level/' . $level['code']) . '</loc>' . "\n";
            echo '    <changefreq>weekly</changefreq>' . "\n";
            echo '    <priority>0.8</priority>' . "\n";
            echo '  </url>' . "\n";
        }
    }
} catch (Exception $e) {
    // Skip if database not available
}

echo '</urlset>';
