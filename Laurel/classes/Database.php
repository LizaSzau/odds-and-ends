<?php

class Database { 	
	private $mysqli;
	private $selectResult = array(); 

    public static function connection()
    {  
        static $database;
        if (!is_object($database))
        {
            $database = new Database();
        } 
        return $database;
    }
	
    public function init()
    {
        $this->mysqli = new mysqli(Config::$DB_HOST, Config::$DB_USER, Config::$DB_PASSWORD, Config::$DB_NAME);
		if ($this->mysqli->connect_errno) {
			echo 'Failed to connect to MySQL: '. $mysqli->connect_error;
			exit();
		}
    }
	
	public function getMysqli() { 
		return $this->mysqli; 
	}
	
	public function getSelectResult() { 
		return $this->selectResult; 
	}
	
	public function sqlRaw($sql)
    {	
		$this->makeSelectResult($sql);
    }
	
	public function sqlSelectAll($table, $order)
    {	
        $sql = 'SELECT * FROM '.$table;
        if($order != null) $sql .= ' ORDER BY '.$order;
		$this->makeSelectResult($sql);
    }
	
	private function makeSelectResult($sql) {
		$this->selectResult = array();
		if ($result = $this->mysqli->query($sql)) {
			$i = 0;
			while ($row = $result->fetch_assoc()) {
                $field = array_keys($row); 
                for($j = 0; $j < count($field); $j++) {
                    if(!is_int($field[$j])) {
                         $this->selectResult[$i][$field[$j]] = $row[$field[$j]];
                    }
                }
				$i++;
			}
			$result->close();
		}		
	}
}
