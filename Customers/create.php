<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
		<style type="text/css">
			.Error {color:red;}
		</style>
		<title>PDO: Create a Record</title>
	</head>
	<body>
		<!-- Container Start -->
		<div class="container">
			<div class="page-header">
				<h1>Create New Customer Record</h1>
			</div>
			<?php

				#include database connection
				include"config/database.php";

				$CustName = "";
				$custNameError = "";
				$ConName = "";
				$conNameError = "";
				$Phone = "";
				$phoneError = "";
				$Add = "";
				$addressError = "";
				$Cit = "";
				$cityError = "";
				$ZIP = "";
				$ZipError = "";
				$Ctry = "";
				$countryError = "";
				$isCustNameValid = false;
				$isConNameValid = false;
				$isPhoneValid = false;
				$isAddValid = false;
				$isCityValid = false;
				$isZipValid = false;
				$isCtryValid = false;

				
				if ($_SERVER['REQUEST_METHOD']=="POST")
				{
					#Check if customer name is valid
					if (empty($_POST['custname']))
					{
						$custNameError = "Customer name is required";
						$isCustNameValid = false;
					}
					else
					{
						$CustName = sanitize_input($_POST['custname']);
						if (!preg_match("/^[a-zA-Z-' ]*$/", $CustName))
						{
							$custNameError = "Only letters and whitespace allowed";
							$isCustNameValid = false;
						}
						else
						{
							$isCustNameValid = true;
						}
					}

					#Check if contact name is valid
					if (empty($_POST['conname']))
					{
						$conNameError = "Contact name is required";
						$isConNameValid = false;
					}
					else
					{
						$ConName = sanitize_input($_POST['conname']);
						if (!preg_match("/^[a-zA-Z-' ]*$/", $ConName))
						{
							$conNameError = "Only letters and whitespace allowed";
							$isConNameValid = false;
						}
						else
						{
							$isConNameValid = true;
						}
					}

					#Check if contact phone number is valid
					if (empty($_POST['conphone']))
					{
						$phoneError = "Contact phone number is required";
						$isPhoneValid = false;
					}
					else
					{
						$Phone = sanitize_input($_POST['conphone']);
						if (!preg_match("/^[+]?[1-9][0-9]{9,14}$/", $Phone))
						{
							$phoneError = "Please enter a valid phone number";
							$isPhoneValid = false;
						}
						else
						{
							$isPhoneValid = true;
						}
					}

					#Check if address is valid
					if (empty($_POST['address']))
					{
						$addressError = "Address is required";
						$isAddValid = false;
					}
					else
					{
						$Add = sanitize_input($_POST['address']);
						if (!preg_match("/^[0-9a-zA-Z. ]+$/", $Add))
						{
							$addressError = "Please enter a valid address";
							$isAddValid = false;
						}
						else
						{
							$isAddValid = true;
						}
					}

					#Check if city is valid
					if (empty($_POST['city']))
					{
						$cityError = "City is required";
						$isCityValid = false;
					}
					else
					{
						$Cit = sanitize_input($_POST['city']);
						if (!preg_match("/^[a-zA-Z-' ]*$/", $Cit))
						{
							$cityError = "Only letters and whitespace allowed";
							$isCityValid = false;
						}
						else
						{
							$isCityValid = true;
						}
					}

					#Check if postal code is valid
					if (empty($_POST['zip']))
					{
						$ZipError = "Postal code is required";
						$isZipValid = false;
					}
					else
					{
						$ZIP = sanitize_input($_POST['zip']);
						#This validation will only apply to United States postal codes.
						if (!preg_match("/^\d{5}(?:\-\d{4})?$/i", $ZIP))
						{
							$ZipError = "Please enter a valid postal code.";
							$isZipValid = false;
						}
						else
						{
							$isZipValid = true;
						}
					}

					#Check if country is valid
					if (empty($_POST['country']))
					{
						$countryError = "Country is required";
						$isCtryValid = false;
					}
					else
					{
						$Ctry = sanitize_input($_POST['country']);
						if (!preg_match("/^[a-zA-Z-' ]*$/", $Ctry))
						{
							$countryError = "Only letters and whitespace allowed";
							$isCtryValid = false;
						}
						else
						{
							$isCtryValid = true;
						}
					}

					if ($isCustNameValid && $isConNameValid && $isPhoneValid && $isAddValid && $isCityValid && $isZipValid && $isCtryValid)
					{
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
					}
				}
				function sanitize_input ($data)
				{
					$data = trim($data);
					$data = stripslashes($data);
					$data = htmlspecialchars($data);
					return $data;
				}
			?>
			<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
				<table class="table table-hover table-responsive table-bordered">
					<tr>
						<td>Customer Name</td>
						<td>
							<input type="text" name="custname" class="form-control" value="<?php echo $CustName ;?>">
							<span class="Error"><?php echo $custNameError;?></span>
						</td>
					</tr>
					<tr>
						<td>Contact Name</td>
						<td>
							<input type="text" name="conname" class="form-control" value="<?php echo $ConName ;?>">
							<span class="Error"><?php echo $conNameError;?></span>
						</td>
					</tr>
					<tr>
						<td>Contact Phone</td>
						<td>
							<input type="text" name="conphone" class="form-control" value="<?php echo $Phone ;?>">
							<span class="Error"><?php echo $phoneError;?></span>
						</td>
					</tr>
					<tr>
						<td>Street Address</td>
						<td>
							<input type="text" name="address" class="form-control" value="<?php echo $Add ;?>">
							<span class="Error"><?php echo $addressError;?></span>
						</td>
					</tr>
					<tr>
						<td>City</td>
						<td>
							<input type="text" name="city" class="form-control" value="<?php echo $Cit ;?>">
							<span class="Error"><?php echo $cityError;?></span>
						</td>
					</tr>
					<tr>
						<td>Postal Code</td>
						<td>
							<input type="text" name="zip" class="form-control" value="<?php echo $ZIP ;?>">
							<span class="Error"><?php echo $ZipError;?></span>
						</td>
					</tr>
					<tr>
						<td>Country</td>
						<td>
							<input type="text" name="country" class="form-control" value="<?php echo $Ctry ;?>">
							<span class="Error"><?php echo $countryError;?></span>
						</td>
					</tr>
					<tr>
						<td></td>
						<td>
							<input type="submit" value="Submit" name="Submit" class="btn btn-success">
							<input type="reset" value="Cancel" name="reset" class="btn btn-danger">
							<a href="index.php" class="btn btn-primary">Home</a>
						</td>
					</tr>
				</table>
			</form>
		</div>
		<!-- Container End -->
	</body>
</html>