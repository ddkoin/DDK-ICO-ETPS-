<?php require_once('func/config.php');
checkUser($main_conn);
$TITLE_PAGE="Coin-Payment";
$uid=getSession("USER_ID",$main_conn,"0");

$JS_FILE.=<<<js
<script src="assets/plugins/shufflejs/modernizr.custom.min.js"></script>  <!-- Dependency for Shuffle.js -->
<script src="assets/plugins/shufflejs/jquery.shuffle.min.js"></script>    <!-- Shuffle.js -->

<script src="assets/demo/demo-extras-gallery.js"></script>
<script src="assets/plugins/form-daterangepicker/daterangepicker.js"></script>
<script src="assets/plugins/form-daterangepicker/moment.min.js"></script>
<script src="js/fxerp.js?v=4"></script>
js;

$dnc_price=getGoldPrice($main_conn,"di");
$JS=<<<js

wrap_js_function();

js;

?>

<div class="row col-lg-8 col-lg-offset-2">
    <div class="widget">
        <div class="widget-header ori-bg">
            <div class="title">Deposit by Coin-Payment</div>
        </div>

        <div class="body">
<form method="post" action="payment-process-coin-payment.php">
    <div class="row">
        <div class="col-lg-12">
            <div class="form-group">
                <label for="product_id">Currency</label>
                <select name="m_curr_dnc" id="m_curr_dnc"  class="form-control">
                    <option value="DNC">DNC</option>
                </select>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="form-group">
                <label for="price">DNC Amount</label>
                <input name="m_amount_dnc" id="m_amount_dnc" value="1" onchange="update_amount(this.value)"    maxlength="10" class="form-control input-sm cur" data-parsley-type="digits" type="text">
            </div>




        </div>
        <div class="col-lg-12">
            <div class="form-group">
                <label for="price">Amount in USD(Value may vary as per market price)</label>
                <input name="m_amount" id="m_amount" value="<?php echo($dnc_price)?>"  maxlength="10" class="form-control input-sm cur" data-parsley-type="digits" type="text">
            </div>
            <input type="hidden" name="m_curr" id="m_curr" value="USD">
            <input type="hidden" name="unit" id="unit" value="<?php echo($dnc_price)?>">




        </div>




        <div class="col-lg-12">
            <div class="form-group">

                <input type="image" src="https://www.coinpayments.net/images/pub/buynow-wide-blue.png" alt="Buy Now with CoinPayments.net">
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