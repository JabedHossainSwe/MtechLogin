<?php
session_start();
error_reporting(0);
include("../../config/connection.php");
// include("../../config/functions.php");
$Branch = addslashes(trim($_POST['Bid']));

?>

<select id="sBid" name="sBid" class="grpreq select2_demo_1 form-control" tabindex="4" required>
    <?php
    $countQry = Run("Select * from " . dbObject . "BranchSub where Bid = '$Branch'");
    $subBranches = Run("Select * from " . dbObject . "BranchSub where Bid = '$Branch'");
    $j = 1;

    $count = count(colfetch($countQry));
    if($count > 0){
        while ($subBranch = myfetch($subBranches)) {
            $selected = "";
            if ($j == 1) {
                $selected = "Selected";
            }
        ?>
            <option value="<?php echo $subBranch->sbid; ?>" <?php echo $selected; ?>><?php echo $subBranch->sBName; ?></option>
        <?php
            $j++;
        }
    } 
    else{ 
            $sBid = "2";
            $bQ = Run("Select * from " . dbObject . "Branch where Bid = '" . $Branch . "'");
            $getBData = myfetch($bQ);
            if ($getBData->ismain == '1') {
              $sBid = "1";
            }
        ?>

        <option value="<?php echo $sBid; ?>" selected></option>
        
        <?php
    }
    ?>

</select>