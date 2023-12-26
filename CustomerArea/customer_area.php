<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Customer Area</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<style>
		body {
			margin: 20px;
			padding: 5px;
		}
	</style>
</head>

<body>
	<div class="container mt-5">
		<form>

			<div class="form-row align-items-center mb-3">
				<div class="col-md-4">
					<div class="row">
						<div class="col-auto">
							<label for="GID" class="mr-sm-2">ID:</label>
							<input type="text" class="form-control mb-2 mr-sm-2" id="GID" readonly>
						</div>
					</div>
				</div>

				<div class="col-md-4">
					<div class="row align-items-end">
						<div class="col-md-8">
							<label for="Code">Code</label>
							<input type="text" class="form-control mb-2 mr-sm-2" id="Code" readonly>
						</div>
					</div>
				</div>
			</div>

			<div class="form-row align-items-center mb-3">
				<div class="col-md-6">
					<label for="NameEng" class="mr-sm-2">Name:</label>
					<input type="text" value="name" class="form-control mb-2 mr-sm-2" id="NameEng">
				</div>
			</div>



			<div class="col-6">
				<div class="row justify-content-center mt-5">
					<div class="col-md-4">
						<a href="../home.php" class="btn btn-block btn-lg btn-outline-danger">Exit</a>
					</div>

					<div class="col-md-4">
						<button type="submit" class="btn btn-block btn-lg btn-outline-success">Submit</button>
					</div>
				</div>
			</div>
		</form>
	</div>




	<script>
		let counter = 1;

		// Function to pad single digit numbers with leading zero
		function pad(num) {
			return num.toString().padStart(2, '0');
		}

		// Update ID and Code fields with the incremented value
		function updateFields() {
			document.getElementById('GID').value = pad(counter);
			document.getElementById('Code').value = pad(counter);
			counter++; // Increment counter for the next value
		}

		// Call the updateFields function when the document loads
		document.addEventListener('DOMContentLoaded', updateFields);
	</script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>