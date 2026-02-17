<?php
session_start();

// Check for login session
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    // If not logged in, redirect to login page
    header("Location: login.php");
    exit;
}
?>

<?php
	// Connecting
	require_once 'db_connect.php';  // Imports $connection from db_connect.php

	// Runs only if there are incoming parameters
	if (isset($_POST['id'])) {
		
		$id = $_POST['id'];				// Incoming client id
		$name = $_POST['client_name'];	// The new name
		$balance = $_POST['balance']; 	// The new balance

		// SQL UPDATE command (Change the client name to 'name', the balance to 'balance', WHERE id is 'id')
		$sql = "UPDATE accounts SET client_name = ?, balance = ? WHERE id = ?";
		
		$statement = mysqli_prepare($connection, $sql);
		
		// s = string (name), d = double (balance), i = integer (id)
		mysqli_stmt_bind_param($statement, "sii", $name, $balance, $id);
		
		if (mysqli_stmt_execute($statement)) {
			// If success - redirect to list
			header("Location: list.php");
		} else {
			echo "Hiba történt: " . mysqli_error($connection);
		}
		
		mysqli_stmt_close($statement);
	}

	mysqli_close($connection);
?>

