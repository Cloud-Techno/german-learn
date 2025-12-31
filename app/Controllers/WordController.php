<?php
/**
 * Word Controller
 * Handles word learning pages
 */

class WordController extends Controller
{
    private $wordModel;
    private $adModel;
    
    public function __construct()
    {
        parent::__construct();
        $this->wordModel = new WordModel();
        $this->adModel = new AdPositionModel();
    }
    
    /**
     * Words index - List all word levels
     */
    public function index($params = [])
    {
        $levels = $this->wordModel->getLevels();
        $adPositions = $this->adModel->getAdPositions('words');
        
        $data = [
            'levels' => $levels,
            'adPositions' => $adPositions,
            'pageTitle' => 'Almanca Kelimeler - German Words',
            'metaTitle' => 'Almanca Kelime Öğren | A1-B1 ve B2-C1 Seviye Kelimeler',
            'metaDescription' => 'Almanca kelime öğren! Seviye bazlı kelime listeleri, çeviriler, örnek cümleler ve kullanım notları.',
            'pageType' => 'words'
        ];
        
        $this->render('words/index', $data);
    }
    
    /**
     * Show words for a level
     */
    public function level($params = [])
    {
        $levelCode = $params[0] ?? null;
        
        if (!$levelCode) {
            $this->redirect(LanguageManager::url('words'));
        }
        
        $level = $this->wordModel->getLevelByCode($levelCode);
        
        if (!$level) {
            http_response_code(404);
            require_once VIEWS_PATH . '/errors/404.php';
            exit;
        }
        
        // Pagination
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $perPage = 50; // Words per page
        $offset = ($page - 1) * $perPage;
        
        // Get words
        $words = $this->wordModel->getWordsByLevel($level['id'], $this->language, $perPage, $offset);
        $totalWords = $this->wordModel->getWordCountByLevel($level['id']);
        $totalPages = ceil($totalWords / $perPage);
        
        // Get ad positions
        $adPositions = $this->adModel->getAdPositions('words');
        
        $data = [
            'level' => $level,
            'words' => $words,
            'page' => $page,
            'totalPages' => $totalPages,
            'totalWords' => $totalWords,
            'adPositions' => $adPositions,
            'pageTitle' => $level['name'] . ' - Almanca Kelimeler',
            'metaTitle' => $level['name'] . ' Kelime Listesi | Almanca Öğren',
            'metaDescription' => $level['description'] ?? $level['name'] . ' seviyesi için Almanca kelime listesi ve çevirileri.',
            'pageType' => 'words'
        ];
        
        $this->render('words/level', $data);
    }
    
    /**
     * Show single word detail
     */
    public function detail($params = [])
    {
        $wordId = isset($params[0]) ? (int)$params[0] : null;
        
        if (!$wordId) {
            $this->redirect(LanguageManager::url('words'));
        }
        
        $word = $this->wordModel->getWordById($wordId, $this->language);
        
        if (!$word) {
            http_response_code(404);
            require_once VIEWS_PATH . '/errors/404.php';
            exit;
        }
        
        // Get all translations
        $translations = $this->wordModel->getWordTranslations($wordId);
        
        // Get examples
        $examples = $this->wordModel->getExamplesByWord($wordId, $this->language);
        
        // Increment view count
        $this->wordModel->incrementViewCount($wordId);
        
        // Get ad positions
        $adPositions = $this->adModel->getAdPositions('words');
        
        $data = [
            'word' => $word,
            'translations' => $translations,
            'examples' => $examples,
            'adPositions' => $adPositions,
            'pageTitle' => $word['german_word'] . ' - Almanca Kelime',
            'metaTitle' => $word['german_word'] . ' Anlamı ve Kullanımı | Almanca Öğren',
            'metaDescription' => $word['german_word'] . ' kelimesinin anlamı, çevirisi, örnek cümleler ve kullanım notları.',
            'pageType' => 'words'
        ];
        
        $this->render('words/detail', $data);
    }
}
