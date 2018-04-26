<?php require_once('func/config.php'); 
checkUser($main_conn);
$TITLE_PAGE="List of Group Income";
$uid=getSession("USER_ID",$main_conn,"0");
$data=flushBinaryBonus($uid,$main_conn);
$html_deposits=report_panel(19,$main_conn);
$USERNAME=getSession("USERNAME",$main_conn,"");
$css_="danger";

if($data['refreshed']=='0' && intval($data['unitpair'])<20000){
  $data=flushBinaryBonusBackOffice($uid,$USERNAME,$main_conn);  
    
}

if($data['unitpair']>=BINARY_START_FROM){
    $css_="success";
}
$available=($data['commission']- $data['transfered']);

// REFRESH B BONUIS
function GetTotalSales_2($UserID,$SType,$vMonth,$vYear,$conn){
    $SQL="";
    $ReturnVal="";
    $UserID=($UserID=="")?"0":$UserID;
    $SQL="SELECT sum(quantity) as TOTAL FROM buy WHERE account_id in(".$UserID.")  ";
    if($SType==1){
        $SQL=$SQL." AND Month(insert_time)=MONTH(CURRENT_DATE()) AND Year(insert_time)=YEAR(CURRENT_DATE()) ";

    }else if($SType==2 && $vMonth>0 && $vYear>0){
        $SQL=$SQL." AND Month(insert_time)=".$vMonth." AND Year(insert_time)=".$vYear;
    }
   // echo($SQL);
    $RS=getRowsSingleSQL($SQL,$conn);
    if($RS){
        $ReturnVal=$RS["TOTAL"];
    }else{
        $ReturnVal="0.00";
    }

    return $ReturnVal;
}
function flushBinaryBonusBackOffice($uid,$username='',$conn){
    
  
        $UserID=$uid;
        $Left_IDs=array();
        $Right_IDs=array();
        $unit_pair=0;
        $Left_U=CountDownLineID_Num($UserID,1,$Left_IDs,$conn);
        $Right_U=CountDownLineID_Num($UserID,2,$Right_IDs,$conn);
        $left_ids=implode(",",$Left_IDs);
        $right_ids=implode(",",$Right_IDs);

        $Left_T=GetTotalSales_2($left_ids,0,0,0,$conn);
        $Right_T=GetTotalSales_2($right_ids,0,0,0,$conn);
        
        $side=array("lft","rgt");
        $obj=array();
        $obj['type']='binaries';
        $obj['int_uid']=$uid;
        $data=getRowsSingle($obj,$conn);

        $data_old= $data;
        //$Left_T=$data['n_lft'];
        //$Right_T=$data['n_rgt'];

        $transferred=getTotalBinaryWithdraw($uid,$conn);
        $d_amount=($transferred['dinar_amount']=='')?0:$transferred['dinar_amount'];
        $us_amount=($transferred['amount']=='')?0:$transferred['amount'];
        $obj_g=array();
        if($data){
            $obj=array();
            $obj['type']='binaries';

            $obj['lft']=$Left_T;
            $obj['rgt']=$Right_T;
            $obj['n_lft']=$Left_T;
            $obj['n_rgt']=$Right_T;
            $obj['refreshed']=1;
            $unit_pair=calculateUnitPair($Left_T,$Right_T);
            $obj['unitpair']=$unit_pair;
            $commission=($unit_pair>=15)?$unit_pair*15:0;
            //$obj['commission']=$commission;
            $obj['transfered']=$d_amount;
            $obj['transferred_amount']=$us_amount;
            $obj['pk']='uid';
            $obj['pk_val']=$uid;
            $check=date('Y-m-d H:i:s',strtotime("-4 hours"));  
            $obj['last_update']=$check;
            // print_r($obj);
            safeUpdateSQL($obj,$conn);
            $obj_g=$obj;
        }else{
            $obj=array();
            $obj['type']='binaries';
            $obj['uid']=$uid;
            $obj['lft']=$Left_T;
            $obj['rgt']=$Right_T;
            $obj['n_lft']=$Left_T;
            $obj['n_rgt']=$Right_T;
            $unit_pair=calculateUnitPair($Left_T,$Right_T);
            $obj['unitpair']=$unit_pair;
            $commission=($unit_pair>=15)?$unit_pair*15:0;
            //$obj['commission']=$commission;
            $obj['transfered']=$d_amount;
            $obj['transferred_amount']=$us_amount;
            $check=date('Y-m-d H:i:s',strtotime("-4 hours"));  
            $obj['last_update']=$check;
            // print_r($obj);
            safeSaveSQL($obj,$conn);
            $obj_g=$obj;
        }
        //die($unit_pair."AAAA");
        if($unit_pair>=149){
            $sql_da="SELECT max(achievement_ward) as awarded  FROM `diamondaward` where uid=".$uid;
            //echo($sql_da);
            $data_awarded=getRowsSingleSQL($sql_da,$conn);
            $total_past_award=intval($data_awarded['awarded']);
            $diamond=intval(getDiamondAward($unit_pair));
            $new_award=$diamond-$total_past_award;
            //echo($unit_pair."UNIT".$new_award."AAAA".$total_past_award."TOTAL".$diamond);
            if($new_award>0){
                $obj_new_award=array();
                $obj_new_award['type']='diamondaward';
                $obj_new_award['uid']=$uid;
                $obj_new_award['lft']=$obj_g['lft'];
                $obj_new_award['rgt']=$obj_g['rgt'];

                $obj_new_award['unitpair']=$unit_pair;

                $obj_new_award['commission']=$obj_g['commission'];
                $obj_new_award['transfered']=0;
                $obj_new_award['transferred_amount']=$obj_g['transferred_amount'];
                $obj_new_award['achievement_ward']=$diamond;
                // print_r($obj);
                safeSaveSQL($obj_new_award,$conn);
            }
        }
    
    $obj=array();
    $obj['type']='binaries';
    
    $obj['int_uid']=$uid;
    $data=getRowsSingle($obj,$conn);

    

   // NEW
            $obj_l=array();
            $obj_l['type']='brlog';
            $obj_l['uid']=$uid;
            $obj_l['lft']=$Left_T;
            $obj_l['rgt']=$Right_T;
            $obj_l['o_lft']=$data_old['lft'];
            $obj_l['o_rgt']=$data_old['rgt'];
            $obj_l['username']=$username;
            $obj_l['ut']=now();
            // print_r($obj);
            safeSaveSQL($obj_l,$conn);

    //LOG 




    return $data;
}
// END
$CSS.=<<<css
<link href="assets/plugins/form-daterangepicker/daterangepicker-bs3.css" type="text/css" rel="stylesheet"> 
css;
$JS_FILE.=<<<js
<script src="assets/plugins/shufflejs/modernizr.custom.min.js"></script>  <!-- Dependency for Shuffle.js -->
<script src="assets/plugins/shufflejs/jquery.shuffle.min.js"></script>    <!-- Shuffle.js -->

