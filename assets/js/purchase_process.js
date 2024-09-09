'use strict';
$(window).on('load',function(){
    load_chalan();
    pur_mode_select('chalan_opt');
    trans_mode('cash_opt');
    allow_key_qnty("#Itm_Qny");
});
function load_chalan(){
    $.ajax({
        type: "POST",
        url: "method/ajax.php",
        async:false,
        data: {pLoad_chalan_pur:0},
        success: function (response) {
            var data = JSON.parse(response);
            $("#chalan_id").empty();
            $("#chalan_id").append('<option value="" selected="" disabled="" >Select Chalan</option>');
            data.forEach(function(chalan_data) {
                $("#chalan_id").append('<option value="'+ chalan_data.Id +'" >'+ chalan_data.chalan_No +'</option>')
            });
        }
    });
}
function pur_mode_select(p){
    if(p=='chalan_opt'){
        $("#party_div").attr('style','display:none;');
        $("#wh_div").attr('style','display:none');
        $("#item_div").attr('style','display:none');
        $("#qnty_div").attr('style','display:none;');
        $("#unit_div").attr('style','display:none;');
        $("#chalan_div").removeAttr('style');
        load_chalan();
    }
    if(p=='non_chalan_opt'){
        $("#party_div").removeAttr('style');
        $("#wh_div").removeAttr('style');
        $("#item_div").removeAttr('style');
        $("#qnty_div").removeAttr('style');
        $("#unit_div").removeAttr('style');
        $("#chalan_div").attr('style','display:none;');
        load_item();
        load_party();
        load_whare();
    }
}
function load_item_unit(){
    var pItem_Id = $("#Item_Id").val();
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
        }
    });
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
function load_party(){
    $.ajax({
        type: "POST",
        url: "method/ajax.php",
        data: {pLoad_Party_purchase:0},
        success: function (response) {
            // console.log(response);
            var data = JSON.parse(response);
            $("#Party_Idd").empty();
            $("#Party_Idd").append('<option value="" selected="" disabled="" >Select Party</option>');
            data.forEach(function(party_data) {
                $("#Party_Idd").append('<option value="'+ party_data.Id +'">'+ party_data.Party_Name +'</option>')
            });
        }
    });
}
function add_item(){
    if($("#chalan_opt").prop('checked')==true){
        var chalan_Id = $("#chalan_id").val();
        if(chalan_Id==null){
            simple_alert('Warning','Please Select Chalan First','warning');
        }
        else{
            $.ajax({
                type: "POST",
                url: "method/ajax.php",
                data: {pPur_Chalan_Id:chalan_Id},
                success: function (response) {
                    
                    var data = JSON.parse(response);
                    // console.log(data[0].party_Id);
                    if($("#party_Id").val()=='' || $("#party_Id").val()==data[0].party_Id){  
                    // $("#pur_table_data").empty();
                    var rowCount = $('#pur_table_data tr').length;
                    
                    
                    
                    if(rowCount==0){
                        $("#pur_table_data").empty();
                    }
                    var sl=1;
                    data.forEach(function(chalan_Data) {
                        
                        $("#pur_table_data").append('<tr><td>'+ sl++ +'</td>'+
                        '<td style="display:none;">'+ chalan_Data.id +'</td>'+
                        '<td style="display:none;">'+ chalan_Data.party_Id +'</td>'+
                        '<td>'+ chalan_Data.Item_Name +'</td>'+
                        '<td style="display:none;">'+ chalan_Data.Item_Id +'</td>'+
                        '<td>'+ chalan_Data.Item_Unit_val +'</td>'+
                        '<td>'+ chalan_Data.Unit_Name +'</td>'+
                        '<td style="display:none;">'+ chalan_Data.Item_Unit_Id +'</td>'+
                        '<td><input type="text" class="decimal" onkeyup="cal_amt_pur(this);" onkeypress="return keyallow(this,event);"></td>'+
                        '<td>0.00</td>'+
                        '<td style="display:none;">'+ chalan_Data.Item_Sgst +'</td>'+
                        '<td>0.00</td>'+
                        '<td style="display:none;">'+ chalan_Data.Item_cgst +'</td>'+
                        '<td>0.00</td>'+
                        '<td style="display:none;">'+ chalan_Data.item_Igst +'</td>'+
                        '<td>0.00</td>'+
                        '<td style="display:none;">0.00</td>'+
                        '<td style="display:none;">'+ chalan_Data.Whareh_Id +'</td>'+
                        '<td style="display:none;">'+ chalan_Data.Item_Pur_Gl +'</td>'+
                        '<td><button type="button" class="btn btn-danger myclass" disabled id="Action" style="padding-top: 8px;padding-bottom: 8px;"name="Action"><i class="fa fa-trash" aria-hidden="true"></i> delete</button></td>'+
                    '</tr>');
                
                    });
                    $('#pur_table_data tr').each(function () {
                        var item = $(this);
                        // console.log(item.find('td:eq(2)').text());
                        $("#party_Id").val(item.find('td:eq(2)').text());
                    });
                    load_chalan();
                    $('#pur_table_data tr').each(function () {
                        var item = $(this);
                        // console.log(item.find('td:eq(1)').text());
                        $("#chalan_id option[value='"+ item.find('td:eq(1)').text() +"']").remove();
                    });
                    
                }
                else{
                    simple_alert('Warning','You Can Add Same Party Chalan Only','warning');
                }
            }
            });
        }
       
    }
    else{
        var pParty_Id = $("#Party_Idd").val();
        var pWhare_Id = $("#whare_house").val();
        var pItem_Id = $("#Item_Id").val();
        var pItem_Qnty = $("#Itm_Qny").val();
        var pItem_Unit = $("#Unit_Id").val();

        if(pParty_Id==null){
            simple_alert('Warning','Please Select Party First','warning');
        }
        else if(pWhare_Id==null){
            simple_alert('Warning','Please Select Whare House','warning');
        }
        else if(pItem_Id==null){
            simple_alert('Warning','Please Select Item','warning');
        }
        else if(pItem_Qnty=='' || pItem_Qnty==0){
            simple_alert('Warning','Please Enter Quantity','warning');
        }
        else if(pItem_Unit==null){
            simple_alert('Warning','Please Select Item Unit','warning');
        }
        else{
            $.ajax({
                type: "POST",
                url: "method/ajax.php",
                data: {pPurchase_Item_Id:pItem_Id},
                success: function (response) {
                    var data = JSON.parse(response);
                    var rowCount = $('#pur_table_data tr').length;
            
                    if(rowCount==0){
                        $("#pur_table_data").empty();
                    }
                    var sl=1;
                    data.forEach(function(item_data) {
                        $("#pur_table_data").append('<tr><td>'+ sl++ +'</td>'+
                        '<td style="display:none;">null</td>'+
                        '<td style="display:none;">'+ pParty_Id +'</td>'+
                        '<td>'+ $("#Item_Id option:selected").text() +'</td>'+
                        '<td style="display:none;">'+ pItem_Id +'</td>'+
                        '<td>'+ pItem_Qnty +'</td>'+
                        '<td>'+ $("#Unit_Id option:selected").text() +'</td>'+
                        '<td style="display:none;">'+ pItem_Unit +'</td>'+
                        '<td><input type="text" class="decimal" onkeyup="cal_amt_pur(this);" onkeypress="return keyallow(this,event);"  ></td>'+
                        '<td>0.00</td>'+
                        '<td style="display:none;">'+ item_data.Item_Sgst +'</td>'+
                        '<td>0.00</td>'+
                        '<td style="display:none;">'+ item_data.Item_cgst +'</td>'+
                        '<td>0.00</td>'+
                        '<td style="display:none;">'+ item_data.item_Igst +'</td>'+
                        '<td>0.00</td>'+
                        '<td style="display:none;">0.00</td>'+
                        '<td style="display:none;">'+ pWhare_Id +'</td>'+
                        '<td style="display:none;">'+ item_data.Item_Pur_Gl +'</td>'+
                        '<td><button type="button" class="btn btn-danger myclass" onclick="revove_row(this);" id="Action" style="padding-top: 8px;padding-bottom: 8px;"name="Action"><i class="fa fa-trash" aria-hidden="true"></i> delete</button></td>'+
                    '</tr>');
                    });
                    load_item();
                    $('#pur_table_data tr').each(function () {
                        var item = $(this); //this should represent one row
                       var  tbl_item = (item.find('td:eq(4)').text());
                        $("#Item_Id option[value='"+ tbl_item +"']").remove();
                        });
                    
                    $("#Unit_Id").empty();
                    $("#Unit_Id").append('<option value="" selected="" disabled="" >Select Unit</option>');
                    $("#Itm_Qny").val('');
                    $("#Party_Idd").attr('disabled',true);
                    $("#whare_house").attr('disabled',true);

                }
            });
        }
    }
    $("#gst_opt").attr('disabled',true);
    $("#non_gst_opt").attr('disabled',true);
}
const elToggle  = document.querySelector("#Cash_Denom_btn");
const elContent = document.querySelector("#Cash_Denomination");

