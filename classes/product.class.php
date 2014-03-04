<?php
	class Product
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
                $result = $db->runQuery("SELECT * FROM product WHERE id=$id");
                
                if ($result !== FALSE)
                {
                    while($row = mysqli_fetch_assoc($result)){
                        $this->properties = $row;
                    }
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
        
        public function showProductBox()
        {
            echo("<div class=\"col-sm-4\">
                    <div class=\"panel panel-info\">
                    <div class=\"panel-heading\">
                    <h3 class=\"panel-title item-title ".$this->get('rarity')."\">".$this->get('name')."</h3>
                    </div>
                    <div class=\"panel-body\">
                    <div class=\"product-container\">");
            if(file_exists("images/thumbs/".$this->get('image')))
            {
                echo("<img class=\"thumb\" src=\"images/thumbs/".$this->get('image')."\" alt=\"".$this->get('name')."\" />");
            }
            else
            {
                echo("<img class=\"thumb\" src=\"images/thumbs/NoImage.jpg\" alt=\"".$this->get('name')."\" />");
            }
            echo("<div class=\"description\">".$this->get('description')."<br /><br /><a href=\"index.php?page=product&amp;productid=".$this->get('id')."\">More Info</a></div>
                    </div>
                    <div class=\"price\">Price: &euro;".$this->get('price')."</div>
                    <div class=\"cart\"><input class=\"amount\" name=\"".$this->get('name')." amount\" type=\"number\" value=\"1\" />&nbsp;
                    <button type=\"button\" class=\"btn btn-xs btn-default add-to-cart\">Add to cart</button></div>
                    </div>
                    </div>
                    </div>");
        }
        
        public function showProductDetail()
        {
            $longdescription = $this->get('longdescription');
            //$longdescription = nl2br($longdescription); //doesn't work, mysql doesn't give the line breaks? 
            
            echo("<div class=\"panel panel-info\">
                    <div class=\"panel-heading\">
                    <h3 class=\"panel-title item-title ".$this->get('rarity')."\">".$this->get('name')."</h3>
                    </div>
                    <div class=\"panel-body\">
                    <div class=\"product-container\">");
            if(file_exists("images/".$this->get('image')))
            {
                echo("<img class=\"product-image\" src=\"images/".$this->get('image')."\" alt=\"".$this->get('name')."\" />");
            }
            else
            {
                echo("<img class=\"product-image\" src=\"images/NoImage.jpg\" alt=\"".$this->get('name')."\" />");
            }
            echo("<div class=\"description\">".$this->get('longdescription')."</div>
                    </div>
                    <div class=\"price\">Price: &euro;".$this->get('price')."</div>
                    <div class=\"cart\"><input class=\"amount\" name=\"".$this->get('name')." amount\" type=\"number\" value=\"1\" />&nbsp;
                    <button type=\"button\" class=\"btn btn-xs btn-default add-to-cart\">Add to cart</button></div>
                    </div>
                    </div>");
        }
	}
?>