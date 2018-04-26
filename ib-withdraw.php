<?php require_once('func/config.php'); 
checkUser($main_conn);
$TITLE_PAGE="List of Withdraw request under this IB";
$uid=getSession("USER_ID",$main_conn,"0");
$html_deposits="";
if(isIB($uid,$main_conn)){


$html_deposits=report_panel(10,$main_conn);


$CSS.=<<<css
<link href="assets/plugins/form-daterangepicker/daterangepicker-bs3.css" type="text/css" rel="stylesheet"> 
css;
$JS_FILE.=<<<js
<script src="assets/plugins/shufflejs/modernizr.custom.min.js"></script>  <!-- Dependency for Shuffle.js -->
<script src="assets/plugins/shufflejs/jquery.shuffle.min.js"></script>    <!-- Shuffle.js -->

<script src="assets/demo/demo-extras-gallery.js"></script>
<script src="assets/plugins/form-daterangepicker/daterangepicker.js"></script>
<script src="assets/plugins/form-daterangepicker/moment.min.js"></script>
<script src="js/fxerp.js?v=6"></script>
js;
$JS=<<<js

wrap_js_function();

js;
}else{
	$html_deposits="<h1>Only for IB</h1>";
}
?>
<h2 class="page-title">Withdraw </h2>

<div class="alert alert-danger">
                            


<strong>Please note that all withdrawal request on Exchangers must be processed within <u>48 hours</u> on working day as per SOP under the IB Contract. </strong>
<br>If you cannot meet your obligations to honour the withdrawal request for whatever reason, your <u>ICE agreement maybe terminated</u> <br>Please contact partnership@etpswallet.gold should you have any issue meeting your obligations.
Further, in order not to jeopardise the clients, please let us assist you by just re-directing the request back to the company or other IBs to process the transaction without delay.
<h4>Thanks.</h4>
                           
                        </div>
	<?php echo($html_deposits)?>
    	
<?php


 $MainContent = ob_get_contents();
 ob_end_clean();
 
 include("master.php");

?>