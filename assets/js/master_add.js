'use strict';
function show_unit(p){
    var type = p;
    if(p=='update_unit'){
        $("#nu_unit").show();
        $("#unit_list").hide();
        unit_type_load();
    }
    if(p=='list_unit'){
        $("#nu_unit").hide();
        $("#unit_list").show();
        load_unit_list();
    }
}
function show_brand(p){
    var type = p;
    if(p=='brand_update'){
        $("#nu_brand").show();
        $("#brand_list").hide();
    }
    if(p=='brand_list_tab'){
        $("#nu_brand").hide();
        $("#brand_list").show();
        load_brand();
    }
}
function show_cat(p){
    var type = p;
    if(p=='cat_update'){
        $("#nu_cat").show();
        $("#cat_list").hide();
    }
    if(p=='cat_list_tab'){
        $("#nu_cat").hide();
        $("#cat_list").show();
        cat_list_table();
    }
    if(p=='size_update'){
        $("#nu_subcata").show();
        $("#sub_cat_list").hide();
        load_catagory();
    }
    if(p=='sub_cat_list_show'){
        $("#nu_subcata").hide();
        $("#sub_cat_list").show();
        load_sub_cat();
    } 
}
$(window).on('load',function(){
    unit_type_load();
    load_catagory();
});
function unit_type_load(){
    $.ajax({
        type: "POST",
        url: "method/ajax.php",
        data: {pUnit_Type:0},
        success: function (response) {
            var type_Data = JSON.parse(response);
            $("#select_unt_typ").empty();
            $("#select_unt_typ").append('<option value="" selected="" disabled="" data-select2-id="2">Select Type</option>');
            type_Data.forEach(function(unit_type) {
                $("#select_unt_typ").append('<option value="'+ unit_type.Id +'">'+ unit_type.Type_Name +'</option>');
                
            });
           
        }
       }); 
}
function load_catagory(){
    $.ajax({
        type: "POST",
        url: "method/ajax.php",
        data: {pCat_drop_list:0},
        success: function (response) {
            // console.log(response);
            var type_Data = JSON.parse(response);
            $("#sel_cat").empty();
            $("#sel_cat").append('<option value="" selected="" disabled="">Select Catagory</option>');
            type_Data.forEach(function(unit_type) {
                $("#sel_cat").append('<option value="'+ unit_type.Id +'">'+ unit_type.Type_Name +'</option>');
                
            });
           
        }
       });    
}
function load_unit_list(){
    $.ajax({
        type: "POST",
        url: "method/ajax.php",
        data: {pLoad_unit_tbl:0},
        success: function (response) {
            $("#tbl_unit").empty();
            var un_list = JSON.parse(response);
            var sl=1;
            un_list.forEach(function(uni_list) {
                $("#tbl_unit").append('<tr><td style="display:none;">'+ uni_list.Id +'</td>'+
                '<td class="text-center">'+ sl++ +'</td>'+
                '<td>'+ uni_list.Unit_Name +'</td>'+
                '<td>'+ uni_list.Unit_Short_Name +'</td>'+
                '<td>'+ uni_list.Type_Name +'</td>'+
                '<td class="td-actions text-right" style="float: right;"><button type="button" class="btn btn-success btn-link" onclick="edit_unit(this);">'+
				'Edit<i class="material-icons edit_btn">edit</i>'+
				'</button></td>'+
                '</tr>')
            });
        }
    });
}
function edit_unit(p){
    var tr = $(p).closest('tr');
    var unit_id = tr.find('td:eq(0)').text();
    $.ajax({
        type: "POST",
        url: "method/ajax.php",
        data: {pUnit_id_pop:unit_id},
        success: function (response) {
            var edit_data = JSON.parse(response);
            edit_data.forEach(function(unit_edit) {
                $("#unit_id").val(unit_edit.Id);
                $("#unit_f_nm").val(unit_edit.Unit_Name);
                $("#unit_s_nm").val(unit_edit.Unit_Short_Name);
                
                $("#select_unt_typ").val(unit_edit.type_id);
                // $('#select_unt_typ').select2().trigger('change');
                $("#select_unt_typ").trigger('change');
                // $("#select_unt_typ").val(unit_edit.type_id).trigger('change.select2')

            });
            $("#nu_unit").show();
            $("#unit_list").hide();
            $("#unit_btn").text('Update');
        }
    });
}
function unit_form_clean(){
    $("#unit_id").val('0');
    $("#unit_f_nm").val('');
    $("#unit_s_nm").val('');
    $("#unit_btn").text('Add');
    unit_type_load();
}
function post_unit(){
    var unit_Id = $("#unit_id").val();
    var pUnit_Name = $("#unit_f_nm").val();
    var pUnit_short_Nam = $("#unit_s_nm").val();
    var pUnit_Type = $("#select_unt_typ").val();
    if(unit_Id==0){
        $("#unit_btn").text('Add');
        if(pUnit_Name==''){
            simple_alert('Warning','Please Enter Unit Name','warning');
        }
        else if(pUnit_short_Nam==''){
            simple_alert('Warning','Please Enter Unit Short Name','warning');
        }
        else if(pUnit_Type==null){
            simple_alert('Warning','Please Select Unit Type','warning');
        }
        else{
            $.ajax({
                type: "POST",
                url: "method/ajax.php",
                data: {pUnit_Name_add:pUnit_Name,pUnit_srt_add:pUnit_short_Nam,pUnit_typ_add:pUnit_Type,pInser_mode:1,pUnit_iser_Id:unit_Id},
                success: function (response) {
                    var add_adata = JSON.parse(response);
                    add_adata.forEach(function(unit_add) {
                        var err = unit_add.Error_No;
                        var msg = unit_add.Message;
                        if(err<0){
                            simple_alert('Error',msg,'error'); 
                        }
                        else{
                            simple_alert('Success',msg,'success');
                        }
                        
                    });
                    unit_form_clean();
                }
            });
        }
    }
    else{
        $("#unit_btn").text('Update');
        if(unit_Id==0){
            simple_alert('Warning','Unit Id Not Found','warning');
        }
        else if(pUnit_Name==''){
            simple_alert('Warning','Please Enter Unit Name','warning');
        }
        else if(pUnit_short_Nam==''){
            simple_alert('Warning','Please Enter Unit Short Name','warning');
        }
        else if(pUnit_Type==null){
            simple_alert('Warning','Please Select Unit Type','warning');
        }
        else{
            $.ajax({
                type: "POST",
                url: "method/ajax.php",
                data: {pEdit_unit_Id:unit_Id,pEdit_Unit_Name:pUnit_Name,pUnit_shor_name:pUnit_short_Nam,pUnit_Edit_Type:pUnit_Type,pUnit_edite_mode:2},
                success: function (response) {
                    var edit_data = JSON.parse(response);
                    edit_data.forEach(function(edit_d) {
                        var err = edit_d.Error_No;
                        var msg = edit_d.Message;
                        if(err<0){
                            simple_alert('Error',msg,'error'); 
                        }
                        else{
                            simple_alert('Success',msg,'success');
                        }
                    });
                    unit_form_clean();
                }
            });
        }
    }
}
function brand_form_clean(){
    $("#brand_Id").val('0');
    $("#brand_Name").val('');
    $("#brand_btn").text('Add');
}
function load_brand(){
    $.ajax({
        type: "POST",
        url: "method/ajax.php",
        data: {pLoad_brand:0},
        success: function (response) {
            var load_brand = JSON.parse(response);
            var sl=1;
            $("#brand_table").empty();
            load_brand.forEach(function(tbl_brand) {
                $("#brand_table").append('<tr><td style="display: none;">'+ tbl_brand.Id +'</td>'+
				'<td class="text-center">'+ sl++ +'</td>'+
				'<td>'+ tbl_brand.Brand_name +'</td>'+		
				'<td class="td-actions text-right" style="float: right;">'+		
				'<button type="button" class="btn btn-success btn-link" onclick="edit_brand(this);">'+
				'Edit<i class="material-icons edit_btn">edit</i>'+
				'</button></td></tr>');
            });
        }
    });
}
function edit_brand(p){
    var row = $(p).closest('tr');
    var br_id = $(row).find('td:eq(0)').text();
    $.ajax({
        type: "POST",
        url: "method/ajax.php",
        data: {pEdit_brand_data:br_id},
        success: function (response) {
            var edit_data = JSON.parse(response);
            edit_data.forEach(function(edd_data) {
                $("#brand_Id").val(edd_data.Id);
                $("#brand_Name").val(edd_data.Brand_name);
                $("#brand_btn").text('Update');
                $("#nu_brand").show();
                $("#brand_list").hide();
            });
        }
    });
}
function post_brand(){
    var brand_id = $("#brand_Id").val();
    var brand_Name = $("#brand_Name").val();
    if(brand_id==0){
        $("#brand_btn").text('Add');
        if(brand_Name==''){
            simple_alert('Warning','Please Enter Brand Name','warning');   
        }
        else{
            $.ajax({
                type: "POST",
                url: "method/ajax.php",
                data: {pAdd_Brand_Id:brand_id,pBrand_Add_Name:brand_Name,pBrand_Add_Mode:1},
                success: function (response) {
                    var brand_Data = JSON.parse(response);
                    brand_Data.forEach(function(brand_msg) {
                        var err = brand_msg.Error_No;
                        var msg = brand_msg.Message;
                        if(err<0){
                            simple_alert('Error',msg,'error');  
                        }
                        else{
                            simple_alert('Success',msg,'success'); 
                        }
                    });
                    brand_form_clean();
                }
            });
        }
    }
    else{
        $("#brand_btn").text('Update');
        if(brand_Name==''){
            simple_alert('Warning','Please Enter Brand Name','warning');   
        }
        else{
            $.ajax({
                type: "POST",
                url: "method/ajax.php",
                data: {pAdd_Brand_Id:brand_id,pBrand_Add_Name:brand_Name,pBrand_Add_Mode:2},
                success: function (response) {
                    var brand_Data = JSON.parse(response);
                    brand_Data.forEach(function(brand_msg) {
                        var err = brand_msg.Error_No;
                        var msg = brand_msg.Message;
                        if(err<0){
                            simple_alert('Error',msg,'error');  
                        }
                        else{
                            simple_alert('Success',msg,'success'); 
                        }
                    });
                    brand_form_clean();
                }
            });
        }
    }
}
function cat_form_clean(){
    $("#cat_id").val('0');
    $("#cat_name").val('');
    $("#cat_btn").text('Add');
}
function add_cat(){
    var cat_id = $("#cat_id").val();
    var cat_name = $("#cat_name").val();
    if(cat_id==0){
        $("#cat_btn").text('Add');
        if(cat_name==''){
            simple_alert('Warning','Please Enter Catagory Name','warning');
        }
        else{
            $.ajax({
                type: "POST",
                url: "method/ajax.php",
                data: {pCat_Id:cat_id,pCat_Name:cat_name,pCat_Mode:1},
                success: function (response) {
                    var cat_add = JSON.parse(response);
                    cat_add.forEach(function(cat_data) {
                        var err = cat_data.Error_No;
                        var msg = cat_data.Message;

                        if(err<0){
                            simple_alert('Error',msg,'error');  
                        }
                        else{
                            simple_alert('Success',msg,'success'); 
                        }
                    });
                    cat_form_clean();
                }
            });
        }
    }
    else{
        $("#cat_btn").text('Update');
        if(cat_name==''){
            simple_alert('Warning','Please Enter Catagory Name','warning');
        }
        else{
            $.ajax({
                type: "POST",
                url: "method/ajax.php",
                data: {pCat_Id:cat_id,pCat_Name:cat_name,pCat_Mode:2},
                success: function (response) {
                    var cat_add = JSON.parse(response);
                    cat_add.forEach(function(cat_data) {
                        var err = cat_data.Error_No;
                        var msg = cat_data.Message;

                        if(err<0){
                            simple_alert('Error',msg,'error');  
                        }
                        else{
                            simple_alert('Success',msg,'success'); 
                        }
                    });
                    cat_form_clean();
                }
            });
        }
    }
}
function cat_list_table(){
    $.ajax({
        type: "POST",
        url: "method/ajax.php",
        data: {pCatTbl_list:0},
        success: function (response) {
           var cat_tbl = JSON.parse(response);
           var sl=1;
           $("#cat_table").empty();
           cat_tbl.forEach(function(tbl_data) {
            $("#cat_table").append('<tr>'+
            '<td style="display: none;">'+ tbl_data.Id +'</td>'+
            '<td class="text-center">'+ sl++ +'</td>'+
            '<td>'+ tbl_data.Type_Name +'</td>'+		
            '<td class="td-actions text-right" style="float: right;">'+		
            '<button type="button" class="btn btn-success btn-link" onclick="edit_cat_data(this);">'+
            'Edit<i class="material-icons edit_btn">edit</i>'+
            '</button>'+
            '</td></tr>');
           }); 
        }
    });
}
function edit_cat_data(p){
    var row = $(p).closest('tr');
    var cat_id = $(row).find('td:eq(0)').text(); 
    $.ajax({
        type: "POST",
        url: "method/ajax.php",
        data: {pEdit_cat_Id:cat_id},
        success: function (response) {
            var edit_cat = JSON.parse(response);
            edit_cat.forEach(function(cat_edit) {
               $("#cat_id").val(cat_edit.Id);
               $("#cat_name").val(cat_edit.Type_Name);
               $("#cat_btn").text('Update');
               $("#nu_cat").show();
               $("#cat_list").hide();

            });
        }
    });
}
function sub_cat_add(){
    var sub_cat_Id = $("#sub_cat_id").val();
    var sub_cat_name = $("#sub_cat_name").val();
    var cat_id = $("#sel_cat").val();
    if(sub_cat_Id==0){
        $("#sub_cat_btn").text('Add');
        if(sub_cat_name==''){
            simple_alert('Warning','Please Enter Sub Catagory Name','warning');
        }
        else if(cat_id==null){
            simple_alert('Warning','Please Select Catagory','warning');
        }
        else{
            $.ajax({
                type: "POST",
                url: "method/ajax.php",
                data: {pAdd_sub_cat_id:sub_cat_Id,pAdd_sub_Cat_Name:sub_cat_name,pAdd_sub_catg:cat_id,pAdd_Sub_Cat_Mode:1},
                success: function (response) {
                    var sub_cat = JSON.parse(response);
                    sub_cat.forEach(function(sub_add) {
                        var error = sub_add.Error_No;
                        var err_msg = sub_add.Message;
                        if(error<0){
                            simple_alert('Error',err_msg,'error');
                            sub_cat_form_clead();
                        }
                        else{
                            simple_alert('Success',err_msg,'success');
                            sub_cat_form_clead();
                        }
                    });
                }
            });
        }
    }
    else{
        $("#sub_cat_btn").text('Update');
        $.ajax({
            type: "POST",
            url: "method/ajax.php",
            data: {pAdd_sub_cat_id:sub_cat_Id,pAdd_sub_Cat_Name:sub_cat_name,pAdd_sub_catg:cat_id,pAdd_Sub_Cat_Mode:2},
            success: function (response) {
                var sub_cat = JSON.parse(response);
                sub_cat.forEach(function(sub_add) {
                    var error = sub_add.Error_No;
                    var err_msg = sub_add.Message;
                    if(error<0){
                        simple_alert('Error',err_msg,'error');
                        sub_cat_form_clead();
                    }
                    else{
                        simple_alert('Success',err_msg,'success');
                        sub_cat_form_clead();
                    }
                });
            }
        });
    }
}

