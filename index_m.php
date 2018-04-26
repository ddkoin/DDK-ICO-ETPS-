<?php
require_once('func/config.php');
checkUser();//CHECK PERMISSION
$uid=getSession("USER_ID","0");
$gold_price=getGoldBarPrice();
$user_details=getUserDetails($uid);
$obj_list=array();
$uid=getSession("USER_ID","0");
$Wallets=getWallets($uid,"USD");
$Wallets=mysqli_fetch_array($Wallets);
$obj_p=array();
$obj_p['type']="product";

$product=getRows($obj_p);

$obj_list=array();
$obj_list['type_index']=1;

$html="<div  class=\"row\">";
$html.="<div class=\"col-lg-12\">";

$html.="<div class=\"panel panel-success\">";
//$html.="<div class=\"panel-heading\"><h2>ETPS List</h2></div>";
$html.="<div class=\"panel-body\" id=\"buy-panel\">";

$html.=getList_($obj_list,20,10,1);
$html.="</div>";
$html.="</div>";
$html.="</div>";

$etps_count_sql="SELECT sum(quantity) from buy where account_id=".$uid;
$etps_count_data=getRowsSingleSQL($etps_count_sql);
$etps_count=null2zero($etps_count_data[0]);
$gain_usd=0;

$ref_count_sql="SELECT count(uid) FROM  `referral` WHERE pid =".$uid."";
$ref_count_data=getRowsSingleSQL($ref_count_sql);
$ref_count_num=null2zero($ref_count_data[0]);
$gain_per=getGainAverage($uid,$gain_usd);
$CSS.=<<<css
<link href="assets/plugins/form-daterangepicker/daterangepicker-bs3.css" type="text/css" rel="stylesheet">
css;
$JS_FILE.=<<<js
<script src="assets/plugins/shufflejs/modernizr.custom.min.js"></script>  <!-- Dependency for Shuffle.js -->
<script src="assets/plugins/shufflejs/jquery.shuffle.min.js"></script>    <!-- Shuffle.js -->


<script src="assets/plugins/form-daterangepicker/daterangepicker.js"></script>
<script src="assets/plugins/form-daterangepicker/moment.min.js"></script>
<script src="js/fxerp.js?v=7"></script>
<script src="js/index.js"></script>


<script src="js/chat.js"></script>
js;

