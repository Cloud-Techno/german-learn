<?php
/**
 * Exam Controller
 * Handles exam preparation pages (TELC, Goethe, etc.)
 */

class ExamController extends Controller
{
    private $adModel;
    
    public function __construct()
    {
        parent::__construct();
        $this->adModel = new AdPositionModel();
    }
    
    /**
     * TELC exam page
     */
    public function telc($params = [])
    {
        $adPositions = $this->adModel->getAdPositions('exam');
        
        $data = [
            'adPositions' => $adPositions,
            'pageTitle' => 'TELC Sınav Hazırlık - TELC Exam Preparation',
            'metaTitle' => 'TELC Sınav Hazırlık | Almanca TELC Sınavına Hazırlan',
            'metaDescription' => 'TELC sınavına hazırlan! Almanca TELC sınavı için hazırlık materyalleri, örnek sorular ve ipuçları.',
            'pageType' => 'exam'
        ];
        
        $this->render('exams/telc', $data);
    }
    
    /**
     * Goethe exam page
     */
    public function goethe($params = [])
    {
        $adPositions = $this->adModel->getAdPositions('exam');
        
        $data = [
            'adPositions' => $adPositions,
            'pageTitle' => 'Goethe Sınav Hazırlık - Goethe Exam Preparation',
            'metaTitle' => 'Goethe Sınav Hazırlık | Goethe Institut Sınavına Hazırlan',
            'metaDescription' => 'Goethe sınavına hazırlan! Goethe Institut Almanca sınavları için hazırlık materyalleri ve kaynaklar.',
            'pageType' => 'exam'
        ];
        
        $this->render('exams/goethe', $data);
    }
    
    /**
     * General exam preparation
     */
    public function preparation($params = [])
    {
        $adPositions = $this->adModel->getAdPositions('exam');
        
        $data = [
            'adPositions' => $adPositions,
            'pageTitle' => 'Sınava Hazırlık - Exam Preparation',
            'metaTitle' => 'Almanca Sınav Hazırlık | Tüm Sınavlar İçin Hazırlık Materyalleri',
            'metaDescription' => 'Almanca sınavlarına hazırlan! TELC, Goethe ve diğer sınavlar için kapsamlı hazırlık materyalleri.',
            'pageType' => 'exam'
        ];
        
        $this->render('exams/preparation', $data);
    }
}
