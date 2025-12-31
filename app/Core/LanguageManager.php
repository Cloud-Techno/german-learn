<?php
/**
 * Language Manager
 * Handles multi-language support, URL routing, and translations
 */

class LanguageManager
{
    private static $currentLanguage = null;
    private static $supportedLanguages = [];
    
    /**
     * Initialize language system
     */
    public static function init()
    {
        self::$supportedLanguages = SUPPORTED_LANGUAGES;
        self::$currentLanguage = self::detectLanguage();
    }
    
    /**
     * Detect current language from URL
     */
    private static function detectLanguage()
    {
        $requestUri = $_SERVER['REQUEST_URI'] ?? '/';
        
        // Extract language from URL (/tr/, /en/, etc.)
        if (preg_match(LANG_ROUTE_PATTERN, $requestUri, $matches)) {
            $langCode = $matches[1];
            if (isset(self::$supportedLanguages[$langCode])) {
                return $langCode;
            }
        }
        
        // Try to detect from browser (optional - can be disabled)
        // For now, default to DEFAULT_LANGUAGE
        
        return DEFAULT_LANGUAGE;
    }
    
    /**
     * Get current language code
     */
    public static function getCurrentLanguage()
    {
        if (self::$currentLanguage === null) {
            self::init();
        }
        return self::$currentLanguage;
    }
    
    /**
     * Get current language data
     */
    public static function getCurrentLanguageData()
    {
        $lang = self::getCurrentLanguage();
        return self::$supportedLanguages[$lang] ?? self::$supportedLanguages[DEFAULT_LANGUAGE];
    }
    
    /**
     * Get all supported languages
     */
    public static function getSupportedLanguages()
    {
        return self::$supportedLanguages;
    }
    
    /**
     * Generate URL with language prefix
     */
    public static function url($path = '', $lang = null)
    {
        $lang = $lang ?? self::getCurrentLanguage();
        $path = ltrim($path, '/');
        
        // Remove existing language prefix if present
        $path = preg_replace(LANG_ROUTE_PATTERN, '', $path);
        $path = ltrim($path, '/');
        
        return BASE_URL . '/' . $lang . ($path ? '/' . $path : '');
    }
    
    /**
     * Generate hreflang tags for SEO
     */
    public static function getHreflangTags($route = '')
    {
        $tags = [];
        $currentPath = $_SERVER['REQUEST_URI'] ?? '/';
        
        // Remove language prefix to get base path
        $basePath = preg_replace(LANG_ROUTE_PATTERN, '', $currentPath);
        $basePath = ltrim($basePath, '/');
        
        foreach (self::$supportedLanguages as $code => $langData) {
            $url = BASE_URL . '/' . $code . ($basePath ? '/' . $basePath : '');
            $tags[] = '<link rel="alternate" hreflang="' . $code . '" href="' . htmlspecialchars($url) . '">';
        }
        
        // Add x-default
        $defaultUrl = BASE_URL . '/' . DEFAULT_LANGUAGE . ($basePath ? '/' . $basePath : '');
        $tags[] = '<link rel="alternate" hreflang="x-default" href="' . htmlspecialchars($defaultUrl) . '">';
        
        return implode("\n    ", $tags);
    }
    
    /**
     * Remove language prefix from path
     */
    public static function removeLanguagePrefix($path)
    {
        return preg_replace(LANG_ROUTE_PATTERN, '', $path);
    }
}
