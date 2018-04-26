<?php
require_once('func/config.php');
$REPORT="";
checkUser($main_conn);
$USER_ID=getSession("USER_ID",$main_conn,"0");
$tbl_index_q=my_simple_crypt("tbl_index","e");
$tbl_id_q=my_simple_crypt("id","e");


$tbl_index=getQueryString($tbl_index_q,$main_conn);
$tbl_index_=$tbl_index;
//echo($tbl_id_q);
$tbl_id=getQueryString($tbl_id_q,$main_conn);
$tbl_id_=$tbl_id;
$tbl_index=my_simple_crypt($tbl_index,"d");
$tbl_id=my_simple_crypt($tbl_id,"d");
$token_field="id_tbl_index_".$tbl_id."_".$tbl_index;
$tbl_id_ee=my_simple_crypt($token_field,"e");
$data=null;
$report="";
if (isset($_REQUEST['confirm'])) {
    $submit = strip_tags($_REQUEST['confirm']);

    $confirm = getPost('confirm', $main_conn, '');
    $tbl_index_p = getPost($tbl_index_q, $main_conn, '');
    $tbl_id_p = getPost($tbl_id_q, $main_conn, '');

    $tbl_index_d=my_simple_crypt($tbl_index_p,"d");
    $tbl_id_d=my_simple_crypt($tbl_id_p,"d");
    $token_field_p="id_tbl_index_".$tbl_id_d."_".$tbl_index_d;
    $tbl_id_ee_p=my_simple_crypt($token_field_p,"e");
    if (isset($confirm) && $confirm == "Confirm") {
        $t_code=getPost($tbl_id_ee_p,$main_conn);
        if($t_code==getSession("token",$main_conn)){

            if($tbl_index_d==30){
                $confirm_code = getPost('confirm_code', $main_conn, '');
                if($confirm_code==""){
                    redirect("?".$tbl_index_q."=".$tbl_index."&".$tbl_id_q."=".$tbl_id);
                }
                $check_data="select * from transferdnc where status=0 and id=$tbl_id_d and uid=$USER_ID and pincode='".$confirm_code."' and pncode_time>='".now()."'";
                $data=getRowsSingleSQL($check_data,$main_conn);
               // print_r($data);
               // echo("+++++++++++++++++++++<BR>");
                //print_r($obj);
                //die("END");
                if($data['id']){
                    $obj_ = array();
                    $obj_['type'] = 'transferdnc';
                    $obj_['status'] = "1";
                    $date = date('Y-m-d H:i:s');
                    $newtimestamp = date('Y-m-d H:i:s',strtotime($date. ' - 5 minute'));

                    $obj_['pncode_time'] = $newtimestamp;
                    $obj_['pk'] = "id";
                    $obj_['pk_val'] = $tbl_id_d;

                    $sender=getUserDetails($USER_ID,$main_conn);
                    $receiver = getUserDetails($data["username"], $main_conn);
                    $amount = floatval($data["amount"]);
                    $bal=floatval($sender["balance_d"]);
                    $remain=$bal-$amount;
                    if($remain>=0){
                        safeUpdateSQL($obj_, $main_conn);
                     $wid_r = updateWalletTransDNC($receiver["id"], $amount, 0, $main_conn);
                    $wid_s = updateWalletTransDNC($sender["id"], -$amount, 0, $main_conn);
                    $token = md5(uniqid(rand(), true));
                    $_SESSION['token'] = $token;
                    walletTransactionDNC($receiver["id"], $amount, 5, $data['comments'] . '(Received  from ' . $sender["username"] . ')', $main_conn);

                    walletTransactionDNC($sender["id"], -$amount, 5, $data['comments'] . '(Transfer to user ' . $receiver["username"] . ')', $main_conn);
                    require_once(PATH . "tem/email-tem.php");
                    require_once('func/email.php');
                    $s_body = $usertransrecieverdnc['english']['body'];
                    $s_subject = $usertransrecieverdnc['english']['subject'];
                    $s_sms = $usertransrecieverdnc['english']['smsmessage'];
                    $s_body = preg_replace('/{sendername}/u', $sender['name'], $s_body);
                    $s_body = preg_replace('/{receivername}/u', $receiver['name'], $s_body);
                    $s_body = preg_replace('/{senderuser}/u', $sender['username'], $s_body);
                    $s_body = preg_replace('/{receiveruser}/u', $receiver['username'], $s_body);
                    $s_body = preg_replace('/{amount}/u', $amount, $s_body);
                    $s_body = preg_replace('/{status}/u', $status, $s_body);
                    $s_body = html_entity_decode($s_body);
                    $r_template = preg_replace('/{MESSAGE}/u', $s_body, $template);

                    $s_sms = preg_replace('/{sendername}/u', $sender['name'], $s_sms);
                    $s_sms = preg_replace('/{receivername}/u', $receiver['name'], $s_sms);
                    $s_sms = preg_replace('/{senderuser}/u', $sender['username'], $s_sms);
                    $s_sms = preg_replace('/{receiveruser}/u', $receiver['username'], $s_sms);
                    $s_sms = preg_replace('/{amount}/u', $amount, $s_sms);
                    $s_sms = preg_replace('/{status}/u', $status, $s_sms);
                    $s_sms = html_entity_decode($s_sms);


                       sendEmail($receiver['email'], $s_subject, $r_template);
                       redirect("Transaction-success.php");
                    }else{
                        $report="Insufficient funds ,your can't transfer";

                        $URL="Transaction-failed.php?error=".urlencode($report);
                        redirect("Transaction-failed.php");
                    }
                }else{
                    $report="Wrong Confirmation code or Form expire";
                    $URL="Transaction-failed.php?error=".urlencode($report);
                    redirect($URL);
                }
            }

        }else{
            $report="Form-Submission error";
            $URL="Transaction-failed.php?error=".urlencode($report);
            redirect($URL);
        }

    }
}else{
if($tbl_index==30){

    $obj=array();
    $obj['type']="transferdnc";
    $obj['int_status']='0';
    $obj['int_id']=$tbl_id;
    $obj['int_uid']=$USER_ID;
    $obj['dtgteq_pncode_time']=now();
    $data=getRowsSingle($obj,$main_conn,1);
    //print_r($data);
    if($data['id']){

    }else{
        redirect("wallets.php");
    }
}
}
$token = md5(uniqid(rand(), true));
$_SESSION['token'] = $token;
$JS_FILE.=<<<js
<script src="js/fxerp.js?v=2"></script>
js;

 ?>
 
 
 
     <h2 class="page-title">Confirm DNC Transfer</h2>
 


		<section class="widget">
