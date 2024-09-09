<?php
ob_start();
session_start();
require_once('Include/header.php');
require_once('Include/slider.php');
require_once('Include/topbar.php');
if(isset($_SESSION['user_id'])){
?>
<style>
    .is-hidden {
  display: none;
}
.right-corn{
	float:right;
	margin-top:-25px;
}
</style>
<div class="content" style="padding-bottom: 0;">
<div class="content">
<div class="container-fluid">
<div class="row">
<div class="col-lg-12 col-md-12 col-sm-12">
<div class="card p-3 m-0">
<div>
  <div class="card card-collapse">
    <div class="card-header p-3 card-header-rose" >
    <h4>Party Create</h4>
    </div>

    <div id="add_stock" class="collapse show" role="tabpanel" aria-labelledby="headingOne" data-parent="#accordion">
      <div class="card-body">
        <form >
		<input type="hidden" id="party_gl_Id" name="party_gl_Id" value="0">
				<div class="form-row">
					
					
					
					<div class="form-group col-md-2 mb-2 bmd-form-group is-focused" id="party_div">
						<label class="bmd-label-floating" id="mem_drop_lbl">Select Party Type</label>
						<select class="form-control select2-hidden-accessible" data-style="btn btn-link" id="party_type" name="party_type" tabindex="-1" aria-hidden="true" onchange="get_gl_Id();" >
							<option value="" selected="" disabled="" >Select Party Type</option>
							<option value="1" >Creditor</option>
							<option value="2" >Debtor</option>
                        </select>
					</div>
                    <div class="form-group col-md-4 mb-4 is-focused bmd-form-group">
					<label class="bmd-label-floating">Party Name</label>
					<input type="text" class="form-control" id="party_name" required="true" name="party_name">
					</div>
					
					<div class="form-group col-md-3 mb-2 is-focused bmd-form-group">
					<label class="bmd-label-floating">Address</label>
					<textarea class="form-control" name="part_addr" id="part_addr" cols="50" rows="1"></textarea>
					</div>
                    <div class="form-group col-md-2 mb-2 is-focused bmd-form-group">
					<label class="bmd-label-floating">Party Mobile</label>
					<input type="text" class="form-control" id="party_Mobile" required="true" name="party_Mobile">
					</div>
					<div class="form-group col-md-2 mb-2 is-focused bmd-form-group">
					<label class="bmd-label-floating">Party GSTIN</label>
					<input type="text" class="form-control" id="part_GSTIN" required="true" name="part_GSTIN">
					</div>
                    <div class="form-group col-md-2 mb-2 is-focused bmd-form-group">
					<label class="bmd-label-floating">Opening Balance</label>
					<input type="text" class="form-control" id="open_bal" required="true" name="open_bal">
					</div>
                    
        <div class="form-group col-md-2 mb-3">
        <!-- <a class="btn btn-info btn-sm btn-block text-white" disabled id="save_btn"><i class="material-icons"></i> Save</a> -->
		<button type="button" class="btn btn-info btn-sm btn-block text-white"  id="save_btn" onclick="post_party();">Save</button>
        </div>	
    
				</div>									
			
      </form>
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
</div>

</div>
</div>

<?php
require_once('Include/footer.php');
?>
 <script src="../assets/js/party_proc.js"></script>
 <?php
}
else{
    header('location:../login');
}
?>