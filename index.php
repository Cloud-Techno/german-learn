<?php
/**
 * German Learn Platform - Entry Point
 * Production-ready entry point with proper error handling
 */

// Start output buffering
ob_start();

// Define root path
if (!defined('ROOT_PATH')) {
    define('ROOT_PATH', dirname(__DIR__));
}

// Load configuration
require_once ROOT_PATH . '/config/config.php';

// Load autoloader
require_once ROOT_PATH . '/app/Core/Autoloader.php';

// Initialize autoloader
spl_autoload_register(['Autoloader', 'load']);

// Start session
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Initialize and run application
try {
    $router = new Router();
    $router->dispatch();
} catch (Exception $e) {
    if (APP_DEBUG) {
        die('Error: ' . $e->getMessage() . '<br>File: ' . $e->getFile() . '<br>Line: ' . $e->getLine());
    } else {
        http_response_code(500);
        require_once VIEWS_PATH . '/errors/500.php';
    }
}

ob_end_flush();
