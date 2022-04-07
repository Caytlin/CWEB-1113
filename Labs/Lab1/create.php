<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
		<title>PDO: Create a Record</title>
	</head>
	<body>
		<!-- Container Start -->
		<div class="container">
			<div class="page-header">
				<h1>Create New Customer Record</h1>
			</div>
			<?php
			if ($_POST)
			{
				#include database connection
				include"config/database.php";
				try
				{
					#Insert Query
					$query= "INSERT INTO customers SET Customer_Name=:custname, Contact_Name=:conname, Contact_Phone=:conphone, Address=:address, City=:city, Postal_Code=:zip, Country=:country";

					#Prepare query for execution
					$stmt = $con -> prepare($query);

					$CustName = htmlspecialchars(strip_tags($_POST['custname']));
					$ConName = htmlspecialchars(strip_tags($_POST['conname']));
					$Phone = htmlspecialchars(strip_tags($_POST['conphone']));
					$Add = htmlspecialchars(strip_tags($_POST['address']));
					$Cit = htmlspecialchars(strip_tags($_POST['city']));
					$ZIP = htmlspecialchars(strip_tags($_POST['zip']));
					$Ctry = htmlspecialchars(strip_tags($_POST['country']));

					#Bind parameters
					$stmt -> bindParam(':custname',$CustName);
					$stmt -> bindParam(':conname',$ConName);
					$stmt -> bindParam(':conphone',$Phone);
					$stmt -> bindParam(':address',$Add);
					$stmt -> bindParam(':city',$Cit);
					$stmt -> bindParam(':zip',$ZIP);
					$stmt -> bindParam(':country',$Ctry);

					#Execute query

					if ($stmt -> execute())
					{
						Echo '<div class="alert alert-success" role="alert"> Entry Successful </div>';
					}
					else
					{
						echo '<div class="alert alert-warning" role="alert">Entry failed. Please verify data is correct and resubmit.</div>';
					}
				}
				catch(PDOException $e)
				{
					echo "ERROR: ".$e -> getMessage();
				}
			};
			?>
			<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
				<table class="table table-hover table-responsive ">
					<tr>
						<td>Customer Name</td>
						<td><input type="text" name="custname" class="form-control"></td>
					</tr>
					<tr>
						<td>Contact Name</td>
						<td><input type="text" name="conname" class="form-control"></td>
					</tr>
					<tr>
						<td>Contact Phone</td>
						<td><input type="text" name="conphone" class="form-control"></td>
					</tr>
					<tr>
						<td>Street Address</td>
						<td><input type="text" name="address" class="form-control"></td>
					</tr>
					<tr>
						<td>City</td>
						<td><input type="text" name="city" class="form-control"></td>
					</tr>
					<tr>
						<td>Postal Code</td>
						<td><input type="text" name="zip" class="form-control"></td>
					</tr>
					<tr>
						<td>Country</td>
						<td><input type="text" name="country" class="form-control"></td>
					</tr>
					<tr>
						<td></td>
						<td><input type="submit" value="Save" name="Submit" class="btn btn-primary"> <a href="index.php" class="btn btn-danger">Home</a></td>
					</tr>
				</table>
			</form>
		</div>
		<!-- Container End -->
	</body>
</html>