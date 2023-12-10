<?php
session_start();
error_reporting(0);
include("../../config/connection.php");
$item_id = addslashes($_POST['item_id']);
$tp = addslashes($_POST['tp']);
if($tp=='customer_area')
{
?>	
<select class="select2_demo_1 form-control" id="custAreaId" name="custAreaId" >
<option value="">Please Select</option>	
<?php
$abc = Run("Select * from " . dbObject . "CustArea order by NameEng ASC");
while($loadA = myfetch($abc))
{
?>
<option value="<?=$loadA->GId?>"><?=$loadA->NameEng?></option>
<?php
}
?>
</select>
<span class="help-block errorDiv" id="custAreaId_error"></span>
	
<?php	
}

if($tp=='currency')
{
?>	

<select class="grpreq select2_demo_1 form-select" id="Currency" name="Currency" >
<option value="">Please Select Option</option>
<?php

$SalesMan = Run("select  * from Currency   order by CurrencyName ASC");


while ($getSalesMan = myfetch($SalesMan)) {
$selected = "";

?>
<option value="<?php echo $getSalesMan->CurrencyID; ?>" <?php echo $selected; ?> ><?php echo $getSalesMan->CurrencyName; ?></option>
<?php
}

?>
</select>
<span class="help-block errorDiv" id="Currency_error"></span>


<?php	
}

if($tp=='sections')
{
?>	
<select class="select2_demo_1 form-control" id="SectionId" name="SectionId" >
<option value="">Please Select</option>	
<?php
$abc = Run("Select * from " . dbObject . "Sections where isDeleted=0 order by CName ASC");
while($loadA = myfetch($abc))
{
?>
<option value="<?=$loadA->Cid?>"><?=$loadA->CName?></option>
<?php
}
?>
</select>
<span class="help-block errorDiv" id="SectionId_error"></span>

<?php	
}

if($tp=='ProductType')
{
?>	
<select class="select2_demo_1 form-control" id="ProductType" name="ProductType" >
<option value="">Please Select</option>	
<?php
$abc = Run("Select * from " . dbObject . "ProductType where isDeleted=0 order by CName ASC");
while($loadA = myfetch($abc))
{
?>
<option value="<?=$loadA->Cid?>"><?=$loadA->CCode?>- <?=$loadA->CName?></option>
<?php
}
?>
</select>
<span class="help-block errorDiv" id="ProductType_error"></span>

<?php	
}
if($tp=='suppid')
{
?>	
<select class="select2_demo_1 form-control" id="suppid" name="suppid" >
<option value="">Please Select</option>	
<?php
$abc = Run("Select * from " . dbObject . "SupplierFile where isDeleted=0 order by CName ASC");
while($loadA = myfetch($abc))
{
?>
<option value="<?=$loadA->Cid?>"><?=$loadA->CCode?>- <?=$loadA->CName?></option>
<?php
}
?>
</select>
<span class="help-block errorDiv" id="suppid_error"></span>

<?php	
}
if($tp=='PGID')
{
?>	
<select class="select2_demo_1 form-control" id="PGID" name="PGID" >
<option value="">Please Select</option>	
<?php
$abc = Run("Select * from " . dbObject . "ProductGroup where isDeleted=0 order by NameEng ASC");
while($loadA = myfetch($abc))
{
?>
<option value="<?=$loadA->Gid?>"><?=$loadA->Code?>- <?=$loadA->NameEng?></option>
<?php
}
?>
</select>
<span class="help-block errorDiv" id="PGID_error"></span>

<?php	
}
if($tp=='uid')
{
?>	
<select class="select2_demo_1 form-control" id="uid" name="uid" onChange="loadUnitsGrid(this.value);" >
<option value="">Please Select</option>	
<?php
$abc = Run("Select * from " . dbObject . "Units where isDeleted=0 and (ParentParaID is NUll Or ParentParaID = 0) order by ParaName ASC");
while($loadA = myfetch($abc))
{
?>
<option value="<?=$loadA->ParaID?>"><?=$loadA->ParaCode?>- <?=$loadA->ParaName?></option>
<?php
}
?>
</select>
<span class="help-block errorDiv" id="uid_error"></span>

<?php	
}if($tp=='offerGrpId')
{
?>	
<select class="select2_demo_1 form-control" id="offerGrpId" name="offerGrpId" >
<option value="">Please Select</option>	
<?php
$abc = Run("Select * from " . dbObject . "OfferProductGroup order by NameEng ASC");
while($loadA = myfetch($abc))
{
?>
<option value="<?=$loadA->Gid?>"><?=$loadA->Code?>- <?=$loadA->NameEng?></option>
<?php
}
?>
</select>
<span class="help-block errorDiv" id="offerGrpId_error"></span>

<?php	
}if($tp=='supplier_group')
{
?>	
<select class="grpreq select2_demo_1 form-control" id="grpId" name="grpId">
<option value="">Please Select</option>
<?php
$abc = Run("Select * from " . dbObject . "SupplierGroup  order by Gid ASC");
while ($loadA = myfetch($abc)) {
?>
<option value="<?= $loadA->Gid ?>"><?= $loadA->NameEng ?></option>
<?php
}
?>
</select>
<span class="help-block errorDiv" id="grpId_error"></span>

<?php	
}

?>

<script>
$(document).ready(function () {
  $(".select2_demo_1").select2({
    width: '100%',
    closeOnSelect: true,
});
});

</script>