<?php
/**
 * Configuration Test
 * Tests if config files are loaded correctly
 * DELETE THIS FILE AFTER TESTING!
 */

error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "<h1>Configuration Test</h1>";
echo "<pre>";

// Test paths
echo "1. Testing paths...\n";
define('ROOT_PATH', dirname(__DIR__));
echo "   ROOT_PATH: " . ROOT_PATH . "\n";

if (file_exists(ROOT_PATH . '/config/config.php')) {
    echo "   ✓ config/config.php exists\n";
    require_once ROOT_PATH . '/config/config.php';
} else {
    echo "   ❌ config/config.php NOT FOUND!\n";
    die();
}

echo "   APP_PATH: " . (defined('APP_PATH') ? APP_PATH : 'NOT DEFINED') . "\n";
echo "   BASE_URL: " . (defined('BASE_URL') ? BASE_URL : 'NOT DEFINED') . "\n\n";

// Test database config
echo "2. Testing database configuration...\n";
if (defined('DB_HOST')) {
    echo "   ✓ DB_HOST: " . DB_HOST . "\n";
} else {
    echo "   ❌ DB_HOST NOT DEFINED\n";
}

if (defined('DB_NAME')) {
    echo "   ✓ DB_NAME: " . DB_NAME . "\n";
} else {
    echo "   ❌ DB_NAME NOT DEFINED\n";
}

if (defined('DB_USER')) {
    echo "   ✓ DB_USER: " . DB_USER . "\n";
} else {
    echo "   ❌ DB_USER NOT DEFINED\n";
}

if (defined('DB_PASS')) {
    echo "   ✓ DB_PASS: " . (empty(DB_PASS) ? '(empty)' : '***set***') . "\n";
} else {
    echo "   ❌ DB_PASS NOT DEFINED\n";
}
echo "\n";

// Test autoloader
echo "3. Testing autoloader...\n";
if (file_exists(ROOT_PATH . '/app/Core/Autoloader.php')) {
    echo "   ✓ Autoloader.php exists\n";
    require_once ROOT_PATH . '/app/Core/Autoloader.php';
    spl_autoload_register(['Autoloader', 'load']);
    echo "   ✓ Autoloader registered\n";
} else {
    echo "   ❌ Autoloader.php NOT FOUND!\n";
}
echo "\n";

// Test core classes
echo "4. Testing core classes...\n";
$classes = ['Database', 'Router', 'Controller', 'LanguageManager'];
foreach ($classes as $class) {
    if (class_exists($class)) {
        echo "   ✓ $class class exists\n";
    } else {
        echo "   ❌ $class class NOT FOUND\n";
    }
}
echo "\n";

// Test file permissions
echo "5. Testing file permissions...\n";
$dirs = [
    ROOT_PATH . '/app',
    ROOT_PATH . '/config',
    ROOT_PATH . '/public'
];
foreach ($dirs as $dir) {
    if (is_readable($dir)) {
        echo "   ✓ $dir is readable\n";
    } else {
        echo "   ❌ $dir is NOT readable\n";
    }
}

echo "</pre>";
echo "<p><strong>⚠️ REMEMBER: Delete this file after testing!</strong></p>";
