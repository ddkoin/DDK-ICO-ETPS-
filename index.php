<?php
require_once('func/config.php');
require_once('func/analyticstracking.php');
checkUser($main_conn);//CHECK PERMISSION

$uid=getSession("USER_ID",$main_conn,"0");
$gold_price=getGoldBarPrice($main_conn);
$user_details=getUserDetails($uid,$main_conn);
$obj_list=array();
$uid=getSession("USER_ID",$main_conn,"0");
$Wallets=getWallets($uid,$main_conn,"USD");
$Wallets=mysqli_fetch_array($Wallets);
$obj_p=array();
$obj_p['type']="product";

$product=getRows($obj_p,$main_conn);




$etps_count_sql="SELECT sum(quantity) from buy where status in(0,1,4) and  account_id=".$uid;
$etps_count_data=getRowsSingleSQL($etps_count_sql,$main_conn);
$etps_count=null2zero($etps_count_data[0]);
$gain_usd=0;

$ref_count_sql="SELECT count(uid) FROM  `referral` WHERE pid =".$uid."";
$ref_count_data=getRowsSingleSQL($ref_count_sql,$main_conn);
$ref_count_num=null2zero($ref_count_data[0]);
$gain_per=getGainAverage($uid,$main_conn,$gain_usd);


$dinar_bid=getGoldPriceHtml($main_conn,"di","bid");
$dinar_=getGoldPriceHtml($main_conn,"di");
$gm_bid=getGoldPriceHtml($main_conn,'gm','bid');
$gm_=getGoldPriceHtml($main_conn,'gm');
$etps_=getGoldPriceHtml($main_conn,'etps');


$merchant_check="select id from merchant where uid=".$uid;
$is_merchant=getRowsSingleSQL($merchant_check,$main_conn);

//checkSecurity($uid,$main_conn,"buy");
//checkSecurity($uid,$main_conn,"transaction");
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

    <?php if($is_merchant){?>
        <a href="merchant_profile.php"> <button type="button" class="btn btn-default btn-lg" data-original-title="" title="">
               <i class="fa fa-building"></i> Merchant Profile<br>
            </button></a>

    <?php } ?>
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

                            <font color="#00FF00">+<?php echo($gain_per)?>%</font>~ $<?php echo($gain_usd)?>

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

                            <?php echo $dinar_ ?>


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

                            <?php echo $gm_ ?>



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
                                        / <?php if($user_details['ib_type']==1){?><font color="#00FF00">ICE account</font><?php }else{?><font color="#ff9900">Normal Account</font><?php } ?>

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

                                DNC Price

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

                                        <div class="value"><?php echo $dinar_bid ?></div>

                                    </div>

                                    <div class="col-sm-3 col-xs-6">

                                        <div class="key"><i class="fa fa-bolt"></i> We Sell</div>

                                        <div class="value"><?php echo $dinar_ ?></div>

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

                                    <th> <strong>DNC PRICE 999.9</strong></th>

                                    <th><strong>BID</strong></th>

                                    <th><strong>ASK</strong></th>

                                </tr>


                                <tr>

                                    <td> USD/DNC</td>

                                    <td><?php echo($dinar_bid)?></td>

                                    <td><?php echo($dinar_)?></td>

                                </tr>

                                <tr>

                                    <td> USD/Gram</td>

                                    <td><?php echo($gm_bid)?></td>

                                    <td><?php echo($gm_)?></td>

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

                                        <td><?php echo($dinar_)?></td>

                                    </tr>

                                    <tr>

                                        <td>ETPS Discount Price USD/DNC</td>

                                        <td><?php echo($etps_)?></td>

                                    </tr>

                                    <tr>

                                        <td>Auto-Restock Contract</td>

                                        <td>6 Months</td>

                                    </tr>


                                    </tbody>

                                </table></div>











                        </div>
                    </section>

















                </div>





                <div class="col-lg-6">






                    <section class="widget">
                        <header>
                            <h4> last 8 DNC purchase </h4>
                        </header>
                        <div class="body">
                            <div class="table-responsive">
                                <table width="100%" class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th>Username</th>
                                        <th>Product name</th>
                                        <th class="text-right">Price</th>
                                        <th>Quantity</th>
                                        <th class="text-right">Cost</th>
                                        <th>Status</th>
                                        <th>time</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $cur="$";
                                    $sql_last_etps_purchase="select u.username,b.price,b.quantity,b.cost,b.status,b.insert_time,u.country,b.indnc from accounts u inner join
                                        buy_rpt b on b.account_id=u.id where b.status=0 order by b.id desc limit 8";
                                    $dt__last_etps_purchas=getRowsSQL($sql_last_etps_purchase,$main_conn);
                                    $css_tbl="";
                                    while($rs__last_etps_purchase=mysqli_fetch_array($dt__last_etps_purchas)){

                                        $country=strtolower($rs__last_etps_purchase['country']);
                                        $cost_sym="<img src='img/dd.png'>";
                                        if($rs__last_etps_purchase['indnc']=="1"){
                                            $cur="$";//<img src='img/dd.png'>
                                            $cost_sym="<img src='img/dd.png'>".($rs__last_etps_purchase['quantity']*.9);
                                        }else{
                                            $cur="$";
                                            $cost_sym="$".$rs__last_etps_purchase['cost'];
                                        }
                                        ?>
                                        <tr<?php echo($css_tbl)?>>
                                            <td><span class="flag flag-<?php echo($country)?>"></span><?php echo($rs__last_etps_purchase['username'])?></td>
                                            <td>ETPS-30</td>
                                            <td class="text-right"><?php echo($cur.$rs__last_etps_purchase['price'])?></td>
                                            <td><?php echo($rs__last_etps_purchase['quantity'])?></td>
                                            <td class="text-right"><?php echo($cost_sym)?></td>
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
                            <h4> Last 8 New Users </h4>
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
                                    $sql_last_members="select * from  accounts_rpt order by id desc limit 8";
                                    $dt_last_members=getRowsSQL($sql_last_members,$main_conn);
                                    $css_tbl="";
                                    while($rs_last_members=mysqli_fetch_array($dt_last_members)){

                                    $country=strtolower($rs_last_members['country']);
                                    ?>
                                    <tr<?php echo($css_tbl)?>>
                                        <td><?php echo($rs_last_members['referral'])?></td>
                                        <td><span class="flag flag-<?php echo($country)?>"></span><?php echo($rs_last_members['username'])?></td>
                                        <td><?php echo($rs_last_members['created'])?></td>
                                        <td><?php echo obfuscate_email($rs_last_members['email'])?></td>

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
                                        <td><?php echo(getTotalRows($sql_reg_members,$main_conn))?></td>
                                        <td><?php echo(getTotalRows($sql_act_members,$main_conn))?></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </section>











                </div>



                <div class="col-lg-12">


                   <a href="my-etps.php" class="btn btn-danger">My ETPS</a>



                </div>



                <div class="col-lg-12">


                </div>



            </div>








        </div>





    </div>



</section>

<!--


-->

</div>

<?php

$TITLE_HEADER =$H1." :: ". $TITLE;
$TITLE_PAGE = $TITLE;
$MainContent = ob_get_contents();
ob_end_clean();
include("master.php");

?>
