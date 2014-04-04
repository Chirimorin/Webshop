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
        echo $username . $accesslevel;

        $db = new DBClass();
        $clearUsername = $db->clearText($username);
        $intaccesslevel = intval($accesslevel);
        echo "<br/> " . $clearUsername . $intaccesslevel;
        if($accesslevel !== 0){
            $db->runQuery("UPDATE user SET accesslevel=". $intaccesslevel." WHERE username = '".$clearUsername."' ;");
            //echo $result;
        }
        else{
            //echo $result;
        }
        
        unset($db);
        //return $result;
    }
?>