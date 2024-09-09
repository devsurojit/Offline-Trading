<?php
ob_start();
session_start();
require_once('Include/header.php');
require_once('Include/slider.php');
require_once('Include/topbar.php');
if(isset($_SESSION['user_id'])){
?>
<div class="modal fade" id="war_modal" tabindex="-1" role="dialog" data-keyboard="false">
    <div class="modal-dialog modal-login" role="document">
        <div class="modal-content">
            <div class="card card-signup card-plain">
                <div class="modal-header">
                  <div class="card-header card-header-primary text-center">
                    <h4 class="card-title">Please Select WareHouse</h4>                    
                    </div>
                  </div>
                </div>
                <div class="modal-body">
                    <form class="form" >
                       
                    <div class="form-group col-md-12 mb-12 bmd-form-group is-focused" id="party_div">
						<label class="bmd-label-floating">Select WareHouse</label>
						<select class="form-control select2-hidden-accessible" data-style="btn btn-link" id="whare_house" name="whare_house" tabindex="-1" aria-hidden="true">
						<option value="" selected="" disabled="" >Select WareHouse</option>
                            	
                        </select>

					</div>
                    
                </form></div>
                <div class="modal-footer justify-content-center">
                    <!-- <a href="javascript:;" class="btn btn-primary btn-link btn-wd btn-lg" id="st_wr_btn" style="pointer-events: none; cursor: default;">Set Warehouse</a> -->
                    <button type="submit" id="set_war_h" class="btn btn-primary btn-link btn-wd btn-lg" style="cursor: default;" name="set_war_h" onclick="fetch_stock();">Show</button>
                </div>
                
            </div>
        </div>
    </div>
<div class="content" style="padding-bottom: 0;">
<div class="content">
<div class="container-fluid">
<div class="row">
<div class="col-md-12">
<div class="card">
<div class="card-header card-header-primary card-header-icon">
<div class="card-icon">
<i class="material-icons">assignment</i>
</div>
<h4 class="card-title">Sale Bill Cancelation  <span style="margin-left: 410px;">As On: <?php echo date_format(date_create(date("Y-m-d")),"d-m-Y"); ?></span></h4>
</div>
<div class="card-body">
<div class="toolbar">

</div>
<div class="material-datatables">
<div id="datatables_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
	<table id="datatables" class="table table-striped table-no-bordered table-hover dataTable no-footer dtr-inline" cellspacing="0" width="100%" style="width: 100%;" role="grid" aria-describedby="datatables_info">
<thead>
<tr role="row">
    <th class="sorting_asc" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 34px;" aria-sort="ascending" aria-label="SL: activate to sort column descending">SL</th>
    <th class="sorting" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 308px;" aria-label="Bill No: activate to sort column ascending">Bill No</th>
    <th class="sorting" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 159px;" aria-label="Customer Name: activate to sort column ascending">Sold To</th>
    <th class="sorting" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 159px;" aria-label="Created At: activate to sort column ascending">Bill Amount</th>
    <th class="sorting" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 159px;" aria-label="Created At: activate to sort column ascending">Action</th>


</tr>
</thead>

    <tbody id="live_stock">
    
    </tbody>
</table>
</div>
</div>
</div>
</div>

</div>
</div>
</div>
</div>
</div>
</div>

<?php
require_once('Include/footer.php');
?>
 <script>
    $(document).ready(function() {
      $('#datatables').DataTable({
        "pagingType": "full_numbers",
        "lengthMenu": [
          [10, 25, 50, -1],
          [10, 25, 50, "All"]
        ],
        responsive: true,
        language: {
          search: "Enter Keyword",
          searchPlaceholder: "Search records",
        }
      });

      var table = $('#datatables').DataTable();

    //   // Edit record

    //   table.on('click', '.edit', function() {
    //     $tr = $(this).closest('tr');

    //     if ($($tr).hasClass('child')) {
    //       $tr = $tr.prev('.parent');
    //     }

    //     var data = table.row($tr).data();
    //     alert('You press on Row: ' + data[0] + ' ' + data[1] + ' ' + data[2] + '\'s row.');
    //   });

      // Delete a record

      table.on('click', '.remove', function(e) {
        $tr = $(this).closest('tr');

        if ($($tr).hasClass('child')) {
          $tr = $tr.prev('.parent');
        }

        table.row($tr).remove().draw();
        e.preventDefault();
      });

      //Like record

      table.on('click', '.like', function() {
        alert('You clicked on Like button');
      });
    });
  </script>
  <script src="../assets/js/sale_bill_cancel.js"></script>
<?php
}
else{
    header('location:../login');
}
?>