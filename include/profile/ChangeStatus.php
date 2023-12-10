<?php
session_start();
error_reporting(0);
include("../../config/main_connection.php");
include("../../config/connection.php");
// include("../../config/functions.php");
$id = $_POST['id'];
$qst = RunMain("Select * from " . dbObjectMain . "Logins where id = '" . $id . "'");
$myq = myfetchMain($qst);



?>
<div id="error"></div>
<form action="javascript:saveChangeStatus('<?= $id ?>')" class="form-horizontal form-bordered form-label-stripped" id="update_user_form_comp" enctype="multipart/form-data">
  <div class="modal-body" id="modalBody">

    <div class="form-body">






      <div class="row mb-3">
        <label class="control-label col-md-4" style="text-align: left;"><span class="en">Status</span><span class="ar"><?= getArabicTitle('Status') ?></span></label>
        <div class="col-md-8">
          <select id="status" name="status" class="select2_demo_1 form-control">
            <option value="0" <?php if ($myq->status == 0) {
                                echo "Selected";
                              } ?>>Inactive</option>

            <option value="1" <?php if ($myq->status == 1) {
                                echo "Selected";
                              } ?>>Active</option>
          </select>
        </div>





      </div>


    </div>


  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-danger" data-dismiss="modal" id="closed"><span class="en">Close</span><span class="ar"><?= getArabicTitle('Close') ?></span></button>
    <button type="submit" id="ajaxStart" class="btn btn-primary"><span class="en">Save</span><span class="ar"><?= getArabicTitle('Save') ?></span></button>
  </div>

</form>
<div id="saveBranch"></div>
<script>
  $(document).ready(function() {
    $(".select2_demo_1").select2({
      width: '100%',
      closeOnSelect: true,
    });
  });
</script>
<script>
    $(document).ready(function() {
        var lang = document.getElementById("selected_lang").value;
        changeLanguage(lang);
    });
</script>