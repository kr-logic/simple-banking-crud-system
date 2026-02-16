<?php
	$message = "";

	if($_SERVER["REQUEST_METHOD"] == "POST") {
		$connection = mysqli_connect("localhost", "root", "", "bank_db");
		
		$username = $_POST['user'];
		$password = $_POST['pass'];

		if (!empty($username) && !empty($password)) {								// Check if the fields are empty
			$hashed_password = password_hash($password, PASSWORD_DEFAULT); 			// Hashing password, PASSWORD_DEFAULT is always using the latest, most safe method (e.g. Bcrypt)
			$sql = "INSERT INTO users (username, password_hash) VALUES (?, ?)";		// Prepared statement
			$statement = mysqli_prepare($connection, $sql);
			
			if($statement){
				mysqli_stmt_bind_param($statement, "ss", $username, $hashed_password);
				
				//Error handling
				try{
					if (mysqli_stmt_execute($statement)){
						$message = "Sikeres regisztráció! <a href='login.php'> Bejelentkezés </a>";
					}
				}
				catch (mysqli_sql_exception $e){
						$message = "Hiba: Ez a felhasználónév már létezik!";
					}
				mysqli_stmt_close($statement);
			} else {
				$message = "Hiba az SQL parancs előkészítésében: " . mysqli_error($connection);
			}
		} else {
			$message = "Minden mezőt ki kell tölteni!";
		}
		mysqli_close($connection);
		}
?>	

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
			z-index: -1;
			box-shadow: 0px 2px 0px #000; 
		}
		h1,h2 {
			color: #000;
			text-align: center;
		}		
		html {
			overflow-y: scroll;
		}
        body {
            font-family: Consolas;
            background-color: #686;           
			margin: 30px;
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
		.btn-register {
			font-family: Consolas, monospace;
			text-transform: uppercase;
			font-weight: bold;
			border: 2px solid #000;
			padding: 8px 15px;
			cursor: pointer;
			box-shadow: 4px 4px 0px #000000; 
			transition: all 0.1s ease-in-out;
			text-decoration: none;
			color: white;
			background-color: #050;
			}
		.btn-register:active {
			box-shadow: 0px 0px 0px #000000;
			transform: translate(4px, 4px);
			}
		.btn-register:hover {
			filter: brightness(1.25);
			}						
		.btn-login {
			font-family: Consolas, monospace;
			text-transform: uppercase;
			font-weight: bold;
			border: 2px solid #000;
			padding: 8px 15px;
			cursor: pointer;
			box-shadow: 4px 4px 0px #000000; 
			transition: all 0.1s ease-in-out;
			text-decoration: none;
			color: white;
			background-color: #550;
			}
		.btn-login:active {
			box-shadow: 0px 0px 0px #000000;
			transform: translate(4px, 4px);
			}			
		.btn-login:hover {
			filter: brightness(1.25);
			}			
	</style>
</head>
<body>
<div class="top-background-strip"></div>
<div class="container">
        </div>
<h1>Gazdaságinformatika projekt</h1>
<h2>Számlavezető rendszer</h2>
<br>
<br>
<h3 style="text-align: left;">Regisztráció</h3>


	<form method="POST">
	  Felhasználónév: <input type="text" name="user"> <br><br>
	  Jelszó: <input type="password" name="pass">
	  <br>
	  <br>
	  <?php if ($message) echo "<div>$message</div>"; ?>
	  <br>
	  <input type="submit" value="Regisztráció véglegesítése" class="btn-register" style="font-size: 15px;">
	  <br>
	  <br>
	  <br>
	  <br>
	  <a href="login.php" class="btn-login">Vissza a belépésre</a>
	</form>
	
    <div style="margin-top: 50px; text-align: right;">
        <small style="color: var(--text-muted);">&copy; Princzinger Krisztián 2026</small>
    </div>
	
</body>
</html>