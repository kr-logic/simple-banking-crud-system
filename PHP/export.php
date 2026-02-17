<?php
	session_start();

	// Check for login session
	if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
		// If not logged in, redirect to login page
		header("Location: login.php");
		exit;
	}
	
	// Connecting
	require_once 'db_connect.php';  // Imports $connection from db_connect.php
	
	if (!$connection) {
		die("Hiba: " . mysqli_connect_error());
	}
	mysqli_set_charset($connection, "utf8");
	
	// Get search & sort params from list.php (Default: ID, ASC)
	$allowed_columns = ['id', 'client_name', 'balance'];
	$order_column_source = isset($_GET['order']) ? $_GET['order'] : 'id';
	$order_column_safe = in_array($order_column_source, $allowed_columns) ? $order_column_source : 'id'; // If the column with GET doesnt exist then default to 'id' (protection)
	
	// Direction
	$order_direction_source = isset($_GET['direction']) ? strtoupper($_GET['direction']) : 'ASC';
	$order_direction_safe = ($order_direction_source === 'DESC') ? 'DESC' : 'ASC';
	
	$search_source	= isset($_GET['search'])  ? $_GET['search']  : '';
	$search_safe = mysqli_real_escape_string($connection, $search_source); 	//SQL Injection protection: real_escape_string
	
	// HTTP Header - signaling to the browser: CSV incoming
	header('Content-Type: text/csv; charset=utf-8');
	// Download with this name:
	header('Content-Disposition: attachment; filename=partner_adatok_' . date("Y_m_d_His") . '.csv');

	// Output channel opening
	// Writing directly to the output, not to the file
	$output = fopen('php://output', 'w');
	
	// Byte Order Mark (BOM)
	// These 3 bytes tell Excel that the file is UTF-8 encoded
	fputs($output, "\xEF\xBB\xBF");
	
	// Print header line
	// fputcsv: automatically puts dividing characters
	fputcsv($output, array('ID', 'Ügyfél Neve', 'Egyenleg (HUF)'));
	
	// Data query and printing
	$sql = "SELECT * FROM accounts WHERE client_name LIKE '%$search_safe%' ORDER BY $order_column_safe $order_direction_safe";
	
	$results = mysqli_query($connection, $sql);
	
	while ($line = mysqli_fetch_assoc($results)) {
		// Print the current line into the CSV
		fputcsv($output, array($line['id'], $line['client_name'], $line['balance']));
	}
	
	// Cleaning up and closing
	fclose($output);
	mysqli_close($connection);
	exit();
?>