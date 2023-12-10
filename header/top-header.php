<?php
// session_start();
error_reporting(0);
include("config/connection.php");
include("config/main_connection.php");
if (empty($_SESSION['id'])) {
  printf("<script>location.href='index.php?value=logout'</script>");
  die();
}
$img = "MtechSuperAdmin/user_images/noimage.png";

///// Get Main Database Records//////
$myq2 = RunMain("Select * from " . dbObjectMain . "Logins where email = '" . $_SESSION['email'] . "'");

$mymaster = myfetchMain($myq2);
?>

<input type="hidden" id="selected_lang" name="selected_lang" value="<?= $_SESSION['lang'] ?>">

<nav class="navbar-default navbar-static-side" role="navigation">
  <div class="sidebar-collapse">
    <ul class="nav metismenu" id="side-menu">
      <li class="nav-header">
        <div class="dropdown profile-element text-center">

          <img alt="image" style="width: 40px;height: 40px;" class="img-circle" src="/<?= $mymaster->img ?>" />
          <a data-toggle="dropdown" class="dropdown-toggle" href="#">
            <span class="block m-t-xs font-bold">
              <?= $mymaster->name ?>
            </span>

          </a>
          <ul class="dropdown-menu animated fadeInRight m-t-xs">
            <li><a class="dropdown-item" href="profile.php"><span class="en">Profile</span><span class="ar">
                  <?= getArabicTitle('Profile') ?>
                </span></a></li>

            <li class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="logout.php"><span class="en">Logout</span><span class="ar">
                  <?= getArabicTitle('Logout') ?>
                </span></a></li>
          </ul>
        </div>
        <div class="logo-element">
          Mtech
        </div>
      </li>
      <li>
        <a href="home.php"><i class="fa fa-th-large"></i> <span class="nav-label en">Dashboard</span> <span
            class="nav-label ar">
            <?= getArabicTitle('Dashboard') ?>
          </span> <i class="fa arrow"></i> </a>

        <ul class="nav nav-second-level collapse">
          <li><a href="home.php"> <span class="en">Home</span> <span class="ar">
                <?= getArabicTitle('Home') ?>
              </span> </a></li>
          <li><a href="profile.php"> <span class="en">Company Profile</span> <span class="ar">
                <?= getArabicTitle('Company Profile') ?>
              </span> </a></li>
          <li><a href="profile.php"> <span class="en">User Management</span> <span class="ar">
                <?= getArabicTitle('User Management') ?>
              </span> </a></li>
          <!-- <li class="d-none"><a href="#"> <span class="en">Employee Management</span> <span class="ar"><?= getArabicTitle('Employee Management') ?></span> <i class="fa arrow"></i></a>
            <ul class="nav nav-third-level collapse">
              <li><a href="#"> <span class="en">Employee Master</span> <span class="ar"><?= getArabicTitle('Employee Master') ?></span> </a></li>
              <li><a href="#"> <span class="en">Salary Management</span> <span class="ar"><?= getArabicTitle('Salary Management') ?></span> </a></li>
              <li><a href="#"> <span class="en">Employee Reports</span> <span class="ar"><?= getArabicTitle('Employee Reports') ?></span> <i class="fa arrow"></i></a>
                <ul class="nav nav-fourth-level collapse">
                  <li><a href="#"> <span class="en">Employee Payment Report</span> <span class="ar"><?= getArabicTitle('Employee Payment Report') ?></span> </a></li>
                </ul>
              </li>
            </ul>
          </li> -->
        </ul>
      </li>

      <li>
        <a href="daily_report.php"><i class="fa fa-table"></i> <span class="nav-label en">Daily Report</span> <span
            class="nav-label ar">
            <?= getArabicTitle('Daily Report') ?>
          </span> <i class="fa arrow"></i></a>
      </li>

      <li>
        <a href="#"><i class="fa fa-shopping-cart"></i> <span class="nav-label en">Product</span> <span
            class="nav-label ar">
            <?= getArabicTitle('Product') ?>
          </span> <i class="fa arrow"></i></a>

        <ul class="nav nav-second-level collapse">
          <li><a href="products.php"> <span class="en">File</span> <span class="ar">
                <?= getArabicTitle('File') ?>
              </span> </a></li>
          <li><a href="product_group.php"> <span class="en">Group</span> <span class="ar">
                <?= getArabicTitle('Group') ?>
              </span> </a></li>
          <li><a href="product_type.php"> <span class="en">Type</span> <span class="ar">
                <?= getArabicTitle('Type') ?>
              </span> </a></li>
          <li><a href="product_unit.php"> <span class="en">Unit</span> <span class="ar">
                <?= getArabicTitle('Unit') ?>
              </span> </a></li>
          <!-- <li><a href="product_offer_group.php"> <span class="en">Offer Group</span> <span class="ar"><?= getArabicTitle('Offer Group') ?></span> </a></li> -->
          <!-- <li><a href="sections.php"> <span class="en">Sections</span> <span class="ar"><?= getArabicTitle('Sections') ?></span> </a></li> -->
          <li><a href="#"> <span class="en">Transaction</span> <span class="ar">
                <?= getArabicTitle('Transaction') ?>
              </span> <i class="fa arrow"></i></a>
            <ul class="nav nav-third-level collapse">
              <!-- <li><a href="#"><span class="en">Stock Recieve</span> <span class="ar"><?= getArabicTitle('Stock Recieve') ?></span></a></li> -->
              <!-- <li><a href="#"><span class="en">Stock out Report</span> <span class="ar"><?= getArabicTitle('Stock out Report') ?></span></a></li> -->
              <li><a href="branch_transfer.php"><span class="en">Branch Transfering Data</span> <span class="ar">
                    <?= getArabicTitle('Branch Transfering Data') ?>
                  </span></a></li>
              <!-- <li><a href="#"><span class="en">Branch Recieving Data</span> <span class="ar"><?= getArabicTitle('Branch Recieving Data') ?></span></a></li> -->
              <!-- <li><a href="#"><span class="en">Section Transfering Data</span> <span class="ar"><?= getArabicTitle('Section Transfering Data') ?></span></a></li> -->
              <!-- <li><a href="#"><span class="en">Production</span> <span class="ar"><?= getArabicTitle('Production') ?></span></a></li> -->
              <!-- <li><a href="#"><span class="en">Product Promotion</span> <span class="ar"><?= getArabicTitle('Product Promotion') ?></span></a></li> -->
            </ul>
          </li>

          <li><a href="#"> <span class="en">Product Reports</span> <span class="ar">
                <?= getArabicTitle('Product Reports') ?>
              </span> <i class="fa arrow"></i></a>

            <ul class="nav nav-third-level collapse">
              <!-- <li><a href="#"><span class="en">Stock Reciveing Report</span> <span class="ar"><?= getArabicTitle('Stock Reciveing Report') ?></span></a></li> -->
              <!-- <li><a href="#"><span class="en">Stock out Report</span> <span class="ar"><?= getArabicTitle('Stock out Report') ?></span></a></li> -->
              <li><a href="product_stock_report.php"><span class="en">Stock Report</span> <span class="ar">
                    <?= getArabicTitle('Stock Report') ?>
                  </span></a></li>
              <!-- <li><a href="#"><span class="en">Product Expiry</span> <span class="ar"><?= getArabicTitle('Product Expiry') ?></span></a></li> -->
              <!-- <li><a href="#"><span class="en">Product List</span> <span class="ar"><?= getArabicTitle('Product List') ?></span></a></li> -->
              <!-- <li><a href="#"><span class="en">Product Promotion</span> <span class="ar"><?= getArabicTitle('Product Promotion') ?></span></a></li> -->
              <!-- <li><a href="#"><span class="en">Product Transaction</span> <span class="ar"><?= getArabicTitle('Product Transaction') ?></span></a></li> -->
              <!-- <li><a href="#"><span class="en">Transfer & Recieve Report</span> <span class="ar"><?= getArabicTitle('Transfer & Recieve Report') ?></span></a></li> -->
            </ul>
          </li>
        </ul>
      </li>

      <li>
        <a href="#"><i class="fa fa-users"></i> <span class="nav-label en">Customer/Sales</span> <span
            class="nav-label ar">
            <?= getArabicTitle('Customer/Sales') ?>
          </span> <i class="fa arrow"></i></a>
        <ul class="nav nav-second-level collapse">
          <li><a href="#"> <span class="en">Management</span> <span class="ar">
                <?= getArabicTitle('Management') ?>
              </span> <i class="fa arrow"></i></a>
            <ul class="nav nav-third-level collapse">
              <li><a href="customer_area.php"><span class="en">Area</span> <span class="ar">
                    <?= getArabicTitle('Area') ?>
                  </span></a></li>
              <li><a href="customer.php"><span class="en">File</span> <span class="ar">
                    <?= getArabicTitle('File') ?>
                  </span></a></li>
            </ul>
          </li>
          <li><a href="#"> <span class="en">Transactions</span> <span class="ar">
                <?= getArabicTitle('Transactions') ?>
              </span> <i class="fa arrow"></i></a>
            <ul class="nav nav-third-level collapse">
              <li><a href="sales_voucher.php"><span class="en">Sales</span> <span class="ar">
                    <?= getArabicTitle('Sales') ?>
                  </span></a></a></li>
              <li><a href="sales_voucher_return.php"><span class="en">Sales Return</span> <span class="ar">
                    <?= getArabicTitle('Sales Return') ?>
                  </span></a></a></li>
              <li><a href="issue_receipt.php"><span class="en">Issue Receipt</span> <span class="ar">
                    <?= getArabicTitle('Issue Receipt') ?>
                  </span></a></a></li>
              <li><a href="customer_advance.php"><span class="en">Advance</span> <span class="ar">
                    <?= getArabicTitle('Advance') ?>
                  </span></a></a></li>
              <li><a href="quotation.php"><span class="en">Quotations</span> <span class="ar">
                    <?= getArabicTitle('Quotations') ?>
                  </span></a></a></li>
              <li><a href="delivery_note.php"><span class="en">Delivery Note</span> <span class="ar">
                    <?= getArabicTitle('Delivery Note') ?>
                  </span></a></a></li>
            </ul>
          </li>
          <li><a href="#"> <span class="en">Reports</span> <span class="ar">
                <?= getArabicTitle('Reports') ?>
              </span><i class="fa arrow"></i></a>
            <ul class="nav nav-third-level collapse">
              <li><a href="customer_account_statement.php"><span class="en">Account Statement</span> <span class="ar">
                    <?= getArabicTitle('Account Statement') ?>
                  </span></a></a></li>
              <li><a href="customer_balance_report.php"><span class="en">Balance Report</span> <span class="ar">
                    <?= getArabicTitle('Balance Report') ?>
                  </span></a></a></li>
              <!-- <li><a href="#"><span class="en">Quotation report</span> <span class="ar"><?= getArabicTitle('Quotation report') ?></span></a></a></li> -->
              <!-- <li><a href="#"><span class="en">Adv report</span> <span class="ar"><?= getArabicTitle('Adv report') ?></span></a></a></li> -->
              <li><a href="sale_report_type.php"><span class="en">Sales Report</span> <span class="ar">
                    <?= getArabicTitle('Sales Report') ?>
                  </span></a></a></li>
              <li><a href="sale_return_report_type.php"><span class="en">Sales Return Report</span> <span class="ar">
                    <?= getArabicTitle('Sales Return Report') ?>
                  </span></a></a></li>
              <li><a href="sale_profit_calculation.php"> <span class="en">Sales Profit/Loss Calculation</span> <span
                    class="ar">
                    <?= getArabicTitle('Sales Profit/Loss Calculation') ?>
                  </span></a></a></li>
              <!-- <li class="d-none"><a href="#"> <span class="en">Missing Pos Invoice</span> <span class="ar"><?= getArabicTitle('Missing Pos Invoice') ?></span></a></a></li> -->
              <!-- <li class="d-none"><a href="#"><span class="en">Sales Quantity Movement Summary Report</span> <span class="ar"><?= getArabicTitle('Sales Quantity Movement Summary Report') ?></span></a></a></li> -->
              <!-- <li><a href="#"><span class="en">Delievery Note Report</span> <span class="ar"><?= getArabicTitle('Delievery Note Report') ?></span></a></a></li> -->
            </ul>
          </li>
        </ul>
      </li>

      <li>
        <a href="#"><i class="fa fa-user-circle-o"></i> <span class="nav-label en">Supplier/Purchases</span> <span
            class="nav-label ar">
            <?= getArabicTitle('Supplier/Purchases') ?>
          </span> <i class="fa arrow"></i></a>
        <ul class="nav nav-second-level collapse">
          <li><a href="#"> <span class="en">Management</span> <span class="ar">
                <?= getArabicTitle('Management') ?>
              </span><i class="fa arrow"></i></a>
            <ul class="nav nav-third-level collapse">
              <li><a href="sup_group.php"><span class="en">Group</span> <span class="ar">
                    <?= getArabicTitle('Group') ?>
                  </span></a></a></li>
              <li><a href="suppliers.php"><span class="en">File</span> <span class="ar">
                    <?= getArabicTitle('File') ?>
                  </span></a></a></li>
              <li><a href="pur_type.php"><span class="en">Type</span> <span class="ar">
                    <?= getArabicTitle('Type') ?>
                  </span></a></a></li>
              <li><a href="purchaser.php"><span class="en">Purchaser</span> <span class="ar">
                    <?= getArabicTitle('Purchaser') ?>
                  </span></a></a></li>
            </ul>
          </li>

          <li><a href="#"> <span class="en">Transactions</span> <span class="ar">
                <?= getArabicTitle('Transactions') ?>
              </span><i class="fa arrow"></i></a>
            <ul class="nav nav-third-level collapse">
              <li><a href="purchase_voucher.php"><span class="en">Purchase</span> <span class="ar">
                    <?= getArabicTitle('Purchase') ?>
                  </span></a></a></li>
              <li><a href="purchase_return_voucher.php"><span class="en">Purchase Return</span> <span class="ar">
                    <?= getArabicTitle('Purchase Return') ?>
                  </span></a></a></li>
              <li><a href="issue_payment.php"><span class="en">Issue Payment</span> <span class="ar">
                    <?= getArabicTitle('Issue Payment') ?>
                  </span></a></a></li>
              <li><a href="supplier_advance.php"><span class="en">Advance</span> <span class="ar">
                    <?= getArabicTitle('Advance') ?>
                  </span></a></a></li>
              <li><a href="purchase_order.php"><span class="en">Purcahse Order</span> <span class="ar">
                    <?= getArabicTitle('Purcahse Order') ?>
                  </span></a></a></li>
              <!-- <li><a href="#"><span class="en">Fixed Price Agreement</span> <span class="ar"><?= getArabicTitle('Fixed Price Agreement') ?></span></a></a></li> -->
            </ul>
          </li>

          <li><a href="#"> <span class="en">Reports</span> <span class="ar">
                <?= getArabicTitle('Reports') ?>
              </span><i class="fa arrow"></i></a>
            <ul class="nav nav-third-level collapse">
              <li><a href="supplier_account_statement.php"><span class="en">Account Statement</span> <span class="ar">
                    <?= getArabicTitle('Account Statement') ?>
                  </span></a></li>
              <li><a href="supplier_balance_report.php"><span class="en">Balance Report</span> <span class="ar">
                    <?= getArabicTitle('Balance Report') ?>
                  </span></a></li>
              <li><a href="supplier_issue_report.php"><span class="en">Issue Payment report</span> <span class="ar">
                    <?= getArabicTitle('Issue Payment report') ?>
                  </span></a></li>
              <!-- <li><a href="#"><span class="en">Purcahse Order Report</span> <span class="ar"><?= getArabicTitle('Purcahse Order Report') ?></span></a></li> -->
              <li><a href="purchase_report_type.php"><span class="en">Purcahase Report</span> <span class="ar">
                    <?= getArabicTitle('Purcahase Report') ?>
                  </span></a></li>
              <li><a href="purchase_return_report_type.php"><span class="en">Purchase Return Report</span> <span
                    class="ar">
                    <?= getArabicTitle('Purchase Return Report') ?>
                  </span></a></li>
            </ul>
          </li>
        </ul>
      </li>

      <li>
        <a href="#"><i class="fa fa-laptop"></i> <span class="nav-label en">Accounts/Expenses</span> <span
            class="nav-label ar">
            <?= getArabicTitle('Accounts/Expenses') ?>
          </span> <i class="fa arrow"></i></a>
        <ul class="nav nav-second-level collapse">
          <li class="d-none"><a href="#"> <span class="en">Account Transaction</span> <span class="ar">
                <?= getArabicTitle('Account Transaction') ?>
              </span><i class="fa arrow"></i></a>
            <ul class="nav nav-third-level collapse">
              <li><a href="#"><span class="en">Bank Widraw</span> <span class="ar">
                    <?= getArabicTitle('Bank Widraw') ?>
                  </span></a></li>
              <li><a href="#"><span class="en">Bank Deposit</span> <span class="ar">
                    <?= getArabicTitle('Bank Deposit') ?>
                  </span></a></li>
            </ul>
          </li>

          <li><a href="#"> <span class="en">Expense</span> <span class="ar">
                <?= getArabicTitle('Expense') ?>
              </span><i class="fa arrow"></i></a>
            <ul class="nav nav-third-level collapse">
              <li><a href="expense_head.php"><span class="en">Expense Head</span> <span class="ar">
                    <?= getArabicTitle('Expense Head') ?>
                  </span></a></li>
              <li><a href="expense_data.php"><span class="en">Expense Data</span> <span class="ar">
                    <?= getArabicTitle('Expense Data') ?>
                  </span></a></li>
              <!-- <li><a href="expense.php"><span class="en">Expense Report</span> <span class="ar"><?= getArabicTitle('Expense Report') ?></span></a></li> -->
            </ul>
          </li>
        </ul>
      </li>

      <li class="d-none">
        <a href="#"><i class="fa fa-pie-chart"></i> <span class="nav-label en">General Reports</span> <span
            class="nav-label ar">
            <?= getArabicTitle('General Reports') ?>
          </span> <i class="fa arrow"></i></a>
        <ul class="nav nav-second-level collapse">
          <li><a href="#"> <span class="en">Vat Report</span> <span class="ar">
                <?= getArabicTitle('Vat Report') ?>
              </span><i class="fa arrow"></i></a>
            <ul class="nav nav-third-level collapse">
              <li><a href="#"><span class="en">Vat Report</span> <span class="ar">
                    <?= getArabicTitle('Vat Report') ?>
                  </span></a></li>
              <li><a href="#"><span class="en">Vat Detail Report</span> <span class="ar">
                    <?= getArabicTitle('Vat Detail Report') ?>
                  </span></a></li>
              <li><a href="#"><span class="en">Vat Report (Sale)</span> <span class="ar">
                    <?= getArabicTitle('Vat Report (Sale)') ?>
                  </span></a></li>
              <li><a href="#"><span class="en">Vat Report (Purchase)</span> <span class="ar">
                    <?= getArabicTitle('Vat Report (Purchase)') ?>
                  </span></a></li>
            </ul>
          </li>

          <li><a href="#"> <span class="en">Accounts Reports</span> <span class="ar">
                <?= getArabicTitle('Accounts Reports') ?>
              </span><i class="fa arrow"></i></a>
            <ul class="nav nav-third-level collapse">
              <li><a href="#"><span class="en">Accounts Report</span> <span class="ar">
                    <?= getArabicTitle('Accounts Report') ?>
                  </span></a></li>
            </ul>
          </li>

          <li><a href="#"> <span class="en">Other Reports</span> <span class="ar">
                <?= getArabicTitle('Other Reports') ?>
              </span><i class="fa arrow"></i></a>
            <ul class="nav nav-third-level collapse">
              <li><a href="#"><span class="en">Business Summary Reports</span> <span class="ar">
                    <?= getArabicTitle('Business Summary Reports') ?>
                  </span></a></li>
            </ul>
          </li>
        </ul>
      </li>

      <li class="d-none">
        <a href="#"><i class="fa fa-picture-o"></i> <span class="nav-label en">Inventory/Adjustmnets</span> <span
            class="nav-label ar">
            <?= getArabicTitle('Inventory/Adjustmnets') ?>
          </span> <i class="fa arrow"></i></a>
        <ul class="nav nav-second-level collapse">
          <li><a href="#"><span class="en">Open Quantity Entry</span> <span class="ar">
                <?= getArabicTitle('Open Quantity Entry') ?>
              </span></a></li>
          <li><a href="#"><span class="en">Inventory Data</span> <span class="ar">
                <?= getArabicTitle('Inventory Data') ?>
              </span></a></li>
          <li><a href="#"><span class="en">Product Price Update Trans</span> <span class="ar">
                <?= getArabicTitle('Product Price Update Trans') ?>
              </span></a></li>
        </ul>
      </li>
    </ul>
  </div>
</nav>