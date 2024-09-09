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
    <h4>Voucher Entry</h4>
    </div>

    <div id="add_stock" class="collapse show" role="tabpanel" aria-labelledby="headingOne" data-parent="#accordion">
      <div class="card-body">
        <form >
		<input type="hidden" id="tbl_data" name="tbl_data">
				<div class="form-row">
					<div class="form-group col-md-2 mb-2 is-focused bmd-form-group">
						<label class="bmd-label-floating">Voucher Date</label>
						<input type="date" class="form-control" id="purchase_Date" name="purchase_Date" value="<?php echo date('Y-m-d'); ?>" min="<?php echo $_SESSION['fin_frm_dt']  ?>" max="<?php echo date("Y-m-d");  ?>" >
					</div>
				
					
					<div class="form-group col-md-2 mb-2 is-focused bmd-form-group">
					<label class="bmd-label-floating">Reference Voucher No</label>
					<input type="text" class="form-control" id="ref_pur_No" autocomplete="off" required="true" name="ref_pur_No">
					</div>
					
					
					<div class="form-group col-md-4 mb-4 bmd-form-group is-focused" id="party_div">
						<label class="bmd-label-floating" id="mem_drop_lbl">Select Voucher Type</label>
						<select class="form-control select2-hidden-accessible" data-style="btn btn-link" id="vouch_type" name="vouch_type" tabindex="-1" aria-hidden="true" onchange="hide_sb(this.value);">
							<option value="" selected="" disabled="" >Select Voucher Type</option>
							<option value="R" >Receipt</option>
							<option value="P" >Payment</option>
                        </select>

					</div>
					<div class="form-group col-md-4 mb-4 bmd-form-group is-focused" id="wh_div">
						<label class="bmd-label-floating">Select Ledger</label>
						<select class="form-control select2-hidden-accessible" data-style="btn btn-link" id="acct_ledg" name="acct_ledg" tabindex="-1" aria-hidden="true" >
						<option value="" selected="" disabled="" >Select Ledger</option>
                            	
                        </select>

					</div>
					<input type="hidden" id="sub_count" name="sub_count" >
					<!-- <div class="form-group col-md-4 mb-4 bmd-form-group is-focused" id="wh_div">
						<label class="bmd-label-floating">Select Party</label>
						<select class="form-control select2-hidden-accessible" data-style="btn btn-link" id="party_id" name="party_id" tabindex="-1" aria-hidden="true">
						<option value="" selected="" disabled="" >Select Party</option>
                            	
                        </select>

					</div> -->
					<div class="form-group col-md-3 mb-2 is-focused bmd-form-group">
					<label class="bmd-label-floating">Narration</label>
					<input type="text" class="form-control" id="narration" autocomplete="off" required="true" name="narration">
					</div>
                    <!-- <div class="form-group col-md-4 mb-2 is-focused bmd-form-group">
					<label class="bmd-label-floating">Address</label>
					<input type="text" class="form-control" id="address" required="true" name="address">
					</div> -->
					<!-- <div class="form-group col-md-2 mb-2 is-focused bmd-form-group">
					<label class="bmd-label-floating">Mobile No</label>
					<input type="text" class="form-control" id="mem_mob" required="true" name="mem_mob">
					</div> -->
                    <!-- <div class="form-group col-md-2 mb-2 is-focused bmd-form-group">
					<label class="bmd-label-floating">GSTIN No</label>
					<input type="text" class="form-control" id="gst_in_No" required="true" name="gst_in_No">
					</div> -->
					<!-- <div class="form-group col-md-2 mb-2 is-focused bmd-form-group">
					<label class="bmd-label-floating">Nominee Name</label>
					<input type="text" class="form-control" id="nom_name" required="true" name="nom_name">
					</div> -->
					<div class="form-group col-md-2 mb-2 is-focused bmd-form-group">
					<label class="bmd-label-floating">Enter Amount</label>
					<input type="text" class="form-control" id="vouch_amt" autocomplete="off" required="true" name="vouch_amt">
					</div>
					<!-- <div class="form-group col-md-3 mb-3">
					<a class="btn btn-info btn-sm btn-block text-white" onclick="add_item();"><i class="material-icons">add</i> Add Item</a>
					</div> -->
				</div>									
			
      </form>
    </div>
    </div>
  </div>  
</div>
</div>





</div>
<div class="card">
<div class="card-header card-header-tabs card-header-primary">
	<h4 class="mb-0">Voucher Section</h4>
	<h4 id="balance_lable" class=" mb-2 right-corn" style="display:none;">Available Balance : <span id="sb_balance"></span></h4> 
