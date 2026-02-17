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
		
	if(isset($_GET['id']) && is_numeric($_GET['id'])) {
		
		$delete_id = $_GET['id'];
		
		$sql = "DELETE FROM accounts WHERE id = ?";
		
		$statement = mysqli_prepare($connection,$sql);
		
		mysqli_stmt_bind_param($statement, "i", $delete_id); // "i" because the 'id' is an integer
		
		if(mysqli_stmt_execute($statement)){
			header("Location: list.php");
			exit();
		} else {
			echo "Hiba a törlésnél: " . mysqli_error($connection);
		}
		
		mysqli_stmt_close($statement);
		mysqli_close($connection);
		
	} else {
		echo "Nincs megadva ID!";
		}
?>