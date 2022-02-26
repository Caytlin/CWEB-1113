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
				<h1>READ DATA</h1>
			</div>
			<?php
				#include database connection
				include"config/database.php";

				$id = isset($_GET['id']) ?$_GET['id'] : die("ERROR: ID not found.");

				#echo $id;

				#Read current record's data.
				try
				{
					#Prepare select query
					$query = "SELECT id, First_Name, Last_Name, Student_Email, Student_Phone From students WHERE id=? LIMIT 0,1";

					$stmt = $con -> prepare($query);

					$stmt -> bindParam(1,$id);

					#Execute our query
					$stmt -> execute();

					#Store retrieved row to a variable
					$row = $stmt -> fetch(PDO::FETCH_ASSOC);
					
					/* This was created to test the array.
					echo "<pre>";
					print_r($row);
					echo "</pre>";
					*/

					#Values to fill up
					$FirstName = $row["First_Name"];
					$LastName = $row["Last_Name"];
					$StudentEmail = $row["Student_Email"];
					$StudentPhone = $row["Student_Phone"];

				}
				#Show error
				catch(PDOException $e)
				{
					die("Error : ".$e -> getMessage());
				}
			?>

			<table class="table table-hover table-responsive table-bordered">
				<tr>
					<td>First Name</td>
					<td><?php echo $FirstName;?></td>
				</tr>
				<tr>
					<td>Last Name</td>
					<td><?php echo $LastName;?></td>
				</tr>
				<tr>
					<td>Student Email</td>
					<td><?php echo $StudentEmail;?></td>
				</tr>
				<tr>
					<td>Student Phone</td>
					<td><?php echo $StudentPhone;?></td>
				</tr>
			</table>
		</div>
	</body>
</html>