</div>


	
<div class="card-body">	
    <div class="row">				
        <div class="col-md-6 col-12">
        <div class="form-check-inline">
        <label class="form-check-label" for="radio1" style="font-weight: 600;">
            <input type="radio" class="form-check-input" id="cash_opt" name="trans_opt" value="cash" checked="true" onchange="trans_mode(this.id);">Cash
        </label>
        </div>
        <div class="form-check-inline">
        <label class="form-check-label" for="radio2" style="font-weight: 600;">
            <input type="radio" class="form-check-input" id="bank_opt" name="trans_opt" value="bank" onchange="trans_mode(this.id);">Bank/Cheque
        </label>
        </div>
        <div class="form-check-inline">
        <label class="form-check-label" for="radio2" style="font-weight: 600;">
            <input type="radio" class="form-check-input" id="sb_opt" name="trans_opt" value="bank" onchange="trans_mode(this.id);">S/B
        </label>
        </div>
        <!-- <div class="form-check-inline">
        <label class="form-check-label" for="radio3" style="font-weight: 600;">
            <input type="radio" class="form-check-input" id="credit_opt" name="trans_opt" value="credit" onchange="trans_mode(this.id);" >Credit
        </label>
        </div> -->
        </div>

        <div class="form-group col-md-3 mb-3 bmd-form-group is-focused" id="bank_div">
            <label class="bmd-label-floating ">Select Bank Account</label>
            <select class="form-control select2-hidden-accessible" data-style="btn btn-link" id="bank_Id" name="bank_Id" tabindex="-1" aria-hidden="true" onchange="$('#save_btn').removeAttr('disabled');">
            <option value="" selected="" disabled="" >Select Bank Account</option>
            </select>            
        </div>
        <div class="form-group col-md-3 mb-3 bmd-form-group is-focused" id="sb_div">
            <label class="bmd-label-floating ">Enter S/B Account</label>
            <input type="text" class="form-control" id="mem_sb_acct" required="true" autocomplete="off" name="mem_sb_acct" onchange="fetch_sb_account();" >
			<input type="hidden" id="pSb_Acct_Id" name="pSb_Acct_Id">
        </div>        
		<input type="hidden" id="mem_bal" name="mem_bal">
        <!-- <div class="form-group col-md-3 mb-3" id="cash_div">
        <button type="button" class="btn btn-info btn-sm btn-block text-white" id="Cash_Denom_btn"><i class="material-icons"></i> Cash Denom</button>
        </div>	 -->
        
    </div>	
    <div class="row justify-content-center">
        <div class="form-group col-md-2 mb-3">
        <!-- <a class="btn btn-info btn-sm btn-block text-white" disabled id="save_btn"><i class="material-icons"></i> Save</a> -->
		<button type="button" class="btn btn-info btn-sm btn-block text-white"  id="save_btn" onclick="post_voucher();">Save</button>
        </div>	
    </div>
</div>



</div>

