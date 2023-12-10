<?php
session_start();
error_reporting(0);
include("../../config/connection.php");
// include("../../config/functions.php");

//// Fetch BID And Bcode//<br>
$abc = "Select max(Bid) as maxBid,max(Bcode) as maxBd from " . dbObject . "Branch ";
$myq2 = Run($abc);
$getData = myfetch($myq2);
$Bid = $getData->maxBid + 1;
$Bcode = $getData->maxBd + 1;
if ($Bcode < 10) {
    $Bcode = "0" . $Bcode;
}

?>
<div class="modal-body" id="modalBody">
    <form id="addBranchForm">
        <div class="row">

            <div class="col-6">
                <div class="row">
                    <div class="col-md-3">
                        <h4><span class="en">BID</span><span class="ar"><?= getArabicTitle('BID') ?></span></h4>
                    </div>
                    <div class="col-md-9">
                        <div class="form-group">
                            <input id="Bid" name="Bid" type="text" value="<?= $Bid ?>" class="form-control" readonly>
                            <span class="help-block errorDiv" id="bid_error"></span>

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="row">
                    <div class="col-md-3">
                        <h4><span class="en">BCode</span><span class="ar"><?= getArabicTitle('BCode') ?></span></h4>
                    </div>
                    <div class="col-md-9">
                        <div class="form-group">
                            <input id="BCode" name="BCode" type="text" class="form-control" readonly value="<?= $Bcode ?>">
                            <span class="help-block errorDiv" id="bcode_error"></span>

                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12">
                <div class="row">
                    <div class="col-md-3">
                        <h4><span class="en">Name</span><span class="ar"><?= getArabicTitle('Name') ?></span></h4>
                    </div>
                    <div class="col-md-9">
                        <div class="form-group">
                            <input value="" id="bname" name="bname" type="text" class="form-control" autocomplete="off">
                            <span class="help-block errorDiv" id="bname_error"></span>

                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12">
                <div class="row">
                    <div class="col-md-3">
                        <h4><span class="en">Description</span><span class="ar"><?= getArabicTitle('Description') ?></span></h4>
                    </div>
                    <div class="col-md-9">
                        <div class="form-group">
                            <textarea id="BDescription" name="BDescription" type="text" class="form-control" autocomplete="off"></textarea>
                            <span class="help-block errorDiv" id="BDescription_error"></span>

                        </div>
                    </div>
                </div>
            </div>


            <div class="col-12">
                <div class="row">
                    <div class="col-md-3">
                        <h4><span class="en">Starting Inv</span><span class="ar"><?= getArabicTitle('Starting Inv') ?></span></h4>
                    </div>
                    <div class="col-md-9">
                        <div class="form-group">
                            <input value="1" id="StartInvoiceNo" name="StartInvoiceNo" type="number" class="form-control" autocomplete="off">
                            <span class="help-block errorDiv" id="StartInvoiceNo_error"></span>

                        </div>
                    </div>
                </div>
            </div>
            <hr />


        </div>
</div>
<div class="modal-footer">
    <div class="col-md-12 d-flex justify-content-center">
        <div class="col-md-4">
            <button type="button" class="btn btn-block btn-outline-danger" data-dismiss="modal" id="closed"><span class="en">Close</span><span class="ar"><?= getArabicTitle('Close') ?></span></button>
        </div>
        <div class="col-md-4">
            <button type="button" class="btn btn-block btn-outline-primary" id="saveBranchBtn" onClick="return saveBranch()"><span class="en">Save</span><span class="ar"><?= getArabicTitle('Save') ?></span></button>
        </div>
    </div>

</div>
</form>
<div id="saveBranch"></div>

<script>
    $(document).ready(function() {
        var lang = document.getElementById("selected_lang").value;
        changeLanguage(lang);
    });
</script>