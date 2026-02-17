<?php
session_start();

// Check for login session
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    // If not logged in, redirect to login page
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="hu">
<head>
	<meta charset="UTF-8">
    <style>
        body {
            font-family: Consolas;
            background-color: #668866;
            margin: 30px;
			font-weight: bold;
        }
        h1 {
            color: #000;
            text-align: center;
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

<?php
	if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['client_name']) && isset($_POST['balance'])) {
		
		// Connecting
		require_once 'db_connect.php';  // Imports $connection from db_connect.php
		
		if (!$connection) {
            die("Kapcsolódási hiba: " . mysqli_connect_error());
        }
		
		$name = $_POST['client_name'];
		$balance_string = $_POST['balance'];
		// Delete spaces so that PHP sees "1500000" instead of "1 500 000"
		$balance = str_replace(' ', '', $balance_string);

		if (!$connection) {
			die("Kapcsolódási hiba: " . mysqli_connect_error());
		}

		// Prepared statement
		$sql = "INSERT INTO accounts (client_name, balance) VALUES (?, ?)";
		$statement = mysqli_prepare($connection, $sql);

		if ($statement) {
			// Bind parameters: "s" (string) for name, "i" (integer) for balance
			mysqli_stmt_bind_param($statement, "si", $name, $balance);

			// Execute
			if (mysqli_stmt_execute($statement)) {
				echo "Sikeres mentés!";		
			} else {
				echo "Hiba történt: " . mysqli_error($connection);
			}

			// Closing statement
			mysqli_stmt_close($statement);

		} else {
			echo "Hiba az előkészítésben: " . mysqli_error($connection);
		}
		
	// Closing connection
	mysqli_close($connection);
		
	} else {
		echo "<h2>Nincs feldolgozandó adat.</h2>";
	}
?>

<br>
<br>

<div>
    <a href="new.php" class="btn"> További tétel rögzítése</a>
    <a href="list.php" class="btn"> Vissza a listára</a>
</div>
	
    <div style="margin-top: 50px; text-align: right;">
        <small style="color: var(--text-muted);">&copy; Princzinger Krisztián 2026</small>
    </div>
</body>
</html>