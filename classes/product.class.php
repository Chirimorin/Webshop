<?php
	class Product
	{
		// Alle properties worden als associative array uit de database gehaald.
		// Hierdoor komt de database altijd overeen met het object.
		private $properties;
		
		
		public function __construct($id)
		{
			echo("product constructor. Id: ".$id."<br />");
			
			include_once("database/db.class.php");
			
			$db = new DBClass();
			$result = $db->runQuery("SELECT * FROM product WHERE id=$id");
			
			while($row = mysqli_fetch_assoc($result)){
				$this->properties = $row;
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