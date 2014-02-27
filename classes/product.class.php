<?php
	class Product
	{
		// Alle properties worden als associative array uit de database gehaald.
		// Hierdoor komt de database altijd overeen met het object.
		private $properties;
		
		
		public function __construct($id)
		{
			$this->$properties['test'] = 'Testing!';
		}
		
		public function __get($property)
		{
			if (isset($this->$properties[$property]))
			{
				return $this->$properties[$property];
			}
		}

		public function __set($property, $value)
		{
			if (isset($this->$properties[$property]))
			{
				$this->$properties[$property] = $value;
			}
		
			return $this;
		}
	}
?>