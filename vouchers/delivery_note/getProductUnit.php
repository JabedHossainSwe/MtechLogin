<?php
session_start();
error_reporting(0);
include("../../config/connection.php");
$code = addslashes($_POST['code']);
?>

<select id="unit" name="unit"
class="select2_demo_1 form-control" tabindex="4">
	<option value="">No Unit</option>
</select>