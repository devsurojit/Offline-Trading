<?php
ob_start();
session_start();
?>
<?php
require_once('Include/header.php');
require_once('Include/slider.php');
require_once('Include/topbar.php');
if(isset($_SESSION['user_id'])){
?>


<div class="content" style="padding-bottom: 0;">
<div class="content">
<div class="container-fluid">
<div class="row">
<div class="col-md-12">
<div class="card-header mb-4">
<h4 class="card-title mb-0">Master Setup -
<small class="description">Unit,Brand,Category,Sub-Category,Item,Warehouse</small>
</h4>
</div>

<div class="row">
<div class="col-lg-2 col-md-6">
	<ul class="nav nav-pills nav-pills-rose nav-pills-icons flex-column p-0" role="tablist">
	
	<li class="nav-item">
	<a class="nav-link  active" data-toggle="tab" href="#prd-unit" role="tablist">
	<i class="material-icons">ad_units</i> UNIT
	</a>
	</li>	
	<li class="nav-item">
	<a class="nav-link " data-toggle="tab" href="#prd-category" role="tablist">
	<i class="material-icons">admin_panel_settings</i> Brand
	</a>
	</li>
    <li class="nav-item">
	<a class="nav-link " data-toggle="tab" href="#prd-type" role="tablist">
	<i class="material-icons">category</i> Categoey
	</a>
	</li>
    <li class="nav-item">
	<a class="nav-link " data-toggle="tab" href="#prd-size" role="tablist" onclick="load_catagory();">
	<i class="material-icons">aspect_ratio</i> Sub Catagory
	</a>
	</li>
	<li class="nav-item">
	<a class="nav-link" data-toggle="tab" href="#prd-subcategory" role="tablist" onclick="load_item_drop();">
	<i class="material-icons">lightbulb_circle</i> Item
	</a>
	</li>
	<li class="nav-item">
	<a class="nav-link" data-toggle="tab" href="#prd-warehouse" role="tablist">
	<i class="material-icons">home</i> WAREHOUSE
	</a>
	</li>
	</ul>
</div>
<div class="col-md-10">
<div class="tab-content">
<div class="tab-pane active" id="prd-unit">	
	<div class="card" style="margin-top: 1.3rem;">
		<div class="card-header card-header-tabs card-header-rose">
		<div class="nav-tabs-navigation">
		<div class="nav-tabs-wrapper">
		<span class="nav-tabs-title">Unit:</span>
		<ul class="nav nav-tabs" data-tabs="tabs">
		<li class="nav-item">
		<a class="nav-link active" href="#nu_unit" data-toggle="tab" id="update_unit" onclick="show_unit(this.id);">
		<i class="material-icons">add</i> New / Update Unit
		<div class="ripple-container"></div>
		</a>
		</li>
		<li class="nav-item">
		<a class="nav-link" href="#unit_list" data-toggle="tab" id="list_unit" onclick="show_unit(this.id);">
		<i class="material-icons">toc</i> Product Unit List
		<div class="ripple-container"></div>
		</a>
		</li>		
		</ul>
		</div>
		</div>
		</div>
		
		<div class="card-body">
		<div class="tab-content">
		<div class="tab-pane active" id="nu_unit">
			<form >
			<input type="hidden" id="unit_id" name="unit_id" value="0">
				<div class="form-row">
					<div class="form-group col-md-6 is-focused bmd-form-group">
						<label class="bmd-label-floating">Enter Product Unit Name</label>
						<input type="text" class="form-control" id="unit_f_nm" required="true" name="unit_f_nm">
					</div>
					<div class="form-group col-md-6 is-focused bmd-form-group">
						<label class="bmd-label-floating">Enter Product Unit Sort Name</label>
						<input type="text" class="form-control" id="unit_s_nm" required="true" name="unit_s_nm" maxlength="3">
					</div>
					
					<div class="form-group col-md-6 bmd-form-group is-focused">
						<select class="form-control select2-hidden-accessible" data-style="btn btn-link" id="select_unt_typ" name="select_unt_typ"    tabindex="-1" aria-hidden="true">
						<option value="" selected="" disabled="" >Select Type</option>
                		</select>

				</div>
			</div>
				<div class="card-footer ml-auto mr-auto justify-content-center">
				<button type="button" class="btn btn-rose" id="unit_btn" name="unit_btn" onclick="post_unit();">Add</button>
				</div>				
			</form>			
		</div>
		<div class="tab-pane" id="unit_list">
			<table class="table">
				<thead>
				<tr>
                <th style="display:none;" class="text-center">id_hidd</th>
				<th class="text-center">SL</th>
				<th>Unit Name</th>	
				<th>Short Name</th>
				<th>Type</th>	
				<th class="text-right">Actions</th>
				</tr>
				</thead>
				<tbody id="tbl_unit">	
				     		
				</tbody>
		</table>
		</div>		
		</div>
		</div>
</div>
</div> 


<div class="tab-pane " id="prd-category">
	<div class="card" style="margin-top: 1.3rem;">
		<div class="card-header card-header-tabs card-header-rose">
		<div class="nav-tabs-navigation">
		<div class="nav-tabs-wrapper">
		<span class="nav-tabs-title">Brand:</span>
		<ul class="nav nav-tabs" data-tabs="tabs">
		<li class="nav-item">
		<a class="nav-link active" href="#nu_brand" data-toggle="tab" id="brand_update" onclick="show_brand(this.id);">
		<i class="material-icons">add</i> New / Update Brand
		<div class="ripple-container"></div>
		</a>
		</li>
		<li class="nav-item">
		<a class="nav-link" href="#brand_list" data-toggle="tab" id="brand_list_tab" onclick="show_brand(this.id);">
		<i class="material-icons">toc</i> Product Brand List
		<div class="ripple-container"></div>
		</a>
		</li>		
		</ul>
		</div>
		</div>
		</div>
		
		<div class="card-body">
		<div class="tab-content">
		<div class="tab-pane active" id="nu_brand">
			<form >
			<input type="hidden" id="brand_Id" name="brand_Id" value="0">
				<div class="form-group is-focused bmd-form-group">
				<label for="product_category" class="bmd-label-floating">Enter Product Brand</label>
				<input type="text" class="form-control" id="brand_Name" required="true" name="brand_Name">
				</div>		
					
				<div class="card-footer ml-auto mr-auto justify-content-center">
				<button type="button" class="btn btn-rose" id="brand_btn" name="brand_btn" onclick="post_brand();">Add</button>
				</div>				
			</form>			
		</div>
		<div class="tab-pane" id="brand_list">
			<table class="table">
				<thead>
				<tr>
                <th style="display:none;">SL</th>
				<th class="text-center">SL</th>
				<th>Product Brand Name</th>		
				<th class="text-right">Actions</th>
				</tr>
				</thead>
				<tbody id="brand_table">	
				     
				</tbody>
		</table>
		</div>		
		</div>
		</div>
</div>
</div>

<!-- ---------------------------------- -->
<div class="tab-pane " id="prd-type">
	<div class="card" style="margin-top: 1.3rem;">
		<div class="card-header card-header-tabs card-header-rose">
		<div class="nav-tabs-navigation">
		<div class="nav-tabs-wrapper">
		<span class="nav-tabs-title">Category:</span>
		<ul class="nav nav-tabs" data-tabs="tabs">
		<li class="nav-item">
		<a class="nav-link active" href="#nu_cat" data-toggle="tab" id="cat_update" onclick="show_cat(this.id);">
		<i class="material-icons">add</i> New / Update Category
		<div class="ripple-container"></div>
		</a>
		</li>
		<li class="nav-item">
		<a class="nav-link" href="#cat_list" data-toggle="tab" id="cat_list_tab" onclick="show_cat(this.id);">
		<i class="material-icons">toc</i> Product Category List
		<div class="ripple-container"></div>
		</a>
		</li>		
		</ul>
		</div>
		</div>
		</div>
		
		<div class="card-body">
		<div class="tab-content">
		<div class="tab-pane active" id="nu_cat">
			<form >
			<input type="hidden" id="cat_id" name="cat_id" value="0">
				<div class="form-group is-focused bmd-form-group">
				<label for="cat_name" class="bmd-label-floating">Enter Catagory Name</label>
				<input type="text" class="form-control" id="cat_name" required="true" name="cat_name">
				</div>		
					
				<div class="card-footer ml-auto mr-auto justify-content-center">
				<button type="button" class="btn btn-rose" id="cat_btn" name="cat_btn" onclick="add_cat();">Add</button>
				</div>				
			</form>			
		</div>
		<div class="tab-pane" id="cat_list">
			<table class="table">
				<thead>
				<tr>
				<th style="display:none;">cat_id</th>	
				<th class="text-center">SL</th>
				<th>Product Category Name</th>		
				<th class="text-right">Actions</th>
				</tr>
				</thead>
				<tbody id="cat_table">	
				     
			
				</tbody>
		</table>
		</div>		
		</div>
		</div>
</div>
</div>

<!-- ------------------------------------------- -->
<div class="tab-pane " id="prd-size">
	<div class="card" style="margin-top: 1.3rem;">
		<div class="card-header card-header-tabs card-header-rose">
		<div class="nav-tabs-navigation">
		<div class="nav-tabs-wrapper">
		<span class="nav-tabs-title">Sub Catagory:</span>
		<ul class="nav nav-tabs" data-tabs="tabs">
		<li class="nav-item">
		<a class="nav-link active" href="#nu_subcata" data-toggle="tab" id="size_update" onclick="show_cat(this.id);">
		<i class="material-icons">add</i> New / Update Size
		<div class="ripple-container"></div>
		</a>
		</li>
		<li class="nav-item">
		<a class="nav-link" href="#sub_cat_list" data-toggle="tab" id="sub_cat_list_show" onclick="show_cat(this.id);">
		<i class="material-icons">toc</i> Sub Catagory List
		<div class="ripple-container"></div>
		</a>
		</li>		
		</ul>
		</div>
		</div>
		</div>
		
		<div class="card-body">
		<div class="tab-content">
		<div class="tab-pane active" id="nu_subcata">
			<form>
		<div class="form-row">
			
					<input type="hidden" id="sub_cat_id" name="sub_cat_id" value="0">
					<div class="form-group col-md-6 is-focused bmd-form-group">
						<label class="bmd-label-floating">Enter Sub Catagory Name</label>
						<input type="text" class="form-control" id="sub_cat_name" required="true" name="sub_cat_name">
					</div>
					<div class="form-group col-md-6 bmd-form-group is-focused">
						<select class="form-control select2-hidden-accessible" data-style="btn btn-link" id="sel_cat" name="sel_cat"   tabindex="-1" aria-hidden="true">
						<option value="" selected="" disabled="" >Select Catagory</option>
                		</select>
				</div>
			</div>
				<div class="card-footer ml-auto mr-auto justify-content-center">
				<button type="button" class="btn btn-rose" id="sub_cat_btn" name="sub_cat_btn" onclick="sub_cat_add();">Add</button>
				</div>				
			</form>			
		</div>
		<div class="tab-pane" id="sub_cat_list">
			<table class="table">
				<thead>
				<tr>
				<th class="text-center">SL</th>
				<th class="text-center" style="display:none;">Id</th>
				<th>Sub Catagory Name</th>
				<th>Catagory Name</th>		
				<th class="text-right">Actions</th>
				</tr>
				</thead>
				<tbody id="sub_cat_list_tbl">	
				     
			
				</tbody>
		</table>
		</div>		
		</div>
		</div>
</div>
</div>

<!-- ----------------------------------------- -->
<div class="tab-pane" id="prd-subcategory">
	<div class="card" style="margin-top: 1.3rem;">
		<div class="card-header card-header-tabs card-header-rose">
		<div class="nav-tabs-navigation">
		<div class="nav-tabs-wrapper">
		<span class="nav-tabs-title">Item:</span>
		<ul class="nav nav-tabs" data-tabs="tabs">
		<li class="nav-item">
		<a class="nav-link active" href="#nu_item" data-toggle="tab" id="Sub_category_update">
		<i class="material-icons">add</i> New / Update Item
		<div class="ripple-container"></div>
		</a>
		</li>
		<li class="nav-item">
		<a class="nav-link" href="#item_list" data-toggle="tab" onclick="load_item_list();">
		<i class="material-icons">toc</i> Product Item List
		<div class="ripple-container"></div>
		</a>
		</li>		
		</ul>
		</div>
		</div>
		</div>
		
		<div class="card-body">
		<div class="tab-content">
		<div class="tab-pane active" id="nu_item">
			<form >
				<div class="form-row">
				    <div class="form-group col-md-4 bmd-form-group is-focused">
                        <label for="product_subcategory" class="bmd-label-floating">Enter Item Name</label>
                        <input type="text" class="form-control" id="item_Name" required="true" name="item_Name">
					</div>	
                    <div class="form-group col-md-4 bmd-form-group is-focused">
						<label for="select_pcategory" class="bmd-label-floating">Select Brand</label>
						<select class="form-control select2-hidden-accessible" data-style="btn btn-link" id="item_brand_id" name="item_brand_id" tabindex="-1" aria-hidden="true">
						<option value="" selected="" disabled="" >Select Brand</option>     
						
					</select>
						
					</div>
					
                    <div class="form-group col-md-4 bmd-form-group is-focused">
						<label for="select_pcategory" class="bmd-label-floating">Select Category</label>
						<select class="form-control select2-hidden-accessible" data-style="btn btn-link" id="item_cat" name="item_cat" tabindex="-1" aria-hidden="true" onchange="load_item_sub_cat();">
						<option value="" selected="" disabled="" >Select Category</option>   
						<option value="1">Tiles</option><option value="2">Sanitary</option>	
					</select>
					</div>
					<div class="form-group col-md-4 bmd-form-group is-focused">
						<label for="select_pcategory" class="bmd-label-floating">Select Sub-Catagory</label>
						<select class="form-control select2-hidden-accessible" data-style="btn btn-link" id="item_sub_cat" name="item_sub_cat" tabindex="-1" aria-hidden="true">
						<option value="" selected="" disabled="" >Select Sub-Catagory</option>     
						
					</select>	
					</div>
					<div class="form-group col-md-2 bmd-form-group is-focused">
                        <label for="product_subcategory" class="bmd-label-floating">Enter HSN Code</label>
                        <input type="text" class="form-control" id="item_hsn" required="true" name="item_hsn">
					</div>	
				<div class="form-group col-md-2 bmd-form-group is-focused">
                        <label for="product_subcategory" class="bmd-label-floating">Enter CGST %</label>
                        <input type="text" class="form-control" id="item_cgst" required="true" name="item_cgst">
					</div>	
					<div class="form-group col-md-2 bmd-form-group is-focused">
                        <label for="product_subcategory" class="bmd-label-floating">Enter SGST %</label>
                        <input type="text" class="form-control" id="item_sgst" required="true" name="item_sgst">
					</div>
					<div class="form-group col-md-2 bmd-form-group is-focused">
                        <label for="product_subcategory" class="bmd-label-floating">Enter IGST %</label>
                        <input type="text" class="form-control" id="item_igst" required="true" name="item_igst">
					</div>

					<div class="form-group col-md-4 bmd-form-group is-focused">
                        <label for="product_subcategory" class="bmd-label-floating">Enter Name In Bill</label>
                        <input type="text" class="form-control" id="item_bill_name" maxlength="10" required="true" name="item_bill_name">
					</div>	
					<div class="form-group col-md-4 bmd-form-group is-focused">
						<label for="select_pcategory" class="bmd-label-floating">Purchase GL</label>
						<select class="form-control select2-hidden-accessible" data-style="btn btn-link" id="item_pur_gl" name="item_pur_gl" tabindex="-1" aria-hidden="true">
						<option value="" selected="" disabled="" >Select Purchase GL</option>     
						
					</select>	
					</div>
					<div class="form-group col-md-4 bmd-form-group is-focused">
						<label for="select_pcategory" class="bmd-label-floating">Sale GL</label>
						<select class="form-control select2-hidden-accessible" data-style="btn btn-link" id="item_sale_gl" name="item_sale_gl" tabindex="-1" aria-hidden="true">
						<option value="" selected="" disabled="" >Select Sale GL</option>     
						
					</select>	
					</div>
					<div class="form-group col-md-2 bmd-form-group is-focused">
                        <label for="product_subcategory" class="bmd-label-floating">Enter Base unit Value</label>
                        <input type="text" class="form-control" id="item_base_unit_val" required="true" name="item_base_unit_val">
					</div>	
					<div class="form-group col-md-2 bmd-form-group is-focused">
						<label for="select_pcategory" class="bmd-label-floating">Select Unit</label>
						<select class="form-control select2-hidden-accessible" data-style="btn btn-link" id="item_base_unit" name="item_base_unit" tabindex="-1" aria-hidden="true" onchange="load_unit(this.id);">
						<option value="" selected="" disabled="" >Select Base Unit</option>     
						
					</select>	
					</div>
					<div class="form-group col-md-2 bmd-form-group is-focused">
                        <label for="product_subcategory" class="bmd-label-floating">Enter Convertion#1 unit Value</label>
                        <input type="text" class="form-control" id="item_unit1_Val" required="true" name="item_unit1_Val">
					</div>	
					<div class="form-group col-md-2 bmd-form-group is-focused">
						<label for="select_pcategory" class="bmd-label-floating">Select Unit</label>
						<select class="form-control select2-hidden-accessible" data-style="btn btn-link" id="item_unit1" name="item_unit1" tabindex="-1" aria-hidden="true" onchange="load_unit(this.id);">
						<option value="" selected="" disabled="" >Select Unit 1</option>     
						
					</select>	
					</div>
					<div class="form-group col-md-2 bmd-form-group is-focused">
                        <label for="product_subcategory" class="bmd-label-floating">Enter Convertion#2 unit Value</label>
                        <input type="text" class="form-control" id="item_unit2_val" required="true" name="item_unit2_val">
					</div>	
					<div class="form-group col-md-2 bmd-form-group is-focused">
						<label for="select_pcategory" class="bmd-label-floating">Select Unit</label>
						<select class="form-control select2-hidden-accessible" data-style="btn btn-link" id="item_unit2" name="item_unit2" tabindex="-1" aria-hidden="true" onchange="load_unit(this.id);">
						<option value="" selected="" disabled="" >Select Unit 2</option>     
						
					</select>	
					</div>
					<div class="form-group col-md-2 bmd-form-group is-focused">
                        <label for="product_subcategory" class="bmd-label-floating">Enter Convertion#3 unit Value</label>
                        <input type="text" class="form-control" id="item_unit3_val" required="true" name="item_unit3_val">
					</div>	
					<div class="form-group col-md-2 bmd-form-group is-focused">
						<label for="select_pcategory" class="bmd-label-floating">Select Unit</label>
						<select class="form-control select2-hidden-accessible" data-style="btn btn-link" id="item_unit3" name="item_unit3" tabindex="-1" aria-hidden="true" onchange="load_unit(this.id);">
						<option value="" selected="" disabled="" >Select Unit 3</option>     
						
					</select>	
					</div>
					<div class="form-group col-md-2 bmd-form-group is-focused">
						<label for="select_pcategory" class="bmd-label-floating">Select Stock Unit</label>
						<select class="form-control select2-hidden-accessible" data-style="btn btn-link" id="item_stock_unit" name="item_stock_unit" tabindex="-1" aria-hidden="true">
						<option value="" selected="" disabled="" >Select Stock Unit</option>     
						
					</select>	
					</div>
				</div>
				
				
					
				<div class="card-footer ml-auto mr-auto justify-content-center">
				<button type="button" class="btn btn-rose" onclick="item_post();">Add</button>
				</div>				
			</form>			
		</div>
		<div class="tab-pane" id="item_list">
			<table class="table">
				<thead>
				<tr>
				<th class="text-center">SL</th>
				<th>Item Name</th>
				<th>Brand Name</th>	
                <th>Category</th>		
				<th >Name In Bill</th>
				</tr>
				</thead>
				<tbody id="prod_item_list">	
				     
			<tr>
				<td class="text-center">1</td>
				<td>SPARK WOOD</td>	
				<td>Kajaria</td>	
                <td>Tiles</td>
				<td>Tiles</td>
			</tr>		
						
				</tbody>
		</table>
		</div>		
		</div>
		</div>
</div>
</div>

<div class="tab-pane" id="prd-warehouse">
	<div class="card" style="margin-top: 1.3rem;">
		<div class="card-header card-header-tabs card-header-rose">
		<div class="nav-tabs-navigation">
		<div class="nav-tabs-wrapper">
		<span class="nav-tabs-title">Warehouse:</span>
		<ul class="nav nav-tabs" data-tabs="tabs">
		<li class="nav-item">
		<a class="nav-link active" href="#nu_warehouse" data-toggle="tab" id="warehouse_t" onclick="show_whare(this.id);">
		<i class="material-icons">add</i> New / Update Warehouse
		<div class="ripple-container"></div>
		</a>
		</li>
		<li class="nav-item">
		<a class="nav-link" href="#warehouse_list" data-toggle="tab" id="warehouse_l" onclick="show_whare(this.id);">
		<i class="material-icons">toc</i>Warehouse List
		<div class="ripple-container"></div>
		</a>
		</li>		
		</ul>
		</div>
		</div>
		</div>
		
		<div class="card-body">
		<div class="tab-content">
		<div class="tab-pane active" id="nu_warehouse">
			<form  action="" >
			<input type="hidden" id="ware_huse_id" name="ware_huse_id" value="0">
				<div class="form-group is-focused bmd-form-group">
				<label for="warehouse" class="bmd-label-floating">Enter Warehouse Name</label>
				<input type="text" class="form-control" id="warehouse_name" name="warehouse_name" required="true">
				</div>		
					
				<div class="card-footer ml-auto mr-auto justify-content-center">
				<button type="button" class="btn btn-rose" id="ware_house_btn" name="ware_house_btn" onclick="crt_whareh();">Add</button>
				</div>				
			</form>			
		</div>
		<div class="tab-pane" id="warehouse_list">
			<table class="table">
				<thead>
				<tr>
				<th style="display:none;">hidd_id</th>
				<th class="text-center">SL</th>
				<th>Warehouse Name</th>		
				<th class="text-right">Actions</th>
				</tr>
				</thead>
				<tbody id="warehouse_lst">	
				     
			
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
</div>
</div>
</div>
<?php
require_once('Include/footer.php');
?>
 <script src="../assets/js/master_add.js"></script>
<?php
}
else{
    header('location:../login');
}
?>