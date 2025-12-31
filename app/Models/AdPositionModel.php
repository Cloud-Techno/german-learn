<?php
/**
 * Ad Position Model
 * Manages Google AdSense ad placements
 */

class AdPositionModel extends Model
{
    public function __construct()
    {
        parent::__construct();
    }
    
    /**
     * Get active ad positions for a page type
     */
    public function getAdPositions($pageType = null)
    {
        $sql = "SELECT * FROM ads_positions WHERE is_active = 1";
        $params = [];
        
        if ($pageType !== null) {
            $sql .= " AND (page_type = :page_type OR page_type IS NULL)";
            $params['page_type'] = $pageType;
        }
        
        $sql .= " ORDER BY display_order ASC";
        
        return $this->fetchAll($sql, $params);
    }
    
    /**
     * Get ad position by code
     */
    public function getAdByPosition($positionCode, $pageType = null)
    {
        $sql = "SELECT * FROM ads_positions 
                WHERE position_code = :position_code AND is_active = 1";
        $params = ['position_code' => $positionCode];
        
        if ($pageType !== null) {
            $sql .= " AND (page_type = :page_type OR page_type IS NULL)";
            $params['page_type'] = $pageType;
        }
        
        $sql .= " ORDER BY page_type DESC LIMIT 1"; // Prefer page-specific over general
        
        return $this->fetchOne($sql, $params);
    }
}
