<?php
	class Category
	{
		// Alle properties worden als associative array uit de database gehaald.
		// Hierdoor komt de database altijd overeen met het object.
		private $properties;
		
		
		public function __construct($id)
		{
            if (is_int($id)) //id meegegeven, zoek in database
            {
                include_once("database/db.class.php");
                
                $db = new DBClass();
                $result = $db->runQuery("SELECT * FROM category WHERE id=$id");
                
                while($row = mysqli_fetch_assoc($result)){
                    $this->properties = $row;
                }
                unset($db);
            }
            if (is_array($id)) //array meegegeven, data gebruiken
            {
                $this->properties = $id;
            }
		}
		
		public function get($property)
		{
			if (isset($this->properties[$property]))
			{
				return $this->properties[$property];
			}
		}

		public function set($property, $value)
		{
			if (isset($this->properties[$property]))
			{
				$this->properties[$property] = $value;
			}
		
			return $this;
		}
	}
?>