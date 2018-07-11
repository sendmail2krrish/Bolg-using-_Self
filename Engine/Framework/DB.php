<?php
namespace _Self;

use PDO;
use Exception;

final class DB
{
    /**
     * Connection variable which holds instance of the database connection.
     */
    private $connection = NULL;

    /**
     * To store table name.
     */
    private $table = NULL;
    
    /**
     * To store where AND clause.
     */
    private $where = NULL;
    
    /**
     * To store where OR clause.
     */
    private $whereOr = NULL;
    
    /**
     * To store query clause.
     */
    private $queryData = [];
    
    /**
     * To store response JSON
     */
    private $response = NULL;

    /**
     * This __construct method holds database configuration.
     * Please goto Config directory and edit database.php file to set the database.
     * @return current instance $this
     */
    public function __construct()
    {
        $db = $GLOBALS['db'];

        try {
            $this->connection = new PDO("mysql:host=" . $db["hostname"] . ";dbname=" . $db["database"], $db["username"], $db["password"]);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }

        return $this;
    }

    /**
     * 
     * @param string $table
     * @return current instance
     */
    public function table($table)
    {
        $this->table = $table;
        return $this;
    }

    /**
     * 
     * @return json object
     */
    public function all()
    {
        if(empty($this->where) && empty($this->whereOr))
        {
            $stmt = $this->connection->prepare("SELECT * FROM " . $this->table);
            $stmt->execute();
            $this->response = $stmt->fetchAll(PDO::FETCH_OBJ);
            return $this->response;
        }
        else 
        {
            throw new Exception('all() not works with where()');
        }
    }
    
    /**
     * 
     * @param array $params
     * @return current instance
     */
    public function where($params = [])
    {
        $this->where = $this->queryFormat(array_keys($params), "AND");
        foreach ($params as $key=>$value)
        {
            $this->queryData[$key] = $value;
        }
        return $this;
    }
    
    /**
     * 
     * @param array $params
     * @return current instance
     */
    public function whereOr($params = [])
    {
        $this->where = $this->queryFormat(array_keys($params), "OR");
        foreach ($params as $key=>$value)
        {
            $this->queryData[$key] = $value;
        }
        return $this;
    }
    
    /**
     * 
     * @param array $keys
     * @return string
     */
    private function queryFormat($data, $type)
    {
        $clause = NULL;
        foreach ($data as $key=>$value)
        {
            if($key == 0)
            {
                $clause .= $value . "=:" . $value;
            }
            else 
            {
                $clause .= " " . $type . " " . $value . "=:" . $value;
            }
        }
        return $clause;
    }

    /**
     * 
     * @return json object
     */
    public function get()
    {
        if(!empty($this->where) || !empty($this->whereOr))
        {
            $sql = "SELECT * FROM " . $this->table . " WHERE " . $this->where . $this->whereOr;
        }
        else
        {
            $sql = "SELECT * FROM " . $this->table;
        }
        $stmt = $this->connection->prepare($sql);
        foreach($this->queryData as $key=>$value)
        {
            $stmt->bindParam(":" . $key, $value);
        }
        $stmt->execute();
        $this->response = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $this->response;
    }
}
