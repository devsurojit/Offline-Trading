'use strict';
const elToggle  = document.querySelector("#Cash_Denom_btn");
const elContent = document.querySelector("#Cash_Denomination");

// elToggle.addEventListener("click", function() {
// elContent.classList.toggle("is-hidden");
// });
$(window).on('load',function(){
    sale_opt('mem_opt');
    load_whare();
    load_item();
    trans_mode('cash_opt');
    sale_no_load();
    allow_key_qnty("#Itm_Qny");

});

function sale_no_load(){
    $.ajax({
        type: "POST",
        url: "method/ajax.php",
        async:false,
        data: {pSales_ref_No:0},
        success: function (response) {
            // console.log(response);
            var data = JSON.parse(response);
            data.forEach(function(sales_no) {
                $("#ref_pur_No").val(sales_no.sales_no);
            });
        }
    });
}
function sale_opt(p){
    if(p=='mem_opt'){
        fetch_mem();
        $("#party_div").removeAttr('style');
        $("#mem_drop_lbl").text('Select Member');
        $("#mem_name").attr('readonly',true);
        $("#address").attr('readonly',true);
        $("#mem_mob").attr('readonly',true);
        $("#mem_name").val('');
        $("#address").val('');
        $("#mem_mob").val('');
        $("#gst_in_No").val(''); 
        $("#sb_opt").removeAttr('disabled');
        $("#credit_opt").attr('disabled',true);  
    }
    if(p=='party_opt'){
        fetch_party();
        $("#party_div").removeAttr('style');
        $("#mem_drop_lbl").text('Select Party');
        $("#mem_name").attr('readonly',true);
        $("#address").attr('readonly',true);
        $("#mem_mob").attr('readonly',true);
        $("#mem_name").val('');
        $("#address").val('');
        $("#mem_mob").val('');
        $("#gst_in_No").val('');
        $("#sb_opt").attr('disabled',true); 
        $("#credit_opt").removeAttr('disabled');  
    }
    if(p=='other_opt'){
        $("#party_div").attr('style','display:none');
        $("#mem_name").removeAttr('readonly',true);
        $("#address").removeAttr('readonly',true);
        $("#mem_mob").removeAttr('readonly',true);  
        $("#mem_name").val('');
        $("#address").val('');
        $("#mem_mob").val('');
        $("#gst_in_No").val('');
        $("#sb_opt").attr('disabled',true);
        $("#credit_opt").attr('disabled',true);
    }
}

