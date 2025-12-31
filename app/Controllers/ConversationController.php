<?php
/**
 * Conversation Controller
 * Handles daily conversation pages
 */

class ConversationController extends Controller
{
    private $adModel;
    
    public function __construct()
    {
        parent::__construct();
        $this->adModel = new AdPositionModel();
    }
    
    /**
     * Daily conversations index
     */
    public function index($params = [])
    {
        $adPositions = $this->adModel->getAdPositions('conversation');
        
        $data = [
            'adPositions' => $adPositions,
            'pageTitle' => 'Günlük Konuşmalar - Daily Conversations',
            'metaTitle' => 'Almanca Günlük Konuşmalar | Pratik Almanca Diyaloglar',
            'metaDescription' => 'Almanca günlük konuşmalar öğren! Gerçek hayat senaryoları, pratik diyaloglar ve konuşma kalıpları.',
            'pageType' => 'conversation'
        ];
        
        $this->render('conversations/index', $data);
    }
}
