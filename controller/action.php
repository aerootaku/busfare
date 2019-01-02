<?php
define('ROOT_DIR', dirname(__FILE__));
define('ROOT_URL', substr($_SERVER['PHP_SELF'], 0, - (strlen($_SERVER['SCRIPT_FILENAME']) - strlen(ROOT_DIR))));
ini_set( 'error_reporting', E_ALL );
ini_set( 'display_errors', true );
ini_set('allow_url_include', 0);
date_default_timezone_set("Asia/Manila");
include ROOT_DIR. '/../system/constant.php';
session_start();
include ROOT_DIR. '/../system/config.php';




//initialize the settings

$DB_con = db_connect();

$action = new action($DB_con);

class action
{
    private $db;

    function __construct($DB_con)
    {
        $this->db = $DB_con;
    }


//LOGIN CLASS
    public function login($username, $password) //login to owner of the system
    {
        try {
            $stmt = $this->db->prepare("SELECT * FROM tbl_users WHERE username=:username LIMIT 1");
            $stmt->execute(array(':username' => $username));
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($stmt->rowCount() > 0) {
                if (password_verify($password, $row['password'])) {
                    if($row['role']=='Admin'){
                        $_SESSION['id'] = $row['id'];
                        $_SESSION['password'] = $row['password'];
                        $_SESSION['username'] = $row['username'];
                        $_SESSION['firstname'] = $row['firstname'];
                        $_SESSION['middlename'] = $row['middlename'];
                        $_SESSION['lastname'] = $row['lastname'];
                        $_SESSION['declared'] = $row['password'];
                        $_SESSION['role'] = $row['role'];
                        $this->redirect('admin/');
                    }
                    else if($row['role']=='Staff'){
                        $_SESSION['id'] = $row['id'];
                        $_SESSION['password'] = $row['password'];
                        $_SESSION['username'] = $row['username'];
                        $_SESSION['firstname'] = $row['firstname'];
                        $_SESSION['lastname'] = $row['lastname'];
                        $_SESSION['declared'] = $row['password'];
                        $_SESSION['role'] = $row['role'];
                        $this->redirect('staff/');
                    }
                }
                else {
                    return false;
                }

            } else {
                return false;
                //
            }

        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

	public function fingerprintLogin($fp_template){
	
		try{
			$stmt = $this->db->prepare("SELECT * FROM tbl_client WHERE fp_template=:template LIMIT 1");
			$stmt->execute(array(':template' => $fp_template));
			$row = $stmt->fetch(PDO::FETCH_ASSOC);
			if ($stmt->rowCount() > 0) {
					echo "success template";
					$_SESSION['id'] = $row['id'];
					$_SESSION['firstname'] = $row['firstname'];
					$_SESSION['lastname'] = $row['lastname'];
					$_SESSION['port'] = $row['locker_no'];
					$_SESSION['locker_no'] = $row['locker_no'];
					$_SESSION['fp_template'] = $row['fp_template'];
					$this->redirect('dashboard.php');
					
			}

			else{
				return false;
			}
		} 
		catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
	}
	

	public function pinLogin($pin)
	{
		try{
			$stmt = $this->db->prepare("SELECT * FROM tbl_client WHERE pin_no=:pin LIMIT 1");
            $stmt->execute(array(':pin' => $pin));
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($stmt->rowCount() > 0) {
				            $_SESSION['id'] = $row['id'];
                            $_SESSION['firstname'] = $row['firstname'];
                            $_SESSION['lastname'] = $row['lastname'];
                            $_SESSION['port'] = $row['locker_no'];
                            $_SESSION['locker_no'] = $row['locker_no'];
                            $_SESSION['fp_template'] = $row['fp_template'];
                            $this->redirect('dashboard.php');
			}
			else{
				return false;
			}
		}
		catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
	}
	
	
    public function is_loggedin()
    {
        if (isset($_SESSION['id'])) {
            return true;
        }
    }

    public function redirect($url)
    {
        header("Location: $url");
    }

    public function logout()
    {
        session_destroy();
        unset($_SESSION['id']);
        return true;
    }

}
