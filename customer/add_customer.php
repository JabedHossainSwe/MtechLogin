<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Add | Customer</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <script src='customer.js'></script>
    <style>
        body {
            margin: 20px;
            padding: 5px;
        }
    </style>
</head>

<body>

    <div class="container mt-5">
        <form action="javascript:saveCustomer()" id="save_form" method="post">

            <div class="form-row align-items-center mb-3">
                <div class="col-md-4">
                    <div class="row">
                        <div class="col-auto">
                            <label for="CCode" class="mr-sm-2">Code:</label>
                            <input type="text" class="form-control mb-2 mr-sm-2" id="CCode"
                                value="<?php echo sprintf('%04d', mt_rand(0, 9999)); ?>" readonly>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="row align-items-end">
                        <div class="col-md-8">
                            <label for="bid">Branch</label>
                            <select name="bid" id="bid" class="form-control">
                                <option value="0">Option 0</option>
                                <option value="1">Option 1</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <div class="add_ref_icons d-flex justify-content-around">
                                <button
                                    onclick="window.open('../branch/branch.php', '_blank', 'location=yes,height=570,width=600,scrollbars=yes,status=yes');"
                                    class="btn btn-info btn-circle mt-2" type="button">
                                    <i class="fa fa-plus"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <label for="CName" class="mr-sm-2">Name:</label>
                    <input type="text" class="form-control mb-2 mr-sm-2" id="CName" value='name'>
                </div>
            </div>

            <div class="form-row align-items-center mb-3">
                <div class="col-md-6">
                    <label for="Description" class="mr-sm-2">Description</label>
                    <input id="Description" value="description" name="Description" type="text"
                        class="form-control mb-2 mr-sm-2" maxlength="400">
                </div>
                <div class="col-md-6">
                    <label for="Address" class="mr-sm-2">Address</label>
                    <input id="Address" value="address" name="Address" type="text" class="form-control mb-2 mr-sm-2"
                        maxlength="400">
                </div>
            </div>

            <div class="form-row align-items-center mb-3">
                <div class="col-md-4">
                    <label for="Contact1">Phone</label>
                    <input type="number" value='0' name="Contact1" id="Contact1" class="form-control" maxlength="200">
                </div>

                <div class="col-md-4">
                    <label for="Contact2">Mobile</label>
                    <input type="number" value='0' name="Contact2" id="Contact2" class="form-control" maxlength="200">
                </div>

                <div class="col-md-4">
                    <label for="CRNo">CR Number</label>
                    <input type="number" value='0' name="CRNo" id="CRNo" class="form-control" maxlength="200">
                </div>
            </div>

            <div class="form-row align-items-center mb-3">
                <div class="col-md-4">
                    <label for="Fax">Fax</label>
                    <input type="text" value="0" name="Fax" id="Fax" class="form-control" maxlength="200">
                </div>

                <div class="col-md-4">
                    <label for="Email">Email</label>
                    <input type="email" name="Email" id="Email" value="test@gmail.com" class="form-control">
                </div>

                <div class="col-md-4">
                    <label for="OpenBalance">Opening Balance</label>
                    <input type="number" name="OpenBalance" id="OpenBalance" class="form-control" value="0">
                </div>
            </div>

            <div class="form-row align-items-center mb-3">
                <div class="col-md-4">
                    <div class="row">
                        <div class="col-md-8">
                            <label for="openDebit">Opening Balance Debit</label>
                            <input type="number" name="openDebit" id="openDebit" class="form-control" value="0"
                                maxlength="200">
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="row align-items-end">
                        <div class="col-md-8">
                            <label for="custAreadiv">Customer Area</label>
                            <select name="custAreadiv" id="custAreadiv" class="form-control">
                                <option value="0">Option 0</option>
                                <option value="1">Option 1</option>
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

                <div class="col-md-4">
                    <div class="row align-items-end">
                        <div class="col-md-8">
                            <label for="Salesman">Salesman</label>
                            <select name="Salesman" id="Salesman" class="form-control">
                                <option value="0">Option 0</option>
                                <option value="1">Option 1</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <div class="add_ref_icons d-flex justify-content-around">
                                <button
                                    onclick="window.open('../salesman/salesman.php', '_blank', 'location=yes,height=570,width=600,scrollbars=yes,status=yes');"
                                    class="btn btn-info btn-circle mt-2" type="button">
                                    <i class="fa fa-plus"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-row align-items-center mb-3">
                <div class="col-md-4">
                    <label for="StreetName" class="mr-sm-2">Street</label>
                    <input id="StreetName" value="street" name="StreetName" type="text"
                        class="form-control mb-2 mr-sm-2" maxlength="400">
                </div>

                <div class="col-md-4">
                    <label for="District" class="mr-sm-2">District</label>
                    <input id="District" value="District" name="District" type="text" class="form-control mb-2 mr-sm-2"
                        maxlength="100">
                </div>

                <div class="col-md-4">
                    <label for="CityN" class="mr-sm-2">City</label>
                    <input id="CityN" value="City" name="CityN" type="text" class="form-control mb-2 mr-sm-2"
                        maxlength="100">
                </div>
            </div>

            <div class="form-row align-items-center mb-3">
                <div class="col-md-4">
                    <label for="Address" class="mr-sm-2">Country</label>
                    <input id="Address" value="country" name="Address" type="text" class="form-control mb-2 mr-sm-2"
                        maxlength="100">
                </div>

                <div class="col-md-4">
                    <label for="PostalCode" class="mr-sm-2">Postal Code</label>
                    <input id="PostalCode" value="0" name="PostalCode" type="text" class="form-control mb-2 mr-sm-2"
                        maxlength="400">
                </div>

                <div class="col-md-4">
                    <div class="row align-items-end">
                        <div class="col-md-8">
                            <label for="Currency">Currency</label>
                            <select name="Currency" id="Currency" class="form-control">
                                <option value="0">Option 0</option>
                                <option value="1">Option 1</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <div class="add_ref_icons d-flex justify-content-around">
                                <button
                                    onclick="window.open('../currency/currency.php', '_blank', 'location=yes,height=570,width=600,scrollbars=yes,status=yes');"
                                    class="btn btn-info btn-circle mt-2" type="button">
                                    <i class="fa fa-plus"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-12">
                <div class="row justify-content-center mt-5">
                    <div class="col-md-3">
                        <a href="../home.php" class="btn btn-block btn-lg btn-outline-danger">Exit</a>
                    </div>

                    <div class="col-md-3">
                        <button type="submit" class="btn btn-block btn-lg btn-outline-success" value='Search' id="seles_report_search">Submit</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <!-- Bootstrap JS -->
  
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>