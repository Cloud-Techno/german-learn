<?php
/**
 * Database Connection Test
 * This file tests if database connection works
 * DELETE THIS FILE AFTER TESTING!
 */

error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "<h1>Database Connection Test</h1>";
echo "<pre>";

// Load config
define('ROOT_PATH', dirname(__DIR__));
require_once ROOT_PATH . '/config/config.php';
require_once ROOT_PATH . '/app/Core/Autoloader.php';
spl_autoload_register(['Autoloader', 'load']);

echo "1. Config loaded\n";
echo "   DB_HOST: " . DB_HOST . "\n";
echo "   DB_NAME: " . DB_NAME . "\n";
echo "   DB_USER: " . DB_USER . "\n";
echo "   DB_PASS: " . (empty(DB_PASS) ? '(empty)' : '***hidden***') . "\n\n";

// Test Database Connection
try {
    echo "2. Testing database connection...\n";
    $db = Database::getInstance();
    $pdo = $db->getPdo();
    echo "   ✓ Database connection successful!\n\n";
    
    // Test query
    echo "3. Testing query...\n";
    $stmt = $pdo->query("SELECT COUNT(*) as count FROM languages");
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    echo "   ✓ Query successful!\n";
    echo "   Languages count: " . $result['count'] . "\n\n";
    
    // List tables
    echo "4. Listing tables...\n";
    $stmt = $pdo->query("SHOW TABLES");
    $tables = $stmt->fetchAll(PDO::FETCH_COLUMN);
    echo "   Found " . count($tables) . " tables:\n";
    foreach ($tables as $table) {
        echo "   - $table\n";
    }
    echo "\n";
    
    // Test menu items
    echo "5. Testing menu items...\n";
    $menuModel = new MenuModel();
    $menuItems = $menuModel->getMenuItems('tr');
    echo "   ✓ Menu items query successful!\n";
    echo "   Found " . count($menuItems) . " menu items\n\n";
    
    echo "✅ ALL TESTS PASSED! Database is working correctly.\n";
    
} catch (PDOException $e) {
    echo "❌ DATABASE ERROR:\n";
    echo "   Error: " . $e->getMessage() . "\n";
    echo "   Code: " . $e->getCode() . "\n\n";
    echo "Check:\n";
    echo "   - Database credentials in config/config.php\n";
    echo "   - Database exists in Hostinger\n";
    echo "   - Database user has correct permissions\n";
} catch (Exception $e) {
    echo "❌ ERROR:\n";
    echo "   " . $e->getMessage() . "\n";
    echo "   File: " . $e->getFile() . "\n";
    echo "   Line: " . $e->getLine() . "\n";
}

echo "</pre>";
echo "<p><strong>⚠️ REMEMBER: Delete this file after testing!</strong></p>";
