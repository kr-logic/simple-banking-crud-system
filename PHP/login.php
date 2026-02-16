<!DOCTYPE html>
<html>
<head>
    <title>Gazdaságinformatika projekt</title>
    <style>	
		.top-background-strip {
			position: absolute;
			top: 0;
			left: 0;
			width: 100%;        
			height: 150px;      
			background-color: #5a5; 
			z-index: -1;        /* Push it behind the text */
			box-shadow: 0px 2px 0px #000; 
		}

		h1,h2 {
			color: #000;
			text-align: center;
		}
		
		html {
			overflow-y: scroll; /* Always show the vertical scroll bar */
		}

        body {
            font-family: Consolas;
            background-color: #686;           
			margin: 30px;
        }
		
		.btn-login {
			font-family: Consolas, monospace;
			text-transform: uppercase;
			font-weight: bold;
			border: 2px solid #000;
			padding: 8px 15px;
			cursor: pointer;
			box-shadow: 4px 4px 0px #000000; /* Retro style, thick shadow */
			transition: all 0.1s ease-in-out; /* Move when pushing button */			
			text-decoration: none;
			color: white;
			background-color: #050;
			}

		.btn-login:active {
			box-shadow: 0px 0px 0px #000000; /* Shadow disappears */
			transform: translate(4px, 4px); /* The button moves to the position of the shadow */
			}
			
		.btn-login:hover {
			filter: brightness(1.25); /* Becomes brigther a little */
			}
			
		.btn-register {
			text-decoration: none;
			margin-left: 70px;
			font-family: Consolas, monospace;
			text-transform: uppercase;
			font-weight: bold;
			border: 2px solid #000;
			padding: 8px 15px;
			cursor: pointer;
			box-shadow: 4px 4px 0px #000000; 
			transition: all 0.1s ease-in-out;
			color: white;
			background-color: #550;
			}

		.btn-register:active {
			box-shadow: 0px 0px 0px #000000;
			transform: translate(4px, 4px);
			}
			
		.btn-register:hover {
			filter: brightness(1.25);
			}
			
		.btn.flex{
			display: flex;               
			margin-top: 20px;
		}
	</style>
</head>
<body>
<?php
	session_start();
	
	//If logged in already, redirect to list.php
	if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
		header("Location: list.php");
		exit;
	}

	// Login (POST)
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$username = $_POST['username'];
		$password = $_POST['password'];
		
		// Connecting to SQL server
		$connection = mysqli_connect("localhost", "root", "", "bank_db");
		mysqli_set_charset($connection, "utf8");
		
		// SQL query to fetch the password hash (SQL injection protection from using prepared statement)
		$sql_login = "SELECT password_hash FROM users WHERE username = ?";	
		
		if ($statement = mysqli_prepare($connection, $sql_login)){
			// Binding parameter: username to ? (s for string)
			mysqli_stmt_bind_param($statement,"s",$username);
			
			//Execute the SQL code
			mysqli_stmt_execute($statement);
			
			//Binding the results
			mysqli_stmt_bind_result($statement, $tarolt_hash);
			
			//Fetch the results
			if (mysqli_stmt_fetch($statement)){ 				//Does the username exist?
				//If it does, verify password
				if(password_verify($password, $tarolt_hash)){
					// Successful login
					echo "Sikeres belépés!";
					$_SESSION['logged_in'] = true;
					$_SESSION['logged_in_username'] = $username;					
					// Redirect to the database
					header("Location: list.php");
					exit;
				} else {
					echo "<script>alert('Hibás jelszó!');</script>";
				}
			} else {
				echo "<script>alert('Nem létező felhasználónév!');</script>";
				
			}
			
		//Closing SQL statement
		mysqli_stmt_close($statement);			
		} else { 
		echo "Hiba az SQL parancs előkészítésekor: " . mysqli_error($connection);
		}
	} 
?>

<div class="top-background-strip"></div>
<div class="container">
        </div>
<h1>Gazdaságinformatika projekt</h1>
<h2>Számlavezető rendszer</h2>
<br>
<br>
<h3 style="text-align: left;">Belépés</h3>

	<form method="POST">
		Felhasználónév: <input type="text" name="username"> <br><br>
		Jelszó: <input type="password" name="password"> <br><br><br>
		<div class="btn-flex">
			<input type="submit" value="Belépés" class="btn-login" style="font-size: 16px;">
			<a class="btn-register" href="register.php">Regisztráció</a>
		</div>
	</form>
	
    <div style="margin-top: 50px; text-align: right;">
        <small style="color: var(--text-muted);">&copy; Princzinger Krisztián 2026</small>
    </div>
	
</body>
</html>