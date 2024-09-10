<?php
ob_start();
session_start();
require_once('../../method.php');
require_once('../../config.php');
if(isset($_POST['pUnit_Type'])){
    echo json_encode(qry_lst_out("Select Id,Type_Name From mst_unit_type Where Isactive=1;"));
}
if(isset($_POST['pUnit_Name_add'])){
    echo json_encode(qry_lst_out("Call USP_ADD_UNIT(". $_POST['pUnit_iser_Id'] .",'". $_POST['pUnit_Name_add'] ."','". $_POST['pUnit_srt_add'] ."',". $_POST['pUnit_typ_add'] .",". $_SESSION['user_id'] .",". $_POST['pInser_mode'] .");"));
}
if(isset($_POST['pLoad_unit_tbl'])){
    echo json_encode(qry_lst_out("Call USP_GET_UNIT_LIST(null,1);"));
}
if(isset($_POST['pUnit_id_pop'])){
    echo json_encode(qry_lst_out("Call USP_GET_UNIT_LIST(". $_POST['pUnit_id_pop'] .",2);"));
}
if(isset($_POST['pEdit_unit_Id'])){
    echo json_encode(qry_lst_out("Call USP_ADD_UNIT(". $_POST['pEdit_unit_Id'] .",'". $_POST['pEdit_Unit_Name'] ."','". $_POST['pUnit_shor_name'] ."',". $_POST['pUnit_Edit_Type'] .",". $_SESSION['user_id'] .",". $_POST['pUnit_edite_mode'] .");"));
}
if(isset($_POST['pAdd_Brand_Id'])){
    echo json_encode(qry_lst_out("Call USP_ADD_EDIT_BRAND(". $_POST['pAdd_Brand_Id'] .",'". $_POST['pBrand_Add_Name'] ."',". $_SESSION['user_id'] .",". $_POST['pBrand_Add_Mode'] .");"));
}
if(isset($_POST['pLoad_brand'])){
    echo json_encode(qry_lst_out("Select Id,Brand_name From mst_item_brand Where Isactive=1;"));
}
if(isset($_POST['pEdit_brand_data'])){
    echo json_encode(qry_lst_out("Select Id,Brand_name From mst_item_brand Where Isactive=1 And Id=". $_POST['pEdit_brand_data'] .";"));
}
if(isset($_POST['pCat_Id'])){
    echo json_encode(qry_lst_out("Call USP_ADD_EDIT_CATAG(". $_POST['pCat_Id'] .",'". $_POST['pCat_Name'] ."',". $_SESSION['user_id'] .",". $_POST['pCat_Mode'] .");"));
}
if(isset($_POST['pCatTbl_list'])){
    echo json_encode(qry_lst_out("Select Id,Type_Name From mst_item_catag Where Isactive=1;"));
}
if(isset($_POST['pEdit_cat_Id'])){
    echo json_encode(qry_lst_out("Select Id,Type_Name From mst_item_catag Where Isactive=1 And Id=". $_POST['pEdit_cat_Id'] .";"));
}
if(isset($_POST['pCat_drop_list'])){
    echo json_encode(qry_lst_out("Select Id,Type_Name From mst_item_catag Where Isactive=1;"));
}
if(isset($_POST['pAdd_sub_cat_id'])){
    echo json_encode(qry_lst_out("Call USP_ADD_EDIT_SUBCAT(". $_POST['pAdd_sub_cat_id'] .",'". $_POST['pAdd_sub_Cat_Name'] ."',". $_POST['pAdd_sub_catg'] .",". $_SESSION['user_id'] .",". $_POST['pAdd_Sub_Cat_Mode'] .");"));
}
if(isset($_POST['pSub_Cat_fetch'])){
    echo json_encode(qry_lst_out("Select m.Id,m.sub_Cat_Name,c.Type_Name,m.Type_Id From mst_item_sub_cat m 
    join mst_item_catag c on c.id=m.Type_Id Where m.Isactive=1 ;"));
}
if(isset($_POST['pEdit_sub_cat_Id'])){
    echo json_encode(qry_lst_out("Select Id,sub_Cat_Name,Type_Id From mst_item_sub_cat Where Isactive=1 And Id=". $_POST['pEdit_sub_cat_Id'] .";"));
}
if(isset($_POST['pWhare_Id'])){
    echo json_encode(qry_lst_out("Call USP_ADD_EDIT_WHAREHOUSE(". $_POST['pWhare_Id'] .",'". $_POST['pWhhare_Name'] ."',". $_SESSION['user_id'] .",". $_POST['pWhare_Mode'] .");"));
}
if(isset($_POST['pWhare_list'])){
    echo json_encode(qry_lst_out("Select Id,wharehouse_Name From mst_wharehouse Where is_Active=1;"));
}
if(isset($_POST['pEdit_whare_house'])){
    echo json_encode(qry_lst_out("Select Id,wharehouse_Name From mst_wharehouse Where is_Active=1 And Id=". $_POST['pEdit_whare_house'] .";"));
}
if(isset($_POST['pItem_Pur_Gl_drp'])){
    echo json_encode(mssql_query("Select Account_Id,CONVERT(varchar(100),Account_Code)+' - '+Account_Desc gl_Name From Acct_GL_Head WHere Head_ID in(93,94,95,96,97,98,99,100,101,102,103) order by Account_Code;"));
}
if(isset($_POST['pItem_sale_Gl_drp'])){
    echo json_encode(mssql_query("Select Account_Id,CONVERT(varchar(100),Account_Code)+' - '+Account_Desc gl_Name From Acct_GL_Head WHere Head_ID in(109,110,111,112,113,114,115,116,117) order by Account_Code;"));
}
if(isset($_POST['pItem_Cat_Id'])){
    echo json_encode(qry_lst_out("Select Id,sub_Cat_Name From mst_item_sub_cat Where Isactive=1 And Type_Id=".  $_POST['pItem_Cat_Id'] .";"));
}
if(isset($_POST['pItem_Name'])){
    echo json_encode(qry_lst_out("Call USP_ADD_ITEM_MASTER('". $_POST['pItem_Name'] ."',". $_POST['pItem_cat'] .",". $_POST['pItem_Sub_Cat'] .",". $_POST['pItem_Brand'] .",'". $_POST['pItem_Hsn'] ."',". $_POST['pItem_Sgst'] .",". $_POST['pItem_cgst'] .",". $_POST['pItem_Igst'] .",'". $_POST['pItem_BillName'] ."',". $_POST['pItem_Sale_Gl'] .",". $_POST['pItem_Pur_Gl'] .",". $_POST['pItem_Base_Val'] .",". $_POST['pItem_Base_Unit'] .",". $_POST['pItem_Unit1_Val'] .",". $_POST['pItem_Unit1'] .",". $_POST['pItem_Unit2_val'] .",". $_POST['pItem_Unit2'] .",". $_POST['pItem_Unit3_Val'] .",". $_POST['pItem_Unit3'] .",". $_POST['pItem_Stock_Unit'] .",". $_SESSION['user_id'] .");"));
}
if(isset($_POST['pItem_list_tab'])){
    echo json_encode(qry_lst_out("Select m.Item_Name,c.Type_Name,b.Brand_name,m.Item_Bill_Name From mst_item_maater m
    join mst_item_brand b on b.id=m.Item_Brand
    join mst_item_catag c on c.id=m.Item_cat
    order by m.id;"));
}
if(isset($_POST['pLoad_dash_Item'])){
    echo json_encode(qry_lst_out("Call USP_LOAD_DASH_ITEM();"));
}
if(isset($_POST['pCheck_fin_fd'])){
    echo json_encode(qry_lst_out("Call USP_CHECK_FIN_YEAR('". vtyp($_POST['pCheck_fin_fd'],'date') ."','". vtyp($_POST['pCheck_fin_td'],'date') ."');"));
}
if(isset($_POST['pPost_fin_fd'])){
    echo json_encode(qry_lst_out("Call USP_POST_FINANCIAL_YEAR('". vtyp($_POST['pPost_fin_fd'],'date') ."','". vtyp($_POST['pPost_fin_td'],'date') ."');"));
}
if(isset($_POST['pLoad_Party_purchase'])){
    echo json_encode(qry_lst_out("Select Id,Party_Name From mst_party_master Where Party_Type=1;"));
}
if(isset($_POST['pLoad_Item'])){
    echo json_encode(qry_lst_out("Select m.Id,concat(m.Item_Name,' - ',c.Type_Name) item_Name From mst_item_maater m
    join mst_item_catag c on c.Id=m.Item_cat;"));
}
if(isset($_POST['pItem_Load_Unit'])){
    echo json_encode(qry_lst_out("Call USP_GET_PRODUCT_UNIT(". $_POST['pItem_Load_Unit'] .");"));
}
if(isset($_POST['pLoad_Whare_h'])){
    echo json_encode(qry_lst_out("Select Id,wharehouse_Name From mst_wharehouse;"));
}
if(isset($_POST['pLoad_chalan_pur'])){
    echo json_encode(qry_lst_out("Select Id,chalan_No From trn_chalan_master WHere Ispurchase=0;"));
}
if(isset($_POST['pPur_Chalan_Id'])){
    echo json_encode(qry_lst_out("Call USP_FETCH_CHALAN_DTLS(". $_POST['pPur_Chalan_Id'] .");"));
}
if(isset($_POST['pFetch_Bank_Acct'])){
    echo json_encode(mssql_query("Select BankLedgr_ID,BankLedgr_Desc From Acct_BankLedger"));
}
if(isset($_POST['pMemsb_Id'])){
    echo json_encode(mssql_query("Select dbo.udf_GetSbBal(". $_POST['pMemsb_Id'] .",'". vtyp($_POST['pSale_Date'],'date') ."') as Balance"));
}
if(isset($_POST['pFetch_mem'])){
    echo json_encode(mssql_query("Select Member_ID,Member_Code,Member_Name,Relation_Name From Member_Master Where Cust_Type=3"));
}
if(isset($_POST['pFetch_Party_sale'])){
    echo json_encode(qry_lst_out("Select Id,concat(Party_Code,'-',Party_Name) As Party_Name From mst_party_master Where Party_Type=2;"));
}
if(isset($_POST['pFetch_cust_data'])){
    echo json_encode(mssql_query("Select Member_ID,Member_Code,Member_Name,Phone_No,Address From Member_Master Where Member_ID=". $_POST['pFetch_cust_data'] .""));
}
if(isset($_POST['pFetch_Party_Data'])){
    echo json_encode(qry_lst_out("Select Id,Party_Name,Party_Address,Party_Mobile,Party_GSTIN From mst_party_master Where Id=". $_POST['pFetch_Party_Data'] .";"));
}
if(isset($_POST['pStock_Item'])){
    echo json_encode(qry_lst_out("Call USP_GET_LIVE_STOCK(". $_POST['pStock_Item'] .",'". vtyp($_POST['pItem_Date'],'date') ."',". $_POST['pItem_Wareh_Id'] .",". $_SESSION['branch_id'] .");"));
}
if(isset($_POST['pCal_stock_Item'])){
    echo json_encode(qry_lst_out("Select UDF_CAL_CURR_STOCK('". vtyp($_POST['pItem_cal_Date'],'date') ."',". $_POST['pCal_stock_Item'] .",". $_POST['pCalStock_ware'] .",". $_SESSION['branch_id'] .",". $_POST['pCalStock_unit'] .") as stock;"));
}
if(isset($_POST['pSale_Item_Id'])){
    echo json_encode(qry_lst_out("Select Item_Sal_Gl,Item_Sgst,Item_cgst,item_Igst From mst_item_maater Where Id=". $_POST['pSale_Item_Id'] .";"));
}
if(isset($_POST['pPurchase_Item_Id'])){
    echo json_encode(qry_lst_out("Select Item_Pur_Gl,Item_Sgst,Item_cgst,item_Igst From mst_item_maater Where Id=". $_POST['pPurchase_Item_Id'] .";"));
}
if(isset($_POST['pFetch_mem_sbAcct'])){
    echo json_encode(mssql_query("Select Account_ID,Account_No,Ref_AcNo From Savings_Account Where Cust_ID=". $_POST['pFetch_mem_sbAcct'] ." And cust_type=3 And Prod_ID=1"));
}
if(isset($_POST['pPrint_org_ID'])){
    echo json_encode(mssql_query("Select Org_Name,Address,GSTIN From Organisation"));
}
if(isset($_POST['pSales_bill_id'])){
    echo json_encode(qry_lst_out("Call USP_GET_BILL_INFO(". $_POST['pSales_bill_id'] .",". $_POST['pPrint_Mode'] .");"));
}
if(isset($_POST['pLive_stock_ware'])){
    echo json_encode(qry_lst_out("Call USP_RPT_LIVE_STOCK('". vtyp(date("Y-m-d"),'date') ."',". $_POST['pLive_stock_ware'] .",". $_SESSION['branch_id'] .");"));
}
if(isset($_POST['pSale_Bill_Cancel'])){
    echo json_encode(qry_lst_out("Select Id,Sale_No,party_Name,tot_amt_net From trn_sales_master Where Sale_Date='". vtyp(date("Y-m-d"),'date') ."';"));
    // echo json_encode(qry_lst_out("Select Id,Sale_No,party_Name,tot_amt_net From trn_sales_master Where Sale_Date='2024-04-30';"));
}
if(isset($_POST['pUser_Branch'])){
    echo json_encode(mssql_query("Select * From Branch Where Branch_Sl in(Select Branch_Sl From InstallBranch)"));
}
if(isset($_POST['pCrt_user_br'])){
    $pass = password_hash($_POST['pcrt_user_pass'], PASSWORD_DEFAULT);
    echo json_encode(qry_lst_out("Call USP_ADD_USER('". vtyp($_POST['pcrt_user_Nm'],'str') ."','". $pass ."',". $_POST['pCrt_user_br'] .",". $_SESSION['user_id'] .",". $_POST['pUser_Mode'] .");"));
}
if(isset($_POST['pSales_ref_No'])){
    echo json_encode(qry_lst_out("Select UDF_GET_SALE_NO(". $_SESSION['branch_id'] .") as sales_no;"));
}
if(isset($_POST['pRate_Item_Id'])){
    echo json_encode(qry_lst_out("Select USP_GET_ITEM_RATE(". $_POST['pRate_Item_Id'] .",". $_POST['pRate_Item_Unit'] .",". $_SESSION['branch_id'] .") as rate;"));
}
if(isset($_POST['prpt_head'])){
    echo json_encode(mssql_query("Select Org_Name,Address From organisation"));
}
if(isset($_POST['pRpt_saler_fdate'])){
    $_SESSION['pRpt_saler_fdate'] = $_POST['pRpt_saler_fdate'];
    $_SESSION['pRpt_saler_tdate'] = $_POST['pRpt_saler_tdate'];
    $_SESSION['pRpt_sale_whare'] = $_POST['pRpt_sale_whare'];
    echo json_encode(qry_lst_out("Call USP_RPT_SALE_REGISTER('". $_POST['pRpt_saler_fdate'] ."','". $_POST['pRpt_saler_tdate'] ."',". $_POST['pRpt_sale_whare'] .",". $_SESSION['branch_id'] .");"));
}
if(isset($_POST['pRpt_Sales_Id'])){
    echo json_encode(qry_lst_out("Call USP_GET_PRINT_DATA(". $_POST['pRpt_Sales_Id'] .",null);"));
}
if(isset($_POST['pRpt_pur_reg_fdate'])){
    $_SESSION['pRpt_pur_reg_fdate'] = $_POST['pRpt_pur_reg_fdate'];
    $_SESSION['pRpt_pur_reg_todate'] = $_POST['pRpt_pur_reg_todate'];
    $_SESSION['pRpt_pur_reg_ware'] = $_POST['pRpt_pur_reg_ware'];
    echo json_encode(qry_lst_out("Call USP_RPT_PURCHASE_REGISTER('". $_POST['pRpt_pur_reg_fdate'] ."','". $_POST['pRpt_pur_reg_todate'] ."',". $_POST['pRpt_pur_reg_ware'] .",". $_SESSION['branch_id'] .",null);"));
}
if(isset($_POST['rpt_chalan_fdate'])){
    $_SESSION['rpt_chalan_fdate'] = $_POST['rpt_chalan_fdate'];
    $_SESSION['rpt_chalan_todate'] = $_POST['rpt_chalan_todate'];
    $_SESSION['pRpt_chalan_whare'] = $_POST['pRpt_chalan_whare'];
    echo json_encode(qry_lst_out("Call USP_RPT_CHALAN_REGISTER('". $_POST['rpt_chalan_fdate'] ."','". $_POST['rpt_chalan_todate'] ."',". $_POST['pRpt_chalan_whare'] .",". $_SESSION['branch_id'] .",null);"));
}
if(isset($_POST['pLoad_item_cat_stock'])){
    echo json_encode(qry_lst_out("Select Id,Type_Name From mst_item_catag Where Isactive=1 order by Id;"));
}
if(isset($_POST['pRpt_stock_fdate'])){
    $_SESSION['pRpt_stock_fdate']= $_POST['pRpt_stock_fdate'];
    $_SESSION['pRpt_stock_td'] = $_POST['pRpt_stock_td'];
    $_SESSION['pRpt_stock_cat'] = $_POST['pRpt_stock_cat'];
    $_SESSION['pRpt_stock_ware'] = $_POST['pRpt_stock_ware'];
    $_SESSION['pItem_Stock_Unitr'] = $_POST['pItem_Stock_Unitr'];
    echo json_encode(qry_lst_out("Call USP_GET_FINAL_STOCK('". $_POST['pRpt_stock_fdate'] ."','". $_POST['pRpt_stock_td'] ."',". $_POST['pRpt_stock_ware'] .",". $_SESSION['branch_id'] .",". $_POST['pRpt_stock_cat'] .",". $_POST['pItem_Stock_Unitr'] .");"));
}
if(isset($_POST['pVouch_GL_Get'])){
    echo json_encode(mssql_query("Select Account_ID,CONVERT(varchar(100),Account_Code)+' - '+Account_Desc gl_Name From Acct_GL_Head Where Head_ID in(104,105,106,117) order by Account_Code"));
}
if(isset($_POST['pSubGl_Count'])){
    echo json_encode(mssql_query("Select dbo.UDF_CHECK_PARTY(". $_POST['pSubGl_Count'] .") as sub_gl"));
}
if(isset($_POST['pFetch_Sub_GL'])){
    echo json_encode(mssql_query("Select Party_ID,Party_Nm From item_party_master Where Constitution_ID=". $_POST['pFetch_Sub_GL'] .""));
}
if(isset($_POST['pParty_Sb_Fetch'])){
    echo json_encode(mssql_query("Select Account_ID,Account_No,Ref_AcNo From Savings_Account Where Cust_ID=(Select Cust_Id From item_party_master Where Party_ID=". $_POST['pParty_Sb_Fetch']  ." )And cust_type=3 And Prod_ID=1"));
}
if(isset($_POST['pParty_Sb_Vouch'])){
    echo json_encode(mssql_query("Select Account_ID,Account_No,Ref_AcNo,Cur_Balance From Savings_Account Where Account_No=". $_POST['pParty_Sb_Vouch'] .""));
}
if(isset($_POST['pMis_bill_id'])){
    echo json_encode(qry_lst_out("Call USP_GET_MIS_PRINT_INFO(". $_POST['pMis_bill_id'] .");"));
}
if(isset($_POST['pSaleBill_Id'])){
    $message = array();
    foreach (qry_lst_out("Call USP_SALE_BILL_CANCEL(". $_POST['pSaleBill_Id'] .");") as $sale_No) {
        
        $pBill_No = $sale_No['Bill_No'];
        $sql = "exec USP_SALEBILL_CANCEL '". $pBill_No ."'";
        $result = sqlsrv_query($sqlconn,$sql);

        if($result==true){
            $message= ['errorNo'=>'0','Message'=>'Bill Calcel Successfully !'];
        }
        else{
            $message= ['errorNo'=>'-1','Message'=>'Some Error Found In Operation !'];
        }
    }
    echo json_encode($message);
}
if(isset($_POST['pItem_Stock_Units'])){
    echo json_encode(qry_lst_out("Select Id,Unit_Name From mst_unit Where IsActive=1 order by Id;"));
}
if(isset($_POST['pParty_GL'])){
    echo json_encode(mssql_query("Select Account_ID From Acct_GL_Head Where Account_Code= ". $_POST['pParty_GL'] ." "));
}
if(isset($_POST['pParty_type'])){
    echo json_encode(qry_lst_out("Call USP_ADD_PARTY_MASTER(". $_POST['pParty_type'] .",'". $_POST['pParty_Name'] ."','". $_POST['pParty_Add'] ."','". $_POST['pParty_Mob'] ."','". $_POST['pParty_GSTIN'] ."',". $_POST['pOpen_Bal'] .",". $_POST['pParty_Gl'] .",". $_SESSION['user_id'] .");"));
}
if(isset($_POST['pLoad_Party_Pay'])){
    echo json_encode(qry_lst_out("Select Id,concat(Party_Name,'-',Party_Code) As Party_Name From mst_party_master Where Party_Type=". $_POST['pLoad_Party_Pay'] .";"));
}
if(isset($_POST['pRpt_PartLedg_Fd'])){
    $_SESSION['pRpt_PartLedg_Fd'] = $_POST['pRpt_PartLedg_Fd'];
    $_SESSION['pRptLedg_Td'] = $_POST['pRptLedg_Td'];
    $_SESSION['pRpt_PartLedg_Type'] = $_POST['pRpt_PartLedg_Type'];
    $_SESSION['pRpt_PartLedg_Id'] = $_POST['pRpt_PartLedg_Id'];
    $_SESSION['pParty_Name'] = $_POST['pParty_Name'];
}
if(isset($_POST['pRpt_PartDlist_Fd'])){
    $_SESSION['pRpt_PartDlist_Fd'] = $_POST['pRpt_PartDlist_Fd'];
    $_SESSION['pRpt_partDlist_Td'] = $_POST['pRpt_partDlist_Td'];
    $_SESSION['pRpt_PartDlist_Type'] = $_POST['pRpt_PartDlist_Type'];
    $_SESSION['pType_Name'] = $_POST['pType_Name'];
}
if(isset($_POST['pItemWise_fd'])){
    $_SESSION['pItemWise_fd'] = $_POST['pItemWise_fd'];
    $_SESSION['pItemwise_td'] = $_POST['pItemwise_td'];
    $_SESSION['pItemwise_whare'] = $_POST['pItemwise_whare'];
    $_SESSION['pItemwise_cat'] = $_POST['pItemwise_cat'];
    $_SESSION['pItemwisep_unit'] = $_POST['pItemwisep_unit'];
    $_SESSION['pItemwise_cat_name'] = $_POST['pItemwise_cat_name'];
}
if(isset($_POST['rptopen_itemcat'])){
    $_SESSION['rptopen_itemcat'] = $_POST['rptopen_itemcat'];
    $_SESSION['rptopen_whare'] = $_POST['rptopen_whare'];
    $_SESSION['rptopen_catname'] = $_POST['rptopen_catname'];
    $_SESSION['rptopn_unit'] = $_POST['rptopn_unit'];
}
if(isset($_POST['pCatag_Id'])){
    echo json_encode(qry_lst_out("Select Id,Item_Name From mst_item_maater Where Item_cat=". $_POST['pCatag_Id'] .";"));
}
if(isset($_POST['pRpt_Itemwise_fd'])){
    $_SESSION['pRpt_Itemwise_fd'] = $_POST['pRpt_Itemwise_fd'];
    $_SESSION['rpt_itemwisetd'] = $_POST['rpt_itemwisetd'];
    $_SESSION['rptitemwise_item'] = $_POST['rptitemwise_item'];
    $_SESSION['rptitemwise_unit'] = $_POST['rptitemwise_unit'];
    $_SESSION['prptitemwise_iname'] = $_POST['prptitemwise_iname'];
    $_SESSION['itemwise_whare'] = $_POST['itemwise_whare'];
}
if(isset($_POST['pGstr_fd'])){
    $_SESSION['pGstr_fd'] = $_POST['pGstr_fd'];
    $_SESSION['pgetr_td'] = $_POST['pgetr_td'];
    $_SESSION['pgstr_wh'] = $_POST['pgstr_wh'];
}
if(isset($_POST['pGstr2a_fd'])){
    $_SESSION['pGstr2a_fd'] = $_POST['pGstr2a_fd'];
    $_SESSION['pgetr2a_td'] = $_POST['pgetr2a_td'];
    $_SESSION['pgstr2a_wh'] = $_POST['pgstr2a_wh'];
}
if(isset($_POST['pItemWise_GST_fd'])){
    $_SESSION['pItemWise_GST_fd'] = $_POST['pItemWise_GST_fd'];
    $_SESSION['pItemwise_GST_td'] = $_POST['pItemwise_GST_td'];
    $_SESSION['pItemwise_GST_whare'] = $_POST['pItemwise_GST_whare'];
    $_SESSION['pItemwise_GST_cat'] = $_POST['pItemwise_GST_cat'];
    $_SESSION['pItemwisep_GST_unit'] = $_POST['pItemwisep_GST_unit'];
    $_SESSION['pItemwise_GST_cat_name'] = $_POST['pItemwise_GST_cat_name'];
}
?>