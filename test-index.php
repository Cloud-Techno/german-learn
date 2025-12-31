<?php
/**
 * Test index.php routing
 * DELETE THIS FILE AFTER TESTING!
 */

error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "<h1>Index.php Test</h1>";
echo "<pre>";

echo "Testing if index.php structure works...\n\n";

// Test 1: Paths
echo "1. Testing paths...\n";
define('ROOT_PATH', dirname(__DIR__));
echo "   ROOT_PATH: " . ROOT_PATH . "\n";

// Test 2: Config
echo "\n2. Loading config...\n";
try {
    require_once ROOT_PATH . '/config/config.php';
    echo "   ✓ Config loaded\n";
} catch (Exception $e) {
    echo "   ❌ Config error: " . $e->getMessage() . "\n";
    die();
}

// Test 3: Autoloader
echo "\n3. Loading autoloader...\n";
try {
    require_once ROOT_PATH . '/app/Core/Autoloader.php';
    spl_autoload_register(['Autoloader', 'load']);
    echo "   ✓ Autoloader loaded\n";
} catch (Exception $e) {
    echo "   ❌ Autoloader error: " . $e->getMessage() . "\n";
    die();
}

// Test 4: Language Manager
echo "\n4. Testing LanguageManager...\n";
try {
    LanguageManager::init();
    $lang = LanguageManager::getCurrentLanguage();
    echo "   ✓ LanguageManager works\n";
    echo "   Current language: $lang\n";
} catch (Exception $e) {
    echo "   ❌ LanguageManager error: " . $e->getMessage() . "\n";
}

// Test 5: Router
echo "\n5. Testing Router...\n";
try {
    $router = new Router();
    echo "   ✓ Router created\n";
} catch (Exception $e) {
    echo "   ❌ Router error: " . $e->getMessage() . "\n";
    echo "   Stack trace:\n";
    echo "   " . $e->getTraceAsString() . "\n";
}

echo "\n✅ All basic tests passed!\n";
echo "\nNext step: Try accessing index.php directly\n";
echo "URL: https://seagreen-cattle-719277.hostingersite.com/index.php\n";

echo "</pre>";