function load_whare(){
    $("#whare_house").empty();
    $.ajax({
        type: "POST",
        url: "method/ajax.php",
        data: {pLoad_Whare_h:0},
        success: function (response) {
            var data = JSON.parse(response);
            $("#whare_house").append('<option value="" selected="" disabled="" >Select warehouse</option>');
            data.forEach(function(whare_data) {
                $("#whare_house").append('<option value="'+ whare_data.Id +'">'+ whare_data.wharehouse_Name +'</option>');  
            });
        }
    });
}
function load_item(){
    $.ajax({
        type: "POST",
        url: "method/ajax.php",
        async:false,
        data: {pLoad_Item:0},
        success: function (response) {
            var data = JSON.parse(response);
            $("#Item_Id").empty();
            $("#Item_Id").append('<option value="" selected="" disabled="" >Select Item</option>');
            data.forEach(function(load_item) {
                $("#Item_Id").append('<option value="'+ load_item.Id +'">'+ load_item.item_Name +'</option>');
            });
        }
    });
}
function load_item_unit(){
    var pItem_Id = $("#Item_Id").val();
    var ware_Id = $("#whare_house").val();
    var sale_Date = $("#purchase_Date").val();
    if(ware_Id==null){
        simple_alert('Warning','Please Select Warehouse First','warning');
        load_item();
    }
    else if(sale_Date==''){
        simple_alert('Warning','Please Select Sale Date First','warning');
        load_item();
    }
    else{
        $.ajax({
            type: "POST",
            url: "method/ajax.php",
            data: {pItem_Load_Unit:pItem_Id},
            success: function (response) {
                var data = JSON.parse(response);
                $("#Unit_Id").empty();
                $("#Unit_Id").append('<option value="" selected="" disabled="" >Select Unit</option>');
                data.forEach(function(load_unit) {
                    $("#Unit_Id").append('<option value="'+ load_unit.Id +'">'+ load_unit.Unit_Name +'</option>');
                });
                fetch_live_stock(pItem_Id,ware_Id,sale_Date);
            }
        });
    }
   
}
function allow_key_qnty(p){
    $(p).keypress(function (e) {
        var character = String.fromCharCode(e.keyCode)
        var newValue = this.value + character;
        if (isNaN(newValue) || hasDecimalPlace(newValue, 4)) {
            e.preventDefault();
            return false;
        }
    });
}
function hasDecimalPlace(value, x) {
    var pointIndex = value.indexOf('.');
    return  pointIndex >= 0 && pointIndex < value.length - x;
}
$('.decimal').keypress(function (e) {
    var character = String.fromCharCode(e.keyCode)
    var newValue = this.value + character;
    // console.log(character);
    if (isNaN(newValue) || hasDecimalPlace(newValue, 3)) {
        e.preventDefault();
        return false;
    }
    
});
function fetch_live_stock(p,p1,p2){
    $.ajax({
        type: "POST",
        url: "method/ajax.php",
        data: {pStock_Item:p,pItem_Wareh_Id:p1,pItem_Date:p2},
        success: function (response) {
            console.log(response);
            var data = JSON.parse(response);
            data.forEach(function(fetch_stock) {
                $("#curr_stock_lbl").empty();
                $("#curr_stock_lbl").text(fetch_stock.stock);
            });
        }
    });
}
function trans_mode(p){
    $("#"+p+"").attr('checked',true);
    if(p=='cash_opt'){
        $("#bank_div").attr('style','display:none;');
        $("#sb_div").attr('style','display:none;');
        $("#cash_div").removeAttr('style');
        $("#save_btn").removeAttr('disabled',true);
        $("#bank_Id").empty();
        $("#bank_Id").append('<option value="" selected="" disabled="" >Select Bank Account</option>');
        $("#sb_id").empty();
        $("#sb_id").append('<option value="" selected="" disabled="" >Select S/B Account</option>');
        // $("#Cash_Denomination").removeAttr('style','display:none;');
        $("#balance_lable").attr('style','display:none;');
    }
    if(p=='bank_opt'){
        fetch_bank_acct();
        $("#cash_div").attr('style','display:none');
        $("#sb_div").attr('style','display:none;');
        $("#save_btn").attr('disabled',true);
        $("#bank_div").removeAttr('style');
        $("#sb_id").empty();
        $("#sb_id").append('<option value="" selected="" disabled="" >Select S/B Account</option>');
        // $("#Cash_Denomination").attr('style','display:none;');
        $("#balance_lable").attr('style','display:none;');
    }
    if(p=='credit_opt'){
        $("#cash_div").attr('style','display:none');
        $("#bank_div").attr('style','display:none;');
        $("#sb_div").attr('style','display:none;');
        $("#save_btn").removeAttr('disabled',true);
        $("#bank_Id").empty();
        $("#bank_Id").append('<option value="" selected="" disabled="" >Select Bank Account</option>');
        $("#sb_id").empty();
        $("#sb_id").append('<option value="" selected="" disabled="" >Select S/B Account</option>');
        // $("#Cash_Denomination").attr('style','display:none;');
        $("#balance_lable").attr('style','display:none;');
    }
    if(p=='sb_opt'){
        fetch_sb_account();
        $("#cash_div").attr('style','display:none');
        $("#bank_div").attr('style','display:none;');
        $("#save_btn").attr('disabled',true);
        $("#bank_Id").empty();
        $("#bank_Id").append('<option value="" selected="" disabled="" >Select Bank Account</option>'); 
        $("#sb_div").removeAttr('style');
        // $("#Cash_Denomination").attr('style','display:none;');
        $("#balance_lable").attr('style','display:none;');
    }
}

