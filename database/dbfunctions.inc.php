<?php 
    // This class contains functions that apply to the database. 
    
    function get_all_products()
    {
        include_once("database/db.class.php");
        include_once("classes/product.class.php");
        
        $db = new DBClass();
        $result = $db->runQuery("SELECT * FROM product ORDER BY name ASC");
        
        $products = array();        
        
        $i = 0;
        if ($result !== FALSE)
        {
            while($row = mysqli_fetch_assoc($result)){
                $products[$i] = new Product($row);
                $i++;
            }
        }
        unset($db);
        
        return $products;
    }
    
    function get_all_categories()
    {
        include_once("database/db.class.php");
        include_once("classes/category.class.php");
        
        $db = new DBClass();
        $result = $db->runQuery("SELECT * FROM category");
        
        $categories = array();        
        
        $i = 0;
        if ($result !== FALSE)
        {
            while($row = mysqli_fetch_assoc($result)){
                $categories[$i] = new Category($row);
                $i++;
            }
        }
        unset($db);
        
        return $categories;
    }
    
    function get_products_by_category($catid)
    {
        include_once("database/db.class.php");
        include_once("classes/product.class.php");
        
        $db = new DBClass();
        $result = $db->runQuery("SELECT * FROM product WHERE categoryid = $catid ORDER BY name ASC");
        
        $products = array();        
        
        $i = 0;

        if ($result !== FALSE)
        {
            while($row = mysqli_fetch_assoc($result)){
                $products[$i] = new Product($row);
                $i++;
            }
        }
        unset($db);
        
        return $products;
    }
?>