<?php
/**
 * Base Model Class
 * All models extend this class
 */

class Model
{
    protected $db;
    protected $table;
    
    /**
     * Constructor
     */
    public function __construct($table = null)
    {
        $this->db = Database::getInstance();
        $this->table = $table;
    }
    
    /**
     * Find all records
     */
    public function findAll($conditions = [], $orderBy = 'id ASC', $limit = null)
    {
        $sql = "SELECT * FROM {$this->table}";
        $params = [];
        
        if (!empty($conditions)) {
            $where = [];
            foreach ($conditions as $key => $value) {
                $where[] = "{$key} = :{$key}";
                $params[$key] = $value;
            }
            $sql .= " WHERE " . implode(" AND ", $where);
        }
        
        $sql .= " ORDER BY {$orderBy}";
        
        if ($limit) {
            $sql .= " LIMIT {$limit}";
        }
        
        return $this->db->fetchAll($sql, $params);
    }
    
    /**
     * Find one record
     */
    public function findOne($conditions = [])
    {
        $sql = "SELECT * FROM {$this->table}";
        $params = [];
        
        if (!empty($conditions)) {
            $where = [];
            foreach ($conditions as $key => $value) {
                $where[] = "{$key} = :{$key}";
                $params[$key] = $value;
            }
            $sql .= " WHERE " . implode(" AND ", $where);
        }
        
        $sql .= " LIMIT 1";
        
        return $this->db->fetchOne($sql, $params);
    }
    
    /**
     * Find by ID
     */
    public function findById($id)
    {
        return $this->findOne(['id' => $id]);
    }
    
    /**
     * Execute custom query
     */
    protected function query($sql, $params = [])
    {
        return $this->db->query($sql, $params);
    }
    
    /**
     * Fetch all from custom query
     */
    protected function fetchAll($sql, $params = [])
    {
        return $this->db->fetchAll($sql, $params);
    }
    
    /**
     * Fetch one from custom query
     */
    protected function fetchOne($sql, $params = [])
    {
        return $this->db->fetchOne($sql, $params);
    }
}
