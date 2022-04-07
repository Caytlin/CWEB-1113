<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
		<title>View Contact</title>
	</head>
	<body>
		<!-- Container Start -->
		<div class="container">
			<div class="page-header">
				<h1>View Contact</h1>
			</div>

			<?php

				#include database connection
				include"config/database.php";

				#Pulling the record by ID. Making sure the ID exists.
				$id = isset($_GET['id']) ?$_GET['id'] : die("ERROR: ID not found.");

				#Read the current record
				try
				{
					#Prepare Select Query
					$query = "SELECT id, Name, Email, Phone, Title, Created_Date, Modified_Date From contacts WHERE id=? LIMIT 0,1";

					$stmt = $con -> prepare($query);

					$stmt -> bindParam(1,$id);

					#Execute our query
					$stmt -> execute();

					#Store retrieved row to a variable
					$row = $stmt -> fetch(PDO::FETCH_ASSOC);

					#Values to fill up
					$Name = $row["Name"];
					$Email = $row["Email"];
					$Phone = $row["Phone"];
					$Title = $row["Title"];
					$Created_Date = $row["Created_Date"];
					$Modified_Date = $row["Modified_Date"];

				}
				#Show Error
				catch (PDOException $e)
				{
					die("Error : ".$e -> getMessage());
				}

			?>
			<table class="table table-hover table-responsive table-bordered">
				<tr>
					<td>Title</td>
					<td><?php echo $Title;?></td>
				</tr>
				<tr>
					<td>Name</td>
					<td><?php echo $Name;?></td>
				</tr>
				<tr>
					<td>Email Address</td>
					<td><?php echo $Email;?></td>
				</tr>
				<tr>
					<td>Phone Number</td>
					<td><?php echo $Phone;?></td>
				</tr>
				<tr>
					<td>Date Created</td>
					<td><?php echo $Created_Date;?></td>
				</tr>
				<tr>
					<td>Date Modified</td>
					<td><?php echo $Modified_Date;?></td>
				</tr>
			</table>
			<a href="index.php" type="button" class="btn btn-success">Home</a>
		</div>
		<!-- Container End -->
	</body>
</html>