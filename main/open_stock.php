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
<div class="row">
<div class="col-lg-12 col-md-12 col-sm-12">
<div class="card p-3 m-0">
<div id="accordion" role="tablist">
  <div class="card card-collapse">
    <div class="card-header p-3 card-header-rose" role="tab" id="headingOne">
      <h5 class="mb-0">
        <a data-toggle="collapse" href="#add_stock" aria-expanded="true" aria-controls="add_stock" class="text-white">
          Opening Stock Entry
        </a>
      </h5>	  
    </div>

    <div id="add_stock" class="collapse show" role="tabpanel" aria-labelledby="headingOne" data-parent="#accordion">
      <div class="card-body">
        <form >
		<input type="hidden" id="tbl_data" name="tbl_data">
				<div class="form-row">
					<div class="form-group col-md-2 mb-2 is-focused bmd-form-group">
						<label class="bmd-label-floating">Stock Date</label>
						<input type="date" class="form-control" id="chalan_date" name="chalan_date">
					</div>

					<div class="form-group col-md-4 mb-4 bmd-form-group is-focused">
						<label class="bmd-label-floating">Select warehouse</label>
						<select class="form-control select2-hidden-accessible" data-style="btn btn-link" id="whare_house" name="whare_house" tabindex="-1" aria-hidden="true">
						<option value="" selected="" disabled="" >Select warehouse</option>
                            	
                        </select>

					</div>
					
					
				</div>									
			
      </form>
    </div>
    </div>
  </div>  
</div>
</div>

<div class="card">
<div class="card-header card-header-tabs card-header-primary">
	<h4 class="mb-0">Add Item</h4>
</div>
	
<div class="card-body">

				<div class="form-row">
					<div class="form-group col-md-3 mb-3 bmd-form-group is-focused">
						<label class="bmd-label-floating">Select Item</label>
						<select class="form-control select2-hidden-accessible" data-style="btn btn-link" id="Item_Id" name="Item_Id" tabindex="-1" aria-hidden="true" onchange="load_item_unit();">
						<option value="" selected="" disabled="" >Select Item</option>						
                </select>
                
					</div>
					
					
					<div class="form-group col-md-3 mb-3 is-focused bmd-form-group">
					<label class="bmd-label-floating">Quantity</label>
					<input type="text" class="form-control " id="Itm_Qny" name="Itm_Qny" >
					</div>
					<div class="form-group col-md-3 mb-3 bmd-form-group is-focused">
						<label class="bmd-label-floating ">Select Unit</label>
						<select class="form-control select2-hidden-accessible" data-style="btn btn-link" id="Unit_Id" name="Unit_Id" tabindex="-1" aria-hidden="true">
						<option value="" selected="" disabled="" >Select Unit</option>
						</select>
                        
					</div>
					<div class="form-group col-md-3 mb-3 is-focused bmd-form-group">
					<label class="bmd-label-floating">Rate</label>
					<input type="text" class="form-control decimal" id="item_rate" name="item_rate">
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
							<th>Qnt.</th>
							<th>Unit</th>
							<th style="display:none;">Unit_id</th>
                            <th>Rate</th>
							<th>Total Value</th>
							<th style="width: 10%;" class="text-center">Action</th>
						</tr>
					</thead>
					<tbody id="chalan_table">
						
					</tbody>
				</table>
				


				
				
				
</div>

<div class="card-footer justify-content-center py-3">
	<button type="button" class="btn btn-primary" id="sav_btn" name="sav_btn" onclick="post_open();">Save</button>
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
 <script src="../assets/js/open_stock.js"></script>
<?php
}
else{
    header('location:../login');
}
?>