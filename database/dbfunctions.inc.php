<?php 
    // This class contains functions that apply to the database. 
    
    function get_all_products()
    {
        include_once("database/db.class.php");
        include_once("classes/product.class.php");
        
        $db = new DBClass();
        $result = $db->runQuery("CALL get_all_products();");
        
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
        $result = $db->runQuery("CALL get_all_categories();");
        
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
        $result = $db->runQuery("CALL get_products_by_category('".$catid."');");
        
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

    function get_all_users()
    {
        include_once("database/db.class.php");
        include_once("classes/user.class.php");
        
        $db = new DBClass();
        $result = $db->runQuery("CALL get_all_users();");
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
            $result = $db->runQuery("CALL edit_user('".$clearUsername."' , '".$accesslevel."')");
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
            $result = $db->runQuery("CALL edit_category('". $id."' , '". $clearText."' ,'".$clearDescription."';");
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
        $result = $db->runQuery("CALL add_category('".$clearName."','".$clearDescription."');");
        if($result){
            echo "Successfully inserted category ". $name . ".<br>";
        }
        
        
        unset($db);
    }

        function remove_Category($id){
        include_once("database/db.class.php");
        $db = new DBClass();
        $result = $db->runQuery("CALL remove_category('".$id."');");
        if($result){
            echo "Successfully removed category<br>";
        }
        
        
        unset($db);
    }

    function get_rarities(){
        include_once("database/db.class.php");

        $db = new DBClass();
        $result = $db->runQuery("CALL get_rarities();");
        return $result;
    }

    function edit_Product_Post_Data($id, $name, $description, $longdescription, $image, $categoryid, $price, $rarity){
        include_once("database/db.class.php");
        $db = new DBClass();
        $clearName = $db->clearText($name);
        $clearDescription = $db->clearText($description);
        $clearLongDescription = $db->clearText($longdescription);
        if($id !== 0){
            $result = $db->runQuery("CALL edit_product('".$id."' ,'". $clearName."' , '".$clearDescription."' , '".$clearLongDescription."' , '".$image."', '".$categoryid."' , '".$price."' , '".$rarity."');");
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
        $result = $db->runQuery("CALL add_product('". $clearName."' , '".$clearDescription."', '".$clearLongDescription."', '".$image."', '".$categoryid."', '".$price."', '".$rarity."');");
        if($result){
            echo "Successfully inserted product ". $name . ".<br>";
        }
        
        
        unset($db);
    }

    function remove_Product($id){
        include_once("database/db.class.php");
        $db = new DBClass();
        $result = $db->runQuery("CALL remove_product('".$id."');");
        if($result){
            echo "Successfully removed product<br>";
        }
        
        
        unset($db);
    }

    function get_all_orders()
    {
        include_once("database/db.class.php");
        include_once("classes/product.class.php");
        
        $db = new DBClass();
        $result = $db->runQuery("CALL get_all_orders();");
        
        $orders = array();        
        
        $i = 0;

        if ($result !== FALSE)
        {
            while($row = mysqli_fetch_assoc($result)){
                $orders[$i] = $row;
                $i++;
            }
        }
        unset($db);
        
        return $orders;
    }
    function get_address_by_id($id)
    {
        include_once("database/db.class.php");
        $db = new DBClass();
        $id = intval($id);
        $result = $db->runQuery("CALL get_address_by_id('".$id."');");
        $addresses = array();
        $i=0;
        if ($result !== FALSE)
        {
            while($row = mysqli_fetch_assoc($result)){
                $addresses[$i] = $row;
                $i++;
            }
        }
        unset($db);
        return $addresses;
    }

    function get_items_by_orderid($id)
    {
        include_once("database/db.class.php");

        $db = new DBClass();
        $id = intval($id);
        $result = $db->runQuery("CALL get_items_by_orderid('".$id."');");
        $orderproducts = array();
        $i = 0;
        if ($result !== FALSE)
        {
        
            while($row = mysqli_fetch_assoc($result)){
                $orderproducts[$i] = $row;
                $i++;
            }
        }
        unset($db);
        return $orderproducts;

    }
        function get_order_by_id($id)
    {
        include_once("database/db.class.php");

        $db = new DBClass();
        $id = intval($id);
        $result = $db->runQuery("CALL get_order_by_id('".$id."');");
        $orders = array();
        $i = 0;

        if ($result !== FALSE)
        {
            while($row = mysqli_fetch_assoc($result)){
                $orders[$i] = $row;
                $i++;
            }
        }
        unset($db);
        return $orders;
}

        function edit_order_Post_Data($id, $status){
            include_once("database/db.class.php");
            $db = new DBClass();
            $clearName = $db->clearText($name);
            $clearDescription = $db->clearText($description);
            $clearLongDescription = $db->clearText($longdescription);
            if($id !== 0){
                $result = $db->runQuery("CALL edit_order('".$id."' ,'". $status."');");
                if($result){
                    echo "Successfully updated order ". $name . ".<br>";
                }
            }
            
            unset($db);

        }
      
?>