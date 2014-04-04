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



    function insert_new_user($username, $password)
    {
        include_once("database/db.class.php");
        include_once("classes/user.class.php");
        
        $db = new DBClass();
        $clearUsername = $db->clearText($username);
        $password = hash('sha512', $password + "hosdhgfhou423h5oi42u592y5");
        $result = $db->runQuery("CALL insertUser(". $clearUsername. "," . $password . ");");
        $user = array();
        $i = 0;

        if($result !== FALSE){
            while($row = mysqli_fetch_assoc($result)){
                $user[$i] = new User($row);
                $i++;
            }
        }        
        unset($db);
        
        return $user;
    }

    function user_existing($username)
    {
        include_once("database/db.class.php");
        $clearUsername = $db->clearText($username);
        $db = new DBClass();
        $result = $db->runQuery("SELECT username, password FROM user WHERE username = '" . $clearUsername . "';");
        return $result;
    }

    function get_all_users()
    {
        include_once("database/db.class.php");
        include_once("classes/user.class.php");
        
        $db = new DBClass();
        $result = $db->runQuery("SELECT username, accesslevel FROM user;");
        $user = array();
        $i = 0;
        if($result !== FALSE){
            while($row = mysqli_fetch_assoc($result)){
                $user[$i] = new User($row);
                $i++;
            }
        }        
        unset($db);
        
        return $user;
    }

    function edit_User_Post_Data($username, $accesslevel)
    {
        include_once("database/db.class.php");
        $db = new DBClass();
        $clearUsername = $db->clearText($username);
        $intaccesslevel = intval($accesslevel);
        if($accesslevel !== 0){
            $result = $db->runQuery("UPDATE user SET accesslevel=". $intaccesslevel." WHERE username = '".$clearUsername."' ;");
            if($result){
                echo "Successfully updated ". $username . "&#39;s accesslevel to ".$intaccesslevel.".<br>";
            }
        }
        
        unset($db);

    }

    function edit_Category_Post_Data($id, $name, $description){
        include_once("database/db.class.php");
        $db = new DBClass();
        $clearName = $db->clearText($name);
        $clearDescription = $db->clearText($description);
        if($id !== 0){
            $result = $db->runQuery("UPDATE category SET name='". $clearName."' , description='".$clearDescription."'  WHERE id = '".$id."' ;");
            if($result){
                echo "Successfully updated category ". $name . ".<br>";
            }
        }
        
        unset($db);
    }

    function add_Category_Post_Data($name, $description){
        include_once("database/db.class.php");
        $db = new DBClass();
        $clearName = $db->clearText($name);
        $clearDescription = $db->clearText($description);
        $result = $db->runQuery("INSERT INTO category (name, description) VALUES ('". $clearName."' , '".$clearDescription."');");
        if($result){
            echo "Successfully inserted category ". $name . ".<br>";
        }
        
        
        unset($db);
    }

        function remove_Category($id){
        include_once("database/db.class.php");
        $db = new DBClass();
        $result = $db->runQuery("DELETE FROM category WHERE id = '".$id."';");
        if($result){
            echo "Successfully removed category<br>";
        }
        
        
        unset($db);
    }

    function get_rarities(){
        include_once("database/db.class.php");

        $db = new DBClass();
        $result = $db->runQuery("SELECT distinct(rarity) FROM product;");
        return $result;
    }

    function edit_Product_Post_Data($id, $name, $description, $longdescription, $image, $categoryid, $price, $rarity){
        include_once("database/db.class.php");
        $db = new DBClass();
        $clearName = $db->clearText($name);
        $clearDescription = $db->clearText($description);
        $clearLongDescription = $db->clearText($longdescription);
        if($id !== 0){
            $result = $db->runQuery("UPDATE product SET name='". $clearName."' , description='".$clearDescription."' , longdescription='".$clearLongDescription."' , image='".$image."', categoryid='".$categoryid."' , price='".$price."' , rarity='".$rarity."' WHERE id = '".$id."' ;");
            if($result){
                echo "Successfully updated product ". $name . ".<br>";
            }
        }
        
        unset($db);
    }

    function add_Product_Post_Data($name, $description, $longdescription, $image, $categoryid, $price, $rarity){
        include_once("database/db.class.php");
        $db = new DBClass();
        $clearName = $db->clearText($name);
        $clearDescription = $db->clearText($description);
        $clearLongDescription = $db->clearText($longdescription);
        $result = $db->runQuery("INSERT INTO product (name, description, longdescription, image, categoryid, price, rarity) VALUES ('". $clearName."' , '".$clearDescription."', '".$clearLongDescription."', '".$image."', '".$categoryid."', '".$price."', '".$rarity."');");
        if($result){
            echo "Successfully inserted product ". $name . ".<br>";
        }
        
        
        unset($db);
    }

        function remove_Product($id){
        include_once("database/db.class.php");
        $db = new DBClass();
        $result = $db->runQuery("DELETE FROM product WHERE id = '".$id."';");
        if($result){
            echo "Successfully removed product<br>";
        }
        
        
        unset($db);
    }

?>