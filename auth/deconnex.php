<?php
	session_start();
	header("Cache-Control: no-cache, must-revalidate");
	header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");
    
    /* le destructeur ultime de session */
    session_unset($_SESSION['login']);
    /* code suivant donné par le manuel php */
    $_SESSION = array();
    if (ini_get("session.use_cookies")) {
	    $params = session_get_cookie_params();
	    setcookie(session_name(), '', time() - 42000,
	        $params["path"], $params["domain"],
	        $params["secure"], $params["httponly"]
	    );
	}
    session_destroy();
    session_write_close();
	setcookie('user','',1);
    
    header("Location: ../index.php", TRUE, 301);
?>