<?php
session_start();

// Check for login session
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    // If not logged in, redirect to login page
    header("Location: login.php");
    exit;
}

$username = $_SESSION['logged_in_username'];

?>
<!DOCTYPE html>
<html>
<head>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <title>Gazdaságinformatika projekt</title>
    <style>	
		.top-background-strip {
			position: absolute;					/* Takes out of normal flow */
			top: 0;
			left: 0;
			width: 100%;        
			height: 150px;      
			background-color: #5a5;
			z-index: -1;						/* Place behind text */
			box-shadow: 0px 2px 0px #000; 
		}
        body {
            font-family: Consolas;
            background-color: #686;           
			margin: 30px;
        }
		h1,h2 {
			color: #000;
			text-align: center;
		}
		table {									/* Table styling */
			margin-left: auto;
			margin-right: auto;
			width: 50.2%;  
            border-collapse: collapse;			/* To avoid double borders */
            background-color: gray;
			box-shadow: 6px 6px 0px #000000;	/* Hard black shadow */
			border: 2px solid #000000;			/* Thicker border */
        }
		
        /* 4. Table header and data */
        th, td {
            padding: 15px;						/* Adds spacing for readability */
            text-align: left;
            border-bottom: 1px solid #000;		/* Thin bottom border */
        }
		
        /* 5. Header only styling */
        th {
            background-color: #965;
            color: black;
        }		
		
        /* Zebra striping: Lighter background for even rows */
        tr:nth-child(even) {
            background-color: #949494;
        }
		
        /* Hover effect: Darken row on mouse over (skips header with :not(:first-child) ) */
        tr:not(:first-child):hover {
            background-color: #000066;
            cursor: pointer;
			color: white;
        }

        /* 8. Button styling */
        .btn {
			font-family: Consolas, monospace;
			text-transform: uppercase;			/* All caps */
			font-weight: bold;
			border: 2px solid #000;				/* Thick black border */
			padding: 8px 15px;
			cursor: pointer;
			box-shadow: 4px 4px 0px #000000;	/* Hard shadow */
			transition: all 0.1s ease-in-out;	/* Smooth transition */
			display: inline-block;
			text-decoration: none;
			color: white;
			background-color: #444;
		}
		.btn:active {
			box-shadow: 0px 0px 0px #000000;	/* Remove shadow */
			transform: translate(4px, 4px); 	/* Shift button to simulate press */
		}
		  .btn:hover {
			filter: brightness(1.25);			/* Increase brightness slightly */
		}
		.btn-del {
			font-family: Consolas, monospace;
			text-transform: uppercase;
			font-weight: bold;
			border: 2px solid #000;
			padding: 2px 5px;
			cursor: pointer;
			box-shadow: 4px 4px 0px #000000;
			transition: all 0.1s ease-in-out;
			display: inline-block;
			text-decoration: none;
			color: white;
			background-color: #c00;
		}
		.btn-del:active {
			box-shadow: 0px 0px 0px #000000;
			transform: translate(4px, 4px);
		}        
		  .btn-del:hover {
			filter: brightness(1.25);
		}
		.btn-edit {		
			font-family: Consolas, monospace;
			text-transform: uppercase;
			font-weight: bold;
			border: 2px solid #000;
			padding: 2px 5px;
			cursor: pointer;			
			box-shadow: 4px 4px 0px #000000; 
			transition: all 0.1s ease-in-out;
			display: inline-block;
			text-decoration: none;
			color: white;
			background-color: #c94;
	
		}
		.btn-edit:active {
			box-shadow: 0px 0px 0px #000000;
			transform: translate(4px, 4px);
		}        
		.btn-edit:hover {
			filter: brightness(1.25);
		}
		.header-container {
			display: grid;
			grid-template-columns: 1fr auto 1fr; 	/* 3 columns: left (empty) | middle (form) | right (cards) */
			grid-template-rows: auto auto;			
			column-gap: 100px;			
			align-items: center;					/* Vertically center everything */
			width: 100%;
			box-sizing: border-box;					/* Ensures padding doesn't widen the page */
			position: relative;						
			border-bottom: 0px solid #ccc;
			padding: 10px;
			margin-top: 10px;
		}		
		.welcome-container {
			box-sizing: border-box;					/* Ensures padding doesn't widen the page */
			position: relative;
			padding: 10px;
			margin-top: 50px;
		}
		
		form { 
			grid-column: 2;				
			align-self: center;						/* Prevents stretching */
			height: fit-content;					/* Adjusts height to fit the content */
			font-family: Consolas, monospace;		/* Retro Style */
			background: gray;
			padding: 20px;
			font-size: 16px;
			font-weight: bold;
			border: 2px solid #000000;
			box-shadow: 6px 6px 0px #000000;
			
			/* Layout inside the form */
			display: flex; 
			gap: 10px;								/* Spacing between elements */
			align-items: center;
		}
		
		input{
			border: 2px solid #888;
			border-left-color: #000;
			border-top-color: #000;
			border-right-color: #fff;
			border-bottom-color: #fff;
			background-color: #eee;
			padding: 5px;
			font-family: Consolas;		
		}		
		.top-right-btn1 {
			position: absolute;
			top: 8px;
			right: 10px;
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
			background-color: #b44;
		}
		.top-right-btn1:active {
			box-shadow: 0px 0px 0px #000000;
			transform: translate(4px, 4px);
		}
		.top-right-btn2 {
			position: absolute;
			top: -60px;
			right: 10px;
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
		.top-right-btn2:active {
			box-shadow: 0px 0px 0px #000000;
			transform: translate(4px, 4px);
		}
		.dashboard {
			display: flex;
			gap: 20px;
			margin-bottom: 30px;
			margin-top: 30px;
		}
		.card {
			background: gray; 
			border: 2px solid #000; 
			box-shadow: 6px 6px 0px #000000; 
			border-radius: 0px; 
			padding: 10px;
			text-align: center;
			min-width: 200px;
			font-family: Consolas, monospace;
			border-left-width: 15px; 
			border-left-style: solid; 
			transition: all 0.1s;
		}
		.card h3 {
			margin: 0;
			font-size: 0.9em;
			color: #000;
			text-transform: uppercase;
			font-weight: bold;
			border-bottom: 2px solid #000;
			padding-bottom: 1px;
			background-color: #ddd;
		}
		.card p {
			margin: 5px 0 0 0;
			font-size: 1.5em;
			font-weight: bold;
			color: #000;
		}
		.blue-card { 
			border-left-color: #000066; 
		}
		.green-card { 
			border-left-color: #004400; 
		}			
		.side-by-side-container {
			display: flex;          			/* Places items side-by-side */
			gap: 20px;              			/* Spacing between elements */
			align-items: flex-start;			/* Aligns items to the top */
			flex-wrap: wrap;					/* Wraps to new line on smaller screens (responsive) */
		}
		.table-container {
			flex: 15;                
			min-width: 300px;
		}
		.chart-container{
			flex: 0 0 auto;               
			min-width: 50px;
			background-color: #949494; 
			border: 2px solid #000;
			box-shadow: 5px 5px 0px #000000; 
		}

		/* Ensures table and canvas fill their container */
			table { width: 100%; }
			canvas { width: 100% !important; height: auto !important; }
			
		
		.tooltip-wrapper {						/* Wrapper element that triggers the tooltip */
			position: relative;					/* Tooltip is positioned relative to this element */
			display: inline-block;
		}		
		.custom-tooltip {
			visibility: hidden;
			width: 400px;
			background-color: #949494;
			color: #fff;
			text-align: center;
			border: 2px solid #000;
			box-shadow: 5px 5px 0px #000000; 
			padding: 8px;
			position: absolute;
			z-index: 10;          				/* Ensures layer stays on top */
			bottom: -573%;         				
			left: -421%;
			transform: translateX(-50%); 		/* Centers the element relative to its position */
			opacity: 0;
			transition: opacity 0.3s;			/* Smooth fade effect */
			}
		
		.tooltip-wrapper:hover .custom-tooltip {
			visibility: visible;
			opacity: 1;
		}
	
    </style>
</head>
<body>

<div class="top-background-strip"></div>

<h1>Gazdaságinformatika projekt</h1>
<h2>Számlavezető rendszer</h2>

	<div class="welcome-container">
			<div style="font-family: Consolas, monospace;	border: 2px solid #000;	padding: 8px 15px; background: gray; width: fit-content; white-space: nowrap;">
				Üdv, <b><?php echo "$username" ; ?></b>!
				<a href="logout.php" class="top-right-btn1">Kilépés</a>
			</div>
	</div>

<?php

	// Connecting
	require_once 'db_connect.php';  // Imports $connection from db_connect.php

	// Query for statistics (used in cards)
	$sql_stats = "SELECT COUNT(id) AS client_count, SUM(balance) AS total_balance FROM accounts";

	$results_stats = mysqli_query($connection, $sql_stats);
	$stats_data = mysqli_fetch_assoc($results_stats);
	
	//Fetching chart data
	$sql_chart = "SELECT client_name, balance FROM accounts";
	$chart_results = mysqli_query($connection, $sql_chart);

	$chart_labels = []; 			// Names (e.g., ["Kovács", "Szabó"])
	$chart_data = [];   			// Amounts (e.g., [100000, 50000])

	while ($row = mysqli_fetch_assoc($chart_results)) {
		$chart_labels[] = $row['client_name'];
		$chart_data[] = $row['balance'];
	}
	
	if (!$connection) {
		die("Hiba: " . mysqli_connect_error());
	}
	
?>

<h1>Ügyfelek és egyenlegek</h1>  

<div class="header-container">
    <form action="list.php" method="GET">
        <input type="text" name="search" placeholder="Keresés..." value="<?php if(isset($_GET['search'])) echo $_GET['search']; ?>">
        <input type="submit" value="Keresés" class="btn">
        <a href="list.php" class="btn" style="text-decoration:none; color:white; font-size: 13px;">Szűrés visszaállítása</a>
    </form>	
    <div class="dashboard">
	   <div class="card blue-card">
			<h3>Ügyfelek száma</h3>
			<p><?php echo $stats_data['client_count']; ?> fő</p>
	   </div>

	   <div class="card green-card">
			<h3>Teljes vagyon</h3>
			<p>
				<?php 
					$assets = $stats_data['total_balance'] ? $stats_data['total_balance'] : 0;
					echo number_format($assets, 0, ',', ' '); 
				?> Ft
			</p>
	   </div>
	</div>
	
</div>

<div class="side-by-side-container">

<?php

// Query for the list based on URL parameters
	//Set search pattern
	$searched_name = isset($_GET['search']) ? $_GET['search'] : "";
	$search_pattern = "%" . $searched_name . "%";       //If there is no search, it will find everything
	
	//'Order by' WHITELIST (NOT IMPLEMENTED YET!)
	$valid_columns = ['id', 'client_name', 'balance'];
	$valid_directions = ['ASC', 'DESC'];
	
	// Set the order and direction for the prepared statement (default: ascending by id)
	$order_column = (isset($_GET['order']) && in_array($_GET['order'], $valid_columns)) ? $_GET['order'] : 'id';
	$order_direction = (isset($_GET['direction']) && in_array($_GET['direction'], $valid_directions)) ? $_GET['direction'] : 'ASC';
			

	$sql = "SELECT * FROM accounts WHERE client_name LIKE ? ORDER BY $order_column $order_direction";
	
	$statement = mysqli_prepare($connection, $sql);
	mysqli_stmt_bind_param($statement, "s", $search_pattern);
	mysqli_stmt_execute($statement);
	$results = mysqli_stmt_get_result($statement);
	
	
	// Auxiliary function to generate link
	// Used to keep search results even if you order the table after searching
	function ordering_link($text, $column_name, $current_column, $current_direction) {
		
		$new_direction = 'ASC'; // Default value
		$arrow = ''; // Arrow character to show ordering, defaults to no arrow
		
		// If the list is ordered by the selected column, switch direction
		if ($column_name == $current_column) {
			if ($current_direction == 'ASC') {
				$new_direction = 'DESC';
			} else {
				$new_direction = 'ASC';
			}
		}
		
		// Arrow icon
        // Show the direction on the currently ordered column, 
        // If it's not the active column, it doesn't matter; won't be visible, but has the same width
        $arrow = ($column_name == $current_column && $current_direction == 'ASC') ? '↑' : '↓️';
		
		
		//Visibility of the arrow
		$visibility = ($column_name == $current_column) ? "visible" : "hidden";
		
		// Keep the search parameters in the URL
		$search_param = isset($_GET['search']) ? "&search=" . $_GET['search'] : "";
		

	//Table header		
		echo "<a href='?order=$column_name&direction=$new_direction$search_param' style='color: black; text-decoration: none; display: inline-block;'>
				$text<span style='visibility: $visibility; padding: 10px; '>$arrow</span>
			  </a>";
	}
	
	echo '<div class="table-container">';
	echo "<table>";
		echo "<tr>";
			echo "<th>"; ordering_link("ID", "id", $order_column, $order_direction); echo "</th>";
			echo "<th>"; ordering_link("Ügyfél neve", "client_name", $order_column, $order_direction); echo "</th>";
			echo "<th>"; ordering_link("Egyenleg (HUF)", "balance", $order_column, $order_direction); echo "</th>";
			echo "<th>Művelet</th>";
		echo "</tr>";

	// Filling the $line variable as long as there is data available (loop)
	while ($line = mysqli_fetch_assoc($results)) {
		echo "<tr>";
		echo "<td>" . $line['id'] . "</td>"; 
		echo "<td>" . htmlspecialchars($line['client_name']) . "</td>";	
		echo "<td>" . number_format($line['balance'], 0, ',', ' ') . " Ft</td>"; 	// 'number_format' to display numbers in a readable way		
		echo "<td>
				<a href='delete.php?id=" . $line['id'] . "' class='btn-del'
				onclick=\"return confirm('Biztosan törölni akarod ezt az ügyfelet?');\">
				TÖRLÉS</a>
				<a href='edit.php?id=" . $line['id'] . "' class='btn-edit'>SZERKESZTÉS</a>				
			  </td>";		
		echo "</tr>";
	}
	echo "</table>";
	echo "</div>";
	mysqli_close($connection);	 	// Closing connection
	
    $export_link = "export.php?order=" . $order_column . "&direction=" . $order_direction;	// Dynamic export link creation with ordering parameters

    if (!empty($searched_name)) {															// Concatenate search parameter
        $export_link .= "&search=" . urlencode($searched_name);								// 'urlencode' in case there are special characters in the search
    }

?>  <! -- continuation of the table HTML started in php -->
	<div class="chart-container">
		<div class="tooltip-wrapper">
				<canvas id="balance_chart_small" style="max-height: 50px;"></canvas>
			<span class="custom-tooltip" style="color: #000;">
				Vagyoneloszlás
				<canvas id="balance_chart" style="max-height: 300px;"></canvas>
			</span>
		</div>
		<div style="font-size: 12px;">	
			Eloszlás
		</div>		
	</div>
</div>

<?php
	echo '<br>
	<div style="text-align: center;">
				<a style="background-color: #373;" class="btn" href="' . $export_link . '">LEKÉRDEZÉS EXPORTÁLÁSA (CSV)</a>
				<a style="margin-left: 100px;" href="new.php" class="btn"> Új tétel</a>
	</div>';
?>

    <div style="margin-top: 50px; text-align: right;">
        <small style="color: var(--text-muted);">&copy; Princzinger Krisztián 2026</small>
    </div>
	
<script>
	function generate_colors(count) {
		const colors = [];
		for (let i = 0; i < count; i++) {
			const hue = Math.round(i * (360 / count)); 	// Divide 360 degrees by the number of elements (e.g., increments of 36° for 10 items)
			colors.push(`hsl(${hue}, 70%, 60%)`);		// HSL: Hue, 70% saturation, 60% lightness; to make the colors vibrant and clearly visible
		}
		return colors;
	}

	// Convert PHP arrays into JavaScript arrays
	// 'echo json_encode(...)' embeds the server-side data directly into the JS code
    const labels = <?php echo json_encode($chart_labels); ?>;
    const data = <?php echo json_encode($chart_data); ?>;

    const ctx = document.getElementById('balance_chart');
	const ctx_small = document.getElementById('balance_chart_small');
	
	const myData = data;
    const myColors = generate_colors(myData.length); // Generate exactly as many colors as we need
	
	const commonData = {
    labels: labels,
    datasets: [{
        label: 'Egyenleg (Ft)',
        data: data,
        borderWidth: 1,
        borderColor: '#000',
        backgroundColor: myColors
    }]
};

	Chart.defaults.color = '#000'

    new Chart(ctx, {
        type: 'pie',		 // Options: 'doughnut', 'pie', 'bar', 'line'
        data: commonData,
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom',
					labels: {
						font: {
							family: 'Consolas',
						}
					}
                }
            }
        }
    });
	
new Chart(ctx_small, {
    type: 'pie',
        data: commonData,
    options: {
        responsive: true,
        maintainAspectRatio: false,        
        events: [],        
        plugins: {
            legend: {
                display: false // Hides legend
            },
            tooltip: {
                enabled: false // Disables built-in tooltips
            },
            title: {
                display: false
            }
        }
    }
});
</script>
</body>
</html>