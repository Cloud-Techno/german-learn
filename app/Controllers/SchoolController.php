<?php
/**
 * School Controller
 * Handles school German pages
 */

class SchoolController extends Controller
{
    private $adModel;
    
    public function __construct()
    {
        parent::__construct();
        $this->adModel = new AdPositionModel();
    }
    
    /**
     * School German index
     */
    public function index($params = [])
    {
        $adPositions = $this->adModel->getAdPositions('school');
        
        $data = [
            'adPositions' => $adPositions,
            'pageTitle' => 'Okul Almancası - School German',
            'metaTitle' => 'Okul Almancası | Lise ve Üniversite İçin Almanca',
            'metaDescription' => 'Okul Almancası dersleri! Lise ve üniversite öğrencileri için Almanca dersleri, gramer ve kelime çalışmaları.',
            'pageType' => 'school'
        ];
        
        $this->render('school/index', $data);
    }
}
