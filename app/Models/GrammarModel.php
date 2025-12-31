<?php
/**
 * Grammar Model
 * Handles grammar-related database operations
 */

class GrammarModel extends Model
{
    public function __construct()
    {
        parent::__construct();
    }
    
    /**
     * Get all grammar levels
     */
    public function getLevels()
    {
        $sql = "SELECT * FROM grammar_levels WHERE is_active = 1 ORDER BY sort_order ASC";
        return $this->fetchAll($sql);
    }
    
    /**
     * Get level by code
     */
    public function getLevelByCode($code)
    {
        $sql = "SELECT * FROM grammar_levels WHERE code = :code AND is_active = 1 LIMIT 1";
        return $this->fetchOne($sql, ['code' => $code]);
    }
    
    /**
     * Get topics by level ID
     */
    public function getTopicsByLevel($levelId)
    {
        $sql = "SELECT * FROM grammar_topics 
                WHERE level_id = :level_id AND is_active = 1 
                ORDER BY sort_order ASC";
        return $this->fetchAll($sql, ['level_id' => $levelId]);
    }
    
    /**
     * Get topic by slug
     */
    public function getTopicBySlug($slug)
    {
        $sql = "SELECT * FROM grammar_topics WHERE slug = :slug AND is_active = 1 LIMIT 1";
        return $this->fetchOne($sql, ['slug' => $slug]);
    }
    
    /**
     * Get grammar content by topic ID and language
     */
    public function getContentByTopic($topicId, $languageCode)
    {
        $sql = "SELECT gc.*, gt.level_id, gt.slug as topic_slug, gl.code as level_code
                FROM grammar_contents gc
                INNER JOIN grammar_topics gt ON gc.topic_id = gt.id
                INNER JOIN grammar_levels gl ON gt.level_id = gl.id
                WHERE gc.topic_id = :topic_id AND gc.language_code = :language_code
                LIMIT 1";
        return $this->fetchOne($sql, [
            'topic_id' => $topicId,
            'language_code' => $languageCode
        ]);
    }
    
    /**
     * Get topics with content count
     */
    public function getTopicsWithContentCount($levelId, $languageCode)
    {
        $sql = "SELECT gt.*, 
                (SELECT COUNT(*) FROM grammar_contents gc 
                 WHERE gc.topic_id = gt.id AND gc.language_code = :language_code) as content_count
                FROM grammar_topics gt
                WHERE gt.level_id = :level_id AND gt.is_active = 1
                ORDER BY gt.sort_order ASC";
        return $this->fetchAll($sql, [
            'level_id' => $levelId,
            'language_code' => $languageCode
        ]);
    }
    
    /**
     * Get examples for a grammar topic
     */
    public function getExamplesByTopic($topicId, $languageCode)
    {
        $sql = "SELECT * FROM examples 
                WHERE topic_id = :topic_id AND language_code = :language_code
                ORDER BY sort_order ASC";
        return $this->fetchAll($sql, [
            'topic_id' => $topicId,
            'language_code' => $languageCode
        ]);
    }
    
    /**
     * Increment view count
     */
    public function incrementViewCount($topicId)
    {
        $sql = "UPDATE grammar_topics SET view_count = view_count + 1 WHERE id = :id";
        $this->query($sql, ['id' => $topicId]);
    }
}
