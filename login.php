<?php
require_once('func/config_l.php');
$currentFile = $_SERVER["PHP_SELF"];
//die("<h1>System currently undergoing maintenance</h1>");
$REPORT="";
$SUCCESS="";
$U_ID=0;
$MAX_ATTP=5;
$l_uid=0;



if (isset($_REQUEST['SUBMIT'])) {
    $submit= strip_tags($_REQUEST['SUBMIT']);
    $main_conn=mysqlConn();
    $submit=getPost('SUBMIT',$main_conn,'');
    if (isset($submit) && $submit=="LOGIN"){
        $IP=$_SERVER['REMOTE_ADDR'];
        $code=getPost("code",$main_conn);

        if($code==getSession("token",$main_conn)){


            $UID=getPost("username",$main_conn,'');
            $Password=getPost("password",$main_conn);

            $login_data=LoginRows($UID,$main_conn);


            $lgn_rows=mysqli_fetch_array($login_data);
            //
            // die();
            $rows_count=mysqli_num_rows($login_data);
            //die($rows_count."AAAA");
            $lgn_rows["locked"]=0;
            $l_uid=0;//$lgn_rows['id'];
            if($rows_count>0){
                $l_uid=$lgn_rows['id'];
                $Attempts=$lgn_rows["retry"];
                $U_ID=$lgn_rows["id"];
                $FailedLogin=$Attempts;
                $BlockTill=$lgn_rows["BlockTill"];
                $lgn_rows["locked"]=0;
                if($BlockTill!=""){
                    $time_b=strtotime($BlockTill);
                    if($time_b>time()){
                        $lgn_rows["locked"]=1;
                    }
                }


                $Remainig=$MAX_ATTP-$Attempts-1;
                if($lgn_rows["banned"]==0) {

                    if($lgn_rows["locked"]==0){

                        if(strtolower($lgn_rows["username"])==strtolower($UID) && $lgn_rows["password"]==md5($Password) && $rows_count>0){





                            UpdateLogin($lgn_rows['id'],$main_conn);
                            insertLog($UID,$IP,$main_conn);

                            $_SESSION['NAME']=$lgn_rows['name'];

                            $_SESSION['USERNAME']=$lgn_rows['username'];

                            $_SESSION['USER_ID']=$lgn_rows['id'];



                            unset($chk_login);
                            unset($lgn_rows);




                            mysqli_close($main_conn);
                            redirect('index.php');





                        }else{
                            if($rows_count>0){
                                if($Attempts==($MAX_ATTP-1)){
                                    UpdateBlock($U_ID,$main_conn);
                                    $REPORT="<h2 class=\"alert-warning\">Login Failed and account blocked for 3 minutes</h2><br/>Username and password is not valid<br/><b>$Remainig</b> attempts remaining. ";

                                }else{
                                    UpdateFailedLogin($U_ID,$FailedLogin,$main_conn);

                                    $REPORT="<h2 class=\"alert-warning\">Login Failed</h2><br/>Username and password is not valid<br/><b>$Remainig</b> attempts remaining. ";
                                }
                            }else{
                                $REPORT="<h2 class=\"alert-warning\">Login Failed</h2><br/>Username and password is not valid";
                            }

                            insertLog($UID,$IP,$main_conn,0);
                        }
                    }else{
                        $to_time = strtotime($BlockTill);
                        $from_time = time();
                        $RPT= round(abs($to_time - $from_time) / 60,2). " minute";
                        $REPORT="<h2 class=\"alert-danger\">Error</h2><br/><b>Account Blocked</b><br/>Please try again after  $RPT  <u>OR CONTACT ADMIN FOR SUPPORT</u>";
                    }
                }else{
                    $sql_ban="select * from ban_log where uid=".$l_uid." and banned=1 order by id desc limit 1";
                    $dta=getRowsSingleSQL($sql_ban,$main_conn);
                    $REPORT = "<h2 class=\"alert-danger\">Error</h2><br/><b>Account has been temporary suspended.</b><br/><b><u>".$dta['comments']."</u></b>";
                }
            }else{
                insertLog($UID,$IP,$main_conn,0);
                $REPORT="<h2 class=\"alert-warning\">Login Failed</h2><br/>Username and password is not valid<br/>";
            }

        }else{

            $REPORT="<h2 class=\"error-box\">Error</h2><br/><b>Captcha code is not matching</b><br/>Please try again </div><div class=\"clear\">";
        }

    }
}
$token = md5(uniqid(rand(), true));
$_SESSION['token'] = $token;
?>
    <!DOCTYPE html>
    <html>
    <head>
        <title><?php echo($TITLE)?>:: Login Form</title>

        <link href="css/application3.css" rel="stylesheet">
        <link rel="shortcut icon" href="img/favicon.png">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">
        <meta charset="utf-8">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:400italic,700italic,300,400,700">
        <link href="assets/js/lib/iOS-Overlay/css/iosOverlay.css" rel="stylesheet" media="screen">

        <script>
            /* yeah we need this empty stylesheet here. It's cool chrome & chromium fix
             chrome fix https://code.google.com/p/chromium/issues/detail?id=167083
             https://code.google.com/p/chromium/issues/detail?id=332189
             */
        </script>
    </head>
    <body class="">
    <div class="page-login">
        <a href="index.php" class="logo-login" data-original-title="" title="">
            <img src="img/etps_new.png" alt="Logo" width="134" height="66">
        </a>

        <div class="navbar">



            <ul class="nav navbar-nav navbar-right pull-right">
                <li class="dropdown">

                </li>

                <li class="divider hidden-xs"></li>
                <li class="dropdown">

                </li>

                <!-- <li class="divider hidden-xs"></li>

                 <li class="hidden-xs dropdown">
                     <a href="#" title="Account" id="account" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                         <B>Language: </B> <img src="images/flag-uk.png" width="16" height="16">
                     </a>
                     <ul id="account-menu" class="dropdown-menu account" role="menu">

                         <li role="presentation">
                             <a href="form_account.html" class="link">
                                 <img src="images/flag-uk.png" width="16" height="16">
                                 English
                             </a>
                         </li>
                         <li role="presentation">
                             <a href="component_calendar.html" class="link">
                                 <img src="images/flag-de.png" width="16" height="16">
                                 Deutsch
                             </a>
                         </li>
                         <li role="presentation">
                             <a href="#" class="link"><img src="images/flag-fr.png" width="16" height="16">
                                 Francais
                             </a>
                         </li>
                     </ul>
                 </li>-->


            </ul>


        </div>
    </div>

    <div id="main" class="animated fadeIn">

        <!-- Start: Content-Wrapper -->
        <section id="content_wrapper">

            <!-- begin canvas animation bg -->
            <div id="canvas-wrapper">
                <canvas id="demo-canvas"></canvas>
            </div>

            <!-- Begin: Content -->

            <!-- End: Content -->

        </section>
        <!-- End: Content-Wrapper -->

    </div>
    <div class='alert alert-warning col-md-12'>
        
        <p>
            
            ETPS SERVER MAINTENANCE UPDATE:<br>

