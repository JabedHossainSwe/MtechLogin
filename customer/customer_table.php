<div class="container mt-4">

  <!-- Buttons -->
  <div class="mb-3">
    <a href="../currency/currency.php" class="btn btn-primary mr-2">Currency</a>
    <a href="../CustomerArea/customer_area.php" class="btn btn-primary mr-2">Area</a>
    <a href="add_customer.php" class="btn btn-primary">Add New</a>
  </div>

  <table class="table table-striped table-bordered dt-responsive table-hover ">

    <?php
    if ($pages->items_total > 0) {
      ?>
      <thead>
        <tr>
          <th><span class="en">CCode</span></th>
          <th><span class="en">CName</span></th>
        </tr>
      </thead>
      <tbody>
        <?php
        while ($single = myfetch($result)) {
          ?>
          <tr>
            <td>
              <?= $single->CCode ?>
            </td>
            <td>
              <?= $single->CName ?>
            </td>
            <td style="float: left">
              <a href="update_customer.php?CCode=<?= $single->CCode ?>&bid=<?= $single->bid ?>"
                style="width: fit-content;float: left; margin-right: 5px">
                <span class=""><i class="fa fa-pencil fa-2x" aria-hidden="true"></i></span>
              </a>
              <a href="javascript:" onclick="deleteEntry('<?= $single->CCode ?>','<?= $single->bid ?>')"
                style="width: fit-content; float: left">
                <span class=""><i class="fa fa-trash fa-2x" aria-hidden="true"></i></span>
              </a>
            </td>
          </tr>
          <?php
          $cnt++;
        }
    } else {
      ?>
        <tr>
          <td colspan="4" class="text-center">
            <h2><strong>
                <span class="en float-left">No Record(s)Found..</span></strong></h2>
          </td>
        </tr>
        <?php

    }

    ?>


    </tbody>
  </table>
</div>