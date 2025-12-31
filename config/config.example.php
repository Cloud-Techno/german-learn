<?php
/**
 * Main Configuration File - EXAMPLE
 * Copy this file to config.php and fill in your actual values
 * DO NOT commit config.php to version control!
 */

// Prevent direct access
if (!defined('ROOT_PATH')) {
    define('ROOT_PATH', dirname(__DIR__));
}

// Application settings
define('APP_NAME', 'German Learn');
define('APP_VERSION', '1.0.0');
define('APP_ENV', 'production'); // development, production
define('APP_DEBUG', false);

// Base URL - Auto-detect
$protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http';
$host = $_SERVER['HTTP_HOST'] ?? 'localhost';
$scriptPath = dirname($_SERVER['SCRIPT_NAME']);
define('BASE_URL', $protocol . '://' . $host . ($scriptPath !== '/' ? rtrim($scriptPath, '/') : ''));

// Paths
define('APP_PATH', ROOT_PATH . '/app');
define('CONFIG_PATH', ROOT_PATH . '/config');
define('PUBLIC_PATH', ROOT_PATH . '/public');
define('VIEWS_PATH', APP_PATH . '/Views');
define('MODELS_PATH', APP_PATH . '/Models');
define('CONTROLLERS_PATH', APP_PATH . '/Controllers');

// Database Configuration
// IMPORTANT: Replace these with your actual database credentials
define('DB_HOST', $_ENV['DB_HOST'] ?? 'localhost');
define('DB_NAME', $_ENV['DB_NAME'] ?? 'your_database_name');
define('DB_USER', $_ENV['DB_USER'] ?? 'your_database_user');
define('DB_PASS', $_ENV['DB_PASS'] ?? 'your_database_password');
define('DB_CHARSET', 'utf8mb4');
define('DB_COLLATION', 'utf8mb4_unicode_ci');

// Supported Languages (ISO 639-1 codes)
define('SUPPORTED_LANGUAGES', [
    'de' => ['code' => 'de', 'name' => 'Deutsch', 'native' => 'Deutsch', 'flag' => '🇩🇪'],
    'en' => ['code' => 'en', 'name' => 'English', 'native' => 'English', 'flag' => '🇬🇧'],
    'tr' => ['code' => 'tr', 'name' => 'Turkish', 'native' => 'Türkçe', 'flag' => '🇹🇷'],
    'pl' => ['code' => 'pl', 'name' => 'Polish', 'native' => 'Polski', 'flag' => '🇵🇱'],
    'ru' => ['code' => 'ru', 'name' => 'Russian', 'native' => 'Русский', 'flag' => '🇷🇺'],
]);

// Default language
define('DEFAULT_LANGUAGE', 'tr');

// URL routing pattern
define('LANG_ROUTE_PATTERN', '/^\/(' . implode('|', array_keys(SUPPORTED_LANGUAGES)) . ')(\/|$)/');

// Timezone
date_default_timezone_set('Europe/Istanbul');

// Error reporting (production: off, development: on)
if (APP_DEBUG) {
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
} else {
    error_reporting(0);
    ini_set('display_errors', 0);
}

// Session configuration
ini_set('session.cookie_httponly', 1);
ini_set('session.use_only_cookies', 1);
ini_set('session.cookie_secure', $protocol === 'https' ? 1 : 0);
