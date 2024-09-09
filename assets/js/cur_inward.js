
function CurrencyCal() {
    var input_2000_curren = document.getElementById("input_2000_curren").value;
    document.getElementById("inp2000tot").innerHTML =  input_2000_curren * 2000;
    
    var input_500_curren = document.getElementById("input_500_curren").value;
    document.getElementById("inp500tot").innerHTML =  input_500_curren * 500;
  
    var input_200_curren = document.getElementById("input_200_curren").value;
    document.getElementById("inp200tot").innerHTML =  input_200_curren * 200;
    
    var input_100_curren = document.getElementById("input_100_curren").value;
    document.getElementById("inp100tot").innerHTML =  input_100_curren * 100;
  
    var input_50_curren = document.getElementById("input_50_curren").value;
    document.getElementById("inp50tot").innerHTML =  input_50_curren * 50;
    
    var input_20_curren = document.getElementById("input_20_curren").value;
    document.getElementById("inp20tot").innerHTML =  input_20_curren * 20;
  
    var input_10_curren = document.getElementById("input_10_curren").value;
    document.getElementById("inp10tot").innerHTML =  input_10_curren * 10;
    
    var input_5_curren = document.getElementById("input_5_curren").value;
    document.getElementById("inp5tot").innerHTML =  input_5_curren * 5;
  
    var input_1con_curren = document.getElementById("input_1con_curren").value;
    document.getElementById("inp1contot").innerHTML =  input_1con_curren * 1;
  
      var totinputcas = (input_2000_curren * 2000)+ (input_500_curren * 500)+ (input_200_curren * 200)
      + (input_100_curren * 100)+ (input_50_curren * 50)+ (input_20_curren * 20)+ (input_10_curren * 10)+ (input_5_curren * 5)+ (input_1con_curren * 1);
  
    document.getElementById("inpcastot").innerHTML = totinputcas;
  
  
    var output_2000_curren = document.getElementById("output_2000_curren").value;
    document.getElementById("opt2000tot").innerHTML =  output_2000_curren * 2000;
    
    var output_500_curren = document.getElementById("output_500_curren").value;
    document.getElementById("opt500tot").innerHTML =  output_500_curren * 500;
  
    var output_200_curren = document.getElementById("output_200_curren").value;
    document.getElementById("opt200tot").innerHTML =  output_200_curren * 200;
    
    var output_100_curren = document.getElementById("output_100_curren").value;
    document.getElementById("opt100tot").innerHTML =  output_100_curren * 100;
  
    var output_50_curren = document.getElementById("output_50_curren").value;
    document.getElementById("opt50tot").innerHTML =  output_50_curren * 50;
    
    var output_20_curren = document.getElementById("output_20_curren").value;
    document.getElementById("opt20tot").innerHTML =  output_20_curren * 20;
  
    var output_10_curren = document.getElementById("output_10_curren").value;
    document.getElementById("opt10tot").innerHTML =  output_10_curren * 10;
    
    var output_5_curren = document.getElementById("output_5_curren").value;
    document.getElementById("opt5tot").innerHTML =  output_5_curren * 5;
  
  
    
    var output_1con_curren = document.getElementById("output_1con_curren").value;
    document.getElementById("opt1contot").innerHTML =  output_1con_curren * 1;
  
      var totoutputcas = (output_2000_curren * 2000)+ (output_500_curren * 500)+(output_200_curren * 200)+
    (output_100_curren * 100)+(output_50_curren * 50)+(output_20_curren * 20)+(output_10_curren * 10)+(output_5_curren * 5)+(output_1con_curren * 1);
    document.getElementById("optcastot").innerHTML = totoutputcas;
  
      var amount22 = totinputcas-totoutputcas;
      document.getElementById("gandtot").innerHTML = amount22+' /-';
      //document.getElementById("debitamt").innerHTML = amount22;
      
  
      RsPaise(amount22);
      var tally_form = finaltotal.value;
      var tally_cash = amount22.toFixed(2)
      if (tally_form !== tally_cash){
        document.getElementById("okbut").setAttribute('disabled', true);
        document.getElementById("save_btn").setAttribute('disabled', true);
        
      }
      else if  (tally_form == tally_cash){
        document.getElementById("okbut").removeAttribute('disabled');
        $("#save_btn").removeAttr("disabled", "disabled");
        //alert("go");
      }
      //Rs(amount22);
  
      
  }
  
  
  
     function Rs(amount){
     var words = new Array();
     words[0] = 'Zero';words[1] = 'One';words[2] = 'Two';words[3] = 'Three';words[4] = 'Four';words[5] = 'Five';
     words[6] = 'Six';words[7] = 'Seven';words[8] = 'Eight';words[9] = 'Nine';words[10] = 'Ten';words[11] = 'Eleven';
     words[12] = 'Twelve';words[13] = 'Thirteen';words[14] = 'Fourteen';words[15] = 'Fifteen';words[16] = 'Sixteen';
     words[17] = 'Seventeen';words[18] = 'Eighteen';words[19] = 'Nineteen';words[20] = 'Twenty';words[30] = 'Thirty';
     words[40] = 'Forty';words[50] = 'Fifty';words[60] = 'Sixty';words[70] = 'Seventy';words[80] = 'Eighty';words[90] = 'Ninety';var op;
     amount = amount.toString();
     var atemp = amount.split('.');
     var number = atemp[0].split(',').join('');
     var n_length = number.length;
     var words_string = '';
     if(n_length <= 9){
     var n_array = new Array(0, 0, 0, 0, 0, 0, 0, 0, 0);
     var received_n_array = new Array();
     for (var i = 0; i < n_length; i++){
     received_n_array[i] = number.substr(i, 1);}
     for (var i = 9 - n_length, j = 0; i < 9; i++, j++){
     n_array[i] = received_n_array[j];}
     for (var i = 0, j = 1; i < 9; i++, j++){
     if(i == 0 || i == 2 || i == 4 || i == 7){
     if(n_array[i] == 1){
     n_array[j] = 10 + parseInt(n_array[j]);
     n_array[i] = 0;}}}
     value = '';
     for (var i = 0; i < 9; i++){
     if(i == 0 || i == 2 || i == 4 || i == 7){
     value = n_array[i] * 10;} else {
     value = n_array[i];}
     if(value != 0){
     words_string += words[value] + ' ';}
     if((i == 1 && value != 0) || (i == 0 && value != 0 && n_array[i + 1] == 0)){
     words_string += 'Crores ';}
     if((i == 3 && value != 0) || (i == 2 && value != 0 && n_array[i + 1] == 0)){
     words_string += 'Lakhs ';}
     if((i == 5 && value != 0) || (i == 4 && value != 0 && n_array[i + 1] == 0)){
     words_string += 'Thousand ';}
     if(i == 6 && value != 0 && (n_array[i + 1] != 0 && n_array[i + 2] != 0)){
     words_string += 'Hundred and ';} else if(i == 6 && value != 0){
     words_string += 'Hundred ';}}
     words_string = words_string.split(' ').join(' ');}
     return words_string;}
     function RsPaise(n){
     var validamt= n;  
     nums = n.toString().split('.')
     var whole = Rs(nums[0])
     if(nums[1]==null)nums[1]=0;
     if(nums[1].length == 1 )nums[1]=nums[1]+'0';
     if(nums[1].length> 2){nums[1]=nums[1].substring(2,length - 1)}
     if(nums.length == 2){
     if(nums[0]<=9){nums[0]=nums[0]*10} else {nums[0]=nums[0]};
     var fraction = Rs(nums[1])
     if(whole=='' && fraction==''){op= 'Rupees Zero Only';document.getElementById("okbut").removeAttribute('disabled');}
     if(whole=='' && fraction!=''){op= fraction + 'Paise Only';document.getElementById("okbut").removeAttribute('disabled');}
     if(whole!='' && fraction==''){op='Rupees ' + whole + ' Only';document.getElementById("okbut").removeAttribute('disabled');} 
     if(whole!='' && fraction!=''){op='Rupees ' + whole + 'And ' + fraction + 'Paise Only';document.getElementById("okbut").removeAttribute('disabled');}
     if(validamt > 999999999.99){op='The Amount Is Too Big To Convert'; document.getElementById("okbut").setAttribute('disabled', true);}
     if(validamt < 0){op='Amount Can Not Be Less Than Zero';document.getElementById("okbut").setAttribute('disabled', true);}
     if(isNaN(validamt) == true ){op='Amount In Number Appears To Be Incorrect. Please Check.';document.getElementById("okbut").setAttribute('disabled', true);}
     document.getElementById('op').innerHTML=op;
     }}
     
     
     
      
      function getvalur_frm_tbl(){
  
         var radioValue = $("input[name='res_redo']:checked").val();
         //alert (radioValue);
        //  document.getElementById("myText").value = radioValue;
         if (typeof radioValue === "undefined"){
           document.getElementById("myText").value = "";
                document.getElementById("myText").placeholder="Enter Individual CIF No...";
         }
         else{
           document.getElementById("myText").value = radioValue;
         }
  
  
  
         
      }
  
  function getvalur_frm_tbl12(){
  
  var radioValue = $("input[name='res_redoxx']:checked").val();
  //alert (radioValue);
  //  document.getElementById("myText").value = radioValue;
  if (typeof radioValue === "undefined"){
    document.getElementById("myText").value = "";
    document.getElementById("myText").placeholder="Enter Group CIF No...";
  }
  else{
    document.getElementById("myText").value = radioValue;
  }
  
  }
  function getvalur_frm_tbl13(){
  
  var radioValue = $("input[name='res_redo']:checked").val();
  //alert (radioValue);
  //  document.getElementById("myText").value = radioValue;
  if (typeof radioValue === "undefined"){
    document.getElementById("indivi_cif_txt").value = "";
    document.getElementById("indivi_cif_txt").placeholder="Individual CIF";
  }
  else{
    document.getElementById("indivi_cif_txt").value = radioValue;
  }
  
  }
  function reset_cash_fild(){
  
              document.getElementById("inp2000tot").innerHTML = "0";
              document.getElementById("inp500tot").innerHTML =  "0";
              document.getElementById("inp200tot").innerHTML =  "0";
              document.getElementById("inp100tot").innerHTML =  "0";
              document.getElementById("inp50tot").innerHTML = "0";
              document.getElementById("inp20tot").innerHTML =  "0";
              document.getElementById("inp10tot").innerHTML =  "0";
              document.getElementById("inp5tot").innerHTML =  "0";
              document.getElementById("inp1contot").innerHTML =  "0";
              document.getElementById("inpcastot").innerHTML = "0";
              document.getElementById("opt2000tot").innerHTML =  "0";
              document.getElementById("opt500tot").innerHTML =  "0";
              document.getElementById("opt200tot").innerHTML =  "0";
              document.getElementById("opt100tot").innerHTML =  "0";
              document.getElementById("opt50tot").innerHTML =  "0";
              document.getElementById("opt20tot").innerHTML =  "0";
              document.getElementById("opt10tot").innerHTML =  "0";
              document.getElementById("opt5tot").innerHTML =  "0";
              document.getElementById("opt1contot").innerHTML =  "0";
              document.getElementById("optcastot").innerHTML = "0";
              document.getElementById("gandtot").innerHTML = "";
              document.getElementById("op").innerHTML = "";
              document.getElementById("input_2000_curren").value = "";
              document.getElementById("input_500_curren").value = "";
              document.getElementById("input_200_curren").value = "";
              document.getElementById("input_100_curren").value = "";
              document.getElementById("input_50_curren").value = "";
              document.getElementById("input_20_curren").value = "";
              document.getElementById("input_10_curren").value = "";
              document.getElementById("input_5_curren").value = "";
              document.getElementById("input_1con_curren").value = "";
              document.getElementById("output_2000_curren").value = "";
              document.getElementById("output_500_curren").value = "";
              document.getElementById("output_200_curren").value = "";
              document.getElementById("output_100_curren").value = "";
              document.getElementById("output_50_curren").value = "";
              document.getElementById("output_20_curren").value = "";
              document.getElementById("output_10_curren").value = "";
              document.getElementById("output_5_curren").value = "";
              document.getElementById("output_1con_curren").value = "";
      }
  // searchby
  
  function defload(){
    document.getElementById('sh3').style.display = 'none';
  
  }
  
  
  function showopt() { 
  
     var Placeholdertext = document.getElementById ("searchname");
       
  
    var result1 = document.querySelector('input[name="serchby"]:checked').value;
    
    if(result1=="searchopt3"){
      document.getElementById('sh1').style.display = 'none';
      document.getElementById('sh3').style.display = 'block';
    }
    else{
       if(result1=="searchopt"){
        Placeholdertext.placeholder = "Search By Name";
        }
        if(result1=="searchopt2"){
           Placeholdertext.placeholder = "Search By Phone No";
        }
        if(result1=="searchopt4"){
           Placeholdertext.placeholder = "Search By Deposit A/C No";
        }
        if(result1=="searchopt5"){
           Placeholdertext.placeholder = "Search By Loan A/C No";
        }
  
      document.getElementById('sh1').style.display = 'block';
      document.getElementById('sh3').style.display = 'none';
    }
   }
  function fch_srt(){
      var x= document.getElementById("searchname").value;
      if (x==""){
        document.getElementById('src_res_tbl').style.display = 'none';
      }
      else{
        document.getElementById('src_res_tbl').style.display = 'block';
      }
     
   }
  
  function other_blank(input_ser_id){
    if (input_ser_id =='voter_id'){
     document.getElementById("pan_card").value = '';
     document.getElementById("passport_id").value = '';
     document.getElementById("job_card").value = '';
     document.getElementById("tan_id").value = '';
     document.getElementById("trade_lic").value = '';
     document.getElementById("adhar_id").value = '';
     document.getElementById("driving_lic").value = '';
     document.getElementById("ration_card").value = '';
     document.getElementById("gov_id").value = '';
     document.getElementById("tin_id").value = '';
     document.getElementById("vat_id").value = '';
    }
    if (input_ser_id =='pan_card'){
     document.getElementById("voter_id").value = '';
     document.getElementById("passport_id").value = '';
     document.getElementById("job_card").value = '';
     document.getElementById("tan_id").value = '';
     document.getElementById("trade_lic").value = '';
     document.getElementById("adhar_id").value = '';
     document.getElementById("driving_lic").value = '';
     document.getElementById("ration_card").value = '';
     document.getElementById("gov_id").value = '';
     document.getElementById("tin_id").value = '';
     document.getElementById("vat_id").value = '';
    }
    if (input_ser_id =='passport_id'){
     document.getElementById("pan_card").value = '';
     document.getElementById("voter_id").value = '';
     document.getElementById("job_card").value = '';
     document.getElementById("tan_id").value = '';
     document.getElementById("trade_lic").value = '';
     document.getElementById("adhar_id").value = '';
     document.getElementById("driving_lic").value = '';
     document.getElementById("ration_card").value = '';
     document.getElementById("gov_id").value = '';
     document.getElementById("tin_id").value = '';
     document.getElementById("vat_id").value = '';
    }
    if (input_ser_id =='job_card'){
     document.getElementById("pan_card").value = '';
     document.getElementById("passport_id").value = '';
     document.getElementById("voter_id").value = '';
     document.getElementById("tan_id").value = '';
     document.getElementById("trade_lic").value = '';
     document.getElementById("adhar_id").value = '';
     document.getElementById("driving_lic").value = '';
     document.getElementById("ration_card").value = '';
     document.getElementById("gov_id").value = '';
     document.getElementById("tin_id").value = '';
     document.getElementById("vat_id").value = '';
    }
    if (input_ser_id =='tan_id'){
     document.getElementById("pan_card").value = '';
     document.getElementById("passport_id").value = '';
     document.getElementById("job_card").value = '';
     document.getElementById("voter_id").value = '';
     document.getElementById("trade_lic").value = '';
     document.getElementById("adhar_id").value = '';
     document.getElementById("driving_lic").value = '';
     document.getElementById("ration_card").value = '';
     document.getElementById("gov_id").value = '';
     document.getElementById("tin_id").value = '';
     document.getElementById("vat_id").value = '';
     }
    if (input_ser_id =='trade_lic'){
     document.getElementById("pan_card").value = '';
     document.getElementById("passport_id").value = '';
     document.getElementById("job_card").value = '';
     document.getElementById("tan_id").value = '';
     document.getElementById("voter_id").value = '';
     document.getElementById("adhar_id").value = '';
     document.getElementById("driving_lic").value = '';
     document.getElementById("ration_card").value = '';
     document.getElementById("gov_id").value = '';
     document.getElementById("tin_id").value = '';
     document.getElementById("vat_id").value = '';
   }
    if (input_ser_id =='adhar_id'){
     document.getElementById("pan_card").value = '';
     document.getElementById("passport_id").value = '';
     document.getElementById("job_card").value = '';
     document.getElementById("tan_id").value = '';
     document.getElementById("voter_id").value = '';
     document.getElementById("trade_lic").value = '';
     document.getElementById("driving_lic").value = '';
     document.getElementById("ration_card").value = '';
     document.getElementById("gov_id").value = '';
     document.getElementById("tin_id").value = '';
     document.getElementById("vat_id").value = '';
    }
    if (input_ser_id =='driving_lic'){
     document.getElementById("pan_card").value = '';
     document.getElementById("passport_id").value = '';
     document.getElementById("job_card").value = '';
     document.getElementById("tan_id").value = '';
     document.getElementById("voter_id").value = '';
     document.getElementById("adhar_id").value = '';
     document.getElementById("trade_lic").value = '';
     document.getElementById("ration_card").value = '';
     document.getElementById("gov_id").value = '';
     document.getElementById("tin_id").value = '';
     document.getElementById("vat_id").value = '';
    }
    if (input_ser_id =='ration_card'){
     document.getElementById("pan_card").value = '';
     document.getElementById("passport_id").value = '';
     document.getElementById("job_card").value = '';
     document.getElementById("tan_id").value = '';
     document.getElementById("voter_id").value = '';
     document.getElementById("adhar_id").value = '';
     document.getElementById("driving_lic").value = '';
     document.getElementById("trade_lic").value = '';
     document.getElementById("gov_id").value = '';
     document.getElementById("tin_id").value = '';
     document.getElementById("vat_id").value = '';
    }
    if (input_ser_id =='gov_id'){
     document.getElementById("pan_card").value = '';
     document.getElementById("passport_id").value = '';
     document.getElementById("job_card").value = '';
     document.getElementById("tan_id").value = '';
     document.getElementById("voter_id").value = '';
     document.getElementById("adhar_id").value = '';
     document.getElementById("driving_lic").value = '';
     document.getElementById("ration_card").value = '';
     document.getElementById("trade_lic").value = '';
     document.getElementById("tin_id").value = '';
     document.getElementById("vat_id").value = '';
    }
    if (input_ser_id =='tin_id'){
     document.getElementById("pan_card").value = '';
     document.getElementById("passport_id").value = '';
     document.getElementById("job_card").value = '';
     document.getElementById("tan_id").value = '';
     document.getElementById("voter_id").value = '';
     document.getElementById("adhar_id").value = '';
     document.getElementById("driving_lic").value = '';
     document.getElementById("ration_card").value = '';
     document.getElementById("gov_id").value = '';
     document.getElementById("trade_lic").value = '';
     document.getElementById("vat_id").value = '';
     }
    if (input_ser_id =='vat_id'){
     document.getElementById("pan_card").value = '';
     document.getElementById("passport_id").value = '';
     document.getElementById("job_card").value = '';
     document.getElementById("tan_id").value = '';
     document.getElementById("voter_id").value = '';
     document.getElementById("adhar_id").value = '';
     document.getElementById("driving_lic").value = '';
     document.getElementById("ration_card").value = '';
     document.getElementById("gov_id").value = '';
     document.getElementById("tin_id").value = '';
     document.getElementById("trade_lic").value = '';
    }
   }
  
  function show(str){
                document.getElementById('sh2').style.display = 'none';
                document.getElementById('sh1').style.display = 'block';
            }
  function show2(sign){
                document.getElementById('sh2').style.display = 'block';
                document.getElementById('sh1').style.display = 'none';
            }
  
  
  // Group CIF Search
  
  function grpsrchopt() { 
  
    var Placeholdertext = document.getElementById ("grp_searchname");
      
  
   var result1 = document.querySelector('input[name="src_grpby"]:checked').value;
   
   if(result1=="searchopt3"){
     document.getElementById('grp_sh1').style.display = 'none';
     document.getElementById('sh3').style.display = 'block';
   }
   else{
      if(result1=="src_grpby_name"){
       Placeholdertext.placeholder = "Search By Name";
       }
       if(result1=="src_grpby_phn_no"){
          Placeholdertext.placeholder = "Search By Phone No";
       }
       if(result1=="src_grpby_dpac_no"){
          Placeholdertext.placeholder = "Search By Deposit A/C No";
       }
       if(result1=="src_grpby_lnac_no"){
          Placeholdertext.placeholder = "Search By Loan A/C No";
       }
  
     document.getElementById('sh1').style.display = 'block';
     document.getElementById('sh3').style.display = 'none';
   }
  }
  
  
  
  function show(str){
    document.getElementById('sh2').style.display = 'none';
    document.getElementById('grp_sh1').style.display = 'block';
  }
  function show2(sign){
    document.getElementById('sh2').style.display = 'block';
    document.getElementById('grp_sh1').style.display = 'none';
  }
  
   function isblanc(){
     if($("#input_2000_curren").val()==''){
       $("#input_2000_curren").val(0);
     }
      if($("#input_500_curren").val()==''){
       $("#input_500_curren").val(0);
     }
      if($("#input_200_curren").val()==''){
       $("#input_200_curren").val(0);
     }
      if($("#input_100_curren").val()==''){
      $("#input_100_curren").val(0);
    }
     if($("#input_50_curren").val()==''){
      $("#input_50_curren").val(0);
    }
     if($("#input_20_curren").val()==''){
      $("#input_20_curren").val(0);
    }
     if($("#input_10_curren").val()==''){
      $("#input_10_curren").val(0);
    }
     if($("#input_5_curren").val()==''){
      $("#input_5_curren").val(0);
    }
     if($("#input_1con_curren").val()==''){
      $("#input_1con_curren").val(0);
    }
     if($("#output_2000_curren").val()==''){
      $("#output_2000_curren").val(0);
    }
     if($("#output_500_curren").val()==''){
      $("#output_500_curren").val(0);
    }
     if($("#output_200_curren").val()==''){
      $("#output_200_curren").val(0);
    }
     if($("#output_100_curren").val()==''){
      $("#output_100_curren").val(0);
    }
     if($("#output_50_curren").val()==''){
      $("#output_50_curren").val(0);
    }
     if($("#output_20_curren").val()==''){
      $("#output_20_curren").val(0);
    }
     if($("#output_10_curren").val()==''){
      $("#output_10_curren").val(0);
    }
     if($("#output_5_curren").val()==''){
      $("#output_5_curren").val(0);
    }
     if($("#output_1con_curren").val()==''){
      $("#output_1con_curren").val(0);
    }
    const elContent = document.querySelector("#Cash_Denomination");
    elContent.classList.toggle("is-hidden");
   }