$JS_FI=<<<js
<script>
        var socket_q = io('https://nodejs.dinardirham.com:8280/');
        //var socket = io('http://127.0.0.1:8284/');

        var Main2 = (function(){
            var quotesList = ['EURUSDf', 'USDJPYf', 'GBPUSDf', 'EURJPYf', 'GBPJPYf'];
            var currentState_2 = {};

            var timeouts_2_2 = {};
            return {
                init:function(){
                    for(var i=0; i<quotesList.length; i++){

                        socket_q.emit('quotes.sub', {symbol:quotesList[i]});
                      

                        var id = document.getElementById('table_content');
                        var el = document.createElement('tr');
                        el.innerHTML = "<td>"+quotesList[i]+"</td>" +
                                "<td id='"+quotesList[i]+"_bid'></td>" +
                                "<td id='"+quotesList[i]+"_spread'></td>" +
                                "<td id='"+quotesList[i]+"_ask'></td>";
                        id.appendChild(el);
                    }

                    socket_q.on('a', function(res_2){
                        if (res_2.type.indexOf('spread') !== -1) {
                            document.getElementById(res_2.data.symbol+'_spread').innerHTML = res_2.data.spread;
                        }

                        if (currentState_2.hasOwnProperty(res_2.data.symbol+'_bid')) {

                            if (timeouts_2_2.hasOwnProperty(res_2.data.symbol+'_bid')) {
                                clearTimeout(timeouts_2_2[res_2.data.symbol+'_bid']);
                            }

                            if (res_2.data.bid> currentState_2[res_2.data.symbol+'_bid']) {
                                document.getElementById(res_2.data.symbol+'_bid').parentElement.className = 'up';
                                document.getElementById(res_2.data.symbol+'_bid').className = 'arrow-up';
                            } else {
                                document.getElementById(res_2.data.symbol+'_bid').parentElement.className = 'down';
                                document.getElementById(res_2.data.symbol+'_bid').className = 'arrow-down';
                            }

                            timeouts_2_2[res_2.data.symbol+'_bid'] = setTimeout(function(){
                                document.getElementById(res_2.data.symbol+'_bid').parentElement.className = 'no';
                                document.getElementById(res_2.data.symbol+'_bid').className = 'unchanged';
                            }, 1e3)
                        }

                        currentState_2[res_2.data.symbol+'_bid'] = res_2.data.bid;
                        currentState_2[res_2.data.symbol+'_ask'] = res_2.data.ask;

                        if (res_2.data.bid) {
                            var bidStr = res_2.data.bid.toString();
                            document.getElementById(res_2.data.symbol+'_bid').innerHTML = bidStr.substring(0, bidStr.length -1);
                            document.getElementById(res_2.data.symbol+'_bid').innerHTML += '<sup>' + (parseInt(bidStr[bidStr.length - 1])) + '</sup>';
                        }

                        if (res_2.data.ask) {
                            var askStr = res_2.data.ask.toString();
                            document.getElementById(res_2.data.symbol+'_ask').innerHTML = askStr.substring(0, askStr.length -1);
                            document.getElementById(res_2.data.symbol+'_ask').innerHTML += '<sup>' + (parseInt(askStr[askStr.length - 1])) + '</sup>';
                        }
                    });
                }
            }
        })();
         var socket_3 = io('https://nodejs.dinardirham.com:8680/');
        //var socket = io('http://127.0.0.1:8284/');

        var Main3 = (function(){
            var quotesList = ['EURUSD', 'USDJPY', 'GBPUSD', 'EURJPY', 'GBPJPY'];
            var currentState_3 = {};

            var timeouts_3 = {};
            return {
                init:function(){
                    for(var i=0; i<quotesList.length; i++){

                        socket_3.emit('quotes.sub', {symbol:quotesList[i]});


                        var id = document.getElementById('table_content_3');
                        var el = document.createElement('tr');
                        el.innerHTML = "<td>"+quotesList[i]+"</td>" +
                                "<td id='"+quotesList[i]+"_bid'></td>" +
                                "<td id='"+quotesList[i]+"_spread'></td>" +
                                "<td id='"+quotesList[i]+"_ask'></td>";
                        id.appendChild(el);
                    }

                    socket_3.on('a', function(res_3){
                        if (res_3.type.indexOf('spread') !== -1) {
                            document.getElementById(res_3.data.symbol+'_spread').innerHTML = res_3.data.spread;
                        }

                        if (currentState_3.hasOwnProperty(res_3.data.symbol+'_bid')) {

                            if (timeouts_3.hasOwnProperty(res_3.data.symbol+'_bid')) {
                                clearTimeout(timeouts_3[res_3.data.symbol+'_bid']);
                            }

                            if (res_3.data.bid> currentState_3[res_3.data.symbol+'_bid']) {
                                document.getElementById(res_3.data.symbol+'_bid').parentElement.className = 'up';
                                document.getElementById(res_3.data.symbol+'_bid').className = 'arrow-up';
                            } else {
                                document.getElementById(res_3.data.symbol+'_bid').parentElement.className = 'down';
                                document.getElementById(res_3.data.symbol+'_bid').className = 'arrow-down';
                            }

                            timeouts_3[res_3.data.symbol+'_bid'] = setTimeout(function(){
                                document.getElementById(res_3.data.symbol+'_bid').parentElement.className = 'no';
                                document.getElementById(res_3.data.symbol+'_bid').className = 'unchanged';
                            }, 1e3)
                        }

                        currentState_3[res_3.data.symbol+'_bid'] = res_3.data.bid;
                        currentState_3[res_3.data.symbol+'_ask'] = res_3.data.ask;

                        if (res_3.data.bid) {
                            var bidStr = res_3.data.bid.toString();
                            document.getElementById(res_3.data.symbol+'_bid').innerHTML = bidStr.substring(0, bidStr.length -1);
                            document.getElementById(res_3.data.symbol+'_bid').innerHTML += '<sup>' + (parseInt(bidStr[bidStr.length - 1])) + '</sup>';
                        }

                        if (res_3.data.ask) {
                            var askStr = res_3.data.ask.toString();
                            document.getElementById(res_3.data.symbol+'_ask').innerHTML = askStr.substring(0, askStr.length -1);
                            document.getElementById(res_3.data.symbol+'_ask').innerHTML += '<sup>' + (parseInt(askStr[askStr.length - 1])) + '</sup>';
                        }
                    });
                }
            }
        })();
        var socket_4 = io('https://nodejs.dinardirham.com:8480/');
        //var socket = io('http://127.0.0.1:8284/');

        var Main4 = (function(){
            var quotesList = ['GOLD_100G', 'GOLD_1DINAR', 'GOLD_1G', 'GOLD_1KG', 'SILVER100Oz','SILVER1KG'];
            var currentState_4 = {};
            var timeouts_4 = {};
            return {
                init:function(){
                    for(var i=0; i<quotesList.length; i++){

                        socket_4.emit('quotes.sub', {symbol:quotesList[i]});


                        var id = document.getElementById('table_content_4');
                        var el = document.createElement('tr');
                        el.innerHTML = "<td>"+quotesList[i]+"</td>" +
                                "<td id='"+quotesList[i]+"_bid'></td>" +
                                "<td id='"+quotesList[i]+"_spread'></td>" +
                                "<td id='"+quotesList[i]+"_ask'></td>";
                        id.appendChild(el);
                    }

                    socket_4.on('a', function(res_4){
                        if (res_4.type.indexOf('spread') !== -1) {
                            document.getElementById(res_4.data.symbol+'_spread').innerHTML = res_4.data.spread;
                        }

                        if (currentState_4.hasOwnProperty(res_4.data.symbol+'_bid')) {

                            if (timeouts_4.hasOwnProperty(res_4.data.symbol+'_bid')) {
                                clearTimeout(timeouts_4[res_4.data.symbol+'_bid']);
                            }

                            if (res_4.data.bid> currentState_4[res_4.data.symbol+'_bid']) {

                                document.getElementById(res_4.data.symbol+'_bid').parentElement.className = 'up';
                                document.getElementById(res_4.data.symbol+'_bid').className = 'arrow-up';
                            } else {
                                document.getElementById(res_4.data.symbol+'_bid').parentElement.className = 'down';
                                document.getElementById(res_4.data.symbol+'_bid').className = 'arrow-down';
                            }

                            timeouts_4[res_4.data.symbol+'_bid'] = setTimeout(function(){
                               document.getElementById(res_4.data.symbol+'_bid').parentElement.className = 'no';
                              document.getElementById(res_4.data.symbol+'_bid').className = 'unchanged';
                            }, 1e3)
                        }

                        currentState_4[res_4.data.symbol+'_bid'] = res_4.data.bid;
                        currentState_4[res_4.data.symbol+'_ask'] = res_4.data.ask;

                        if (res_4.data.bid) {
                            var bidStr = res_4.data.bid.toString();
                            document.getElementById(res_4.data.symbol+'_bid').innerHTML = bidStr.substring(0, bidStr.length -1);
                            document.getElementById(res_4.data.symbol+'_bid').innerHTML += '<sup>' + (parseInt(bidStr[bidStr.length - 1])) + '</sup>';
                        }

                        if (res_4.data.ask) {
                            var askStr = res_4.data.ask.toString();
                            document.getElementById(res_4.data.symbol+'_ask').innerHTML = askStr.substring(0, askStr.length -1);
                            document.getElementById(res_4.data.symbol+'_ask').innerHTML += '<sup>' + (parseInt(askStr[askStr.length - 1])) + '</sup>';
                        }
                    });
                }
            }
        })();
        document.addEventListener("DOMContentLoaded", function() {
            Main2 .init();
            Main3 .init();
            Main4 .init();
        });