function load_sub_cat(){
    $.ajax({
        type: "POST",
        url: "method/ajax.php",
        data: {pSub_Cat_fetch:0},
        success: function (response) {
           $("#sub_cat_list_tbl").empty();
           var tbl_data = JSON.parse(response);
           var sl=1;
           tbl_data.forEach(function(tbl_sub_cat) {
            $("#sub_cat_list_tbl").append('<tr>'+
            '<td style="display: none;">'+ tbl_sub_cat.Id +'</td>'+
            '<td class="text-center">'+ sl++ +'</td>'+
            '<td>'+ tbl_sub_cat.sub_Cat_Name +'</td>'+	
            '<td>'+ tbl_sub_cat.Type_Name +'</td>'+		
            '<td class="td-actions text-right" style="float: right;">'+		
            '<button type="button" class="btn btn-success btn-link" onclick="edit_sub_cat(this);">'+
            'Edit<i class="material-icons edit_btn">edit</i>'+
            '</button></td></tr>');
           }); 
        }
    });
}
function edit_sub_cat(p){
    var row = $(p).closest('tr');
    var cat_id = $(row).find('td:eq(0)').text(); 
    $.ajax({
        type: "POST",
        url: "method/ajax.php",
        data: {pEdit_sub_cat_Id:cat_id},
        success: function (response) {
            var edit_cat = JSON.parse(response);
            edit_cat.forEach(function(cat_edit) {
               $("#sub_cat_id").val(cat_edit.Id);
               $("#sub_cat_name").val(cat_edit.sub_Cat_Name);
               $("#sel_cat").val(cat_edit.Type_Id);
               $("#sel_cat").trigger('change');
               $("#sub_cat_btn").text('Update');
               $("#nu_subcata").show();
                $("#sub_cat_list").hide();

            });
        }
    });
}
function sub_cat_form_clead(){
    $("#sub_cat_id").val('0');
    $("#sub_cat_name").val('');
    $("#sub_cat_btn").text('Add');
    load_catagory();
}

