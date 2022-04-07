<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
		<title>Read</title>
	</head>
	<body>
		<div class="container">
			<div class="page-header">
				<h1>READ CUSTOMER RECORD</h1>
			</div>
			<?php
				#include database connection
				include"config/database.php";

				$id = isset($_GET['id']) ?$_GET['id'] : die("ERROR: ID not found.");

				#Read current record's data.
				try
				{
					$query = "SELECT id, Customer_Name, Contact_Name, Contact_Phone, Address, City, Postal_Code, Country From customers WHERE id=? LIMIT 0,1";

					$stmt = $con -> prepare($query);

					$stmt -> bindParam(1,$id);

					$stmt -> execute();

					$row = $stmt -> fetch(PDO::FETCH_ASSOC);

					#Values to fill up
					$CustomerName = $row["Customer_Name"];
					$ContactName = $row["Contact_Name"];
					$ContactPhone = $row["Contact_Phone"];
					$Add = $row["Address"];
					$city = $row["City"];
					$PostalCode = $row["Postal_Code"];
					$country = $row["Country"];

				}
				#Show error
				catch(PDOException $e)
				{
					die("Error : ".$e -> getMessage());
				}
			?>

			<table class="table table-responsive table-hover table-bordered">
				<tr>
					<td>Customer Name</td>
					<td><?php echo $CustomerName;?></td>
				</tr>
				<tr>
					<td>Contact Name</td>
					<td><?php echo $ContactName;?></td>
				</tr>
				<tr>
					<td>Contact Phone</td>
					<td><?php echo $ContactPhone;?></td>
				</tr>
				<tr>
					<td>Address</td>
					<td><?php echo $Add;?></td>
				</tr>
				<tr>
					<td>City</td>
					<td><?php echo $city;?></td>
				</tr>
				<tr>
					<td>Postal Code</td>
					<td><?php echo $PostalCode;?></td>
				</tr>
				<tr>
					<td>Country</td>
					<td><?php echo $country;?></td>
				</tr>
			</table>
			<a href="index.php" type="button" class="btn btn-success">Home</a>
		</div>
	</body>
</html>