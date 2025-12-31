<?php
/**
 * Grammar Controller
 * Handles grammar pages (levels, topics, content)
 */

class GrammarController extends Controller
{
    private $grammarModel;
    private $adModel;
    
    public function __construct()
    {
        parent::__construct();
        $this->grammarModel = new GrammarModel();
        $this->adModel = new AdPositionModel();
    }
    
    /**
     * Grammar index - List all levels
     */
    public function index($params = [])
    {
        $levels = $this->grammarModel->getLevels();
        $adPositions = $this->adModel->getAdPositions('grammar');
        
        $data = [
            'levels' => $levels,
            'adPositions' => $adPositions,
            'pageTitle' => 'Almanca Gramer - German Grammar',
            'metaTitle' => 'Almanca Gramer Dersleri | A1-C1 Seviye Gramer Konuları',
            'metaDescription' => 'Almanca gramer öğren! A1\'den C1\'e kadar tüm seviyelerde detaylı gramer dersleri, örnekler ve açıklamalar.',
            'pageType' => 'grammar'
        ];
        
        $this->render('grammar/index', $data);
    }
    
    /**
     * Show topics for a level
     */
    public function level($params = [])
    {
        $levelCode = $params[0] ?? null;
        
        if (!$levelCode) {
            $this->redirect(LanguageManager::url('grammar'));
        }
        
        $level = $this->grammarModel->getLevelByCode($levelCode);
        
        if (!$level) {
            http_response_code(404);
            require_once VIEWS_PATH . '/errors/404.php';
            exit;
        }
        
        $topics = $this->grammarModel->getTopicsWithContentCount($level['id'], $this->language);
        $adPositions = $this->adModel->getAdPositions('grammar');
        
        $data = [
            'level' => $level,
            'topics' => $topics,
            'adPositions' => $adPositions,
            'pageTitle' => $level['name'] . ' - Almanca Gramer',
            'metaTitle' => $level['name'] . ' Gramer Konuları | Almanca Öğren',
            'metaDescription' => $level['description'] ?? $level['name'] . ' seviyesi için Almanca gramer konuları ve dersleri.',
            'pageType' => 'grammar'
        ];
        
        $this->render('grammar/level', $data);
    }
    
    /**
     * Show grammar topic content
     */
    public function topic($params = [])
    {
        $levelCode = $params[0] ?? null;
        $topicSlug = $params[1] ?? null;
        
        if (!$levelCode || !$topicSlug) {
            $this->redirect(LanguageManager::url('grammar'));
        }
        
        // Get level
        $level = $this->grammarModel->getLevelByCode($levelCode);
        if (!$level) {
            http_response_code(404);
            require_once VIEWS_PATH . '/errors/404.php';
            exit;
        }
        
        // Get topic
        $topic = $this->grammarModel->getTopicBySlug($topicSlug);
        if (!$topic || $topic['level_id'] != $level['id']) {
            http_response_code(404);
            require_once VIEWS_PATH . '/errors/404.php';
            exit;
        }
        
        // Get content
        $content = $this->grammarModel->getContentByTopic($topic['id'], $this->language);
        if (!$content) {
            // Content not available in this language, try default language
            $content = $this->grammarModel->getContentByTopic($topic['id'], DEFAULT_LANGUAGE);
            if (!$content) {
                http_response_code(404);
                require_once VIEWS_PATH . '/errors/404.php';
                exit;
            }
        }
        
        // Get examples
        $examples = $this->grammarModel->getExamplesByTopic($topic['id'], $this->language);
        
        // Increment view count
        $this->grammarModel->incrementViewCount($topic['id']);
        
        // Get ad positions
        $adPositions = $this->adModel->getAdPositions('grammar');
        
        $data = [
            'level' => $level,
            'topic' => $topic,
            'content' => $content,
            'examples' => $examples,
            'adPositions' => $adPositions,
            'pageTitle' => $content['title'] . ' - ' . $level['name'],
            'metaTitle' => $content['meta_title'] ?? $content['title'],
            'metaDescription' => $content['meta_description'] ?? $content['description'],
            'metaKeywords' => $content['meta_keywords'] ?? '',
            'pageType' => 'grammar'
        ];
        
        $this->render('grammar/topic', $data);
    }
}
