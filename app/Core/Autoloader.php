<?php
/**
 * Autoloader Class
 * PSR-4 compatible autoloader
 */

class Autoloader
{
    /**
     * Register autoloader
     */
    public static function load($className)
    {
        // Convert namespace to path
        $namespace = '';
        $className = ltrim($className, '\\');
        
        if ($lastNsPos = strrpos($className, '\\')) {
            $namespace = substr($className, 0, $lastNsPos);
            $className = substr($className, $lastNsPos + 1);
        }
        
        // Base path
        $basePath = APP_PATH . '/';
        
        // Convert namespace to directory path
        $namespacePath = str_replace('\\', DIRECTORY_SEPARATOR, $namespace);
        
        // Build full path
        $filePath = $basePath . $namespacePath . DIRECTORY_SEPARATOR . $className . '.php';
        
        // If file exists, require it
        if (file_exists($filePath)) {
            require_once $filePath;
            return true;
        }
        
        // Try alternative paths (for classes without namespace)
        $alternativePaths = [
            APP_PATH . '/Core/' . $className . '.php',
            APP_PATH . '/Controllers/' . $className . '.php',
            APP_PATH . '/Models/' . $className . '.php',
            APP_PATH . '/Views/' . $className . '.php',
        ];
        
        foreach ($alternativePaths as $path) {
            if (file_exists($path)) {
                require_once $path;
                return true;
            }
        }
        
        return false;
    }
}
