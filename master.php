<?php
checkUser($main_conn);
$UID=getSession("USER_ID",$main_conn,"0");
$NAME=getSession("USERNAME",$main_conn);

$verified=isMemberVerified($UID,$main_conn);
$usr_info=NULL;
if(isset($user_details) && $user_details['id']==$UID){
    $usr_info=$user_details;
}else{
    $usr_info=getUserDetails($UID,$main_conn);
}

$balance=$usr_info['balance'];
$is_ib=($usr_info['ib_type']==1)?1:0;
$etps_count_sql="SELECT sum(quantity) from buy where account_id=".$UID;
$etps_count_data=getRowsSingleSQL($etps_count_sql,$main_conn);
$etps_count=null2zero($etps_count_data[0]);


$docs_=checkDocuments($UID,$main_conn);
$doc_rows=mysqli_fetch_array($docs_);
$rows_count=mysqli_num_rows($docs_);




$gold_last=lastTransactions(0,"feed",$main_conn,"price");

$gold_price=explode(",",$gold_last);
$very_last=$gold_price[0];
$very_2nd=$gold_price[1];

$precentage_gain=number_format(($very_last-$very_2nd)/$very_2nd *100,2);


$file_2=UPLOAD_URL."na.jpg";
$icon="fa-arrow-circle-up text-success";

if($very_last<$very_2nd){
    $icon="fa-arrow-circle-down text-danger";
}else if($very_last==$very_2nd){
    $icon="fa-circle text-warning";
}
if($rows_count>0){

    $file_2=($doc_rows["doc3"]=="" ? $file_2:$doc_rows["doc3"]);

    $file_2=(file_exists($_SERVER["DOCUMENT_ROOT"].UPLOAD_URL.$file_2) ? UPLOAD_URL.$file_2 : UPLOAD_URL."na.jpg");
}
$dinar_bid_m=0;
if(isset($dinar_bid)){
    $dinar_bid_m=$dinar_bid;
}else{
    $dinar_bid_m=getGoldPriceHtml($main_conn,"di","bid");
}

$dinar_m=0;
if(isset($dinar_)){
    $dinar_m=$dinar_;
}else{
    $dinar_m=getGoldPriceHtml($main_conn,"di");
}

$gm_bid_m=0;
if(isset($gm_bid)){
    $gm_bid_m=$gm_bid;
}else{
    $gm_bid_m=getGoldPriceHtml($main_conn,'gm','bid');
}
$gm_m=0;
if(isset($gm_)){
    $gm_m=$gm_;
}else{
    $gm_m=getGoldPriceHtml($main_conn,'gm');
}
$etps_m=0;
if(isset($etps_)){
    $etps_m=$etps_;
}else{
    $etps_m=getGoldPriceHtml($main_conn,'etps');
}

