<?php require_once('func/config.php'); 
checkUser($main_conn);
$TITLE_PAGE="Bank information";
$uid=getSession("USER_ID",$main_conn,"0");
$bank=checkBankDetails($uid,$main_conn);
$bank_id=$uid;
if(mysqli_num_rows($bank)>0){

}else{
	addBankDetails($uid,$main_conn);
}


$add_panel=createAddPanel($uid,8,$main_conn);

$JS_FILE.=<<<js
<script src="assets/plugins/shufflejs/modernizr.custom.min.js"></script>  <!-- Dependency for Shuffle.js -->
<script src="assets/plugins/shufflejs/jquery.shuffle.min.js"></script>    <!-- Shuffle.js -->

<script src="assets/demo/demo-extras-gallery.js"></script>
<script src="js/fxerp.js?v=2"></script>
js;
$JS=<<<js

wrap_js_function();

js;
?>
<div class="col-md-12">
    	<div class="panel panel-success">
			<div class="panel-heading">
				<h2>Update your Bank information</h2>
				<div class="options">

				</div>
			</div>
			<div class="panel-body panel-no-padding"  id="deposit-panel">
            <?php echo($add_panel)?>
            </div>
            </div>
</div>

<?php


 $MainContent = ob_get_contents();
 ob_end_clean();
 
 include("master.php");

?>