<div class="card is-hidden" id="Cash_Denomination">
	<div class="card-header card-header-tabs card-header-primary">
		<h4 class="mb-0">Cash Denomination</h4>
		<!-- <button onclick="addfaqs();" class="btn btn-sm mb-0" style="float: right;margin-top: -28px;background: #0002046b;border: 0;border-radius: 0;"><i class="material-icons">add </i> ADD NEW</button> -->
	</div>
		
	<div class="card-body">
		<div class="container">
			<div class="row section_block">
				<div class="col-md-12">
				<div class="row" style="padding: 0px 15px 0 15px;">
					<div class='col-sm-6 col-xs-12'>
						<h3>Input Cash</h3>
						<div class="table-responsive">
							<table class="table table-striped jambo_table bulk_action"
								style="margin-bottom: 0 !important">
								<thead>
									<tr class="headings">
										<th>Type</th>
										<th>Unit</th>
										<th>Qty</th>
										<th>Total</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>Notes</td>
										<td>2000</td>
										<td><input id="input_2000_curren" name="input_2000_curren"
												class="noteinputClass" placeholder="0"
												oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength); CurrencyCal();"
												type="text" maxlength="7" autocomplete="off" /></td>
										<td><Strong>
												<p class="text-right" id="inp2000tot">0</p>
											</Strong></td>
									</tr>

									<tr>
										<td>Notes</td>
										<td>500</td>
										<td><input id="input_500_curren" name="input_500_curren"
												class="noteinputClass" placeholder="0"
												oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);CurrencyCal();"
												type="text" maxlength="7" autocomplete="off" /></td>
										<td><Strong>
												<p class="text-right" id="inp500tot">0</p>
											</Strong></td>
									</tr>
									<tr>
										<td>Notes</td>
										<td>200</td>
										<td><input id="input_200_curren" name="input_200_curren"
												class="noteinputClass" placeholder="0"
												oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);CurrencyCal()"
												type="text" maxlength="7" autocomplete="off" /></td>
										<td><Strong>
												<p class="text-right" id="inp200tot">0</p>
											</Strong></td>
									</tr>
									<tr>
										<td>Notes</td>
										<td>100</td>
										<td><input id="input_100_curren" name="input_100_curren"
												class="noteinputClass" placeholder="0"
												oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);CurrencyCal()"
												type="text" maxlength="7" autocomplete="off" /></td>
										<td><Strong>
												<p class="text-right" id="inp100tot">0</p>
											</Strong></td>
									</tr>
									<tr>
										<td>Notes</td>
										<td>50</td>
										<td><input id="input_50_curren" name="input_50_curren"
												class="noteinputClass" placeholder="0"
												oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);CurrencyCal()"
												type="text" maxlength="7" autocomplete="off" /></td>
										<td><Strong>
												<p class="text-right" id="inp50tot">0</p>
											</Strong></td>
									</tr>
									<tr>
										<td>Notes</td>
										<td>20</td>
										<td><input id="input_20_curren" name="input_20_curren"
												class="noteinputClass" placeholder="0"
												oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);CurrencyCal()"
												type="text" maxlength="7" autocomplete="off" /></td>
										<td><Strong>
												<p class="text-right" id="inp20tot">0</p>
											</Strong></td>
									</tr>
									<tr>
										<td>Notes</td>
										<td>10</td>
										<td><input id="input_10_curren" name="input_10_curren"
												class="noteinputClass" placeholder="0"
												oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);CurrencyCal()"
												type="text" maxlength="7" autocomplete="off" /></td>
										<td><Strong>
												<p class="text-right" id="inp10tot">0</p>
											</Strong></td>
									</tr>
									<tr>
										<td>Notes</td>
										<td>5</td>
										<td><input id="input_5_curren" name="input_5_curren"
												class="noteinputClass" placeholder="0"
												oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);CurrencyCal()"
												type="text" maxlength="7" autocomplete="off" /></td>
										<td><Strong>
												<p class="text-right" id="inp5tot">0</p>
											</Strong></td>
									</tr>

									<tr>
										<td>Coins</td>
										<td>1</td>
										<td><input id="input_1con_curren" name="input_1con_curren"
												class="noteinputClass" placeholder="0"
												oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);CurrencyCal()"
												type="text" maxlength="7" autocomplete="off" /></td>
										<td><Strong>
												<p class="text-right" id="inp1contot">0</p>
											</Strong></td>
									</tr>
									<tr>
										<td colspan="3"><Strong>Total Cash</Strong></td>
										<td><Strong>
												<p class="text-right" id="inpcastot">0</p>
											</Strong></td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
					<div class='col-sm-6 col-xs-12'>
						<h3>Output Cash</h3>
						<div class="table-responsive">
							<table class="table table-striped jambo_table bulk_action"
								style="margin-bottom: 0 !important">
								<thead>
									<tr class="headings">
										<th>Type</th>
										<th>Unit</th>
										<th>Qty</th>
										<th>Total</th>
									</tr>
								<tbody>
									<tr>
										<td>Notes</td>
										<td>2000</td>
										<td><input id="output_2000_curren" name="output_2000_curren"
												class="noteinputClass" placeholder="0"
												oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength); CurrencyCal();"
												type="text" maxlength="7" /></td>
										<td><strong>
												<p class="text-right" id="opt2000tot">0</p>
											</strong></td>
									</tr>
									<tr>
										<td>Notes</td>
										<td>500</td>
										<td><input id="output_500_curren" name="output_500_curren"
												class="noteinputClass" placeholder="0"
												oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);CurrencyCal();"
												type="text" maxlength="7" autocomplete="off" /></td>
										<td><strong>
												<p class="text-right" id="opt500tot">0</p>
											</strong></td>
									</tr>
									<tr>
										<td>Notes</td>
										<td>200</td>
										<td><input id="output_200_curren" name="output_200_curren"
												class="noteinputClass" placeholder="0"
												oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);CurrencyCal()"
												type="text" maxlength="7" autocomplete="off" /></td>
										<td><strong>
												<p class="text-right" id="opt200tot">0</p>
											</strong></td>
									</tr>
									<tr>
										<td>Notes</td>
										<td>100</td>
										<td><input id="output_100_curren" name="output_100_curren"
												class="noteinputClass" placeholder="0"
												oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);CurrencyCal()"
												type="text" maxlength="7" autocomplete="off" /></td>
										<td><strong>
												<p class="text-right" id="opt100tot">0</p>
											</strong></td>
									</tr>
									<tr>
										<td>Notes</td>
										<td>50</td>
										<td><input id="output_50_curren" name="output_50_curren"
												class="noteinputClass" placeholder="0"
												oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);CurrencyCal()"
												type="text" maxlength="7" autocomplete="off" /></td>
										<td><strong>
												<p class="text-right" id="opt50tot">0</p>
											</strong></td>
									</tr>
									<tr>
										<td>Notes</td>
										<td>20</td>
										<td><input id="output_20_curren" name="output_20_curren"
												class="noteinputClass" placeholder="0"
												oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);CurrencyCal()"
												type="text" maxlength="7" autocomplete="off" /></td>
										<td><strong>
												<p class="text-right" id="opt20tot">0</p>
											</strong></td>
									</tr>
									<tr>
										<td>Notes</td>
										<td>10</td>
										<td><input id="output_10_curren" name="output_10_curren"
												class="noteinputClass" placeholder="0"
												oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);CurrencyCal()"
												type="text" maxlength="7" autocomplete="off" /></td>
										<td><strong>
												<p class="text-right" id="opt10tot">0</p>
											</strong></td>
									</tr>
									<tr>
										<td>Notes</td>
										<td>5</td>
										<td><input id="output_5_curren" name="output_5_curren"
												class="noteinputClass" placeholder="0"
												oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);CurrencyCal()"
												type="text" maxlength="7" autocomplete="off" /></td>
										<td><strong>
												<p class="text-right" id="opt5tot">0</p>
											</strong></td>
									</tr>

									<tr>
										<td>Coins</td>
										<td>1</td>
										<td><input id="output_1con_curren" name="output_1con_curren"
												class="noteinputClass" placeholder="0"
												oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);CurrencyCal()"
												type="text" maxlength="7" autocomplete="off" /></td>
										<td><strong>
												<p class="text-right" id="opt1contot">0</p>
											</strong></td>
									</tr>
									<tr>
										<td colspan="3"><Strong>Total Cash</Strong></td>
										<td><strong>
												<p class="text-right" id="optcastot">0</p>
											</strong></td>
									</tr>


								</tbody>
							</table>
						</div>
					</div>
				</div>
				</div>

				<div class="col-md-12">
				<div class="row" style="padding: 15px 15px 0 15px;">
					<div class="form-group col-md-12 col-xs-12">
						<div class="capsule">

							<label
								class="col-form-label col-md-2 col-sm-2 col-xs-3 label-align left left-lebel"
								for="ApplicationDate" style="padding:6px 6px 6px 15px">
								<h4>Grand Total</h4>
							</label>
							<label class="col-form-label col-md-2 col-sm-2 col-xs-3 label-align"
								for="ApplicationDate" style="padding:6px 6px 6px 15px">
								<h4 id="gandtot"></h4>
							</label>
							<label class="col-form-label col-md-8 col-sm-4 col-xs-6 label-align"
								for="ApplicationDate" style="padding:6px 6px 6px 15px">
								<h4 id="op"></h4>
							</label>
						</div>
					</div>
				</div>
				</div>

			</div>
			<div class="row" style="margin-top: 15px">
				<div class='col-sm-2 col-xs-12 col-lg-offset-4' style="margin-bottom: 15px">
				<input type="button" class="btn btn-warning btn-block" style="margin: 0 auto;display: block;"
						 value="Reset"
						onclick="reset_cash_fild(); javascript: document.getElementById('okbut').setAttribute('disabled', true); "/>
				</div>
				<div class='col-sm-2 col-xs-12'>
					<button type="button" id="okbut" name="okbut" class="btn btn-primary btn-block m-0"
						data-dismiss="modal" aria-label="Close" disabled
						onclick="isblanc()">Done</button>

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

<div class="modal fade" id="cash_denom_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title font-weight-normal" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn bg-gradient-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>




<?php
require_once('Include/footer.php');
?>
 <script src="../assets/js/voucher_proc.js"></script>
 <script src="../assets/js/print_bill.js"></script>
 <script src="../assets/js/cur_inward.js"></script>
 <?php
}
else{
    header('location:../login');
}
?>