<?php
/**
 * Word Model
 * Handles word-related database operations
 */

class WordModel extends Model
{
    public function __construct()
    {
        parent::__construct();
    }
    
    /**
     * Get all word levels
     */
    public function getLevels()
    {
        $sql = "SELECT * FROM word_levels WHERE is_active = 1 ORDER BY sort_order ASC";
        return $this->fetchAll($sql);
    }
    
    /**
     * Get level by code
     */
    public function getLevelByCode($code)
    {
        $sql = "SELECT * FROM word_levels WHERE code = :code AND is_active = 1 LIMIT 1";
        return $this->fetchOne($sql, ['code' => $code]);
    }
    
    /**
     * Get words by level
     */
    public function getWordsByLevel($levelId, $languageCode, $limit = null, $offset = 0)
    {
        $sql = "SELECT w.*, wt.translation, wt.usage_note
                FROM words w
                LEFT JOIN word_translations wt ON w.id = wt.word_id AND wt.language_code = :language_code
                WHERE w.word_level_id = :level_id AND w.is_active = 1
                ORDER BY w.sort_order ASC, w.difficulty ASC";
        
        if ($limit) {
            $sql .= " LIMIT :limit OFFSET :offset";
            return $this->fetchAll($sql, [
                'level_id' => $levelId,
                'language_code' => $languageCode,
                'limit' => $limit,
                'offset' => $offset
            ]);
        }
        
        return $this->fetchAll($sql, [
            'level_id' => $levelId,
            'language_code' => $languageCode
        ]);
    }
    
    /**
     * Get word by ID with all translations
     */
    public function getWordById($wordId, $languageCode)
    {
        $sql = "SELECT w.*, wt.translation, wt.usage_note
                FROM words w
                LEFT JOIN word_translations wt ON w.id = wt.word_id AND wt.language_code = :language_code
                WHERE w.id = :word_id AND w.is_active = 1
                LIMIT 1";
        return $this->fetchOne($sql, [
            'word_id' => $wordId,
            'language_code' => $languageCode
        ]);
    }
    
    /**
     * Get all translations for a word
     */
    public function getWordTranslations($wordId)
    {
        $sql = "SELECT * FROM word_translations WHERE word_id = :word_id ORDER BY language_code ASC";
        return $this->fetchAll($sql, ['word_id' => $wordId]);
    }
    
    /**
     * Get examples for a word
     */
    public function getExamplesByWord($wordId, $languageCode)
    {
        $sql = "SELECT * FROM examples 
                WHERE word_id = :word_id AND language_code = :language_code
                ORDER BY sort_order ASC";
        return $this->fetchAll($sql, [
            'word_id' => $wordId,
            'language_code' => $languageCode
        ]);
    }
    
    /**
     * Get word count by level
     */
    public function getWordCountByLevel($levelId)
    {
        $sql = "SELECT COUNT(*) as count FROM words WHERE word_level_id = :level_id AND is_active = 1";
        $result = $this->fetchOne($sql, ['level_id' => $levelId]);
        return $result['count'] ?? 0;
    }
    
    /**
     * Increment view count
     */
    public function incrementViewCount($wordId)
    {
        $sql = "UPDATE words SET view_count = view_count + 1 WHERE id = :id";
        $this->query($sql, ['id' => $wordId]);
    }
}
