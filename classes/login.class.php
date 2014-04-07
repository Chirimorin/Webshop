<?php

class Login
{
    private $db_connection = null;
    public $errors = array();
    public $messages = array();

    public function __construct()
    {
        // if user tried to log out (happen when user clicks logout button)
        if (isset($_GET["logout"])) {
            $this->doLogout();
        }
        // login via post data (if user just submitted a login form)
        elseif (isset($_POST["login"])) {
            $this->dologinWithPostData();
        }
    }

    /**
     * log in with post data
     */
    private function dologinWithPostData()
    {
        if (empty($_POST['user_name'])) {
            $this->errors[] = "Username field was empty.";
        } elseif (empty($_POST['user_password'])) {
            $this->errors[] = "Password field was empty.";
        } elseif (!empty($_POST['user_name']) && !empty($_POST['user_password'])) {

            // create a database connection, using the constants from config/db.php (which we loaded in index.php)
            $this->db_connection = new mysqli(DB_SERVER, DB_USER, DB_PASS, DB_NAME);

            // change character set to utf8 and check it
            if (!$this->db_connection->set_charset("utf8")) {
                $this->errors[] = $this->db_connection->error;
            }

            if (!$this->db_connection->connect_errno) {

                $user_name = $this->db_connection->real_escape_string($_POST['user_name']);

                $sql = "SELECT username, password, accesslevel
                        FROM user
                        WHERE username = '" . $user_name . "';";
                $result_of_login_check = $this->db_connection->query($sql);

                if ($result_of_login_check->num_rows == 1) {
                    $result_row = $result_of_login_check->fetch_object();

                    $hashed_password = hash('sha256', $_POST['user_password'] . "hosdhgfhou423h5oi42u592y5");
                    $dbpass = $result_row->password;

                    if ($hashed_password===$dbpass) { 
                        $_SESSION['name'] = $result_row->username;
                        $_SESSION['accesslevel'] = $result_row->accesslevel;
                        $_SESSION['user_login_status'] = 1;
                        $this->messages[] = "You logged in succesfully!";

                    } else {
                        $this->errors[] = "Wrong password. Try again.";
                    }
                } else {
                    $this->errors[] = "This user does not exist.";
                }
            } else {
                $this->errors[] = "Database connection problem.";
            }
        }
    }

    /**
     * perform the logout
     */
    public function doLogout()
    {
        if (login::isUserLoggedIn())
        {
            $this->messages[] = "You have been logged out.";
        }
        unset($_SESSION['name'],
                $_SESSION['accesslevel'],
                $_SESSION['user_login_status'],
                $_SESSION['address']);
    }

    /**
     * simply return the current state of the user's login
     * @return boolean user's login status
     */
    public static function isUserLoggedIn()
    {
        if (isset($_SESSION['user_login_status']) AND $_SESSION['user_login_status'] == 1) {
            return true;
        }
        
        return false;
    }
}
