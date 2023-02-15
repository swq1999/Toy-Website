<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>View Toys</title> 
		<link href = "webpage.css" rel = "stylesheet" type = "text/css">
		<meta name="viewport" content="width=device-width, initial-scale=1"> 
	</head> 
	<body class="gridContainer1">
		<header>
			<img class = "logo" src = "logo2.png" alt = "Northumbria Toys Company">
		</header> 
		<nav>
			<div class="navbar">
				<a href="homepage.html">Home</a> 
				<a class="active" href="viewtoys.php">View Toys</a>
				<a href="admin.php">Admin</a>
				<a href="credits.html">Credits</a>
			</div>
		</nav>
		<main>
			<section class = "toylist">
				<h2>Toys</h2>
				<?php
					// make db connection
					include 'database_conn.php';

					// SQL Select Statement
					$sql = "SELECT toyName, description, toyPrice, catDesc, manName 
							FROM NTL_toys 
							INNER JOIN NTL_category
							ON NTL_category.catID=NTL_toys.catID
							INNER JOIN NTL_manufacturer
							ON NTL_manufacturer.manID=NTL_toys.manID
							ORDER BY toyName";
					
					// Executing SQL statement
					$queryResult = $conn->query($sql);
					
					// Check for query failure
					if($queryResult === false) 
					{
						echo "<p>Query failed: ".$conn->error."</p>\n";
						exit;
					}
						
					// Otherwise fetch all the rows
					else 
					{
						while($row = $queryResult->fetch_object())
						{
							echo
							"<div class ='NTL_toys'>
								<span class='toyName'>".$row->toyName."</span><br>
								<span class='description'><span class='bolds'>Description:</span><br>".$row->description."</span><br>
								<span class='catMan'>
									<span class='bolds'>Category: </span>".$row->catDesc."<br>
									<span class='bolds'>Manufacturer: </span>".$row->manName."
								</span><br>
								<span class='toyPrice'>Price: £".$row->toyPrice."</span>
							</div>";
						}
					}
					
					// Closing connection
					$queryResult->close();
					$conn->close();
				?>	
			</section>
		</main>
		<footer>
			<img class = "mariowalk" src = "mariowalk.gif" alt = "Mario running">
			<h4>Contact us:</h4>
			<p>
				Email: toycompany@northumbria.ac.uk <br>
				Phone: +44123456789 <br>
				Working Days/Hours: Mon - Fri / 10:00AM - 5:00PM
			</p>	
			<p>&copy; 2022 Northumbria Toy Company. All Rights Reserved.</p>
		</footer>
	</body> 
</html>