$etps_price_usd=getProductPrice($main_conn);
?>
    <!DOCTYPE html>

    <html>

    <head>

        <title> <?php echo($TITLE)?> </title>



        <link href="css/application3.css?v=6" rel="stylesheet">

        <link href="css/bootstrap-responsive-tabs.css" rel="stylesheet">
        <link href="css/font-awesome.min.css" rel="stylesheet">
        <link href="css/flags.min.css" rel="stylesheet">

        <link rel="shortcut icon" href="img/favicon.ico">

        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <meta name="description" content="">

        <meta name="author" content="">

        <meta charset="utf-8">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:400italic,700italic,300,400,700">
        <link href="assets/js/lib/iOS-Overlay/css/iosOverlay.css" rel="stylesheet" media="screen">

        <link href="assets/plugins/form-typeahead/style.css?v=1" type="text/css" rel="stylesheet">





        <?php echo($CSS)?>
        <script>

            /* yeah we need this empty stylesheet here. It's cool chrome & chromium fix

             chrome fix https://code.google.com/p/chromium/issues/detail?id=167083

             https://code.google.com/p/chromium/issues/detail?id=332189

             */

        </script>

    </head>

    <body class="background-dark">

    <div class="logo">

        <a href="index.php" data-original-title="" title="">

            <img src="img/etps_new.png" alt="Logo" width="152" height="75">

        </a>



    </div>

    <nav id="sidebar" class="sidebar nav-collapse collapse">
        <div  class="hidden-xs">
            <section class="widget_profile">

                <div class="body">
                    <div class="text-align-center">
                        <img src="<?php echo($file_2)?>" alt="" class="img-responsive img-thumbnail" id="doc_all">


                        <br><br>
                        <b>  <?php echo($NAME)?></b>
                        <br>
                        <?php if($etps_count>0){?><font color="#00FF00">Activated</font><?php }else{?><font color="#ffc6b3">Normal member</font><?php } ?>
                        / <?php if($usr_info['ib_type']==1){?><font color="#00FF00">IB Account</font><?php }else{?><font color="#ff9900">Normal Account</font><?php } ?>
                        <br>
                        <b><?php echo($usr_info['email'])?></b>
                        <br>
                        <b>Referral link:<br><a href="<?php echo(DOMAIN)?>Left/<?php echo($NAME)?>" target="_blank" class="btn btn-xs btn-gold"><b>Left</b></a> | <a href="<?php echo(DOMAIN)?>Right/<?php echo($NAME)?>" target="_blank" class="btn btn-xs btn-gold"><b>Right</b></a>
                            <br>


                    </div>
                </div>

            </section>
            <ul class="list-group">
                <li class="list-group-item">
                    <span class="badge"><?php echo $balance ?></span>
                    <i class="fa fa-usd"></i> USD
                </li>
                <li class="list-group-item">
                    <span class="badge"><?php echo number_format($usr_info['balance_d'],4)?></span>
                    <img src="img/dd.png"> DNC
                </li>
                <li class="list-group-item">
                    <span class="badge">0</span>
                    <i class="fa fa-btc"></i> BTC
                </li>
                <li class="list-group-item">
                    <span class="badge">0</span>
                    <img src="img/eth-icon.png"> ETH
                </li>
            </ul>
        </div>
        <br>
        <ul id="side-nav" class="side-nav widget-menu">

            <li class="active">

                <a href="index.php"><i class="fa fa-2x fa-home"></i> <span class="name">Dashboard</span></a>

            </li>

            <?php if($is_ib==1){
                $deposit_num=num_withdraw_deposit($UID,$main_conn);
                $withdraw_num=num_withdraw_deposit($UID,$main_conn,"withdraw");
                $tdw=$deposit_num+$withdraw_num;
                ?>



                <li class="panel ">

                    <a class="accordion-toggle collapsed" data-toggle="collapse"

                       data-parent="#side-nav" href="#forms-collapse6"><i class="fa fa-cog"></i> <span class="name">ICE/MICE Network</span></a>

                    <ul id="forms-collapse6" class="panel-collapse collapse ">


                        <li><a href="ib-deposit.php">Deposit(<?php echo($deposit_num)?>)</span></a>
                        <li><a href="ib-withdraw.php">Withdraw(<?php echo($withdraw_num)?>)</span></a>



                    </ul>

                </li>
            <?php } ?>

            <li class="panel ">

                <a class="accordion-toggle collapsed" data-toggle="collapse"

                   data-parent="#side-nav" href="#forms-collapse"><i class="fa fa-cogs" aria-hidden="true"></i> <span class="name">Settings</span></a>

                <ul id="forms-collapse" class="panel-collapse collapse ">

                    <li class=""><a href="edit_profile.php">Profile</a></li>



                    <li class=""><a href="Submit-Documents.php">Verification</a></li>
                    <li class=""><a href="Change-Password.php">Change Passwords</a></li>
                    <li class=""><a href="Change-Password.php?type=1">Change PIN</a></li>


                </ul>

            </li>

            <li class="panel ">
                <a class="accordion-toggle collapsed" data-toggle="collapse"

                   data-parent="#side-nav" href="#forms-collapsew"><i class="fa fa-credit-card"></i> <span class="name">Wallet</span></a>
                <ul id="forms-collapsew" class="panel-collapse collapse ">
                    <li><a href="wallets.php">Transaction</a></li>

                    <li><a href="Deposits.php">Deposit History </a></li>
                    <li><a href="Withdraw.php">Withdraw History</a></li>
                    <li><a href="Withdraw-ETH.php">Withdraw History(BTC/ETH)</a></li>
                    <li><a href="Withdraw-2-DNC.php">Withdraw History(DNC)</a></li>
                    <li><a href="DNC-Withdraw-BTC-ETH.php">DNC Withdraw History(BTC/ETH)</a></li>
                    <li><a href="Trasnfer.php">Transfer History</a></li>


                    <li><a href="Received-fund.php">Received History</a></li>
                    <li><a href="Credit-History.php">All Time History</a></li>
                    <li><a href="DNC-History.php">All Time DNC History</a></li>
                </ul>

            </li>


            <li class="panel">
                <a class="accordion-toggle collapsed" data-toggle="collapse"
                   data-parent="#side-nav" href="#menu-levels-collapse"><i class="fa fa-area-chart" aria-hidden="true"></i> <span class="name">ETPS Menu</span></a>
                <ul id="menu-levels-collapse" class="panel-collapse collapse">

                    <li class="panel">
                        <a class="accordion-toggle collapsed" data-toggle="collapse"
                           data-parent="#menu-levels-collapse" href="#sub-menu-1-collapse">ETPS Account</a>
                        <ul id="sub-menu-1-collapse" class="panel-collapse collapse">
                            <li><a href="Profit.php">Profit Earning</a></li>

                            <li><a href="Buy.php">Purchase History  </a></li>
                            <li><a href="Buy-Back.php">Buyback History</a></li>
                            <li><a href="Collect.php">Redeem History</a></li>


                        </ul>
                    </li>

                    <li class="panel">
                        <a class="accordion-toggle collapsed" data-toggle="collapse"
                           data-parent="#menu-levels-collapse" href="#sub-menu-2-collapse">ETPS Referrals</a>
                        <ul id="sub-menu-2-collapse" class="panel-collapse collapse">
                            <li><a href="Referral.php">Referrals</a></li>
                            <li><a href="network.php">Network</a></li>

                            <li><a href="Affiliate-Bonus.php">Referral Reward</a></li>
                            <li><a href="Group-Bonus.php">Group Reward</a></li>
                            <li><a href="Overridden-Bonus.php">Overriding Reward</a></li>
                            <li><a href="Achievement-Awards.php">Diamond Achievements</a></li>

                        </ul>
                    </li>

                    <li class="panel">
                        <a class="accordion-toggle collapsed" data-toggle="collapse"
                           data-parent="#menu-levels-collapse" href="#sub-menu-3-collapse">ETPS Terms & Conditions</a>
                        <ul id="sub-menu-3-collapse" class="panel-collapse collapse">
                            <li><a href="faq.php">FAQ</a></li>

                            <li><a href="terms.php">T&C  </a></li>
                            <li><a href="risk.php">Risk Disclaimer</a></li>
                            <li><a href="privacy_policy.php">Privacy Policy</a></li>
                            <li><a href="documents.php">Documents</a></li>
                        </ul>
                    </li>
                </ul>
            </li>









            <li class="panel ">
                <a class="accordion-toggle collapsed" data-toggle="collapse"

                   data-parent="#side-nav" href="#forms-collapsew_temp"><i class="fa fa-line-chart" aria-hidden="true"></i><span class="name">MT4 Menu </span></a>
                <ul id="forms-collapsew_temp" class="panel-collapse collapse ">
                    <li><a href="mt4-dashboard.php">MT4 Dashboard</a></li>






                </ul>

            </li>



            <li class="">

                <a href="supports.php"><i class="fa fa-ticket" aria-hidden="true"></i><span class="name">Support Tickets</span></a>

            </li>







            <li class="">

                <a href="Sign-Out.php"><i class="fa fa-sign-out" aria-hidden="true"></i><span class="name">Sign Out</span></a>

            </li>
        </ul>

















    </nav>    <div class="wrap">

        <header class="page-header">

            <div class="navbar">

                <ul class="nav navbar-nav navbar-right pull-right">



                    <li class="dropdown">
                        <div class="box2 hidden-xs hidden-md ">
                            <b>Wallet USD :</b>  <?php echo $balance ?> <i class="fa fa-usd"></i>  <b> | DNC :</b> <?php echo number_format($usr_info['balance_d'],4)?> <img src="img/dd.png">
                        </div>
                    </li>
                    <li class="divider"></li>
                    <li class="dropdown">
                        <div class="box2 hidden-xs hidden-md">
                            <b>DNC We Buy:</b><?php echo($dinar_bid_m)?><b> | We Sell:</b><?php echo($dinar_m)?>
                        </div>
                    </li>


                    <li class="divider"></li>
                    <li class="dropdown">
                        <div class="box2 hidden-xs hidden-md">
                            <b>ETPS Price :</b>$<?php echo($etps_price_usd)?> (0.9000 DNC)
                        </div>
                    </li>

                    <li class="divider"></li>

                    <li class="hidden-xs">

                        <a href="#" id="settings"

                           title="Settings"

                           data-toggle="popover"

                           data-placement="bottom">

                            <i class="fa fa-cog"></i>

                        </a>

                    </li>

                    <li class="hidden-xs dropdown">

                        <a href="#" title="Account" id="account"

                           class="dropdown-toggle"

                           data-toggle="dropdown">

                            <i class="fa fa-user"></i>

                        </a>

                        <ul id="account-menu" class="dropdown-menu account" role="menu">

                            <li role="presentation" class="account-picture">

                                <img src="<?php echo($file_2)?>" alt="">

                                <?php echo($NAME)?>

                            </li>

                            <li role="presentation">

                                <a href="edit_profile.php" class="link">

                                    <i class="fa fa-user"></i>

                                    Profile

                                </a>

                            </li>




                        </ul>

                    </li>

                    <li class="visible-xs">

                        <a href="#"

                           class="btn-navbar"

                           data-toggle="collapse"

                           data-target=".sidebar"

                           title="">

                            <i class="fa fa-bars"></i>

                        </a>

                    </li>

                    <li class="hidden-xs"><a href="Sign-Out.php"><i class="fa fa-sign-out"></i></a></li>

                </ul>





            </div>

        </header>


        <div class="content container">

            <div  class="hidden-lg hidden-md hidden-sm">
                <section class="widget_profile">

                    <div class="body">
                        <div class="text-align-center">
                            <img src="<?php echo($file_2)?>" alt="" class="img-responsive img-thumbnail" id="doc_all">


                            <br><br>
                            <b> <?php echo($NAME)?></b>
                            <br>
                            <?php if($etps_count>0){?><font color="#00FF00">Activated</font><?php }else{?><font color="#ffc6b3">Normal member</font><?php } ?>
                            / <?php if($usr_info['ib_type']==1){?><font color="#00FF00">IB Account</font><?php }else{?><font color="#ff9900">Normal Account</font><?php } ?>
                            <br>
                            <b><?php echo($usr_info['email'])?></b>
                            <br>
                            <b>Referral link:&nbsp; <a href="<?php echo(DOMAIN)?>Left/<?php echo($NAME)?>" target="_blank" class="btn btn-xs btn-gold"><b>Left</b></a> | <a href="<?php echo(DOMAIN)?>Right/<?php echo($NAME)?>" target="_blank" class="btn btn-xs btn-gold"><b>Right</b></a>
                                <br>


                        </div>
                    </div>

                </section>
                <ul class="list-group">
                    <li class="list-group-item">
                        <span class="badge"><?php echo $balance ?></span>
                        <i class="fa fa-usd"></i> USD
                    </li>
                    <li class="list-group-item">
                        <span class="badge"><?php echo number_format($usr_info['balance_d'],4)?></span>
                        <img src="img/dd.png"> DNC
                    </li>
                    <li class="list-group-item">
                        <span class="badge">0</span>
                        <i class="fa fa-btc"></i> BTC
                    </li>
                    <li class="list-group-item">
                        <span class="badge">0</span>
                        <img src="img/eth-icon.png"> ETH
                    </li>
                </ul>
            </div>

            <?php echo($MainContent)?>



        </div>

        <div class="loader-wrap hiding hide">

            <i class="fa fa-circle-o-notch fa-spin"></i>

        </div>

    </div>

    <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel" id="modal_erp">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="modal-body-title">Modal title</h4>
                </div>
                <div class="modal-body" id="modal-body-erp">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <!-- common libraries. required for every page-->





    <script src="js/jquery.min.js"></script>

    <script src="lib/jquery-pjax/jquery.pjax.js"></script>
    <script src="lib/jquery-ui/jquery-ui.js"></script>

    <script src="lib/bootstrap-sass/assets/javascripts/bootstrap.min.js"></script>

    <script src="lib/widgster/widgster.js"></script>

    <script src="lib/underscore/underscore.js"></script>



    <!-- common application js -->

    <script src="js/app.js"></script>

    <script src="js/settings.js"></script>



    <!-- common templates -->

    <script type="text/template" id="settings-template">

        <div class="setting clearfix">

            <div>Background</div>

            <div id="background-toggle" class="pull-left btn-group" data-toggle="buttons-radio">

                <% dark = background == 'dark'; light = background == 'light';%>

                <button type="button" data-value="dark" class="btn btn-sm btn-default <%= dark? 'active' : '' %>">Dark</button>

                <button type="button" data-value="light" class="btn btn-sm btn-default <%= light? 'active' : '' %>">Light</button>

            </div>

        </div>

        <div class="setting clearfix">

            <div>Sidebar on the</div>

            <div id="sidebar-toggle" class="pull-left btn-group" data-toggle="buttons-radio">

                <% onRight = sidebar == 'right'%>

                <button type="button" data-value="left" class="btn btn-sm btn-default <%= onRight? '' : 'active' %>">Left</button>

                <button type="button" data-value="right" class="btn btn-sm btn-default <%= onRight? 'active' : '' %>">Right</button>

            </div>

        </div>

        <div class="setting clearfix">

            <div>Sidebar</div>

            <div id="display-sidebar-toggle" class="pull-left btn-group" data-toggle="buttons-radio">

                <% display = displaySidebar%>

                <button type="button" data-value="true" class="btn btn-sm btn-default <%= display? 'active' : '' %>">Show</button>

                <button type="button" data-value="false" class="btn btn-sm btn-default <%= display? '' : 'active' %>">Hide</button>

            </div>

        </div>

        <div class="setting clearfix">

            <div>White Version</div>

            <div>

                <a href="../white/index.html" class="btn btn-sm btn-default">&nbsp; Switch &nbsp;   <i class="fa fa-angle-right"></i></a>

            </div>

        </div>

    </script>



    <script type="text/template" id="sidebar-settings-template">

        <% auto = sidebarState == 'auto'%>

        <% if (auto) {%>

        <button type="button"

                data-value="icons"

                class="btn-icons btn btn-transparent btn-sm">Icons</button>

        <button type="button"

                data-value="auto"

                class="btn-auto btn btn-transparent btn-sm">Auto</button>

        <%} else {%>

        <button type="button"

                data-value="auto"

                class="btn btn-transparent btn-sm">Auto</button>

        <% } %>

    </script>



    <!-- page specific scripts -->

    <!-- page libs -->

    <script src="lib/slimScroll/jquery.slimscroll.min.js"></script>

    <script src="lib/jquery.sparkline/index.js"></script>


    <script src="assets/plugins/bootbox/bootbox.js?v=1"></script>					<!-- BOOTBOX -->
    <script src="assets/js/lib/iOS-Overlay/js/iosOverlay.js"></script>
    <script src="assets/js/lib/noty/jquery.noty.packaged.js"></script>
    <script src="lib/backbone/backbone.js"></script>
    <script src="js/moment.js"></script>
    <script src="lib/backbone.localStorage/backbone.localStorage-min.js"></script>
    <script src="assets/plugins/form-typeahead/typeahead.min.js?v=2"></script>

    <script src="js/plugins.js"></script>
    <script src="js/jquery.bootstrap-responsive-tabs.min.js"></script>

    <script src="js/jquery.shuffle.min.js"></script>
    <script src="js/shiffle.js"></script>


    <script>
        $('.responsive-tabs').responsiveTabs({
            accordionOn: ['xs', 'sm']
        });
    </script>

    <script src="lib/d3/d3.min.js"></script>

    <script src="lib/nvd3/build/nv.d3.min.js"></script>

    <script type="text/javascript">
        $(window).load(function(){
            $('#test').modal('show');
        });
    </script>

    <!-- page application js -->





    <!-- page template -->

    <script type="text/template" id="message-template">

        <div class="sender pull-left">

            <div class="icon">

                <img src="img/2.jpg" class="img-circle" alt="">

            </div>

            <div class="time">

                just now

            </div>

        </div>

        <div class="chat-message-body">

            <span class="arrow"></span>

            <div class="sender"><a href="#">Tikhon Laninga</a></div>

            <div class="text">

                <%- text %>

            </div>

        </div>

    </script>
    <?php echo($JS_FILE)?>
    <?php require_once('func/analyticstracking.php'); ?>
    <script type="text/javascript">
        $(document).ready(function() {
            <?php echo($JS)?>


            refresh_data();
            $('li').click( function(e){
                if($(e.target).is('li')){
                    $('li.selected').removeClass('selected');
                    $(this).addClass('selected');
                    $(this).children("input[type=radio]").click();
                }
            });
        });

        function refresh_data(){
            $(".refreshdata").each(function() {
                var interval= $(this).attr('interval');
                var id= $(this).attr('id');
                interval=parseInt(interval)*1000;

                setTimeout(function() {

                    getContentData(id);

                }, interval);


            });
        }

        function getContentData(id){
            $.ajax({
                url: "router/post.php?action="+id,
                context: document.body,
                success: function(result){

                    $("#"+id+"").html(result);

                }
            });
        }

    </script>



    </body>

    </html>
<?php
mysqli_close($main_conn);
?>