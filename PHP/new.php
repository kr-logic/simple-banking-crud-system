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
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <title>Gazdaságinformatika projekt</title>
			<style>
			body {
				font-family: Consolas;
				background-color: #668866;
				margin: 30px;
			}
			h1 {
				color: #000;
				text-align: left;
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
	<script>
		function format_number(input) {
		  let value = input.value.replace(/\s/g, ''); 	 				 				// Remove any existing spaces (to avoid double spacing)
		  if (!isNaN(value) && value !== "") {											// Check if the remaining value is a valid number
			input.value = value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, " ");		// Format with spaces using Regex (inserts space every 3 digits)
		  } else {
			input.value = value.replace(/\D/g, ''); 									// If user types letters, strip them out (optional safety)
		  }
		}
	</script>
</head>
	<h1> Adatbázis bővítés </h1>

	<form action="insert.php" method="POST">
	  Név: <input type="text" name="client_name">
	  Tőke (HUF): <input type="text" inputmode="numeric" name="balance" id="tokeInput" oninput="format_number(this)">
	  <input type="submit" value="Bevitel" class="btn">
	</form>

	<br>
	<a href="list.php" class="btn">Mégse</a>
	
	<div style="margin-top: 50px; text-align: right;">
        <small style="color: var(--text-muted);">&copy; Princzinger Krisztián 2026</small>
    </div>
</html>

