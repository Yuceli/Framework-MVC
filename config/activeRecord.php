<?php
 

class database {
     
    
    private $connections = array();
     
    
    private $activeConnection = 0;
     
    
    private $queryCache = array();
     
    
    private $dataCache = array();
   
    private $last;
     
     
    
    public function __construct()
    {
         
    }
     
    /**
     * Create a new database connection
     * @param String database hostname
     * @param String database username
     * @param String database password
     * @param String database we are using
     * @return int the id of the new connection
     */
    public function newConnection( $host, $user, $password, $database )
    {
        $this->connections[] = new mysqli( $host, $user, $password, $database );
        $connection_id = count( $this->connections )-1;
        if( mysqli_connect_errno() )
        {
            trigger_error('Error connecting to host. '.$this->connections[$connection_id]->error, E_USER_ERROR);
        }   
         
        return $connection_id;
    }
     
    
    public function closeConnection()
    {
        $this->connections[$this->activeConnection]->close();
    }
     
    
    public function setActiveConnection( int $new )
    {
        $this->activeConnection = $new;
    }
     
    
    public function cacheQuery( $queryStr )
    {
        if( !$result = $this->connections[$this->activeConnection]->query( $queryStr ) )
        {
            trigger_error('Error executing and caching query: '.$this->connections[$this->activeConnection]->error, E_USER_ERROR);
            return -1;
        }
        else
        {
            $this->queryCache[] = $result;
            return count($this->queryCache)-1;
        }
    }
     
    
    public function numRowsFromCache( $cache_id )
    {
        return $this->queryCache[$cache_id]->num_rows;    
    }
     
    
    public function resultsFromCache( $cache_id )
    {
        return $this->queryCache[$cache_id]->fetch_array(MYSQLI_ASSOC);
    }
    

    public function cacheData( $data )
    {
        $this->dataCache[] = $data;
        return count( $this->dataCache )-1;
    }
     
    

    public function dataFromCache( $cache_id )
    {
        return $this->dataCache[$cache_id];
    }
     
    /**
     * Delete records from the database
     * @param String the table to remove rows from
     * @param String the condition for which rows are to be removed
     * @param int the number of rows to be removed
     * @return void
     */
    public function deleteRecords( $table, $condition, $limit )
    {
        $limit = ( $limit == '' ) ? '' : ' LIMIT ' . $limit;
        $delete = "DELETE FROM {$table} WHERE {$condition} {$limit}";
        $this->executeQuery( $delete );
    }
     
    /**
     * Update records in the database
     * @param String the table
     * @param array of changes field => value
     * @param String the condition
     * @return bool
     */
    public function updateRecords( $table, $changes, $condition )
    {
        $update = "UPDATE " . $table . " SET ";
        foreach( $changes as $field => $value )
        {
            $update .= "`" . $field . "`='{$value}',";
        }
             
        // remove our trailing ,
        $update = substr($update, 0, -1);
        if( $condition != '' )
        {
            $update .= "WHERE " . $condition;
        }
         
        $this->executeQuery( $update );
         
        return true;
         
    }
     
    /**
     * Insert records into the database
     * @param String the database table
     * @param array data to insert field => value
     * @return bool
     */
    public function insertRecords( $table, $data )
    {
        // setup some variables for fields and values
        $fields  = "";
        $values = "";
         
        // populate them
        foreach ($data as $f => $v)
        {
             
            $fields  .= "`$f`,";
            $values .= ( is_numeric( $v ) && ( intval( $v ) == $v ) ) ? $v."," : "'$v',";
         
        }
         
        // remove our trailing ,
        $fields = substr($fields, 0, -1);
        // remove our trailing ,
        $values = substr($values, 0, -1);
         
        $insert = "INSERT INTO $table ({$fields}) VALUES({$values})";
        $this->executeQuery( $insert );
        return true;
    }
     
    /**
     * Execute a query string
     * @param String the query
     * @return void
     */
    public function executeQuery( $queryStr )
    {
        if( !$result = $this->connections[$this->activeConnection]->query( $queryStr ) )
        {
            trigger_error('Error executing query: '.$this->connections[$this->activeConnection]->error, E_USER_ERROR);
        }
        else
        {
            $this->last = $result;
        }
         
    }
     
    /**
     * Get the rows from the most recently executed query, excluding cached queries
     * @return array 
     */
    public function getRows()
    {
        return $this->last->fetch_array(MYSQLI_ASSOC);
    }
     
    /**
     * Gets the number of affected rows from the previous query
     * @return int the number of affected rows
     */
    public function affectedRows()
    {
        return $this->$this->connections[$this->activeConnection]->affected_rows;
    }
     
    /**
     * Sanitize data
     * @param String the data to be sanitized
     * @return String the sanitized data
     */
    public function sanitizeData( $data )
    {
        return $this->connections[$this->activeConnection]->real_escape_string( $data );
    }
     
    /**
     * Deconstruct the object
     * close all of the database connections
     */
    public function __deconstruct()
    {
        foreach( $this->connections as $connection )
        {
            $connection->close();
        }
    }
}
?>