<?php
/**
 * Base Controller Class
 * All controllers extend this class
 */

class Controller
{
    protected $db;
    protected $view;
    protected $language;
    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->db = Database::getInstance();
        $this->view = new View();
        $this->language = LanguageManager::getCurrentLanguage();
    }
    
    /**
     * Render view
     */
    protected function render($viewFile, $data = [])
    {
        // Add common data to all views
        $menuModel = new MenuModel();
        $data['currentLanguage'] = $this->language;
        $data['languageData'] = LanguageManager::getCurrentLanguageData();
        $data['supportedLanguages'] = LanguageManager::getSupportedLanguages();
        $data['baseUrl'] = BASE_URL;
        $data['appName'] = APP_NAME;
        $data['menuItems'] = $menuModel->getMenuItems($this->language);
        
        return $this->view->render($viewFile, $data);
    }
    
    /**
     * Redirect to URL
     */
    protected function redirect($url, $code = 302)
    {
        header('Location: ' . $url, true, $code);
        exit;
    }
    
    /**
     * Return JSON response
     */
    protected function json($data, $statusCode = 200)
    {
        http_response_code($statusCode);
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        exit;
    }
    
    /**
     * Get request parameter
     */
    protected function getParam($key, $default = null)
    {
        return $_GET[$key] ?? $default;
    }
    
    /**
     * Get POST parameter
     */
    protected function postParam($key, $default = null)
    {
        return $_POST[$key] ?? $default;
    }
}
