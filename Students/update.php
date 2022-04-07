<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
		<title>Edit Record</title>
	</head>
	<body>
		<!-- Container Start -->
		<div class="container">
			<div class="page-header">
				<h1>Edit Record</h1>
			</div>

			<?php

			$id=isset($_GET['id']) ?$_GET['id'] : die("ERROR: ID not found.");
			#echo $id; This was used to verify the code was working.

			#include database connection
			include"config/database.php";

			if($_POST)
			{
				try
				{
					#Create query to update the record
					$query= "UPDATE students SET First_Name=?, Last_Name=?, Student_Email=?, Student_Phone=? WHERE id=?";

					#Prepare query for execution
					$stmt = $con -> prepare($query);

					$fname=sanitize_input($_POST['fname']);
					$lname=sanitize_input($_POST['lname']);
					$email=sanitize_input($_POST['email']);
					$phone=sanitize_input($_POST['phone']);
					$id=sanitize_input($id);

					#Bind the parameters
					$stmt -> bindParam(1,$fname);
					$stmt -> bindParam(2,$lname);
					$stmt -> bindParam(3,$email);
					$stmt -> bindParam(4,$phone);
					$stmt -> bindParam(5,$id);

					#Execute the query
					if($stmt -> execute())
					{
						echo "<div class='alert alert-success'>Record updated successfully</div>";
					}
					else
					{
						echo "<div class='alert alert-danger'>Unable to update the record. Please verify all information is correct then try again.</div>";
					}

				}
				catch(PDOException $ER)
				{
					echo "ERROR: ".$ER -> getMessage();
				}
			}

			try
			{
				#Prepare Select Query
				$query = "SELECT id, First_Name, Last_Name, Student_Email, Student_Phone From students WHERE id=? LIMIT 0,1";
				$stmt = $con -> prepare($query);

				#Binding
				$stmt -> bindParam(1,$id);

				#Execute
				$stmt -> execute();

				#Convert the PDO object to an array
				$row = $stmt -> fetch(PDO ::FETCH_ASSOC);

				#This was used to verify the code thus far works.
				#echo "<pre>";
				#print_r($row);
				#echo "</pre>";

				#Values to fill up
				$Fname = $row["First_Name"];
				$Lname = $row["Last_Name"];
				$Email = $row["Student_Email"];
				$Phone = $row["Student_Phone"];

			}
			catch(PDOException $ER)
			{
				echo "ERROR: ".$ER -> getMessage(); 
			}

			#Sanitize the input data
			function sanitize_input ($data)
				{
					$data = trim($data);
					$data = stripslashes($data);
					$data = htmlspecialchars($data);
					return $data;
				}
			?>

			<form action="update.php?id=<?php echo htmlspecialchars($id); ?>" method="post">
				<table class="table table-hover table-responsive table-bordered">
					<tr>
						<td>First Name</td>
						<td>
							<input type="text" name="fname" class="form-control" value="<?php echo $Fname ;?>">
						</td>
					</tr>
					<tr>
						<td>Last Name</td>
						<td>
							<input type="text" name="lname" class="form-control" value="<?php echo $Lname ;?>">
						</td>
					</tr>
					<tr>
						<td>Student Email</td>
						<td>
							<input type="text" name="email" class="form-control" value="<?php echo $Email ;?>">
						</td>
					</tr>
					<tr>
						<td>Student Phone</td>
						<td>
							<input type="text" name="phone" class="form-control" value="<?php echo $Phone ;?>">
						</td>
					</tr>
					<tr>
						<td></td>
						<td>
							<input type="submit" class="btn btn-primary">
							<a href="index.php" class="btn btn-danger">Home</a>
						</td>
					</tr>
				</table>
			</form>
		</div>
		<!-- Container End -->
	</body>
</html>