<?php
/**
 * Menu Model
 * Handles menu items and translations
 */

class MenuModel extends Model
{
    public function __construct()
    {
        parent::__construct();
    }
    
    /**
     * Get all menu items with translations
     */
    public function getMenuItems($languageCode)
    {
        $sql = "SELECT mi.*, mit.label
                FROM menu_items mi
                LEFT JOIN menu_item_translations mit ON mi.id = mit.menu_item_id AND mit.language_code = :language_code
                WHERE mi.is_active = 1
                ORDER BY mi.sort_order ASC";
        return $this->fetchAll($sql, ['language_code' => $languageCode]);
    }
    
    /**
     * Get menu item by slug
     */
    public function getMenuItemBySlug($slug, $languageCode)
    {
        $sql = "SELECT mi.*, mit.label
                FROM menu_items mi
                LEFT JOIN menu_item_translations mit ON mi.id = mit.menu_item_id AND mit.language_code = :language_code
                WHERE mi.slug = :slug AND mi.is_active = 1
                LIMIT 1";
        return $this->fetchOne($sql, [
            'slug' => $slug,
            'language_code' => $languageCode
        ]);
    }
}