</script>
js;
$JS=<<<js

wrap_js_function();
refresh_data();
$(document).ssTooltips('.demo', {
  bgColor: "#FFBF00",
  txtColor: "#070B19",
  maxWidth: 300,
  borderRadius: 5,
  fontSize: 14
});

js;

$CSS.=<<<css
<style>
        
        .up td {
            position: relative;
          
        }
        .up td.arrow-up:before {
            content: "";
            display: block;
            position: absolute;
            background-image: url('assets/img/arrow-up.png');
            width: 13px;
            height: 16px;
            left: -10px;
        }
        .down td {
            position: relative;
            
        }
        .down td.arrow-down:before {
            content: "";
            display: block;
            position: absolute;
            background-image: url('assets/img/arrow-down.png');
            width: 13px;
            height: 16px;
            left: -10px;
        }
      .no td {
            position: relative;
          
        }
       .no td.unchanged:before {
            content: "";
            display: block;
            position: absolute;
            background-image: url('assets/img/unchanged.png');
            background-repeat:no-repeat;

            width: 12px;
            height: 12px;
            left: -10px;
        }
    </style>
css;
?>

    <h2 class="page-title">ETPS Dashboard <small>Statistics and more</small></h2>
    <div class="btn-group">
        <a href="index.php"><button type="button" class="btn btn-gold btn-lg" data-original-title="" title="">
                <b>ETPS Dashboard</b><br>
            </button></a>
        <a href="mt4-dashboard.php"> <button type="button" class="btn btn-default btn-lg" data-original-title="" title="">
                MT4 Dashboard<br>
            </button></a>
    </div><br><br>

    <section class="">
        <div class="row">




            <div class="col-lg-12">

                <div class="row">


                    <div class="col-lg-12">
                        <div class="alert alert-success">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <strong><i class="fa fa-check"></i> Welcome to ETPS Dashboard. </strong>  We offer promotion price for products DinarCoin (DNC) and referral incomes and residual earnings for members.
                        </div>


                        <div class="alert alert-warning">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h4><strong> DNC & GSC MT4 Master Account Preview </strong></h4>
                            <b>Account </b> : 20976048<br>
                            <b>Password</b> : Xb6yqyA (View only)<br>
                            <b>Server</b> : SabaCapital-Real<br><br>
                            <a href="https://download.mql5.com/cdn/web/7678/mt4/sabacapital4setup.exe" target="_blank"><button type="button" class="btn btn-gold" data-placement="top" data-original-title=".btn .btn-warning">
                                    Download MT4
                                </button></a>
                        </div>
                    </div>
                    <br>
                    <div class="col-lg-2 col-md-6 col-sm-12 col-xs-12">

                        <div class="box">

                            <div class="description">

                                My ETPS
                            </div>

                            <div class="big-text">

                                <?php echo($etps_count)?> DNC

                            </div>

                            <div class="icon">

                                <i class="fa fa-globe"></i>

                            </div>

                        </div>

                    </div>


                    <div class="col-lg-2 col-md-6 col-sm-12 col-xs-12">

                        <div class="box">

                            <div class="description">

                                ETPS Gain

                            </div>

                            <div class="big-text">

                                <font color="#00FF00">+<?php echo($gain_per)?>%</font>~ <?php echo getCurSymbol() ?><?php echo($gain_usd)?>

                            </div>

                            <div class="icon">

                                <i class="fa fa-globe"></i>

                            </div>

                        </div>

                    </div>





                    <!-- mobile dropdown -->



                    <div class="col-md-3 col-sm-12 col-xs-12 hidden-lg hidden-md">


                    </div>



                    <!-- mobile dropdown -->



                    <div class="col-lg-3 col-md-4 col-sm-12 col-xs-12">

                        <div class="box">

                            <div class="description">



                                Current Gold Price in USD(1 DNC)

                            </div>

                            <div class="big-text">

                                <?php echo getGoldPriceHtml("di") ?>


                            </div>

                            <div class="icon">

                                <i class="fa fa-tachometer"></i>

                            </div>

                        </div>

                    </div>

                    <div class="col-lg-3 col-md-4 col-sm-12 col-xs-12">

                        <div class="box">

                            <div class="description">

                                Current Gold price in USD(1 Gram)

                            </div>

                            <div class="big-text">

                                <?php echo getGoldPriceHtml("gm") ?>



                            </div>

                            <div class="icon">

                                <i class="fa fa-user"></i>

                            </div>



                        </div>

                    </div>




                    <div class="col-lg-2 col-md-4 col-sm-12 col-xs-12">

                        <div class="box">

                            <div class="description">



                                Total Referrals

                            </div>

                            <div class="big-text">

