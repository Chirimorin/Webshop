<?php
 
// My database Class called DBClass
class DBClass {

	// our mysqli object instance
	public $mysqli = null;

	// Class constructor override
	public function __construct() {

		include_once "database/dbconfig.php";        
			
		$this->mysqli = 
		new mysqli(DB_SERVER, DB_USER, DB_PASS, DB_NAME);

		if ($this->mysqli->connect_errno) {
			echo "Error MySQLi: ("&nbsp. $this->mysqli->connect_errno 
			. ") " . $this->mysqli->connect_error;
			exit();
		}
		$this->mysqli->set_charset("utf8"); 
	}

	// Class deconstructor override
	public function __destruct() {
		$this->CloseDB();
	}

	// runs a sql query
	public function runQuery($qry) {
		$result = $this->mysqli->query($qry);
		return $result;
	}

	// runs multiple sql queres
	public function runMultipleQueries($qry) {
		$result = $this->mysqli->multi_query($qry);
		return $result;
	}

	// Close database connection
	public function CloseDB() {
		$this->mysqli->close();
	}

	// Escape the string get ready to insert or update
	public function clearText($text) {
		$text = trim($text);
		return $this->mysqli->real_escape_string($text);
	}

	// Get the last insert id 
	public function lastInsertID() {
		return $this->mysqli->insert_id;
	}

	// Gets the total count and returns integer
	public function totalCount($fieldname, $tablename, $where = "") 
	{
		$q = "SELECT count(".$fieldname.") FROM "
		. $tablename . " " . $where;
			 
		$result = $this->mysqli->query($q);
		$count = 0;
		if ($result) {
			while ($row = mysqli_fetch_array($result)) {
			$count = $row[0];
			}
		}
	return $count;
	}
	
	public function get_multi($query)
    {
        //Overwrite the $row var to null
        $row = null;
        
        $results = $this->link->query( $query );
        if( $this->link->error )
        {
            $this->log_db_errors( $this->link->error, $query );
            return false;
        }
        else
        {
            while($this->link->more_results())
            {
                if($this->link->next_result()){
                  if($l_result = $this->link->store_result()){
                          $l_result->free();
                  }
                }
            }

            $row = array();
            while( $r = $results->fetch_assoc() )
            {
                $row[] = $r;
            }
            return $row; 
        }
       
    }

}
 
?>