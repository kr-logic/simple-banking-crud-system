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

$connection = mysqli_connect("localhost", "root", "", "bank_db");
mysqli_set_charset($connection, "utf8");

if(isset($_GET['id'])){
	$id = $_GET['id'];
	
	$sql = "SELECT * FROM accounts WHERE id = ?";
	$statement = mysqli_prepare($connection, $sql);
	mysqli_stmt_bind_param($statement, "i", $id);
	mysqli_stmt_execute($statement);
	
	$results = mysqli_stmt_get_result($statement);
	$line = mysqli_fetch_assoc($results); //the current data in the line
	
	// Closing statement and connection
    mysqli_stmt_close($statement);    
	mysqli_close($connection);	
} else {
    die("Nincs ID megadva!");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Szerkesztés</title>
    <style>
        body {
            font-family: Consolas;
            background-color: #668866;
            margin: 30px;
        }
        form { 
		    font-family: Consolas;
			background: gray;
			padding: 20px;
			border-radius: 0px;
			width: 300px;
			box-shadow: 0 4px 8px rgba(0,0,0,0.1);
			font-size: 16px;
            font-weight: bold;
			border-style: solid;
			border-width: 1px;
			box-shadow: 6px 6px 0px #000000;
			border: 2px solid #000000;
	
		}
        input {
			font-family: Consolas;
			width: 90%;
			padding: 10px;
			margin: 10px 0;
			border: 1px solid #ddd;
			border-radius: 4px;
			font-size: 16px;
			background: #ccc;
		}
        input[type=submit] {
			font-family: Consolas, monospace;
			text-transform: uppercase;
			font-weight: bold;
			border: 2px solid #000;
			padding: 8px 15px;
			cursor: pointer;
			box-shadow: 4px 4px 0px #000000; 
			transition: all 0.1s ease-in-out;			
			display: inline-block;
			text-decoration: none;
			color: white;
			background-color: #444;
		}
		input[type=submit]:active {
			box-shadow: 0px 0px 0px #000000;
			transform: translate(4px, 4px);
		}        
		input[type=submit]:hover {
			filter: brightness(1.25);		
		}		
        .btn {
			font-family: Consolas, monospace;
			text-transform: uppercase;
			font-weight: bold;
			border: 2px solid #000;
			padding: 8px 15px;
			cursor: pointer;
			box-shadow: 4px 4px 0px #000000; 
			transition: all 0.1s ease-in-out;
			display: inline-block;
			text-decoration: none;
			color: white;
			background-color: #444;
		}
		.btn:active {
			box-shadow: 0px 0px 0px #000000;
			transform: translate(4px, 4px);
		}       
		 .btn:hover {
			filter: brightness(1.25);
		}
    </style>
</head>
<body>

<h1>Adatok módosítása</h1>

<form action="update.php" method="POST">
	<input type="hidden" name="id" value="<?php echo $line['id']; ?>">
	
	<label>Ügyfél neve:</label>
	<input type="text" name="client_name" value="<?php echo $line['client_name']; ?>">
	
	<label>Egyenleg (HUF):</label>
    <input type="number" name="balance" value="<?php echo $line['balance']; ?>">

    <input type="submit" value="Mentés">
	
</form>    
<br>
<a href="list.php" class="btn">Mégse</a>	

    <div style="margin-top: 50px; text-align: right;">
        <small style="color: var(--text-muted);">&copy; Princzinger Krisztián 2026</small>
    </div>
	

</body>
</html>