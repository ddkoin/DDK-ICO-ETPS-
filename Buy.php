<?php require_once('func/config.php'); 
checkUser($main_conn);
$TITLE_PAGE="Buy";
$uid=getSession("USER_ID",$main_conn,"0");
//refresh_buy($uid);
$html_deposits=main_panel(37,$main_conn);

$CSS.=<<<css
<link href="assets/plugins/form-daterangepicker/daterangepicker-bs3.css" type="text/css" rel="stylesheet"> 
css;
$JS_FILE.=<<<js
<script src="assets/plugins/shufflejs/modernizr.custom.min.js"></script>  <!-- Dependency for Shuffle.js -->
<script src="assets/plugins/shufflejs/jquery.shuffle.min.js"></script>    <!-- Shuffle.js -->

<script src="assets/demo/demo-extras-gallery.js"></script>
<script src="assets/plugins/form-daterangepicker/daterangepicker.js"></script>
<script src="assets/plugins/form-daterangepicker/moment.min.js"></script>
<script src="js/fxerp.js?v=2"></script>
js;
$JS=<<<js

wrap_js_function();
$(document).ssTooltips('.demo', {
  bgColor: "#e74c3c",
  txtColor: "#fff",
  maxWidth: 300,
  borderRadius: 5,
  fontSize: 14
});
js;
?>
<h2 class="page-title">Purchase History</h2>
	<?php echo($html_deposits)?>
	
<?php


 $MainContent = ob_get_contents();
 ob_end_clean();
 
 include("master.php");

?>