<?php
	session_start();

	// Delete all session data
	session_unset();
	
	if (ini_get("session.use_cookies")) {
		$params = session_get_cookie_params();
		setcookie(session_name(), '', time() - 3600, 	// 3600 = one hour
			$params["path"], $params["domain"],
			$params["secure"], $params["httponly"]
		);
	}

	session_destroy();

	// Redirect to login
	header("Location: login.php");
	exit;
?>