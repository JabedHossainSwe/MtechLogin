<?php
session_start();
error_reporting(0);
include("../../config/connection.php");
$id = $_POST['id'];

$parentQry = Run("select * from ".dbObject."SupplierGroup where MainGid = '".$id."'");
$count = count(colfetch($parentQry));
if($count == 0){
    $insertion = Run("delete from ".dbObject."SupplierGroup where Gid = '".$id."'");
    ?>
    <script>
    toastr.success('Group Deleted Successfully.');
    loadlisting();
    </script>
<?php } else{ ?>
        <script>
        toastr.warning('Delete Child Supplier First.');
        </script>

<?php } ?>