<div class="alert alert-danger">The page will expire in next 5 minute.</div>
                    <div class="body">
               <div class="row">
                                
                                <div class="col-md-12">

                                    <form class="" method="post" action="confirm_transfer_dnc.php">



                                        <div class="form-group">
                                            <label for="username" class="cols-sm-2 control-label">Destination Username</label>
                                            <div class="cols-sm-10">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                                                    <input type="text" class="form-control" name="username" id="username" value="<?php echo($data['username'])?>" readonly placeholder="Destination Username">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="password" class="cols-sm-2 control-label">DNC Amount</label>
                                            <div class="cols-sm-10">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="fa fa-money fa-lg" aria-hidden="true"></i></span>
                                                    <input type="number" readonly="true" class="form-control" name="amount" id="amount" placeholder="DNC Amount" value="<?php echo($data['amount'])?>">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="confirm" class="cols-sm-2 control-label">CODE</label>
                                            <div class="cols-sm-10">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>
                                                    <input type="password" class="form-control" name="confirm_code" id="confirm_code" placeholder="Confirmation CODE:Get the CODE from your email">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group ">

                                            <input type="hidden" name="<?php echo($tbl_id_q)?>" value="<?php echo($tbl_id_)?>" />
                                            <input type="hidden" name="<?php echo($tbl_index_q)?>" value="<?php echo($tbl_index_)?>" />
                                            <input type="hidden" name="<?php echo($tbl_id_ee)?>" value="<?php echo($token)?>" />
                                            <input type="submit" id="confirm" name="confirm" class="btn btn-primary btn-lg btn-block login-button" value="Confirm">
                                        </div>

                                    </form>


            </div>

                    
        </div>
         
			
                    </div>
                </section>
				
                   
          
        
        
 <?php
 
 $TITLE =$H1." :: ". $TITLE;
 $MainContent = ob_get_contents();
 ob_end_clean();
 include("master.php");

?>
