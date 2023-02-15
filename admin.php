<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Admin</title> 
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
				<a href="viewtoys.php">View Toys</a>
				<a class="active" href="admin.php">Admin</a>
				<a href="credits.html">Credits</a>
			</div>
		</nav>
		<main>
			<section>
				<h2>Add Toy</h2>
				<div class = "wrapper">
					<form method = "post" action = "submit.php">
						<fieldset>
							<legend> Enter Toy Details: </legend> <!-- Fieldset title -->	
							<!-- Toy name label and input field -->	
							<label for = "name">Toy Name: </label>
							<input type="text" name="name" id="name" required accesskey = "1" maxlength = "250" placeholder = "Enter Toy Name" >
							<br>
							<!-- Toy price label and input field -->	
							<label for = "price">Price(£): </label>
							<input type="number" name="price" id="price" required accesskey = "2" placeholder = "Enter Toy Price" step = ".01">
							<br>
							<!-- Toy description label and textarea -->	
							<label for = "desc">Description: </label>
							<textarea name="desc" required accesskey = "3" maxlength = "2000" placeholder = "Enter Description" style="height:200px; min-height: 100px;"></textarea>
						</fieldset>
						<fieldset>
							<legend> Select Toy Details: </legend> <!-- Fieldset title -->	
							<!-- Toy category label and select box -->
							<label for = "category">Toy Category: </label> 
							<select name="category" accesskey = "4">
								<?php
									// make db connection
									include 'database_conn.php';									
										
									// SQL Select Statement
									$sql = "SELECT catID, catDesc FROM NTL_category ORDER BY catDesc";
									$queryResult = $conn->query($sql);
										
									// Check for query failure
									if($queryResult === false)
									{
										echo "<p>Query failed: ".$conn->error."</p>\n</body>\n</html>";
										exit;
									}
									// Otherwise fetch all the categories
									else
									{
										while($row = $queryResult->fetch_object())
										{
											echo "<option value = '".$row->catID."'>".$row->catDesc."</option>\n";
										}
									}
									// Closing connection
									$queryResult->close();
									$conn->close();
								?>	
							</select>
							<br>
							<!-- Toy manufacturer label and select box -->
							<label for = "manu">Toy Manufacturer: </label>
							<select name="manu" accesskey = "5">
								<?php
									// make db connection
									include 'database_conn.php';
									
									// SQL Select Statement
									$sql = "SELECT manID, manName FROM NTL_manufacturer ORDER BY manName";
									
									// Executing SQL statement
									$queryResult = $conn->query($sql);

									// Check for query failure
									if($queryResult === false) 
									{
										echo "<p>Query failed: ".$conn->error."</p>\n</body>\n</html>";
										exit;
									}
									// Otherwise fetch all the categories
									else 
									{
										while($row = $queryResult->fetch_object())
										{
											echo "<option value = '".$row->manID."'>".$row->manName."</option>\n";
										}
									}
									// Closing connection
									$queryResult->close();
									$conn->close();
								?>
							</select>
						</fieldset>
						<!-- Add Toy button -->	
						<input type="submit" value="Add Toy">
					</form>
				</div>
			</section>
		</main>
		<footer>	
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