function show_whare(p){
    if(p=='warehouse_t'){
        $("#nu_warehouse").show();
        $("#warehouse_list").hide();
    }
    if(p=='warehouse_l'){
        $("#nu_warehouse").hide();
        $("#warehouse_list").show();
        lish_whare();
    }
}

function whr_frm_clean(){
    $("#ware_huse_id").val('0');
    $("#warehouse_name").val('');
}

function crt_whareh(){
    var whar_id = $("#ware_huse_id").val();
    var whar_name = $("#warehouse_name").val();

    if(whar_id==0){
        $("#ware_house_btn").text('Add');
        if(whar_name==''){
            simple_alert('Warning','Please Enter Wharehouse Name','warning');
        }
        else{
            $.ajax({
                type: "POST",
                url: "method/ajax.php",
                data: {pWhare_Id:whar_id,pWhhare_Name:whar_name,pWhare_Mode:1},
                success: function (response) {
                    var data = JSON.parse(response);
                    data.forEach(function(whar_data) {
                       var err =  whar_data.ErrorNo;
                       var msg = whar_data.Message;
                       if(err<0){
                        simple_alert('Error',msg,'error');
                        whr_frm_clean();
                       }
                       else{
                        simple_alert('success',msg,'success');
                        whr_frm_clean();
                       }
                    });
                }
            });
        }
    }
    else{
        $.ajax({
            type: "POST",
            url: "method/ajax.php",
            data: {pWhare_Id:whar_id,pWhhare_Name:whar_name,pWhare_Mode:2},
            success: function (response) {
                var data = JSON.parse(response);
                data.forEach(function(whar_data) {
                   var err =  whar_data.ErrorNo;
                   var msg = whar_data.Message;
                   if(err<0){
                    simple_alert('Error',msg,'error');
                    whr_frm_clean();
                   }
                   else{
                    simple_alert('success',msg,'success');
                    whr_frm_clean();
                   }
                });
            }
        }); 
    }
}
function lish_whare(){
    $.ajax({
        type: "POST",
        url: "method/ajax.php",
        data: {pWhare_list:0},
        success: function (response) {
            var sl =1;
           var data = JSON.parse(response);
           $("#warehouse_lst").empty();
           data.forEach(function(list_whare) {
            $("#warehouse_lst").append('<tr>'+
            '<td style="display: none;">'+  list_whare.Id +'</td>'+
            '<td class="text-center">'+ sl++ +'</td>'+
            '<td>'+ list_whare.wharehouse_Name +'</td>'+
            '<td class="td-actions text-right" style="float: right;">'+		
            '<button type="button" class="btn btn-success btn-link" onclick="edit_whare(this);">'+
            'Edit<i class="material-icons edit_btn">edit</i>'+
            '</button>'+
            '</td></tr>');
           }); 
        }
    });
}
function edit_whare(p){
    var row = $(p).closest('tr');
    var cat_id = $(row).find('td:eq(0)').text(); 
    $.ajax({
        type: "POST",
        url: "method/ajax.php",
        data: {pEdit_whare_house:cat_id},
        success: function (response) {
            var edit_cat = JSON.parse(response);
            edit_cat.forEach(function(cat_edit) {
               $("#ware_huse_id").val(cat_edit.Id);
               $("#warehouse_name").val(cat_edit.wharehouse_Name);
               $("#ware_house_btn").text('Update');
               $("#warehouse_list").hide();
               $("#nu_warehouse").show();

            });
        }
    });
}
function load_Item_brand(){
    $.ajax({
        type: "POST",
        url: "method/ajax.php",
        data: {pLoad_brand:0},
        success: function (response) {
            var load_brand = JSON.parse(response);
            $("#item_brand_id").empty();
            $("#item_brand_id").append('<option value="" selected="" disabled="" >Select Brand</option>');
            load_brand.forEach(function(tbl_brand) {
                $("#item_brand_id").append('<option value="'+ tbl_brand.Id +'" >'+ tbl_brand.Brand_name +'</option>');
            });
        }
    });
}
function load_Item_catagory(){
    $.ajax({
        type: "POST",
        url: "method/ajax.php",
        data: {pCat_drop_list:0},
        success: function (response) {
            // console.log(response);
            var type_Data = JSON.parse(response);
            $("#item_cat").empty();
            $("#item_cat").append('<option value="" selected="" disabled="">Select Catagory</option>');
            type_Data.forEach(function(unit_type) {
                $("#item_cat").append('<option value="'+ unit_type.Id +'">'+ unit_type.Type_Name +'</option>');
                
            });
           
        }
       });    
}
function load_item_unit_list(p){
    if(p=='base'){
        $.ajax({
            type: "POST",
            url: "method/ajax.php",
            data: {pLoad_unit_tbl:0},
            success: function (response) {
                $("#item_base_unit").empty();
                $("#item_base_unit").append('<option value="" selected="" disabled="" >Select Base Unit</option>');
                var un_list = JSON.parse(response);
                var sl=1;
                un_list.forEach(function(uni_list) {
                    $("#item_base_unit").append('<option value="'+ uni_list.Id +'" >'+ uni_list.Unit_Name +'</option>');
                   
                });
            }
        });
    }
    if(p=='unit1'){
        $.ajax({
            type: "POST",
            url: "method/ajax.php",
            async: false,
            data: {pLoad_unit_tbl:0},
            success: function (response) {
                $("#item_unit1").empty();
                $("#item_unit1").append('<option value="" selected="" disabled="" >Select Unit 1</option>');
                var un_list = JSON.parse(response);
                var sl=1;
                un_list.forEach(function(uni_list) {
                    $("#item_unit1").append('<option value="'+ uni_list.Id +'" >'+ uni_list.Unit_Name +'</option>');
                });
            }
        });
    }
    if(p=='unit2'){
        $.ajax({
            type: "POST",
            url: "method/ajax.php",
            async: false,
            data: {pLoad_unit_tbl:0},
            success: function (response) {
                $("#item_unit2").empty();
                $("#item_unit2").append('<option value="" selected="" disabled="" >Select Unit 2</option>');
                var un_list = JSON.parse(response);
                var sl=1;
                un_list.forEach(function(uni_list) {
                    $("#item_unit2").append('<option value="'+ uni_list.Id +'" >'+ uni_list.Unit_Name +'</option>');
                    
                });
            }
        });
    }
    if(p=='unit3'){
        $.ajax({
            type: "POST",
            url: "method/ajax.php",
            async: false,
            data: {pLoad_unit_tbl:0},
            success: function (response) {
                $("#item_unit3").empty();
                $("#item_unit3").append('<option value="" selected="" disabled="" >Select Unit 3</option>');
                var un_list = JSON.parse(response);
                var sl=1;
                un_list.forEach(function(uni_list) {
                    $("#item_unit3").append('<option value="'+ uni_list.Id +'" >'+ uni_list.Unit_Name +'</option>');
                    
                });
            }
        });
    }
}
function load_item_drop(){
    load_Item_brand();
    load_Item_catagory();
    load_item_unit_list('base');
    load_item_unit_list('unit1');
    load_item_unit_list('unit2');
    load_item_unit_list('unit3');
    load_pur_gl();
    load_sale_gl();
}
function load_pur_gl(){
    $("#item_pur_gl").empty();
    $.ajax({
        type: "POST",
        url: "method/ajax.php",
        data: {pItem_Pur_Gl_drp:0},
        success: function (response) {
           var data = JSON.parse(response);
           $("#item_pur_gl").append('<option value="" selected="" disabled="" >Select Purchase GL</option>');
           data.forEach(function(item_pur_gl) {
           $("#item_pur_gl").append('<option value="'+ item_pur_gl.Account_Id +'">'+ item_pur_gl.gl_Name +'</option>');
           }); 
        }
    });
}
function load_sale_gl(){
    $("#item_sale_gl").empty();
    $.ajax({
        type: "POST",
        url: "method/ajax.php",
        data: {pItem_sale_Gl_drp:0},
        success: function (response) {
            // console.log(response);
           var data = JSON.parse(response);
           $("#item_sale_gl").append('<option value="" selected="" disabled="" >Select Purchase GL</option>');
           data.forEach(function(item_pur_gl) {
           $("#item_sale_gl").append('<option value="'+ item_pur_gl.Account_Id +'">'+ item_pur_gl.gl_Name +'</option>');
           }); 
        }
    });
}
function item_post(){
    var item_Name = $("#item_Name").val();
    var item_brand = $("#item_brand_id").val();
    var item_cat = $("#item_cat").val();
    var item_sub_cat = $("#item_sub_cat").val();
    var item_hsn = $("#item_hsn").val();
    var item_cgst = $("#item_cgst").val();
    var item_sgst = $("#item_sgst").val();
    var item_igst = $("#item_igst").val();
    var item_bill_Name = $("#item_bill_name").val();
    var item_pur_gl = $("#item_pur_gl").val();
    var item_sale_gl = $("#item_sale_gl").val();
    var item_base_val = $("#item_base_unit_val").val();
    var item_base_unit = $("#item_base_unit").val();
    var item_unit1 = $("#item_unit1_Val").val();
    var item_unit1_id = $("#item_unit1").val();
    var item_unit2 = $("#item_unit2_val").val();
    var item_unit2_id = $("#item_unit2").val();
    var item_unit3 = $("#item_unit3_val").val();
    var item_unit3_id = $("#item_unit3").val();
    var item_stock_unit = $("#item_stock_unit").val();

    if(item_Name==''){
        simple_alert('Warning','Please Enter Item Name','warning'); 
    }
    else if (item_brand==null){
        simple_alert('Warning','Please Select Item Brand','warning'); 
    }
    else if (item_cat==null){
        simple_alert('Warning','Please Select Item Catagory','warning'); 
    }
    else if(item_sub_cat==null){
        simple_alert('Warning','Please Select Item Sub Catagory','warning');
    }
    else if(item_hsn==''){
        simple_alert('Warning','Please Enter HSN Code','warning');
    }
    else if(item_cgst==''){
        simple_alert('Warning','Please Enter CGST Rate','warning');
    }
    else if (item_sgst==''){
        simple_alert('Warning','Please Enter SGST Rate','warning');
    }
    else if(item_igst==''){
        simple_alert('Warning','Please Enter IGST Rate','warning');
    }
    else if(item_bill_Name==''){
        simple_alert('Warning','Please Enter Item Bill Name','warning');
    }
    else if(item_pur_gl==null){
        simple_alert('Warning','Please Select Purchase GL','warning');
    }
    else if(item_sale_gl==null){
        simple_alert('Warning','Please Select Sale GL','warning');
    }
    else if(item_base_val==''){
        simple_alert('Warning','Please Enter Item Base Unit Value','warning');
    }
    else if(item_base_unit==null){
        simple_alert('Warning','Please Select Base Unit','warning');
    }
    else if(item_unit1==''){
        simple_alert('Warning','Please Enter Item Unit-1 Value','warning');
    }
    else if(item_unit1_id==null){
        simple_alert('Warning','Please Select Unit-1','warning');
    }
    else if(item_unit2==''){
        simple_alert('Warning','Please Enter Item Base Unit-2 Value','warning');
    }
    else if(item_unit2_id==null){
        simple_alert('Warning','Please Select Unit-2','warning');
    }
    else if(item_unit3==''){
        simple_alert('Warning','Please Enter Item Base Unit-3 Value','warning');
    }
    else if(item_unit3_id==null){
        simple_alert('Warning','Please Select Unit-3','warning');
    }
    else if(item_stock_unit==null){
        simple_alert('Warning','Please Select Stock Unit','warning');
    }
    else{
        $.ajax({
            type: "POST",
            url: "method/ajax.php",
            data: {pItem_Name:item_Name,pItem_Brand:item_brand,pItem_cat:item_cat,pItem_Sub_Cat:item_sub_cat,pItem_Hsn:item_hsn,pItem_cgst:item_cgst,pItem_Sgst:item_sgst,pItem_Igst:item_igst,pItem_BillName:item_bill_Name,pItem_Pur_Gl:item_pur_gl,pItem_Sale_Gl:item_sale_gl,pItem_Base_Val:item_base_val,pItem_Base_Unit:item_base_unit,pItem_Unit1_Val:item_unit1,pItem_Unit1:item_unit1_id,pItem_Unit2_val:item_unit2,pItem_Unit2:item_unit2_id,pItem_Unit3_Val:item_unit3,pItem_Unit3:item_unit3_id,pItem_Stock_Unit:item_stock_unit},
            success: function (response) {
                // console.log(response);
               var insert_data = JSON.parse(response);
               insert_data.forEach(function(item_insert) {
                var err_no = item_insert.ErrorNo;
                var err_msg = item_insert.Message;
                if(err_no<0){
                    simple_alert('Error',err_msg,'error');
                    item_form_clean();
                }
                else{
                    simple_alert('Success',err_msg,'success');
                    item_form_clean();
                }
                
               }); 
            }
        });
    }
}

