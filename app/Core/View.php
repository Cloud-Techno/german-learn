<?php
/**
 * View Class
 * Handles view rendering and layout management
 */

class View
{
    private $layout = 'main';
    private static $instance = null;
    
    /**
     * Get view instance (for partial helper)
     */
    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }
    
    /**
     * Render view file
     */
    public function render($viewFile, $data = [])
    {
        // Set instance for partial helper
        self::$instance = $this;
        
        // Extract data to variables
        extract($data);
        
        // Start output buffering
        ob_start();
        
        // Include view file
        $viewPath = VIEWS_PATH . '/' . $viewFile . '.php';
        
        if (!file_exists($viewPath)) {
            throw new Exception("View file not found: {$viewFile}");
        }
        
        include $viewPath;
        
        // Get view content
        $content = ob_get_clean();
        
        // Wrap in layout if layout is set
        if ($this->layout) {
            $layoutPath = VIEWS_PATH . '/layouts/' . $this->layout . '.php';
            if (file_exists($layoutPath)) {
                // Add content to data array for layout
                $data['content'] = $content;
                extract($data);
                ob_start();
                include $layoutPath;
                $content = ob_get_clean();
            }
        }
        
        echo $content;
    }
    
    /**
     * Set layout
     */
    public function setLayout($layout)
    {
        $this->layout = $layout;
    }
    
    /**
     * Include partial view
     */
    public function partial($partialFile, $data = [])
    {
        extract($data);
        $partialPath = VIEWS_PATH . '/partials/' . $partialFile . '.php';
        
        if (file_exists($partialPath)) {
            include $partialPath;
        }
    }
}

/**
 * Helper function for partials (can be used in view files)
 */
if (!function_exists('partial')) {
    function partial($partialFile, $data = [])
    {
        $view = View::getInstance();
        $view->partial($partialFile, $data);
    }
}
