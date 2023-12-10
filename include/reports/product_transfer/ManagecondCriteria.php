<?php
session_start();
error_reporting(0);
$condCriteria = addslashes($_POST['condCriteria']);
include("../../../config/functions.php");
?>
<div class="modal-body" id="modalBody">
<div class="row">
<div class="col-4">
<div class="row">


<div class="col-md-12 col-12">
<div class="form-group">

<select id="cond_typ" name="cond_typ"
class="select2_demo_1 form-control"
>
<option value="">Select</option>
<?php
$ProductStockConditionCriteria = ProductStockConditionCriteria();
	foreach($ProductStockConditionCriteria as $single)
	{
		?>
	<option value="<?=$single['id']?>"><?=$single['id']?>-<?=$single['name']?></option>
		
		<?php
	}
	
?>	
	
	
	
	
</select>
</div>
</div>
</div>
</div>	
<div class="col-4">
<div class="row">


<div class="col-md-12 col-12">
<div class="form-group">

<select id="cond_op" name="cond_op"
class="select2_demo_1 form-control"
>
<option value="">Select</option>
<option value=">"> > </option>
	
<option value="<"> < </option>	
<option value="="> = </option>	
<option value="<>"> <> </option>		
</select>
</div>
</div>
</div>
</div>
	
<div class="col-4">
<div class="row">


<div class="col-md-12 col-12">
<div class="form-group">
<input id="cond_val" name="cond_val" type="text" class="form-control" value="">

</div>
</div>
</div>
</div>	
	
	<div class="col-12">
<div class="row">


<div class="col-md-12 col-12">
	
	
	
	
<div class="form-group">
<button type="button" class="btn btn-w-m btn-success float-right" id="Add" onClick="addCondCrit()"><span class="en">Add</span><span class="ar"><?= getArabicTitle('Add') ?></span></button>

</div>
</div>
</div>
</div>
	
	
	<hr/>
	
<div class="row">
<div class="col-12" id="loadCOndCrit">
	<div class="row">
	<div class="col-12">
<textarea class="form-control" id="popCnd" name="popCnd" rows="7" cols="60" style="min-width: 100%" readonly>
<?=$condCriteria?></textarea>
</div></div>
	</div>	
	
</div>	
	
	
	
	
	
</div>
</div>
<div class="modal-footer">
<button type="button" class="btn btn-danger" data-dismiss="modal" id="closed"><span class="en">Close</span><span class="ar"><?= getArabicTitle('Close') ?></span></button>
<button type="button" class="btn btn-primary" onClick="setVtc()"><span class="en">Save</span><span class="ar"><?= getArabicTitle('Save') ?></span></button>
</div>

<script>

//$(document).ready(function () {
//$("#cond_typ").select2({
//width: '100%',
//closeOnSelect: true,
//placeholder: '',
//
//});
//	});



</script>
<script>
    $(document).ready(function () {
        var lang = document.getElementById("selected_lang").value;
        changeLanguage(lang);
    });
</script>