function load_item_sub_cat(){
    var item_cat_Id = $("#item_cat").val();
    $.ajax({
        type: "POST",
        url: "method/ajax.php",
        data: {pItem_Cat_Id:item_cat_Id},
        success: function (response) {
            $("#item_sub_cat").empty();
            $("#item_sub_cat").append('<option value="" selected="" disabled="" >Select Sub-Catagory</option>');
           var tbl_data = JSON.parse(response);
           tbl_data.forEach(function(tbl_sub_cat) {
            $("#item_sub_cat").append('<option value="'+ tbl_sub_cat.Id +'">'+ tbl_sub_cat.sub_Cat_Name  +'</option>');

           }); 
        }
    }); 
}
function load_unit(p){
    
    if(p=='item_base_unit'){
        load_item_unit_list('unit1');
        load_item_unit_list('unit2');
        load_item_unit_list('unit3');
        var base_unit = $("#item_base_unit").val();
        $("#item_unit1 option[value='"+ base_unit +"']").remove();
    }
    if(p=='item_unit1'){
        load_item_unit_list('unit2');
        load_item_unit_list('unit3');
        var base_unit = $("#item_base_unit").val();
        var unit1 = $("#item_unit1").val();
        $("#item_unit2 option[value='"+ unit1 +"']").remove();
        $("#item_unit2 option[value='"+ base_unit +"']").remove();
    }
    if(p=='item_unit2'){
        load_item_unit_list('unit3');
        var base_unit = $("#item_base_unit").val();
        var unit1 = $("#item_unit1").val();
        var unit2 = $("#item_unit2").val();
        $("#item_unit3 option[value='"+ unit2 +"']").remove();
        $("#item_unit3 option[value='"+ unit1 +"']").remove();
        $("#item_unit3 option[value='"+ base_unit +"']").remove();

    }
        var item_baseunit = $("#item_base_unit").val();
        var item_unit1 = $("#item_unit1").val();
        var item_unit2 = $("#item_unit2").val();
        var item_unit3 = $("#item_unit3").val();

        $("#item_stock_unit").empty();
        $("#item_stock_unit").append('<option value="" selected="" disabled="" >Select Stock Unit</option>');
        if(item_baseunit!=null){
            var base_unit_name = $("#item_base_unit option:selected").text();
            $("#item_stock_unit").append('<option value="'+ item_baseunit +'">'+ base_unit_name +'</option>'); 
        }
        if(item_unit1!=null){
            var unit1_name = $("#item_unit1 option:selected").text();
            $("#item_stock_unit").append('<option value="'+ item_unit1 +'">'+ unit1_name +'</option>');
        }
        if(item_unit2!=null){
            var unit2_name = $("#item_unit2 option:selected").text();
            $("#item_stock_unit").append('<option value="'+ item_unit2 +'">'+ unit2_name +'</option>');
        }
        if(item_unit3!=null){
            var unit3_name = $("#item_unit3 option:selected").text();
            $("#item_stock_unit").append('<option value="'+ item_unit3 +'">'+ unit3_name +'</option>');  
        }
        
}
$('#item_hsn , #item_base_unit_val , #item_unit1_Val , #item_unit2_val , #item_unit3_val').keypress(function (e) {    
    
    var charCode = (e.which) ? e.which : event.keyCode    

    if (String.fromCharCode(charCode).match(/[^0-9]/g))    

        return false;                        

});
$('#item_cgst , #item_sgst , #item_igst').keypress(function (e) {    
    
    var charCode = (e.which) ? e.which : event.keyCode    

    if (String.fromCharCode(charCode).match(/[^0-9.]/g))    

        return false;                        

});   
function item_form_clean(){
    $("#item_Name").val('');
    $("#item_hsn").val('');
    $("#item_cgst").val('');
    $("#item_sgst").val('');
    $("#item_igst").val('');
    $("#item_bill_name").val('');
    $("#item_base_unit_val").val('');
    $("#item_unit1_Val").val('');
    $("#item_unit2_val").val('');
    $("#item_unit3_val").val(''); 
    load_Item_brand();
    load_Item_catagory();
    load_item_unit_list('base');
    load_item_unit_list('unit1');
    load_item_unit_list('unit2');
    load_item_unit_list('unit3');
    load_pur_gl();
    load_sale_gl();
    $("#item_stock_unit").empty();
    $("#item_stock_unit").append('<option value="" selected="" disabled="" >Select Stock Unit</option>');

}
function load_item_list(){
    $.ajax({
        type: "POST",
        url: "method/ajax.php",
        data: {pItem_list_tab:0},
        success: function (response) {
            var adata = JSON.parse(response);
            $("#prod_item_list").empty();
            var sl=1;
            adata.forEach(function(item_table) {
                $("#prod_item_list").append('<tr>'+
				'<td class="text-center">'+ sl++ +'</td>'+
				'<td>'+ item_table.Item_Name +'</td>'+	
				'<td>'+ item_table.Brand_name +'</td>'+	
                '<td>'+ item_table.Type_Name +'</td>'+
				'<td>'+item_table.Item_Bill_Name  +'</td>'+
			'</tr>');
            });
        }
    });
}