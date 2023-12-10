<div class="row border-bottom">
    <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#" ><i class="fa fa-bars"></i> </a>

            <ul class="nav navbar-top-links navbar-left">
                <li>
                    <button type="button"  data-toggle="modal" data-target="#exampleModal" class="langButton" style="margin: 0 18px 4px 18px;"><img src="assets/img/globe.png" alt=""></button>
                </li>
                <li class="active">
                    <a aria-expanded="false" role="button" href="home.php"> <span class="en">Dashboard</span><span class="ar"><?= getArabicTitle('Dashboard') ?></span> </a>
                </li>
                <li class="dropdown">
                    <a aria-expanded="false" role="button" href="#" class="dropdown-toggle" data-toggle="dropdown"> <span class="en">Reports</span><span class="ar"><?= getArabicTitle('Reports') ?></span> </a>
                    <ul role="menu" class="dropdown-menu" style="max-height: 85vh; overflow-y:scroll;">
                        <?php /*?><li><a href="report.php">Account Report</a></li>
                        <li><a href="report.php">Quotation Report </a></li><?php */ ?>
                        <li><a href="sale_report_type.php"> <span class="en">Sales Report</span><span class="ar"><?= getArabicTitle('Sales Report') ?></span> </a></li>
                        <?php /*?><li><a href="report.php">Missing Pos Invoice </a></li>
                        <li><a href="report.php">Sales Quantity Movement Summery Report</a></li><?php */ ?>
                        <li><a href="sale_return_report_type.php"> <span class="en">Sales Return</span><span class="ar"><?= getArabicTitle('Sales Return') ?></span> </a></li>
                        <?php /*?><li><a href="report.php">Stock Receiving Report </a></li>
                        <li><a href="report.php">Purchase Order Report </a></li><?php */ ?>
                        <li><a href="purchase_report_type.php"> <span class="en">Purchase Report</span><span class="ar"><?= getArabicTitle('Purchase Report') ?></span> </a></li>
                        <li><a href="purchase_return_report_type.php"> <span class="en">Purchase Return Report</span><span class="ar"><?= getArabicTitle('Purchase Return Report') ?></span> </a></li>
                        <?php /*?><li><a href="report.php">Stock Report </a></li>
                        <li><a href="report.php">Product List </a></li>
                        <li><a href="report.php">Product Promotion </a></li><?php */ ?>
                        <li><a href="supplier_issue_report.php"> <span class="en">Issue Payments Report</span><span class="ar"><?= getArabicTitle('Issue Payments Report') ?></span> </a></li>
                        <li><a href="customer_issue_report.php"> <span class="en">Issue Reciept Report</span><span class="ar"><?= getArabicTitle('Issue Reciept Report') ?></span> </a></li>
                        <li><a href="supplier_account_statement.php"> <span class="en">Supplier Account Statement</span><span class="ar"><?= getArabicTitle('Supplier Account Statement') ?></span> </a></li>
                        <li><a href="supplier_balance_report.php"> <span class="en">All Suppliers Balance Report</span><span class="ar"><?= getArabicTitle('All Suppliers Balance Report') ?></span> </a></li>
                        <?php /*?><li><a href="report.php">Suppliers Detail Balance Report </a></li>
                        <li><a href="report.php">Customer Account Statemnet </a></li><?php */ ?>
                        <li><a href="customer_balance_report.php"> <span class="en">All Customers Balance Report</span><span class="ar"><?= getArabicTitle('All Customers Balance Report') ?></span> </a></li>
                        <?php /*?><li><a href="report.php">Customer Detail Balance Report </a></li>
                        <li><a href="report.php">Transfer And Redeye Report </a></li>
                        <li><a href="report.php">Product Transaction </a></li><?php */ ?>
                        <li><a href="expense_report.php"> <span class="en">Expense Report</span><span class="ar"><?= getArabicTitle('Expense Report') ?></span> </a></li>

                        <li><a href="product_stock_report.php"> <span class="en">Product Stock Report</span><span class="ar"><?= getArabicTitle('Product Stock Report') ?></span> </a></li>
                        <li><a href="sale_profit_calculation.php"> <span class="en">Sale Profit Calculation</span><span class="ar"><?= getArabicTitle('Sale Profit Calculation') ?></span> </a></li>

                        <?php /*?><li><a href="report.php">Delivery Note Report </a></li><?php */ ?>
                    </ul>
                </li>
                <li class="dropdown">
                    <a aria-expanded="false" role="button" href="#" class="dropdown-toggle" data-toggle="dropdown"> <span class="en">Vat Reports</span><span class="ar"><?= getArabicTitle('Vat Reports') ?></span> </a>
                    <ul role="menu" class="dropdown-menu">
                        <li><a href="vat_report.php"> <span class="en">Vat Report</span><span class="ar"><?= getArabicTitle('Vat Report') ?></span> </a></li>
                        <li><a href="vat_detail_report.php"> <span class="en">Vat Detail Report</span><span class="ar"><?= getArabicTitle('Vat Detail Report') ?></span> </a></li>
                        <li><a href="vat_sale_report.php"> <span class="en">Vat Report(Sales)</span><span class="ar"><?= getArabicTitle('Vat Report(Sales)') ?></span> </a></li>
                        <li><a href="vat_purchase_report.php"> <span class="en">Vat Report(Purchase)</span><span class="ar"><?= getArabicTitle('Vat Report(Purchase)') ?></span> </a></li>
                    </ul>
                </li>

                <li class="dropdown">
                    <a aria-expanded="false" role="button" href="#" class="dropdown-toggle" data-toggle="dropdown"> <span class="en">Screens Only</span><span class="ar"><?= getArabicTitle('Screens Only') ?></span></a>
                    <ul role="menu" class="dropdown-menu">
                        <li><a href="opening_quantity.php"> <span class="en">Opening Quantity</span><span class="ar"><?= getArabicTitle('Opening Quantity') ?></span> </a></li>
                        <li><a href="inventory_data.php"> <span class="en">Inventory Data</span><span class="ar"><?= getArabicTitle('Inventory Data') ?></span> </a></li>
                        <li><a href="product_tr_report.php"> <span class="en">Product Transfer And Receive Report</span><span class="ar"><?= getArabicTitle('Product Transfer And Receive Report') ?></span> </a></li>
                        <li><a href="quotation.php"> <span class="en">Quotation</span><span class="ar"><?= getArabicTitle('Quotation') ?></span> </a></li>
                        <li><a href="branch_transfer.php"> <span class="en">Branch Transfer</span><span class="ar"><?= getArabicTitle('Branch Transfer') ?></span> </a></li>
                        <li><a href="supplier_advance.php"> <span class="en">Supplier Advance</span><span class="ar"><?= getArabicTitle('Supplier Advance') ?></span> </a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</div>