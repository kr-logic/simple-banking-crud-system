<?php
// Note from my studies: In a real production environment, these variables would be 
// pulled from a .env file or a config file that is NEVER uploaded to GitHub.
$db_host = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "bank_db";

// Telling mysqli not to throw automatic PHP warnings on connection errors,
// which could leak server paths to the browser to potential attackers.
mysqli_report(MYSQLI_REPORT_OFF);

$connection = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

if (!$connection) { 
   
    error_log("Adatbázis csatlakozási hiba: " . mysqli_connect_error());  // Log the real error to the server's error.log file
    
    die("Rendszerhiba: Nem sikerült csatlakozni az adatbázishoz. Kérjük, próbálja később.");     // Stop the script and show a safe, generic message to the user
}

// since normal utf8 is vulnerable to truncation attacks (ie. the hacker submits in too long / special characters)
// utf8mb4 is the true, fully-featured UTF-8 in MySQL (supports emojis and complex symbols to avoid attacks)
mysqli_set_charset($connection, "utf8mb4");
?>
