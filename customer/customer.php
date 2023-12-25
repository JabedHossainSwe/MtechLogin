<?php
session_start();
?>


<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Mtech | Customers</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

	<style>
		body {
			margin: 20px;
			padding: 5px;
		}

		h1 {
			text-align: center;
		}
	</style>
</head>

<body>
	<h1>Customers List</h1>

	<?php include 'customer_table.php'; ?>











	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>