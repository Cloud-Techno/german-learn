<?php
/**
 * Router Class
 * Handles URL routing and dispatches to controllers
 */

class Router
{
    private $routes = [];
    private $params = [];
    
    /**
     * Initialize router
     */
    public function __construct()
    {
        LanguageManager::init();
        $this->parseRequest();
    }
    
    /**
     * Parse incoming request
     */
    private function parseRequest()
    {
        $requestUri = $_SERVER['REQUEST_URI'] ?? '/';
        $queryString = $_SERVER['QUERY_STRING'] ?? '';
        
        // Remove query string
        $path = str_replace('?' . $queryString, '', $requestUri);
        
        // Remove base path if exists
        $basePath = dirname($_SERVER['SCRIPT_NAME']);
        if ($basePath !== '/') {
            $path = str_replace($basePath, '', $path);
        }
        
        // Remove language prefix
        $path = LanguageManager::removeLanguagePrefix($path);
        $path = '/' . ltrim($path, '/');
        
        // Split path into segments
        $segments = array_filter(explode('/', $path));
        $segments = array_values($segments);
        
        // Determine controller, action, and params
        $controller = !empty($segments[0]) ? $segments[0] : 'home';
        $action = !empty($segments[1]) ? $segments[1] : 'index';
        $this->params = array_slice($segments, 2);
        
        // Store route info
        $this->params['controller'] = $controller;
        $this->params['action'] = $action;
    }
    
    /**
     * Dispatch request to appropriate controller
     */
    public function dispatch()
    {
        $controllerName = $this->params['controller'];
        $actionName = $this->params['action'];
        
        // Convert kebab-case to PascalCase for controller
        $controllerClass = $this->toPascalCase($controllerName) . 'Controller';
        
        // Check if controller exists
        $controllerFile = CONTROLLERS_PATH . '/' . $controllerClass . '.php';
        
        if (!file_exists($controllerFile)) {
            // Try default HomeController
            if ($controllerName !== 'home') {
                $controllerClass = 'HomeController';
                $actionName = 'index';
            } else {
                $this->notFound();
                return;
            }
        }
        
        // Load controller
        require_once CONTROLLERS_PATH . '/' . $controllerClass . '.php';
        
        // Check if class exists
        if (!class_exists($controllerClass)) {
            $this->notFound();
            return;
        }
        
        // Instantiate controller
        $controller = new $controllerClass();
        
        // Check if action method exists
        $actionMethod = $this->toCamelCase($actionName);
        if (!method_exists($controller, $actionMethod)) {
            // Try index action
            if ($actionName !== 'index') {
                $actionMethod = 'index';
                if (!method_exists($controller, $actionMethod)) {
                    $this->notFound();
                    return;
                }
            } else {
                $this->notFound();
                return;
            }
        }
        
        // Call controller action
        call_user_func_array([$controller, $actionMethod], $this->params);
    }
    
    /**
     * Convert string to PascalCase
     */
    private function toPascalCase($string)
    {
        return str_replace(' ', '', ucwords(str_replace('-', ' ', $string)));
    }
    
    /**
     * Convert string to camelCase
     */
    private function toCamelCase($string)
    {
        return lcfirst($this->toPascalCase($string));
    }
    
    /**
     * Handle 404 Not Found
     */
    private function notFound()
    {
        http_response_code(404);
        if (file_exists(VIEWS_PATH . '/errors/404.php')) {
            require_once VIEWS_PATH . '/errors/404.php';
        } else {
            echo '404 - Page Not Found';
        }
        exit;
    }
    
    /**
     * Get route parameters
     */
    public function getParams()
    {
        return $this->params;
    }
}
