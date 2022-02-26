<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
		<title>Customers Lab</title>
	</head>
	<body>
		<div class="container">
			<h2>
				Customers
				<div style='float: right;'>
					<a href="create.php" class="btn btn-primary">Create New</a>
				</div>
				<div>
					<?php
						$action=isset($_GET['action']) ? $_GET['action'] :"";
						if ($action == "deleted")
						{
							echo"<div class='alert alert-success'>Record deleted successfully.</div>";
						}
					?>
				</div>
			</h2>
			
			<table class="table table-striped table-hover table-responsive">
				<head>
					<tr>
						<th>Customer ID</th>
						<th>Customer Name</th>
						<th>Contact Name</th>
						<th>Customer Phone</th>
						<th>Address</th>
						<th>City</th>
						<th>Postal Code</th>
						<th>Country</th>
						<th>Action</th>
					</tr>
				</head>
				<tbody>
					<?php
						#include database connection
						include"config/database.php";

						#select all data
						$query = "SELECT id, Customer_Name, Contact_Name, Contact_Phone, Address, City, Postal_Code, Country From customers ORDER by id ASC";
						
						#preparing the statement
						$stmt = $con -> prepare($query);
						$stmt -> execute();

						while ($row = $stmt -> fetch(PDO :: FETCH_ASSOC))
						{
							extract($row);

							echo"<tr>";
								echo"<td>{$id}</td>";
								echo"<td>{$Customer_Name}</td>";
								echo"<td>{$Contact_Name}</td>";
								echo"<td>{$Contact_Phone}</td>";
								echo"<td>{$Address}</td>";
								echo"<td>{$City}</td>";
								echo"<td>{$Postal_Code}</td>";
								echo"<td>{$Country}</td>";
								echo"<td>";
									echo "<a href = '#' class='btn btn-primary btn-sm'>Read</a>";
									echo "<a href = '#' class='btn btn-warning btn-sm'>Edit</a>";
									echo "<a href = '#' class='btn btn-danger btn-sm'>Delete</a>";
								echo"<td>";
							echo"</tr>";
						}
					?>
				</tbody>
			</table>
		</div>
	</body>
</html>