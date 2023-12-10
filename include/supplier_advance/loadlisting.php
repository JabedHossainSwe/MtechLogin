<?php
session_start();
error_reporting(0);
include("../../config/connection.php");
// include("../../config/functions.php");
if (empty($_SESSION['id'])) {
  printf("<script>location.href='index.php?value=logout'</script>");
  die();
}

$myq2 = Run("Select * from " . dbObject . "SupplierAdvance where IsDeleted=0  order by Billno DESC");
$lang = $_SESSION['lang'];

?>
<div id="deleteEntry"></div>
<div class="row">
  <div class="col-lg-12">
    <div class="ibox ">
      <div class="ibox-title pb-4">
					<h5><span class="en">Advance List</span><span class="ar"><?= getArabicTitle('Advance List') ?></span></h5>

        <div class="ibox-tools">
          <div class="col-md-12">
            <button type="button" onClick="Add()" class="btn btn-block btn-lg btn-outline-primary" id="seles_report_search" value="Add"><span class="en">Add <i class="fa fa-plus icon-font"></i></span><span class="ar">اضافة <i class="fa fa-plus icon-font"></i></span>
            </button>
          </div>
        </div>
      </div>
      <div class="ibox-content">
        <div class="table-responsive">
          <table class="table table-striped table-bordered table-hover dataTables-example">
            <thead>
              <tr>
                <th><span class="en">Bill No</span><span class="ar"><?= getArabicTitle('Bill No') ?></span></th>
                <th><span class="en">Branch</span><span class="ar"><?= getArabicTitle('Branch') ?></span></th>
                <th><span class="en">Customer</span><span class="ar"><?= getArabicTitle('Customer') ?></span></th>
                <th><span class="en">Date</span><span class="ar"><?= getArabicTitle('Date') ?></span></th>
                <th><span class="en">Amount</span><span class="ar"><?= getArabicTitle('Amount') ?></span></th>
                <th><span class="en">Bank</span><span class="ar"><?= getArabicTitle('Bank') ?></span></th>
                <th><span class="en">Actions</span><span class="ar"><?= getArabicTitle('Actions') ?></span></th>
              </tr>
            </thead>
            <tbody>
              <?php
              while ($load = myfetch($myq2)) {
                $id = $load->Billno;
                $main = "";
              ?>
                <tr class="gradeX">
                  <td><?= $load->Billno ?></td>
                  <td><?= GetBranchDetils($load->bid)->BName ?></td>
                  <td><?= getSupplierDetails($load->SuppID)->CName ?></td>
                  <td><?= DateValue($load->billdate) ?></td>
                  <td><?= $load->Amount ?></td>
                  <td><?= GetBankDetils($load->bnkid)->NameEng ?></td>
                  <!-- <td></td> -->

                  <td align="center">
                    <!-- <a href="javascript:edit('<?= $id ?>');"><i class="fa fa-pencil-square-o"></i> </a> -->

                    &nbsp;

                    <a href="javascript:deleteEntry('<?= $load->Billno ?>', '<?= $load->bid ?>', '<?= $load->sbid ?>');"><i class="fa fa-times-circle-o"></i> </a>
                  </td>
                </tr>
              <?php
              } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  $(document).ready(function() {
    $('.dataTables-example').DataTable({
      pageLength: 10,
      responsive: true,
      dom: '<"html5buttons"B>lTfgitp',
      buttons: [],
      "ordering": false
    });
  });
</script>

<script>
    $(document).ready(function() {
        var lang = document.getElementById("selected_lang").value;
        changeLanguage(lang);
    });
</script>