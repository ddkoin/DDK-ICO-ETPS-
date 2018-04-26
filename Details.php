<?php require_once('func/config.php'); 
checkUser($main_conn);
$TITLE_PAGE="Affiliate member details";
$uid=getSession("USER_ID",$main_conn,"0");
$ID=getQueryString("ID",$main_conn,"0");
$html_deposits=createDetailPanel($ID,0,$main_conn);


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

js;
?>


    <div class="panel panel-success">
        <div class="panel-heading">
            <h2><?php echo($TITLE_PAGE)?></h2>
            <div class="options">

            </div>
        </div>
        <div class="panel-body panel-no-padding"  id="withdraw-panel">
            <?php echo($html_deposits)?>
        </div></div>
<?php


 $MainContent = ob_get_contents();
 ob_end_clean();
 
 include("master.php");

?>