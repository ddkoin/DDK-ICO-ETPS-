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
$gain_per=getGainAverage($uid,$gain_usd);
$CSS.=<<<css
<link href="assets/plugins/form-daterangepicker/daterangepicker-bs3.css" type="text/css" rel="stylesheet">
css;
$JS_FILE.=<<<js
<script src="assets/plugins/shufflejs/modernizr.custom.min.js"></script>  <!-- Dependency for Shuffle.js -->
<script src="assets/plugins/shufflejs/jquery.shuffle.min.js"></script>    <!-- Shuffle.js -->


<script src="assets/plugins/form-daterangepicker/daterangepicker.js"></script>
<script src="assets/plugins/form-daterangepicker/moment.min.js"></script>
<script src="js/fxerp.js?v=5"></script>
<script src="js/index.js"></script>

<script src="js/chat.js"></script>
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
                        socket_q.emit('spread.sub', {symbol:quotesList[i]});

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
                        socket_3.emit('spread.sub', {symbol:quotesList[i]});

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
                        socket_4.emit('spread.sub', {symbol:quotesList[i]});

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
            Main2.init();
            Main3.init();
            Main4.init();
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
    <h2 class="page-title">Dashboard <small>Statistics and more</small></h2>

    <div class="row">



        <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <strong>  Welcome! </strong>You have successfully registered as an early member of ETPS.
        </div>

        <div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <strong>This is a BETA version.</strong> If have any questions, please contact our Support team..
        </div>
        <div class="col-md-2 col-sm-12 col-xs-12">

            <div class="box">

                <div class="description">

                    My ETPS
                </div>

                <div class="big-text">

                    <?php echo($etps_count)?> Dinar

                </div>

                <div class="icon">

                    <i class="fa fa-globe"></i>

                </div>

            </div>

        </div>


        <div class="col-md-2 col-sm-12 col-xs-12">

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

        <div class="col-md-2 col-sm-12 col-xs-12">

            <div class="box">

                <div class="description">



                    Wallet balance

                </div>

                <div class="big-text">

                    <?php echo getCurSymbol() ?><?php echo getWalletBalance($uid) ?>

                </div>

                <div class="icon">

                    <i class="fa fa-hand-o-left"></i>

                </div>

            </div>

        </div>



        <!-- mobile dropdown -->



        <div class="col-md-3 col-sm-12 col-xs-12 hidden-lg hidden-md">


        </div>



        <!-- mobile dropdown -->



        <div class="col-md-3 col-sm-12 col-xs-12">

            <div class="box">

                <div class="description">



                    Current Gold Price in USD(1 Dinar)

                </div>

                <div class="big-text">

                    <?php echo getGoldPriceHtml("di") ?>


                </div>

                <div class="icon">

                    <i class="fa fa-tachometer"></i>

                </div>

            </div>

        </div>

        <div class="col-md-3 col-sm-12 col-xs-12">

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
                            <td><?php if($etps_count>0){?><font color="#00FF00">Activated</font><?php }else{?><font color="#ffc6b3">Normal member</font><?php } ?>
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
                        Dinar Price


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

                            <td>Physical Gold USD/Dinar</td>

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

                <div class="body no-margin">

                    <div class="table-responsive">

                        <div class="row">

                            <div class="col-lg-12">


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

                                                <td>Indicator ETPS</td>

                                                <td>12</td>

                                            </tr>

                                            <tr>

                                                <td>Quota</td>

                                                <td>2500 Dinar</td>

                                            </tr>

                                            <tr>

                                                <td>Ready Stock Price USD/Dinar</td>

                                                <td><?php echo(getGoldPriceHtml('di'))?></td>

                                            </tr>

                                            <tr>

                                                <td>ETPS Discount Price USD/Dinar</td>

                                                <td><?php echo(getGoldPriceHtml('etps'))?></td>

                                            </tr>

                                            <tr>

                                                <td>Auto-Restock Contract</td>

                                                <td>6 Months</td>

                                            </tr>

                                            <tr>

                                                <td></td>

                                                <td><a class="btn btn-gold" href="javascript:void(0)" onClick="handleNew_('buy_new_1',1,'Buy Gold')"><b>Buy ETPS 30</b></a></td>

                                            </tr>

                                            </tbody>

                                        </table></div>











                                </div>
                            </div>
                        </div>
                    </div>
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

                    <h4>

                        MT4 MICRO


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
                        <tbody id="table_content">

                        </tbody>
                    </table>




                </div>

            </section>

            <section class="widget">

                <header>

                    <h4>

                        MT4 STP


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
                        <tbody id="table_content_3">

                        </tbody>
                    </table>




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





<?php
$TITLE_HEADER =$H1." :: ". $TITLE;
$TITLE_PAGE = $TITLE;
$MainContent = ob_get_contents();
ob_end_clean();
include("master.php");
?>