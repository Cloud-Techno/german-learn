<?php
/**
 * Database Configuration - EXAMPLE
 * Copy this file to database.php and fill in your actual values
 * DO NOT commit database.php to version control!
 */

return [
    'host' => $_ENV['DB_HOST'] ?? 'localhost',
    'database' => $_ENV['DB_NAME'] ?? 'your_database_name',
    'username' => $_ENV['DB_USER'] ?? 'your_database_user',
    'password' => $_ENV['DB_PASS'] ?? 'your_database_password',
    'charset' => 'utf8mb4',
    'collation' => 'utf8mb4_unicode_ci',
    'options' => [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8mb4 COLLATE utf8mb4_unicode_ci"
    ]
];
