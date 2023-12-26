<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Customer | Form</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            margin: 20px;
            padding: 5px;
        }
    </style>
</head>

<body>

    <div class="container mt-4">
        <!-- Form -->
        <form>
            <div class="form-row align-items-center">
                <div class="col-auto">
                    <label for="CCode" class="mr-sm-2">Code:</label>
                    <input type="text" class="form-control mb-2 mr-sm-2" id="CCode"
                        value="<?php echo sprintf('%04d', mt_rand(0, 9999)); ?>" readonly>
                </div>
                <div class="col-auto">
                    <label for="branch" class="mr-sm-2">Branch:</label>
                    <input type="text" class="form-control mb-2 mr-sm-2" name="bid" id="branch">
                </div>
                <div class="col-auto">
                    <label for="CName" class="mr-sm-2">Name:</label>
                    <input type="text" class="form-control mb-2 mr-sm-2" id="CName">
                </div>

                <div class="col-md-6">
                    <label for="Description" class="mr-sm-2">Description</label>
                    <input id="Description" value="" name="Description" type="text" class="form-control mb-2 mr-sm-2"
                        maxlength="400">
                </div>
                <div class="col-md-6">
                    <label for="Address" class="mr-sm-2">Address</label>
                    <input id="Address" value="" name="Address" type="text" class="form-control mb-2 mr-sm-2"
                        maxlength="400">
                </div>

                <div class="col-md-4">
                    <div class="row">
                        <div class="col-md-8">
                            <label for="Contact1">Phone</label>
                            <input type="number" name="Contact1" id="Contact1" class="form-control" maxlength="200">
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="row">
                        <div class="col-md-8">
                            <label for="Contact2">Mobile</label>
                            <input type="number" name="Contact2" id="Contact2" class="form-control" maxlength="200">
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="row">
                        <div class="col-md-8">
                            <label for="CRNo">CR Number</label>
                            <input type="number" name="CRNo" id="CRNo" class="form-control" maxlength="200">
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="row">
                        <div class="col-md-8">
                            <label for="Fax">Fax</label>
                            <input type="text" name="Fax" id="Fax" class="form-control" maxlength="200">
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="row">
                        <div class="col-md-8">
                            <label for="Email">Email</label>
                            <input type="email" name="Email" id="Email" class="form-control">
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="row">
                        <div class="col-md-8">
                            <label for="OpenBalance">Opening Balance</label>
                            <input type="number" name="OpenBalance" id="OpenBalance" class="form-control" value="0">
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="row">
                        <div class="col-md-8">
                            <label for="openDebit">Opening Balance Debit</label>
                            <input type="number" name="openDebit" id="openDebit" class="form-control" value="0"
                                maxlength="200">
                        </div>
                    </div>
                </div>

                <div class="row align-items-end">
                    <div class="col-md-8">
                        <label for="custAreadiv">Customer Area</label>
                        <select name="custAreadiv" id="custAreadiv" class="form-control">
                            <option value="0">Option 0</option>
                            <option value="1">Option 1</option>
                            <!-- Add more options as needed -->
                        </select>
                    </div>
                    <div class="col-md-4">
                        <div class="add_ref_icons d-flex justify-content-around">
                            <button
                                onclick="window.open('../customerArea/customer_area.php', '_blank', 'location=yes,height=570,width=600,scrollbars=yes,status=yes');"
                                class="btn btn-info btn-circle mt-2" type="button">
                                <i class="fa fa-plus"></i>
                            </button>
                        </div>
                    </div>
                </div>



            </div>
            <div class="col-auto">
                <button type="submit" class="btn btn-primary mb-2">Submit</button>
            </div>
        </form>

    </div>

    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>