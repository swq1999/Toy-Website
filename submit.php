<?php
	// make db connection
	include 'database_conn.php';
	
	// Assigning form values to variables
	$name = $_POST['name'];
	$desc = $_POST['desc'];
	$price = $_POST['price'];
	$category = $_POST['category'];
	$manu = $_POST['manu'];
	
	// Isset check on the variables
	$name = isset($_POST['name']) ? $_POST['name']:null;
	$desc = isset($_POST['desc']) ? $_POST['desc']:null;
	$price = isset($_POST['price']) ? $_POST['price']:null;
	$category = isset($_POST['category']) ? $_POST['category']:null;
	$manu = isset($_POST['manu']) ? $_POST['manu']:null;
	
	// Escaping apostrophe
	$name = $conn->real_escape_string($name);
	$desc = $conn->real_escape_string($desc);

	// SQL INSERT Statement
	$sql = 	"INSERT into NTL_toys(toyName, description, manID, catID, toyPrice) 
			values ('".$name."', '".$desc."', '".$manu."', '".$category."', '".$price."')";
	
	// SQL SELECT Statement
	$sql2 = "SELECT toyName, description, toyPrice, catDesc, manName 
			FROM NTL_toys 
			INNER JOIN NTL_category
			ON NTL_category.catID=NTL_toys.catID
			INNER JOIN NTL_manufacturer
			ON NTL_manufacturer.manID=NTL_toys.manID
			WHERE toyID = (SELECT max(toyID) from NTL_toys)
			"; 
	
	// Executing SQL INSERT statement		
	$queryResult = $conn->query($sql);
		
	// Check for query failure
	if($queryResult === false)
	{
		echo "<p>Query failed.</p>\n";
		echo "<p>Error: ".$conn->error."</p>\n";
		echo "<a href = 'admin.php'>Try again</a>\n";
		echo "<a href = 'homepage.html'>Return to Homepage</a>";
		exit;
	}
	// If query is successful
	else
	{
		// Executing SQL SELECT statement		
		$queryResult = $conn->query($sql2);
		
		// Check for query failure
		if($queryResult === false) 
		{
			echo "<p>Query failed: ".$conn->error."</p>\n";
			exit;
		}
		// Otherwise fetch the row
		else 
		{	
			while($row = $queryResult->fetch_object())
			{	
				// Printing out all the results
				echo "<p>Toy was successfully added.</p>\n";
				echo "<p>Name: ".$row->toyName."</p>\n";
				echo "<p>Price: £".$row->toyPrice."</p>\n";
				echo "<p>Description: ".$row->description."</p>\n";
				echo "<p>Category: ".$row->catDesc."</p>\n";
				echo "<p>Manufacturer: ".$row->manName."</p>\n";
				echo "<a href = 'admin.php'>Add another Toy</a><br>";
				echo "<a href = 'homepage.html'>Return to Homepage</a>";
			}
		}	
		
		// Closing connection
		$queryResult->close();
		$conn->close();
	}
?>