<script src="assets/demo/demo-extras-gallery.js"></script>
<script src="assets/plugins/form-daterangepicker/daterangepicker.js"></script>
<script src="assets/plugins/form-daterangepicker/moment.min.js"></script>
<script src="js/fxerp.js?v=113222"></script>
js;
$JS=<<<js

wrap_js_function();

js;


?>

<h2 class="page-title">Group Reward </h2>


<h1>This Section is under modification </h1>

    <section class="widget">

        <header>

            <h4>

                Group Reward Stats
                <small>

                    Based on Current Trades

                </small>

            </h4>

<div class="row">


                <div class="col-lg-12">
                    <div class="alert alert-success">
                        <?php
                        $last_update_time=strtotime($data['last_update']);
                        ?>
                        Group Reward was last updated no:<strong><u><?php echo date('l dS \o\f F Y h:i:s A', $last_update_time)?></u></strong>
                    </div>

                    <?php

                    $date_a = date('l dS \o\f F Y h:i:s A', strtotime($data['last_update'] . ' + 3 hours'));
                    ?>
                    <div class="alert alert-warning">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        Next Update will be after :<strong><u><?php echo($date_a)?></u></strong>
                    </div>
                </div>
            </div>

        </header>

        <div class="body no-margin">

  

                <div class="row">

                    <div class="col-lg-12">


                        <div class="body">

                            <div class="table-responsive">

                                <table class="table table-striped table-editable no-margin mb-sm" width="100%">

                                    <tbody><tr class="info">

                                        <th><strong></strong></th>

                                        <th><strong>Left Sale (DNC)</strong></th>

                                        <th><strong>Right Sale (DNC)</strong></th>



                                    </tr>

                                    <tr>

                                        <td>Username: <strong><?php echo getSession("USERNAME",$main_conn)?></strong>(me)</td>

                                        <td><span class="label label-<?php echo($css_)?>"><?php echo $data['lft']?></span></td>

                                        <td><span class="label label-<?php echo($css_)?>"><?php echo $data['rgt']?></span></td>



                                    </tr>

                                    <tr>

                                        <td>Unit Pair</td>

                                        <td><span class="label label-<?php echo($css_)?>"><?php echo $data['unitpair']?></span></td>

                                        <td><span class="label label-<?php echo($css_)?>"><?php echo $data['unitpair']?></span></td>



                                    </tr>

                                    <tr>

                                        <td>Commission</td>

                                        <td><span class="label label-<?php echo($css_)?>"><?php echo $data['commission']?></span></td>

                                        <td>--</td>



                                    </tr>

                                    <tr>

                                        <td>Transferred So far</td>

                                        <td colspan="2"><?php echo $data['transfered']?> DNC (<?php echo getCurSymbol()?><?php echo $data['transferred_amount']?> )</td>





                                    </tr>

                                    <tr>

                                        <td>Available for Transfer </td>

                                        <td colspan="2"><?php echo $available ?> DNC </td>





                                    </tr>

                                    <tr>

                                        <td>Current Price (We Buy) </td>

                                        <td colspan="2"><?php echo getCurSymbol()?><?php echo getGoldBarSellPrice($main_conn)?></td>





                                    </tr>
                                    <tr>

                                        <td>Available Bonus for transfer (USD)</td>

                                        <td colspan="2"><?php echo getCurSymbol()?><?php echo number_format( $available*getGoldBarSellPrice($main_conn),2)?></td>





                                    </tr>
                                    <tr>

                                        <td>Weekly Limit</td>

                                        <td colspan="2"><?php echo BINARY_WITHDRAW_LIMIT ?> DNC (Transferred  this week: <?php echo(getWeeklyBinaryBonus($uid,$main_conn)) ?> DNC)</td>





                                    </tr>
                                    <tr>

                                        <td>Transfer Amount (DNC)</td>

                                        <td colspan="2"><input type="text" name="withdraw" id="withdraw" class="form-control input-sm" value="<?php echo($available)?>"></td>





                                    </tr>

                                    <tr>

                                        <td>Action</td>

                                        <td><a class="btn btn-gold" href="javascript:void(0)" onclick="withdraw_binary('withdraw','<?php echo($data['id'])?>')"><b>Withdraw to DNC/USD Wallet</b></a></td>



                                        <td></td>



                                    </tr>

                                    </tbody>

                                </table></div>











                        </div>
                    </div>
                </div>
    
    </section>


<div class="clear"></div>

	<?php echo($html_deposits)?>

<?php


 $MainContent = ob_get_contents();
 ob_end_clean();
 
 include("master.php");

?>