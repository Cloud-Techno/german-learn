<?php
/**
 * Home Controller
 * Handles homepage and main navigation
 */

class HomeController extends Controller
{
    private $menuModel;
    private $adModel;
    
    public function __construct()
    {
        parent::__construct();
        $this->menuModel = new MenuModel();
        $this->adModel = new AdPositionModel();
    }
    
    /**
     * Homepage
     */
    public function index($params = [])
    {
        // Get ad positions for homepage
        $adPositions = $this->adModel->getAdPositions('home');
        
        // Prepare page data
        $data = [
            'adPositions' => $adPositions,
            'pageTitle' => 'Almanca Öğren - German Learn',
            'metaTitle' => 'Almanca Öğren | Ücretsiz Almanca Dersleri ve Kelime Öğrenme',
            'metaDescription' => 'Almanca öğrenmeye başla! Ücretsiz gramer dersleri, kelime öğrenme, günlük konuşmalar ve sınav hazırlık materyalleri. A1\'den C1\'e kadar tüm seviyeler.',
            'pageType' => 'home'
        ];
        
        $this->render('home/index', $data);
    }
}