<?php echo($ref_count_num)?>

                            </div>

                            <div class="icon">

                                <i class="fa fa-hand-o-left"></i>

                            </div>

                        </div>


                    </div>






                </div>




                <div class="row">





                    <div class="col-lg-6">
                        <section class="widget">

                            <header>

                                <h4>

                                    Information & Stats

                                    <small>
                                        Profile information

                                    </small>

                                </h4>




                            </header>

                            <div class="body no-margin">

                                <table class="table table-striped table-editable no-margin mb-sm">
                                    <thead>

                                    <tr>
                                        <td><b>Username</b></td>
                                        <td>  <?php echo($user_details['username'])?></td>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    <tr>
                                        <td><b>Introducer</b></td>
                                        <td><?php echo($user_details['referral'])?></td>
                                    </tr>

                                    <tr>
                                        <td><b>Account Status</b></td>
                                        <td><span id="etps_act_self"><?php if($etps_count>0){?><font color="#00FF00">Activated</font><?php }else{?><a href="javascript:void(0)" onclick="activateMyETPS(<?php echo($uid)?>,'<?php echo($user_details['username'])?>','<?php echo($user_details['position'])?>')" class="btn btn-gold">Activate My ETPS</a><?php } ?></span>
                                            / <?php if($user_details['ib_type']==1){?><font color="#00FF00">IB Account</font><?php }else{?><font color="#ff9900">Normal Account</font><?php } ?>

                                        </td>
                                    </tr>



                                    <tr>
                                        <td><b>Email</b></td>
                                        <td><a href="mailto:<?php echo($user_details['email'])?>"><?php echo($user_details['email'])?></a> </td>
                                    </tr>



                                    </tbody>
                                </table>



                            </div>

                        </section>


                        <section class="widget">

                            <header>

                                <h4>

                                    Gold Price

                                    <small>


                                    </small>

                                </h4>



                            </header>

                            <div class="body no-margin">

                                <div id="visits-chart" class="chart visits-chart">

                                    <svg></svg>

                                </div>



                            </div>

                        </section>



                        <section class="widget">
                            <header>

                                <h4>

                                    <br>
                                    DNC Price


                                </h4>



                            </header>
                            <div class="body">
                                <div class="visits-info well well-sm">

                                    <div class="row">

                                        <div class="col-sm-3 col-xs-6">

                                            <div class="key"><i class="fa fa-users"></i> We Buy</div>

                                            <div class="value"><?php echo getGoldPriceHtml("di","bid") ?></div>

                                        </div>

                                        <div class="col-sm-3 col-xs-6">

                                            <div class="key"><i class="fa fa-bolt"></i> We Sell</div>

                                            <div class="value"><?php echo getGoldPriceHtml("di") ?></div>

                                        </div>

                                        <div class="refreshdata" id="gold_price" interval="60">
                                            <?php require_once("gold_price.php")?>
                                        </div>

                                    </div>

                                </div>
                            </div>
                        </section>


                        <section class="widget">

                            <header>

                                <h4>

                                    <br>



                                </h4>



                            </header>

                            <div class="body">

                                <table class="table table-striped table-editable no-margin mb-sm" width="100%">

                                    <tbody><tr class="info">

                                        <th> <strong>MARKET GOLD PRICE 999.9</strong></th>

                                        <th><strong>BID</strong></th>

                                        <th><strong>ASK</strong></th>

                                    </tr>


                                    <tr>

                                        <td>Physical Gold USD/DNC</td>

                                        <td><?php echo(getGoldPriceHtml('di','bid'))?></td>

                                        <td><?php echo(getGoldPriceHtml('di'))?></td>

                                    </tr>

                                    <tr>

                                        <td>Physical Gold USD/Gram</td>

                                        <td><?php echo(getGoldPriceHtml('gm','bid'))?></td>

                                        <td><?php echo(getGoldPriceHtml('gm'))?></td>

                                    </tr>

                                    </tbody></table>

                            </div>
                        </section>





                        <section class="widget">

                            <header>

                                <h4>

                                    ETPS Price

                                    <small>

                                        Based on Current Price

                                    </small>

                                </h4>



                            </header>

                            <div class="body">

                                <div class="table-responsive">

                                    <table class="table table-striped table-editable no-margin mb-sm" width="100%">

                                        <tbody><tr class="info">

                                            <th><strong>ETPS Trading</strong></th>

                                            <th><strong>ETPS 30</strong></th>

                                        </tr>

                                        <tr>

                                            <td>Status</td>

                                            <td><span class="label label-success">Open</span></td>

                                        </tr>

                                        <tr>

                                            <td>Ready Stock Price USD/DNC</td>

                                            <td><?php echo(getGoldPriceHtml('di'))?></td>

                                        </tr>

                                        <tr>

                                            <td>ETPS Discount Price USD/DNC</td>

                                            <td><?php echo(getGoldPriceHtml('etps'))?></td>

                                        </tr>

                                        <tr>

                                            <td>Auto-Restock Contract</td>

                                            <td>6 Months</td>

                                        </tr>

                                        <tr>

                                            <td></td>

                                            <td><a class="btn btn-gold" href="javascript:void(0)" onClick="handleNew_('buy_new_1',1,'Buy DNC')"><b>Buy ETPS DNC</b></a></td>

                                        </tr>

                                        </tbody>

                                    </table></div>











                            </div>
                        </section>

















                    </div>





                    <div class="col-lg-6">


                        <section class="widget">

                            <header>

                                <h4>

                                    MT4 Crypto Assets


                                </h4>



                            </header>

                            <div class="body">


                                <table  class='table'>
                                    <thead>
                                    <tr>
                                        <th width="25%">SYMBOL</th>
                                        <th width="25%">BID</th>
                                        <th width="25%">SPREAD</th>
                                        <th width="25%">ASK</th>
                                    </tr>
                                    </thead>
                                    <tbody id="table_content_4">

                                    </tbody>
                                </table>




                            </div>

                        </section>



                        <section class="widget">
                            <header>
                                <h4> last 5 etps purchase </h4>
                            </header>
                            <div class="body">
                                <div class="table-responsive">
                                    <table width="100%" class="table table-striped">
                                        <thead>
                                        <tr>
                                            <th>Username</th>
                                            <th>Product name</th>
                                            <th class="text-right">Price($)</th>
                                            <th>Quantity</th>
                                            <th class="text-right">Cost($)</th>
                                            <th>Status</th>
                                            <th>time</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $sql_last_etps_purchase="select u.username,b.price,b.quantity,b.cost,b.status,b.insert_time from accounts u inner join
                                        buy b on b.account_id=u.id order by b.id desc limit 5";
                                        $dt__last_etps_purchas=getRowsSQL($sql_last_etps_purchase);
                                        $css_tbl="";
                                        while($rs__last_etps_purchase=mysqli_fetch_array($dt__last_etps_purchas)){
                                            ?>
                                            <tr<?php echo($css_tbl)?>>
                                                <td><?php echo($rs__last_etps_purchase['username'])?></td>
                                                <td>ETPS-30</td>
                                                <td class="text-right"><?php echo($rs__last_etps_purchase['price'])?></td>
                                                <td><?php echo($rs__last_etps_purchase['quantity'])?></td>
                                                <td class="text-right"><?php echo($rs__last_etps_purchase['cost'])?></td>
                                                <td><span class="text-info">Active</span></td>
                                                <td> <?php echo getAgo($rs__last_etps_purchase['insert_time'])?>o</td>
                                            </tr>
                                            <?php
                                            $css_tbl=($css_tbl=="")?" class='bg'":"";
                                        }
                                        ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </section>

                        <section class="widget">
                            <header>
                                <h4> Last 5 New Users </h4>
                            </header>
                            <div class="body">
                                <div class="table-responsive">
                                    <table width="100%" class="table table-striped">
                                        <thead>
                                        <tr>
                                            <th width="10%">Referral</th>
                                            <th width="10%">Username</th>
                                            <th width="15%">Created</th>
                                            <th width="15%">Email</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $sql_last_members="select * from  accounts order by id desc limit 5";
                                        $dt_last_members=getRowsSQL($sql_last_members);
                                        $css_tbl="";
                                        while($rs_last_members=mysqli_fetch_array($dt_last_members)){
                                        ?>
                                        <tr<?php echo($css_tbl)?>>
                                            <td><?php echo($rs_last_members['referral'])?></td>
                                            <td><?php echo($rs_last_members['username'])?></td>
                                            <td><?php echo($rs_last_members['created'])?></td>
                                            <td><?php echo($rs_last_members['email'])?></td>

                                            <?php
                                            $css_tbl=($css_tbl=="")?" class='bg'":"";
                                            }
                                            ?>
                                        </tr>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </section>


                        <section class="widget">
                            <header>
                                <h4> Members Stats </h4>
                            </header>
                            <div class="body">
                                <div class="table-responsive">
                                    <table width="100%" class="table table-striped">
                                        <thead>
                                        <tr>
                                            <th width="10%">&nbsp;</th>
                                            <th width="10%">Registered</th>
                                            <th width="15%">Activated</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <?php
                                            $sql_reg_members="select id from  accounts";
                                            $sql_act_members="select id from  accounts where etps_activation=1";
                                            ?>
                                            <td>Member</td>
                                            <td><?php echo(getTotalRows($sql_reg_members))?></td>
                                            <td><?php echo(getTotalRows($sql_act_members))?></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </section>











                    </div>



                    <div class="col-lg-12">


                        <section class="widget">

                            <header>

                                <h4>

                                    ETPS List
                                    <small>

                                        My Trades

                                    </small>

                                </h4>



                            </header>
                            <div class="body no-margin">


                                <div class="row">

                                    <div class="col-lg-12">




                                        <?php echo($html)?>


                                    </div>
                                </div>

                            </div>
                        </section>



                    </div>



                    <div class="col-lg-12">


                    </div>



                </div>








            </div>





        </div>



    </section>




<?php
$TITLE_HEADER =$H1." :: ". $TITLE;
$TITLE_PAGE = $TITLE;
$MainContent = ob_get_contents();
ob_end_clean();
include("master.php");
?>