Dear users,<br>

<br>We are proud to announce that the ETPS server migration process has now been completed. While the website is now up and running, you might still experience some lagging due to some background works being done to establish an optimum performance. We highly appreciate your kind patience, understanding and support. 


<br>Regards,
<br>ETPS Management
        </p>
        
    </div>
    <div class='clearfix'></div>
<br>
    <div class="single-widget-container">

        <div class="para" id="sub1">
            <section class="widget login-widget">
                <header class="text-align-center">
                    <h4>Login to your account</h4>
                </header>
                <div class="body">
                    <form class="no-margin"
                          action="login.php" method="post">
                        <fieldset>
                            <div class="form-group">
                                <label for="email" style="color:white" >Username</label>
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fa fa-user"></i>
                                    </span>
                                    <input id="username" type="text" name="username" class="form-control input-lg input-transparent"
                                           placeholder="Your Username">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="password" style="color:white">Password</label>

                                <div class="input-group input-group-lg">
                                    <span class="input-group-addon">
                                        <i class="fa fa-lock"></i>
                                    </span>
                                    <input id="password" type="password" name="password" class="form-control input-lg input-transparent"
                                           placeholder="Your Password">
                                </div>
                            </div>
                        </fieldset>
                        <div class="form-actions">
                            <input type="hidden" name="code" value="<?php echo($token)?>" />
                            <button type="submit" class="btn btn-block btn-lg btn-gold" value="LOGIN" name="SUBMIT">
                                <span class="small-circle"><i class="fa fa-caret-right"></i></span>
                                <small>Sign In</small>
                            </button>
                            <div class="forgot">


                                <br><br>
                                <a href="javascript:void(0)" onClick="displaySubs('sub2')" onFocus="if(this.blur)this.blur()";>Forgot  Password ?</a>


                            </div>
                            <div class="forgot">
                                <a href="resend-activation-code.php">No activation code ?</a>


                            </div>
                        </div>



                    </form>
                </div>

                <footer>
                    <div class="signup-login">
                        <center>Need an account?
                            <a href="javascript:void(0)"  onClick="displaySubs('sub3')" onFocus="if(this.blur)this.blur()";>
                                <button  class="btn btn-sm btn-primary">

                                    <small>Create Account</small>
                                </button></a></center>
                    </div>
                    <button type="button" class="btn facebook-login btn-block" disabled="disabled" data-original-title="" title="">
                        <i class="fa fa-facebook-square fa-lg"></i> "Log in via Facebook"
                    </button>
                    <button type="button" class="btn google-login btn-block" disabled="disabled" data-original-title="" title="">
                        <i class="fa fa-google-plus-square fa-lg"></i><span> "Log in via Google"
                    </button>
                </footer>
            </section>
        </div>

        <!-- forgot password -->

        <div class="para" id="sub2" style="display:none">


            <section class="widget login-widget">
                <header class="text-align-center">

                    <h4>Forget Password ?</h4>
                    Enter your e-mail address below to reset your password.
                </header>
                <div class="body">
                    <form class="no-margin"
                          method="get">
                        <fieldset>

                            <div class="form-group">
                                <label for="email"style="color:white" >Email</label>
                                <div class="input-group">
                                    <span class="input-group-addon">
                                       <i class="fa fa-envelope-o"></i>
                                    </span>
                                    <input id="email_f" type="email" class="form-control input-lg input-transparent"
                                           placeholder="Your Email">
                                </div>
                            </div>

                        </fieldset>
                        <fieldset>

                            <div class="form-group">
                                <label for="email"style="color:white" >Code</label>
                                <div class="input-group">
                                    <span class="input-group-addon">
                                       <i class="fa fa-lock"></i>
                                    </span>
                                    <input id="code" type="code" class="form-control input-sm input-transparent"
                                           placeholder="code" autocomplete="off">
                                    <img src="captcha.php" width="150"  id="captcha" height="35" style="padding:5px; border:2px solid #CCCCCC" align="absmiddle" />
                                    <a  href="javascript:void(0)" class="reload" onClick="reloadImage('captcha')"><i class="fa fa-refresh"></i></a>
                                </div>
                            </div>

                        </fieldset>
                        <div class="form-actions">
                            <a class="btn btn-block btn-lg btn-gold" onclick="getMyPass()" href="javascript:void(0)">
                                <span class="small-circle"><i class="fa fa-caret-right"></i></span>
                                <small>Submit</small>
                            </a>
                            <center>
                                <a href="javascript:void(0)"  onClick="displaySubs('sub1')" onFocus="if(this.blur)this.blur()";>
                                    <button  class="btn btn-sm btn-primary">

                                        <small>Back</small>
                                    </button></a></center><br>

                        </div>
                    </form>
                </div>


            </section>




        </div>

        <!-- Sign in -->

        <div class="para" id="sub3" style="display:none">


            <section class="widget login-widget">
                <header class="text-align-center">

                    <h4>Sign Up</h4>
                    Enter your personal details below:
                </header>
                <div class="body">
                    <form class="no-margin"
                          method="get">
                        <fieldset>
                            <div class="form-group">
                                <label for="name" style="color:white">Name</label>
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fa fa-user"></i>
                                    </span>
                                    <input id="name" type="name" class="form-control input-lg input-transparent"
                                           placeholder="Your Name">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="name" style="color:white" >Username</label>
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fa fa-user"></i>
                                    </span>
                                    <input id="name" type="name" class="form-control input-lg input-transparent"
                                           placeholder="Your Username">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="email" >Email</label>
                                <div class="input-group">
                                    <span class="input-group-addon">
                                       <i class="fa fa-envelope-o"></i>
                                    </span>
                                    <input id="email" type="email" class="form-control input-lg input-transparent"
                                           placeholder="Your Email">
                                </div>
                            </div>

                        </fieldset>
                        <div class="form-actions">
                            <button type="button" class="btn btn-block btn-lg btn-gold" data-placement="top" data-original-title=".btn .btn-primary" data-toggle="modal" data-target="#signup">
                                <span class="small-circle"><i class="fa fa-caret-right"></i></span>
                                <small>Sign Up</small>
                            </button>
                            <center>Already have an account?
                                <a href="javascript:void(0)"  onClick="displaySubs('sub1')" onFocus="if(this.blur)this.blur()";>
                                    <button  class="btn btn-sm btn-primary">

                                        <small>Back</small>
                                    </button></a></center><br>

                        </div>
                    </form>
                </div>


            </section>




        </div>

        <CENTER><H3><b>TECHNOLOGY PROVIDED BY</b></H3></CENTER>

        <CENTER>
            <a href="https://www.dinardirham.com/index.php" target="_blank"><img class="powered" src="img/logo2.png" alt="Logo" ></a>

            <a href="https://ethereum.org" target="_blank"><img class="powered" src="img/eth1.png" alt="Logo"></a>
        </center>

    </div>


    <div class="body">

        <div id="signup" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
            <div class="modal-dialog modal-md">
                <div class="modal-content">

                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title" id="myModalLabel"><b><i class="fa fa-fw fa-warning text-warning"></i> Information</b></h4>
                    </div>
                    <div class="modal-body">


                        <h4> In "<b>Beta Version</b>" there is <b>NO free registration</b>, ETPS referral link will not be provided. Please contact your introducer for registration.</h4>










                    </div>
                    <div class="modal-footer">

                        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                    </div>

                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div>
    </div>


    <div class="modal fade" id="terms_modal"  tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Login Status</h4>
                </div>
                <div class="modal-body">
                    <?php echo($REPORT)?>
                </div>
            </div>
        </div>
    </div>
    <!-- common libraries. required for every page-->
    <script src="lib/jquery/dist/jquery.min.js"></script>
    <script src="lib/jquery-pjax/jquery.pjax.js"></script>
    <script src="lib/jquery-ui/jquery-ui.js"></script>
    <script src="lib/bootstrap-sass/assets/javascripts/bootstrap.min.js"></script>

    <script src="lib/widgster/widgster.js"></script>
    <script src="lib/underscore/underscore.js"></script>
    <script src="assets/plugins/bootbox/bootbox.js?v=1"></script>					<!-- BOOTBOX -->
    <script src="assets/js/lib/iOS-Overlay/js/iosOverlay.js"></script>
    <script src="assets/js/lib/noty/jquery.noty.packaged.js"></script>
    <!-- common application js -->
    <script src="js/app.js"></script>
    <script src="js/settings.js"></script>
    <script src="js/login.js"></script>


    <!-- CanvasBG Plugin(creates mousehover effect) -->
    <script src="js/canvasbg.js"></script>

    <!-- Theme Javascript -->
    <script src="js/utility.js"></script>
    <script src="js/demo.js"></script>
    <script src="js/main.js"></script>

    <!-- Page Javascript -->
    <script type="text/javascript">
        jQuery(document).ready(function() {

            "use strict";
            <?php if($REPORT!=""){
                    ?>

            $("#terms_modal").modal('toggle');

            <?php } ?>
            // Init Theme Core
            Core.init();

            // Init Demo JS
            Demo.init();

            // Init CanvasBG and pass target starting location
            CanvasBG.init({
                Loc: {
                    x: window.innerWidth / 2,
                    y: window.innerHeight / 3.3
                },
            });


        });
        function reloadImage(){

            d = new Date();

            $("#captcha").attr("src", "captcha.php?"+d.getTime());





        }

    </script>

    <style>
        td{
            border: 1px solid #5d5d5d;
        }
    </style>

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

    </body>
    </html>
