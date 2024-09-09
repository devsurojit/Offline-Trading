<?php
ob_start();
session_start();
require_once('Include/header.php');
require_once('Include/slider.php');
require_once('Include/topbar.php');
if(isset($_SESSION['user_id'])){
?>

<div class="content" style="padding-bottom: 0;">
<div class="content">
<div class="container-fluid">


<div class="card">
<div class="card-header card-header-tabs card-header-primary">
	<h4 class="mb-0">Add Item</h4>
</div>
	
<div class="card-body">
<input type="hidden" id="tbl_data" name="tbl_data">

				<div class="form-row">
					<div class="form-group col-md-3 mb-3 bmd-form-group is-focused">
						<label class="bmd-label-floating">Select Item</label>
						<select class="form-control select2-hidden-accessible" data-style="btn btn-link" id="Item_Id" name="Item_Id" tabindex="-1" aria-hidden="true" onchange="load_item_unit();">
						<option value="" selected="" disabled="" >Select Item</option>						
                </select>
                
					</div>
					
					
					
					<div class="form-group col-md-3 mb-3 bmd-form-group is-focused">
						<label class="bmd-label-floating ">Select Unit</label>
						<select class="form-control select2-hidden-accessible" data-style="btn btn-link" id="Unit_Id" name="Unit_Id" tabindex="-1" aria-hidden="true">
						<option value="" selected="" disabled="" >Select Unit</option>
						</select>
                        
					</div>
					<div class="form-group col-md-3 mb-3 is-focused bmd-form-group">
					<label class="bmd-label-floating">Rate</label>
					<input type="text" class="form-control " id="item_rate" name="item_rate">
					</div>
					
					<div class="form-group col-md-3 mb-3">
					<a class="btn btn-info btn-sm btn-block text-white" onclick="add_item();"><i class="material-icons">add</i> Add Item</a>
					</div>
					
				</div>



</div>


</div>
<div class="card">

	
<div class="card-body">


				<table id="faqs" class="table table-strip">
					<thead>
						<tr>
							<th>SL</th>
							<th style="width: 45%;">Item</th>
							<th style="display:none;">Item_id</th>
							<th>Unit</th>
							<th style="display:none;">Unit_id</th>
                            <th>Rate</th>
							<th style="width: 10%;" class="text-center">Action</th>
						</tr>
					</thead>
					<tbody id="chalan_table">
						
					</tbody>
				</table>
				


				
				
				
</div>

<div class="card-footer justify-content-center py-3">
	<button type="button" class="btn btn-primary" id="sav_btn" name="sav_btn" onclick="post_rate();">Save</button>
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
 <script src="../assets/js/item_rate.js"></script>
<?php
}
else{
    header('location:../login');
}
?>