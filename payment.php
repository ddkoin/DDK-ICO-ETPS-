<?php require_once('func/config.php');
checkUser($main_conn);
$TITLE_PAGE="Payee Deposit";
$uid=getSession("USER_ID",$main_conn,"0");

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

<div class="row col-lg-8 col-lg-offset-2">
    <div class="widget">
        <div class="widget-header ori-bg">
            <div class="title">Deposit by PAYEE</div>
        </div>

        <div class="body">
<form method="post" action="payment-process.php">
    <div class="row">
        <div class="col-lg-12">
            <div class="form-group">
                <label for="product_id">Currency</label>
                <select name="m_curr" id="m_curr"  class="form-control">
                    <option value="USD">USD</option>
                </select>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="form-group">
                <label for="price">Amount</label>
                <input name="m_amount" id="m_amount" value=""  maxlength="10" class="form-control input-sm cur" data-parsley-type="digits" type="text">
            </div>
        </div>


        <div class="col-lg-12">
            <div class="form-group">

                <button type="submit" class="btn btn-success">Proceed to Payee Deposit</button>
            </div>
        </div>


    </div>
</form>


        </div>
    </div>
</div>
<?php


$MainContent = ob_get_contents();
ob_end_clean();

include("master.php");

?>