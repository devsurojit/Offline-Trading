'use strict';
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
$(window).on('load',function(){
    load_item();
});
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
function check_duplicate(p1,p2){
    var rr = true;
    $('#chalan_table tr').each(function () {
        var item = $(this); //this should represent one row
        var item_id = (item.find('td:eq(2)').text()*1);
        var item_unit = (item.find('td:eq(4)').text()*1);
        
        if(item_id==p1 && item_unit==p2){
            rr= false;
            return false;
        }
        else {
            rr= true;
            return true;
        }
        });
    return rr;
}
function add_item(){
    
    var item_id = $("#Item_Id").val();
    var item_Name = $("#Item_Id option:selected").text();
    var unit_id = $("#Unit_Id").val();
    var unit_Name = $("#Unit_Id option:selected").text();
    var rate = $("#item_rate").val();
    
     if(item_id==null){
        simple_alert('Warning','Please Select Item','warning');
    }
    else if(unit_id==null){
        simple_alert('Warning','Please Select Unit','warning');
    }
    else if(rate==''){
        simple_alert('Warning','Please Enter Rate','warning');
    }
    else if(check_duplicate(item_id,unit_id)==false){
        simple_alert('Warning','Same Unit Already Added !!','warning');
    }
    else {
        var rowCount = $('#chalan_table tr').length;
        if(rowCount==0){
            $("#chalan_table").empty();
        }
        $("#chalan_table").append('<tr><td class="serial">'+ ((rowCount*1)+1) +'</td>'+
        '<td style="width: 45%;">'+ item_Name +'</td>'+
        '<td style="display:none;">'+ item_id +'</td>'+
        '<td >'+ unit_Name +'</td>'+
        '<td style="display:none;">'+ unit_id +'</td>'+
        '<td >'+ rate +'</td>'+
        '<td> <button type="button" class="btn btn-danger myclass" id="Action" style="padding-top: 8px;padding-bottom: 8px;"name="Action" onclick="revove_row(this);"><i class="fa fa-trash" aria-hidden="true"></i> delete</button></td>'+
        '</tr>');
        load_item();
        $("#Unit_Id").empty();
        $("#Unit_Id").append('<option value="" selected="" disabled="" >Select Unit</option>');
        $("#Itm_Qny").val('');
        $("#item_rate").val('');
    }
}
function revove_row(p){
    var currentRow=$(p).closest("tr"); 
    currentRow.remove(); 
    $('#chalan_table tr').each(function(index){
        $(this).find('.serial').html(index+1);
    });
    
}
function gen_tbl_data(){
	var table = document.getElementById("faqs"), tbl_data = '';

            
            for(var i = 1; i < table.rows.length; i++)
            {
				tbl_data = (tbl_data + (table.rows[i].cells[2].innerHTML) + ','+ (table.rows[i].cells[4].innerHTML) + ','+ (table.rows[i].cells[5].innerHTML)+ ',');
                
            }
	$('#tbl_data').val(tbl_data);
}
function post_rate(){
    var rowCount = $('#chalan_table tr').length;
    if(rowCount==0){
        simple_alert('Warning','Please Add Item First !!','warning');
    }
    else{
        $("#sav_btn").attr('disabled',true);
        $("#sav_btn").text('Please Wait...');
        gen_tbl_data();
        $.ajax({
            type: "POST",
            url: "method/push_rate.php",
            data: {pItem_Rate_Date:$("#tbl_data").val()},
            success: function (response) {
                var data = JSON.parse(response);
                    data.forEach(function(pur_post) {
                        var err = pur_post.Errorno;
                        var msg = pur_post.message;
                        if(err<0){
                            post_msg('Error',msg,'error');
                        }
                        else{
                            post_msg('Success',msg,'success');
                           
                        }
                    });
            }
        });
    }
}