// elToggle.addEventListener("click", function() {
// elContent.classList.toggle("is-hidden");
// });
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
function trans_mode(p){
    if(p=='cash_opt'){
        $("#bank_div").attr('style','display:none;');
        $("#cash_div").removeAttr('style');
        // $("#save_btn").attr('disabled',true);
        $("#bank_Id").empty();
        $("#bank_Id").append('<option value="" selected="" disabled="" >Select Bank Account</option>');
    }
    if(p=='bank_opt'){
        fetch_bank_acct();
        $("#cash_div").attr('style','display:none');
        // $("#save_btn").removeAttr('disabled');
        $("#bank_div").removeAttr('style');
    }
    if(p=='credit_opt'){
        $("#cash_div").attr('style','display:none');
        $("#bank_div").attr('style','display:none;');
        // $("#save_btn").removeAttr('disabled');
        $("#bank_Id").empty();
        $("#bank_Id").append('<option value="" selected="" disabled="" >Select Bank Account</option>');
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
function cal_amt_pur(p){
    var sgst_Rate =0;
    var cgst_rate = 0;
    var igst_rate = 0;
    var rate = p.value;
    var qnty = $(p).closest('tr').find('td:eq(5)').text();
    var gross_amt = qnty*rate;
    if($("#gst_opt").prop('checked')==true){
         sgst_Rate = $(p).closest('tr').find('td:eq(10)').text();
         cgst_rate = $(p).closest('tr').find('td:eq(12)').text();
         igst_rate = $(p).closest('tr').find('td:eq(14)').text();
    }
    else{
        sgst_Rate = 0;
        cgst_rate = 0;
        igst_rate = 0;
    }
 

    var sgst_amt = (gross_amt*(sgst_Rate/100));
    $(p).closest('tr').find('td:eq(9)').text(Number(sgst_amt).toFixed(2));
    var cgst_amt = (gross_amt*(cgst_rate/100));
    $(p).closest('tr').find('td:eq(11)').text(Number(cgst_amt).toFixed(2));
    var igst_amt = (gross_amt*(igst_rate/100));
    $(p).closest('tr').find('td:eq(13)').text(Number(igst_amt).toFixed(2));
    var tot_amt = Number((Number(gross_amt).toFixed(2)*1)+(Number(sgst_amt).toFixed(2)*1)+(Number(cgst_amt).toFixed(2)*1)+(Number(igst_amt).toFixed(2)*1)).toFixed(2);
    $(p).closest('tr').find('td:eq(15)').text(Number(tot_amt).toFixed(2));
    $(p).closest('tr').find('td:eq(16)').text(Number(gross_amt).toFixed(2));
    cal_tot_amt();
}
function allow_key(p){
    $(p).keypress(function (e) {
        var character = String.fromCharCode(e.keyCode)
        var newValue = this.value + character;
        if (isNaN(newValue) || hasDecimalPlace(newValue, 3)) {
            e.preventDefault();
            return false;
        }
    });
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
$('.decimal').keypress(function (e) {
    var character = String.fromCharCode(e.keyCode)
    var newValue = this.value + character;
    // console.log(character);
    if (isNaN(newValue) || hasDecimalPlace(newValue, 3)) {
        e.preventDefault();
        return false;
    }
    
});

function hasDecimalPlace(value, x) {
    var pointIndex = value.indexOf('.');
    return  pointIndex >= 0 && pointIndex < value.length - x;
}

function cal_tot_amt(){
    var tot_sgst=0;
    var tot_cgst = 0;
    var tot_amt=0;
    var tot_igst = 0;
    $('#pur_table_data tr').each(function () {
        var item = $(this); //this should represent one row
        tot_sgst = (tot_sgst*1)+ (item.find('td:eq(9)').text()*1);
        tot_cgst = (tot_cgst*1)+ (item.find('td:eq(11)').text()*1);
        tot_amt = (tot_amt*1)+ (item.find('td:eq(15)').text()*1);
        tot_igst = (tot_igst*1)+ (item.find('td:eq(13)').text()*1);
        });
        $("#cgst_lbl_tot").text(Number(tot_cgst).toFixed(2));
        $("#sgst_lbl_tot").text(Number(tot_sgst).toFixed(2));
        $("#tot_ord_val").text(Number(tot_amt).toFixed(2));
        $("#igst_lbl_tot").text(Number(tot_igst).toFixed(2));
        $("#org_tot").val(Number(tot_amt).toFixed(2));
        $("#finaltotal").val(Number(tot_amt).toFixed(2));
        dis_cal();
        tcs_cal();
        round_cal();
        // var amat = $("#org_tot").val();
        // var inward = rscustome(amat);
        // $("#in_word").text(inward);
        // $("#save_btn").attr('disabled',true);
        var amat = $("#org_tot").val();
        
        var amat = $("#org_tot").val();
        var inward = rscustome(amat);
        $("#in_word").text(inward);
       
       
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

function tcs_cal(){
    var tcs_cal = $("#tcs_value").val();
    var tot_val = $("#org_tot").val();
    var act_tot=0;
    if(tcs_cal!=''){
        act_tot = (tot_val*1)+(tcs_cal*1);
        $("#org_tot").val(Number(act_tot).toFixed(2));
        $("#tot_ord_val").text(Number(act_tot).toFixed(2));
        $("#finaltotal").val(Number(act_tot).toFixed(2));
        // $("#save_btn").attr('disabled',true);
    }
}
function round_cal(){
    var tot_amt = $("#org_tot").val();
    var round_Value = $("#round_value").val();
    var finall_val = (tot_amt*1)+(round_Value*1);
        $("#org_tot").val(Number(finall_val).toFixed(2));
        $("#tot_ord_val").text(Number(finall_val).toFixed(2));
        $("#finaltotal").val(Number(finall_val).toFixed(2));
    
    
    // $("#round_val_show").text(Number(round_final).toFixed(2));
    // $("#round_value").val(Number(round_final).toFixed(2));
    
}
$('#round_value').keypress(function (e) {    
    
    var charCode = (e.which) ? e.which : event.keyCode    

    if (String.fromCharCode(charCode).match(/[^0-9.-]/g)||hasDecimalPlace(this.value,2))    

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
                    tbl_data = (tbl_data + (table.rows[i].cells[1].innerHTML) + ','+ (table.rows[i].cells[2].innerHTML) + ','+ (table.rows[i].cells[4].innerHTML)+ ','+ (table.rows[i].cells[5].innerHTML)+ ','+ (table.rows[i].cells[7].innerHTML)+ ','+ (table.rows[i].cells[8].getElementsByTagName('input')[0].value)+ ','+ (table.rows[i].cells[9].innerHTML)+ ','+ (table.rows[i].cells[11].innerHTML)+ ','+ (table.rows[i].cells[13].innerHTML)+ ','+ (table.rows[i].cells[16].innerHTML)+ ','+ (table.rows[i].cells[17].innerHTML)+ ','+ (table.rows[i].cells[18].innerHTML)+ ','+ (table.rows[i].cells[15].innerHTML)+ ',');
                    
                }
        $('#tbl_data').val(tbl_data);
    }
    function post_purchase(){
        var trans_mode = '';
        if($("#cash_opt").prop('checked')==true){
            trans_mode='Cash';
        }
        if($("#bank_opt").prop('checked')==true){
            trans_mode='bank';
        }
        if($("#credit_opt").prop('checked')==true){
            trans_mode='Credit';
        }
       
        var pur_date = $("#purchase_Date").val();
        var ref_pur_No = $("#ref_pur_No").val();
        var pinput_2000_curren = $("#output_2000_curren").val();
        var pinput_500_curren = $("#output_500_curren").val();
        var pinput_200_curren = $("#output_200_curren").val();
        var pinput_100_curren = $("#output_100_curren").val();
        var pinput_50_curren = $("#output_50_curren").val();
        var pinput_20_curren = $("#output_20_curren").val();
        var pinput_10_curren = $("#output_10_curren").val();
        var pinput_5_curren = $("#output_5_curren").val();
        var pinput_1con_curren = $("#output_1con_curren").val();
        var poutput_2000_curren = $("#input_2000_curren").val();
        var poutput_500_curren = $("#input_500_curren").val();
        var poutput_200_curren = $("#input_200_curren").val();
        var poutput_100_curren = $("#input_100_curren").val();
        var poutput_50_curren = $("#input_50_curren").val();
        var poutput_20_curren = $("#input_20_curren").val();
        var poutput_10_curren = $("#input_10_curren").val();
        var poutput_5_curren = $("#input_5_curren").val();
        var poutput_1con_curren = $("#input_1con_curren").val();
        var pBank_Id = $("#bank_Id").val();
        var pParty_Id = $("#Party_Idd").val();
        var pParty_Name = $("#Party_Idd option:selected").text();
        var pWhare_Id = $("#whare_house").val();
        var is_rate = 1;
        var tot_amt=0;
        $('#pur_table_data tr').each(function () {
            var item = $(this); //this should represent one row
            tot_amt = (item.find('td:eq(15)').text()*1);
            // console.log(tot_amt);
            if(tot_amt==0){
                is_rate=0;
            }
            });
        
            if(pur_date==''){
                simple_alert('Warning','Please Enter Purchase Date','warning');
            }
            else if(ref_pur_No==''){
                simple_alert('Warning','Please Enter Ref Purchase No','warning');

            }
            else if($("#org_tot").val()==0){
                simple_alert('Warning','Amount Cannot Be Zero','warning');
            }
            else if(trans_mode=='bank' && pBank_Id==null){
            
                simple_alert('Warning','Please Select Bank Account','warning');
            }
            else if(is_rate==0){
                simple_alert('Warning','Item Rate Cannot Be Zero !!','warning');
            }
            else if(($("#org_tot").val()*1)<0){
                simple_alert('Warning','Amount Cannot Be Negative !!','warning');
            }
            else{
                $("#save_btn").attr('disabled',true);
                $("#save_btn").text('Please Wait');
                gen_tbl_data();
                $.ajax({
                    type: "POST",
                    url: "method/add_purchase.php",
                    data: {pPur_date:pur_date,pPur_ref_No:ref_pur_No,pPur_Party:pParty_Id,pPur_whid:pWhare_Id,pParty_Name:pParty_Name,pPur_Bank_Id:pBank_Id,input_2000_curren:pinput_2000_curren,input_500_curren:pinput_500_curren,input_200_curren:pinput_200_curren,input_100_curren:pinput_100_curren,input_50_curren:pinput_50_curren,input_20_curren:pinput_20_curren,input_10_curren:pinput_10_curren,input_5_curren:pinput_5_curren,input_1con_curren:pinput_1con_curren,output_2000_curren:poutput_2000_curren,output_500_curren:poutput_500_curren,output_200_curren:poutput_200_curren,output_100_curren:poutput_100_curren,output_50_curren:poutput_50_curren,output_20_curren:poutput_20_curren,output_10_curren:poutput_10_curren,output_5_curren:poutput_5_curren,output_1con_curren:poutput_1con_curren,pPur_Data_tbl:$("#tbl_data").val(),pPur_disc_AMt:$("#disc_value").val(),pPur_Mode:trans_mode,pRound_Amt:$("#round_value").val(),pTcs_Amt:$("#tcs_value").val()},
                    success: function (response) {
                        // console.log(response);
                        var data = JSON.parse(response);
                        data.forEach(function(pur_post) {
                            var err = pur_post.Errorno;
                            var msg = pur_post.message;
                            if(err<0){
                                post_msg('Error',msg,'error');
                                // pur_form_clean();
                            }
                            else{
                                post_msg('Success',msg,'success');
                                pur_form_clean();
                            }
                        });
                    }
                });
            }
        
    }
   function pur_form_clean(){
    load_chalan();
    pur_mode_select('chalan_opt');
    trans_mode('cash_opt');
    $("#purchase_Date").val('');
    $("#ref_pur_No").val('');
    $("#pur_table_data").empty();
    $("#org_tot").val(0);
    $("#finaltotal").val(0);
    $("#in_word").text('');
    $("#disc_value").val(0);
    $("#igst_lbl_tot").text('');
    $("#cgst_lbl_tot").text('');
    $("#sgst_lbl_tot").text('');
    $("#tot_ord_val").text('');
   }