function fetch_sb_account(){
    var mem_id = $("#Party_Idd").val();
    if(mem_id==null){
        simple_alert('Warning','Please Select Member First','warning');  
    }
    else{
        $.ajax({
            type: "POST",
            url: "method/ajax.php",
            data: {pFetch_mem_sbAcct:mem_id},
            success: function (response) {
                // console.log(response);
                var data = JSON.parse(response);
                $("#sb_id").empty();
                $("#sb_id").append('<option value="" selected="" disabled="" >Select S/B Account</option>');
                data.forEach(function(sb_darta) {
                    $("#sb_id").append('<option value="'+ sb_darta.Account_ID +'" >'+ sb_darta.Account_No +' - '+ sb_darta.Ref_AcNo +'</option>')
                });
            }
        });
    }
    
}
function check_bal(){
    var sb_Id = $("#sb_id").val();
    var sale_Date = $("#purchase_Date").val();
    var tot_Amount = $("#finaltotal").val();
    if(sb_Id==null){
        simple_alert('Warning','Please Select Account First','warning');  
    }
    else if(sale_Date==''){
        simple_alert('Warning','Please Select Sale Date','warning'); 
    }
    else if(tot_Amount==''||tot_Amount==0){
        simple_alert('Warning','Total Amount Cannot Be Zero','warning'); 
    }
    else{
        $.ajax({
            type: "POST",
            url: "method/ajax.php",
            data: {pMemsb_Id:sb_Id,pSale_Date:sale_Date},
            success: function (response) {
                var data = JSON.parse(response);
                $("#balance_lable").removeAttr('style','display:none;');
                // console.log(tot_Amount);
                data.forEach(function(get_bal) {
                    $("#sb_balance").text(Number(get_bal.Balance).toFixed(2));
                    $("#mem_bal").val(Number(get_bal.Balance).toFixed(2));
                    var sb_Bal = Number(get_bal.Balance).toFixed(2)
                    if((tot_Amount*1)<(sb_Bal*1)){
                        $("#save_btn").removeAttr('disabled',true);
                    }
                    else{
                        simple_alert('Warning','Not Sufficient Balance In Savings Account','warning');
                        $("#save_btn").attr('disabled',true);
                    }

                });
            }
        });
    }
}
function fetch_bank_acct(){
    $.ajax({
        type: "POST",
        url: "method/ajax.php",
        data: {pFetch_Bank_Acct:0},
        success: function (response) {
            var data = JSON.parse(response);
            $("#bank_Id").empty();
            $("#bank_Id").append('<option value="" selected="" disabled="" >Select Bank Account</option>');
            data.forEach(function(bank_data) {
                $("#bank_Id").append('<option value="'+ bank_data.BankLedgr_ID +'" >'+ bank_data.BankLedgr_Desc +'</option>')
            });
        }
    });
}
function fetch_mem(){
    $.ajax({
        type: "POST",
        url: "method/ajax.php",
        data: {pFetch_mem:0},
        success: function (response) {
           var data = JSON.parse(response);
           $("#Party_Idd").empty();
           $("#Party_Idd").append('<option value="" selected="" disabled="" >Select Member</option>');
           data.forEach(function(mem_data) {
           $("#Party_Idd").append('<option value="'+ mem_data.Member_ID +'" >'+ mem_data.Member_Code +' - '+ mem_data.Member_Name +' - '+ mem_data.Relation_Name+'</option>');
            
           }); 
        }
    });
}
function fetch_party(){
    $.ajax({
        type: "POST",
        url: "method/ajax.php",
        data: {pFetch_Party_sale:0},
        success: function (response) {
           var data = JSON.parse(response);
           $("#Party_Idd").empty();
           $("#Party_Idd").append('<option value="" selected="" disabled="" >Select Member</option>');
           data.forEach(function(mem_data) {
           $("#Party_Idd").append('<option value="'+ mem_data.Id +'" >'+ mem_data.Party_Name +'</option>');
            
           }); 
        }
    });
}
function fetch_part_dtls(p){
    if($("#mem_opt").prop('checked')==true){
        $.ajax({
            type: "POST",
            url: "method/ajax.php",
            data: {pFetch_cust_data:p},
            success: function (response) {
                var data = JSON.parse(response);
                data.forEach(function(fetch_mem) {
                    $("#mem_name").val(fetch_mem.Member_Name);
                    if(fetch_mem.Address==''){
                        $("#address").val(''); 
                        $("#address").removeAttr('readonly');
                    }
                    else{
                        $("#address").val(fetch_mem.Address);
                    }
                    $("#mem_mob").val(fetch_mem.Phone_No);
                    $("#gst_in_No").val('');
                });
            }
        });
    }
    else if($("#party_opt").prop('checked')==true){
        $.ajax({
            type: "POST",
            url: "method/ajax.php",
            data: {pFetch_Party_Data:p},
            success: function (response) {
                var data = JSON.parse(response);
                data.forEach(function(fetch_mem) {
                    $("#mem_name").val(fetch_mem.Party_Name);
                    if(fetch_mem.Address==''){
                        $("#address").val(''); 
                        $("#address").removeAttr('readonly');
                    }
                    else{
                        $("#address").val(fetch_mem.Party_Address);
                    }
                    
                    $("#mem_mob").removeAttr('readonly');
                    $("#mem_mob").val(fetch_mem.Party_Mobile);
                    $("#gst_in_No").val(fetch_mem.Party_GSTIN);
                });
            }
        });
    }
    
}
function get_unit_val(p){
    var item_Id = $("#Item_Id").val();
    var ware_id = $("#whare_house").val();
    var sale_Date = $("#purchase_Date").val();
    
    if(ware_id==null){
        simple_alert('Warning','Please Select Warehouse First','warning');
    }
    else if(item_Id==null){
        simple_alert('Warning','Please Select Item','warning');  
    }
    else if(sale_Date==''){
        simple_alert('Warning','Please Select Sale Date','warning'); 
    }
    else{
        $.ajax({
            type: "POST",
            url: "method/ajax.php",
            async:false,
            data: {pCal_stock_Item:item_Id,pCalStock_ware:ware_id,pCalStock_unit:p,pItem_cal_Date:sale_Date},
            success: function (response) {
                // console.log(response);
                var data = JSON.parse(response);
                data.forEach(function(fetch_stock) {
                    $("#hidd_stock").val(fetch_stock.stock);
                });
            }
        });

        $.ajax({
            type: "POST",
            url: "method/ajax.php",
            async:false,
            data: {pRate_Item_Id:item_Id,pRate_Item_Unit:p},
            success: function (response) {
                var data = JSON.parse(response);
                data.forEach(function(item_rate) {
                    $("#hidd_rate").val(item_rate.rate);
                });
            }
        });
    }
}
function check_qnty(p){
    var iput_val = p;
    var aval_qnty = $("#hidd_stock").val();
    if((aval_qnty*1)>0){
    if((iput_val*1) <= (aval_qnty*1)){
        
    }
    else{
        
        $("#Itm_Qny").val(Number(aval_qnty).toFixed(3));
        return false;
    }
}
else{
    $("#Itm_Qny").val(Number(0).toFixed(3));
    return false;
}
   return false; 
}
function add_item(){
var item_Id = $("#Item_Id").val();
var item_Name = $("#Item_Id option:selected").text();
var unit_id = $("#Unit_Id").val();
var unit_name = $("#Unit_Id option:selected").text();
var party_Id = $("#Party_Idd").val();
var ware_Id = $("#whare_house").val();
var item_qnty = $("#Itm_Qny").val();
var org_qnty = $("#hidd_stock").val();

if(item_Id==null){
    simple_alert('Warning','Please Select Item','warning');  
}
else if(unit_id==null){
    simple_alert('Warning','Please Select Unit','warning');  
}
else if(ware_Id==null){
    simple_alert('Warning','Please Select Warehouse','warning');
}
else if(item_qnty=='' || item_qnty==0){
    simple_alert('Warning','Please Enter Quantity','warning');
}
else if(org_qnty==0){
    simple_alert('Warning','Current Stock is Nill','warning');
}
else{
    $.ajax({
        type: "POST",
        url: "method/ajax.php",
        data: {pSale_Item_Id:item_Id},
        success: function (response) {
            // console.log(response);
           var data = JSON.parse(response); 
           var rowCount = $('#pur_table_data tr').length;
        
           if(rowCount==0){
               $("#pur_table_data").empty();
           }
           data.forEach(function(sale_item) {
            $("#pur_table_data").append('<tr><td class="serial">'+ ((rowCount*1)+1) +'</td>'+
            '<td style="display:none;">'+ party_Id +'</td>'+
            '<td>'+ item_Name +'</td>'+
            '<td style="display:none;">'+ item_Id +'</td>'+
            '<td>'+ item_qnty +'</td>'+
            '<td>'+ unit_name +'</td>'+
            '<td style="display:none;">'+ unit_id +'</td>'+
            '<td><input type="text" class="nu" onkeyup="cal_amt_pur(this);" value="'+ Number($("#hidd_rate").val()).toFixed(2) +'" onkeypress="keyallow(this,event);"></td>'+
            '<td>0.00</td>'+
            '<td style="display:none;">'+ sale_item.Item_Sgst +'</td>'+
            '<td>0.00</td>'+
            '<td style="display:none;">'+ sale_item.Item_cgst +'</td>'+
            '<td>0.00</td>'+
            '<td style="display:none;">'+ sale_item.item_Igst +'</td>'+
            '<td>0.00</td>'+
            '<td style="display:none;">0.00</td>'+
            '<td style="display:none;">'+ ware_Id +'</td>'+
            '<td style="display:none;">'+ sale_item.Item_Sal_Gl +'</td>'+
            '<td> <button type="button" class="btn btn-danger myclass" id="Action" style="padding-top: 8px;padding-bottom: 8px;"name="Action" onclick="revove_row(this);"><i class="fa fa-trash" aria-hidden="true"></i> delete</button></td>'+
            '<td style="display:none;">0.00</td>'+
            '</tr>');
           });
           load_item();
           $('#pur_table_data tr').each(function () {
            var item = $(this); //this should represent one row
           var  tbl_item = (item.find('td:eq(3)').text());
            $("#Item_Id option[value='"+ tbl_item +"']").remove();
            });
           $("#Itm_Qny").val('');
           $("#hidd_stock").val(0);
           $("#curr_stock_lbl").empty();
           $("#Unit_Id").empty();
            $("#Unit_Id").append('<option value="" selected="" disabled="" >Select Unit</option>');
           cal_tot_amt();
        }
    });
}

}
function revove_row(p){
    var currentRow=$(p).closest("tr"); 
    currentRow.remove();
    load_item(); 
    $('#pur_table_data tr').each(function(index){
        $(this).find('.serial').html(index+1);
        var item = $(this); //this should represent one row
        var  tbl_item = (item.find('td:eq(3)').text());
        $("#Item_Id option[value='"+ tbl_item +"']").remove();
    });
    cal_tot_amt();
}
function allow_key(p){
    $(p).keypress(function (e) {    
    
        var charCode = (e.which) ? e.which : event.keyCode    
    
        if (String.fromCharCode(charCode).match(/[^0-9.]/g))    
    
            return false;                        
    
    });
}
function keyallow(p,ev){
    // console.log(hasDecimalPlace(p.value,3));
    // var charCode = (ev.which) ? ev.which : ev.keyCode;
    // if (charCode == 46) {
    //   //Check if the text already contains the . character
    //   if (p.value.indexOf('.') === -1) {
    //     return true;
    //   }
    //    else {
    //     return false;
    //   }
    // } else {
    //   if (charCode > 31 &&
    //     (charCode < 48 || charCode > 57) || hasDecimalPlace(p.value,2))
    //     return false;
    // }
    var character = String.fromCharCode(ev.keyCode)
    // console.log(character);
    var newValue = p.value + character;
    // console.log(character);
    if (isNaN(newValue) || hasDecimalPlace(newValue, 3)) {
        ev.preventDefault();
        return false;
    }
    return true;
    
}
function cal_amt_pur(p){
    // var rate = p.value;
    // var qnty = $(p).closest('tr').find('td:eq(4)').text();
    // var sgst_Rate = $(p).closest('tr').find('td:eq(9)').text();
    // var cgst_rate = $(p).closest('tr').find('td:eq(11)').text();
    // var igst_rate = $(p).closest('tr').find('td:eq(13)').text();
    // rate = ((rate*1)/((sgst_Rate*1)+(cgst_rate*1)+(igst_rate*1)+(100*1)));
    // rate = (rate*100);
    // var gross_amt = qnty*rate;
    // var sgst_amt = Number(parseFloat((gross_amt*(sgst_Rate/100)))).toFixed(2);
    // $(p).closest('tr').find('td:eq(8)').text(Number(sgst_amt).toFixed(2));
    // var cgst_amt = Number(parseFloat((gross_amt*(cgst_rate/100)))).toFixed(2);
    // $(p).closest('tr').find('td:eq(10)').text(Number(cgst_amt).toFixed(2));
   
    // var igst_amt = Number(parseFloat((gross_amt*(igst_rate/100)))).toFixed(2);
    // $(p).closest('tr').find('td:eq(12)').text(Number(igst_amt).toFixed(2));
    // var tot_amt = Number(parseFloat((gross_amt*1)+(sgst_amt*1)+(cgst_amt*1)+(igst_amt*1))).toFixed(2);
    // $(p).closest('tr').find('td:eq(14)').text(Number(tot_amt).toFixed(2));
    // $(p).closest('tr').find('td:eq(15)').text(Number(gross_amt).toFixed(2));
    cal_tot_amt();
}
function cal_tot_amt(){
    var tot_sgst=0;
    var tot_cgst = 0;
    var grd_tot_amt=0;
    var tot_igst = 0;
    $('#pur_table_data tr').each(function () {
        var item = $(this); //this should represent one row

        // new area
        var rate = item.find('td:eq(7) input').val();
        var qnty = item.find('td:eq(4)').text();
        var sgst_Rate = item.find('td:eq(9)').text();
        var cgst_rate = item.find('td:eq(11)').text();
        var igst_rate = item.find('td:eq(13)').text();
        rate = ((rate*1)/((sgst_Rate*1)+(cgst_rate*1)+(igst_rate*1)+(100*1)));
        rate = (rate*100);
        item.find('td:eq(19)').text(Number(parseFloat(rate)).toFixed(2));
        var gross_amt = qnty*rate;
        var sgst_amt = Number(parseFloat((gross_amt*(sgst_Rate/100)))).toFixed(2);
        item.find('td:eq(8)').text(Number(sgst_amt).toFixed(2));
        var cgst_amt = Number(parseFloat((gross_amt*(cgst_rate/100)))).toFixed(2);
        item.find('td:eq(10)').text(Number(cgst_amt).toFixed(2));
       
        var igst_amt = Number(parseFloat((gross_amt*(igst_rate/100)))).toFixed(2);
        item.find('td:eq(12)').text(Number(igst_amt).toFixed(2));
        var tot_amt = Number(parseFloat((gross_amt*1)+(sgst_amt*1)+(cgst_amt*1)+(igst_amt*1))).toFixed(2);
        item.find('td:eq(14)').text(Number(tot_amt).toFixed(2));
        item.find('td:eq(15)').text(Number(gross_amt).toFixed(2));

        // new area
        tot_sgst = (tot_sgst*1)+ (item.find('td:eq(8)').text()*1);
        tot_cgst = (tot_cgst*1)+ (item.find('td:eq(10)').text()*1);
        grd_tot_amt = (grd_tot_amt*1)+ (item.find('td:eq(14)').text()*1);
        tot_igst = (tot_igst*1)+ (item.find('td:eq(12)').text()*1);
        });
        $("#cgst_lbl_tot").text(Number(tot_cgst).toFixed(2));
        $("#sgst_lbl_tot").text(Number(tot_sgst).toFixed(2));
        $("#tot_ord_val").text(Number(grd_tot_amt).toFixed(2));
        $("#igst_lbl_tot").text(Number(tot_igst).toFixed(2));
        $("#org_tot").val(Number(grd_tot_amt).toFixed(2));
        $("#finaltotal").val(Number(grd_tot_amt).toFixed(2));
        dis_cal();
        carr_cal();
        serv_cal();
        var amat = $("#org_tot").val();
        round_cal(amat);
        var amat = $("#org_tot").val();
        var inward = rscustome(amat);
        $("#in_word").text(inward);
        // $("#save_btn").attr('disabled',true);

       
       
}
function dis_cal(){
    var dis_val = $("#disc_value").val();
    var tot_val = $("#org_tot").val();
    var act_tot = 0;
    if(dis_val!=''){
        act_tot = tot_val-dis_val;
        $("#org_tot").val(Number(act_tot).toFixed(2));
        $("#tot_ord_val").text(Number(act_tot).toFixed(2));
        $("#finaltotal").val(Number(act_tot).toFixed(2));
        // $("#save_btn").attr('disabled',true);
    }
}
function carr_cal(){
    var dis_val = $("#carr_val").val();
    var tot_val = $("#org_tot").val();
    var act_tot = 0;
    if(dis_val!=''){
        act_tot = (tot_val*1)+(dis_val*1);
        $("#org_tot").val(Number(act_tot).toFixed(2));
        $("#tot_ord_val").text(Number(act_tot).toFixed(2));
        $("#finaltotal").val(Number(act_tot).toFixed(2));
        // $("#save_btn").attr('disabled',true);
    }
}
function serv_cal(){
    var dis_val = $("#serv_val").val();
    var tot_val = $("#org_tot").val();
    var act_tot = 0;
    if(dis_val!=''){
        act_tot = (tot_val*1)+(dis_val*1);
        $("#org_tot").val(Number(act_tot).toFixed(2));
        $("#tot_ord_val").text(Number(act_tot).toFixed(2));
        $("#finaltotal").val(Number(act_tot).toFixed(2));
        // $("#save_btn").attr('disabled',true);
    }
}
function round_cal(p){
    var tot_amt = p;
    var round_Value = Math.round(tot_amt);
    var round_final = (round_Value-tot_amt);
    if(round_final<0){
        $("#round_val_show").attr('style','color:red;');
    }
    else{
        $("#round_val_show").attr('style','color:#aab1c7;font-size:16px; padding-top: 12px !important;'); 
    }
        var finall_val = (tot_amt*1)+(round_final*1);
        $("#org_tot").val(Number(finall_val).toFixed(2));
        $("#tot_ord_val").text(Number(finall_val).toFixed(2));
        $("#finaltotal").val(Number(finall_val).toFixed(2));
    
    
    $("#round_val_show").text(Number(round_final).toFixed(2));
    $("#round_value").val(Number(round_final).toFixed(2));
    // $("#save_btn").attr('disabled',true);
}
$('#disc_value ,#Itm_Qny , #serv_val , #carr_val').keypress(function (e) {    
    
    var charCode = (e.which) ? e.which : event.keyCode    

    if (String.fromCharCode(charCode).match(/[^0-9.]/g))    

        return false;                        

});
function rscustome(n){
    var validamt= n;  
    var op='';
   var  nums = n.toString().split('.')
    var whole = Rs(nums[0])
    if(nums[1]==null)nums[1]=0;
    if(nums[1].length == 1 )nums[1]=nums[1]+'0';
    if(nums[1].length> 2){nums[1]=nums[1].substring(2,length - 1)}
    if(nums.length == 2){
    if(nums[0]<=9){nums[0]=nums[0]*10} else {nums[0]=nums[0]};
    var fraction = Rs(nums[1])
    if(whole=='' && fraction==''){op= 'Rupees Zero Only';}
    if(whole=='' && fraction!=''){op= fraction + 'Paise Only';}
    if(whole!='' && fraction==''){op='Rupees ' + whole + ' Only';} 
    if(whole!='' && fraction!=''){op='Rupees ' + whole + 'And ' + fraction + 'Paise Only';}
    if(validamt > 999999999.99){op='The Amount Is Too Big To Convert'; }
    if(validamt < 0){op='Amount Can Not Be Less Than Zero';}
    if(isNaN(validamt) == true ){op='Amount In Number Appears To Be Incorrect. Please Check.';}
    return op;
    
    }
    }

    function gen_tbl_data(){
        var table = document.getElementById("faqs"), tbl_data = '';
    
                
                for(var i = 1; i < table.rows.length; i++)
                {
                    tbl_data = (tbl_data + (table.rows[i].cells[3].innerHTML) + ','+ (table.rows[i].cells[4].innerHTML) + ','+ (table.rows[i].cells[6].innerHTML)+ ','+ (table.rows[i].cells[19].innerHTML)+ ','+ (table.rows[i].cells[8].innerHTML)+ ','+ (table.rows[i].cells[10].innerHTML)+ ','+ (table.rows[i].cells[12].innerHTML)+ ','+ (table.rows[i].cells[13].innerHTML)+ ','+ (table.rows[i].cells[14].innerHTML)+ ','+ (table.rows[i].cells[15].innerHTML)+ ','+ (table.rows[i].cells[17].innerHTML)+ ',');
                    
                }
        $('#tbl_data').val(tbl_data);
    }
    function post_Sale(){
        var ref_sale_No = $("#ref_pur_No").val();
        var party_ID = $("#Party_Idd").val();
        var ware_Id = $("#whare_house").val();
        var mem_name = $("#mem_name").val();
        var mem_add = $("#address").val();
        var mem_mob_no = $("#mem_mob").val();
        var mem_gst_in = $("#gst_in_No").val();
        var party_Type = '';
        var pRound_AMt = $("#round_value").val();
        var pdisc_Value = $("#disc_value").val();
        var carr_val = $("#carr_val").val();
        var other_val = $("#serv_val").val();
        var nom_Name = $("#nom_name").val();
        var nom_rel = $("#nom_rel").val();
        var pPaid_Mode = '';
        var pBank_Id = $("#bank_Id").val();
        var sb_Id = $("#sb_id").val();
        var tbl_data = $('#pur_table_data tr').length;
        var pinput_2000_curren = $("#input_2000_curren").val();
        var pinput_500_curren = $("#input_500_curren").val();
        var pinput_200_curren = $("#input_200_curren").val();
        var pinput_100_curren = $("#input_100_curren").val();
        var pinput_50_curren = $("#input_50_curren").val();
        var pinput_20_curren = $("#input_20_curren").val();
        var pinput_10_curren = $("#input_10_curren").val();
        var pinput_5_curren = $("#input_5_curren").val();
        var pinput_1con_curren = $("#input_1con_curren").val();
        var poutput_2000_curren = $("#output_2000_curren").val();
        var poutput_500_curren = $("#output_500_curren").val();
        var poutput_200_curren = $("#output_200_curren").val();
        var poutput_100_curren = $("#output_100_curren").val();
        var poutput_50_curren = $("#output_50_curren").val();
        var poutput_20_curren = $("#output_20_curren").val();
        var poutput_10_curren = $("#output_10_curren").val();
        var poutput_5_curren = $("#output_5_curren").val();
        var poutput_1con_curren = $("#output_1con_curren").val();
        var sale_Date = $("#purchase_Date").val();
        var tot_amount = $("#finaltotal").val();
        var sav_Bal = $("#mem_bal").val();
        var is_rate = 1;
        var tot_amt=0;
        $('#pur_table_data tr').each(function () {
            var item = $(this); //this should represent one row
            tot_amt = (item.find('td:eq(7) input').val()*1);
            // console.log(tot_amt);
            if(tot_amt==0){
                is_rate=0;
            }
            else if(Math.trunc(tot_amt)==0){
                is_rate=0;
                // console.log(Math.trunc(tot_amt));
            }
            });
        if($("#mem_opt").prop('checked')==true){
            party_Type='M';
        }
        if($("#party_opt").prop('checked')==true){
            party_Type='P';
        }
        if($("#other_opt").prop('checked')==true){
            party_Type='C';
        }
        if($("#cash_opt").prop('checked')==true){
            pPaid_Mode='Cash';
        }
        if($("#bank_opt").prop('checked')==true){
            pPaid_Mode='Bank';
        }
        if($("#sb_opt").prop('checked')==true){
            pPaid_Mode='Savings';
        }
        if($("#credit_opt").prop('checked')==true){
            pPaid_Mode='Credit';
        }
        if(sale_Date==''){
            simple_alert('Warning','Please Select Sale Date','warning');
        }
        else if(ref_sale_No==''){
            simple_alert('Warning','Please Enter Ref Sale No','warning');
        }
        else if(ware_Id==null){
            simple_alert('Warning','Please Select Ware House','warning');
        }
        else if(mem_name==''){
            simple_alert('Warning','Please Entter Member Name','warning');
        }
        else if(tbl_data==0){
            simple_alert('Warning','Please Add Item To Table','warning');
        }
        else if(tot_amount==''||tot_amount==0){
            simple_alert('Warning','Sale Amount Cannot Be Zero','warning');
        }
        else if($("#sb_opt").prop('checked')==true && (tot_amount*1)>(sav_Bal*1)){
            simple_alert('Warning','Not Sufficient Balance In Savings Account','warning');
        }
        else if(is_rate==0){
            simple_alert('Warning','Item Rate Cannot Be Zero !!','warning');
        }
        else{
            $("#save_btn").attr('disabled',true);
            $("#save_btn").text('Please Wait..');
            gen_tbl_data();

            $.ajax({
                type: "POST",
                url: "method/add_sale.php",
                data: {pSale_No:ref_sale_No,pSale_Party:party_ID,pSale_ware:ware_Id,pSale_mem_Name:mem_name,pMem_Add:mem_add,pMem_Mob:mem_mob_no,pMem_gst:mem_gst_in,pParty_Type:party_Type,round_up:pRound_AMt,disc_value:pdisc_Value,paid_mode:pPaid_Mode,bank_id:pBank_Id,sb_Id:sb_Id,input_2000_curren:pinput_2000_curren,input_500_curren:pinput_500_curren,input_200_curren:pinput_200_curren,input_100_curren:pinput_100_curren,input_50_curren:pinput_50_curren,input_20_curren:pinput_20_curren,input_10_curren:pinput_10_curren,input_5_curren:pinput_5_curren,input_1con_curren:pinput_1con_curren,output_2000_curren:poutput_2000_curren,output_500_curren:poutput_500_curren,output_200_curren:poutput_200_curren,output_100_curren:poutput_100_curren,output_50_curren:poutput_50_curren,output_20_curren:poutput_20_curren,output_10_curren:poutput_10_curren,output_5_curren:poutput_5_curren,output_1con_curren:poutput_1con_curren,pSales_Data:$("#tbl_data").val(),pCarr_amt:carr_val,pMisc_AMt:other_val,pNomin_name:nom_Name,pNom_rel:nom_rel,pSales_Date:sale_Date},
                success: function (response) {
                    // console.log(response);
                    var data = JSON.parse(response);
                    data.forEach(function(pur_post) {
                        var err = pur_post.Errorno;
                        var msg = pur_post.message;
                        var sale_id = pur_post.sales_id;
                        // var org_id = pur_post.org_id;
                        var bill_no = pur_post.bill_no;
                        if(err<0){
                            simple_alert('Error',msg,'error');
                            $("#save_btn").removeAttr('disabled',true);
                            $("#save_btn").text('Save');
                        }
                        else{
                            post_msg('Success',msg,'success');
                            setCookie('sale_id',sale_id,'1');
                            // setCookie('org_id',org_id,'1');
                            setCookie('bill_no',bill_no,'1');
                            setCookie('sale_date',$("#purchase_Date").val(),'1');
                            window.open("print_bill3.php", "popupWindow", "width=600,height=600,scrollbars=yes");
                            pur_form_clean();
                        }
                    });
                }
            });
        }
    }
    function setCookie(cname, cvalue, exdays) {
        const d = new Date();
        d.setTime(d.getTime() + (exdays*24*60*60*1000));
        let expires = "expires="+ d.toUTCString();
        document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
      }
    function pur_form_clean(){
        sale_opt('mem_opt');
        load_whare();
        load_item();
        trans_mode('cash_opt');
        $("#pur_table_data").empty();
        $("#igst_lbl_tot").text('0.00');
        $("#disc_value").val('');
        $("#cgst_lbl_tot").text('0.00');
        $("#sgst_lbl_tot").text('0.00');
        $("#round_val_show").text('0.00');
        $("#round_value").val('');
        $("#in_word").text('');
        $("#tot_ord_val").text('');
        $("#org_tot").val('');
        $("#finaltotal").val('');
        $("#ref_pur_No").val('');
        $("#mem_name").val('');
        $("#address").val('');
        $("#mem_mob").val('');
        $("#gst_in_No").val('');
        $("#curr_stock_lbl").empty();
        $("#Itm_Qny").val('');
    }