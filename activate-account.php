<?php
require_once('func/config.php');
$currentFile = $_SERVER["PHP_SELF"];
$REPORT="";
$SUCCESS="";
$U_ID=0;
$MAX_ATTP=3;
$show_form=false;
if (isset($_GET['key'])&& isset($_GET['email']) && isset($_GET['username']) && !isset($_GET['code'])){

    $UID=getQueryString("username",$main_conn);
    $Password=getQueryString("key",$main_conn);

    $email=getQueryString("email",$main_conn);

    $login_data=LoginRows($UID,$main_conn);


    $lgn_rows=mysqli_fetch_array($login_data);
    //

    $rows_count=mysqli_num_rows($login_data);

    //die($rows_count."AAAA");
    $lgn_rows["locked"]=0;
    if($rows_count>0){
        $Attempts=$lgn_rows["retry"];
        $U_ID=$lgn_rows["id"];




        $IP=$_SERVER['REMOTE_ADDR'];


            if(strtolower($lgn_rows["username"])==strtolower($UID) && $lgn_rows["secret"]==$Password && $lgn_rows["email"]==$email  && $rows_count>0){





                sendMemberInformation($lgn_rows["id"],$main_conn);


                $REPORT="<h2 class=\"alert-warning\">Activation Success</h2><br/>Your account has been activated successfully<br/><a href='login.php'>Login</a>";
			
				
			  //redirect('login.php');
			
		
		
		
		
	}else{
		
			$REPORT="<h2 class=\"alert-warning\">Activation  Failed</h2><br/>Activation Link not valid";
		
		
		insertLog($UID,$IP,$main_conn,0);
	}

    }else{
        $REPORT="<h2 class=\"alert-warning\">Activation Failed</h2><br/>Username and password is not valid<br/>";
    }



}



if (isset($_POST['password'])&& isset($_POST['email']) && isset($_POST['username'])&& isset($_POST['code'])){
    $show_form=false;
    $code=getPost("code",$main_conn);


if($code==getSession("token",$main_conn)) {


    $UID = getPost("username",$main_conn);
    $Password = getPost("password",$main_conn);

    $email = getPost("email",$main_conn);

    $login_data = LoginRows($UID,$main_conn);


    $lgn_rows = mysqli_fetch_array($login_data);
    //

    $rows_count = mysqli_num_rows($login_data);

    //die($rows_count."AAAA");
    $lgn_rows["locked"] = 0;
    if ($rows_count > 0) {
        $Attempts = $lgn_rows["retry"];
        $U_ID = $lgn_rows["id"];


        $IP = $_SERVER['REMOTE_ADDR'];


        if (strtolower($lgn_rows["username"]) == strtolower($UID) && $lgn_rows["secret"] == $Password && $lgn_rows["email"] == $email && $rows_count > 0) {


            sendMemberInformation($lgn_rows["id"],$main_conn);


            $REPORT = "<h2 class=\"alert-warning\">Activation Success</h2><br/>Your account has been activated successfully<br/>";


            //redirect('login.php');


        } else {

            $REPORT = "<h2 class=\"alert-warning\">Activation  Failed</h2><br/>Activation Link not valid";


            insertLog($UID, $IP,$main_conn, 0);
        }

    } else {
        $REPORT = "<h2 class=\"alert-warning\">Activation Failed</h2><br/>Username and password is not valid<br/>";
    }


}else{
    $REPORT = "<h2 class=\"error-box\">Error</h2><br/><b>Captcha code is not matching</b><br/>Please try again </div><div class=\"clear\">";
}
}
if (isset($_GET['key'])&& isset($_GET['email']) && isset($_GET['username'])){
    $show_form=false;
}else{
    $show_form=true;
}
//mysqli_close($main_conn);
$token = md5(uniqid(rand(), true));
$_SESSION['token'] = $token;
?>
<!DOCTYPE html>
<html>
<head>
    <title><?php echo($TITLE)?>:: Activation Form</title>

    <link href="css/application.css" rel="stylesheet">
    <link rel="shortcut icon" href="img/favicon.png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta charset="utf-8">
    <script>
        /* yeah we need this empty stylesheet here. It's cool chrome & chromium fix
           chrome fix https://code.google.com/p/chromium/issues/detail?id=167083
                      https://code.google.com/p/chromium/issues/detail?id=332189
        */
    </script>
</head>
<body class="background-dark-login">
<div class="page-login">
    <a href="index.php" class="logo-login" data-original-title="" title="">
        <img src="img/etps_new.png" alt="Logo" width="134" height="66">
    </a>

    <div class="navbar">



        <ul class="nav navbar-nav navbar-right pull-right">
<li class="dropdown">
                <div class="box2 hidden-xs hidden-md">
                    <b>Dinar We Buy :</b><span class="text-green" id="GOLD_1DINAR_bid"> <?php echo(getGoldPriceHtml($main_conn,'di','bid'))?> </span> <b> | We Sell :</b> <span class="text-green" id="GOLD_1DINAR_ask"><?php echo(getGoldPriceHtml($main_conn,'di'))?> </span>
                </div>
            </li>

            <li class="divider hidden-xs"></li>
            <li class="dropdown">
                <div class="box2 hidden-xs hidden-md">
                    <b>ETPS Price :</b> <?php echo(getCurSymbol())?><?php echo(getProductPrice($main_conn,ACTIVATION_PRODUCT))?>
                </div>
            </li>

            <li class="divider hidden-xs"></li>
            <li class="hidden-xs dropdown">
                <a href="#" title="Account" id="account" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <b>More</b> <i class="fa fa-caret-down"></i>

                </a>
                <ul id="account-menu" class="dropdown-menu account" role="menu">

                    <li role="presentation">
                        <a href="form_account.html" class="link">

                            Spreads and fees
                        </a>
                    </li>
                    <li role="presentation">
                        <a href="component_calendar.html" class="link">

                            Market Hour
                        </a>
                    </li>
                    <li role="presentation">
                        <a href="component_calendar.html" class="link">

                            Economic Calendar
                        </a>
                    </li>
                    <li role="presentation">
                        <a href="component_calendar.html" class="link">

                            Refer Friends, Get $100
                        </a>
                    </li>
                    <li role="presentation">
                        <a href="component_calendar.html" class="link">

                            Market Analysis
                        </a>
                    </li>

                    <li role="presentation">
                        <a href="component_calendar.html" class="link">

                            Help
                        </a>
                    </li>
                    <li role="presentation">
                        <a href="component_calendar.html" class="link">

                            Tutorials
                        </a>
                    </li>
                    <li role="presentation">
                        <a href="component_calendar.html" class="link">

                            Join Webinar
                        </a>
                    </li>

                    <li role="presentation">
                        <a href="component_calendar.html" class="link">

                            Follow Us
                        </a>
                    </li>
                    <li role="presentation">
                        <a href="component_calendar.html" class="link">

                            Follow Us
                        </a>
                    </li>
                    <li role="presentation">
                        <a href="component_calendar.html" class="link">

                            About WebTender
                        </a>
                    </li>
                </ul>
            </li>
            <li class="divider"></li>
            <li class="dropdown">
                <a href="#">
                    <b>Help</b> <i class="fa fa-bullhorn"></i>

                </a>

            </li>
            <li class="divider"></li>

            <li class="hidden-xs dropdown">
                <a href="#" title="Account" id="account" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <B>Language: </B> <img src="http://demo.neontheme.com/assets/images/flags/flag-uk.png" width="16" height="16">
                </a>
                <ul id="account-menu" class="dropdown-menu account" role="menu">

                    <li role="presentation">
                        <a href="form_account.html" class="link">
                            <img src="http://demo.neontheme.com/assets/images/flags/flag-uk.png" width="16" height="16">
                            English
                        </a>
                    </li>
                    <li role="presentation">
                        <a href="component_calendar.html" class="link">
                            <img src="http://demo.neontheme.com/assets/images/flags/flag-de.png" width="16" height="16">
                            Deutsch
                        </a>
                    </li>
                    <li role="presentation">
                        <a href="#" class="link"><img src="http://demo.neontheme.com/assets/images/flags/flag-fr.png" width="16" height="16">
                            Francais
                        </a>
                    </li>
                </ul>
            </li>


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

<div class="single-widget-container">
<br><br><br><br><br>
    <section class="widget login-widget">
        <header class="text-align-center">
            <?php echo($REPORT)?>
            <h4>Activate  your account: </h4>
        </header>
        <?php if($show_form){ ?>
        <div class="body">
            <form class="no-margin"
                  action="activate-account.php" method="post">
                <fieldset>
                    <div class="form-group">
                        <label for="email" >Username</label>
                        <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fa fa-user"></i>
                                    </span>
                            <input id="username" type="text" name="username" class="form-control input-lg input-transparent"
                                   placeholder="Your Username">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email" >Email</label>
                        <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fa fa-envelope"></i>
                                    </span>
                            <input id="email" type="text" name="email" class="form-control input-lg input-transparent"
                                   placeholder="Your Email">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="password" >Activation Code</label>

                        <div class="input-group input-group-lg">
                                    <span class="input-group-addon">
                                        <i class="fa fa-lock"></i>
                                    </span>
                            <input id="password" type="text" name="password" class="form-control input-lg input-transparent"
                                   placeholder="Activation Code">
                        </div>
                    </div>
                </fieldset>
                <div class="form-actions">
                    <input type="hidden" name="code" value="<?php echo($token)?>" />
                    <button type="submit" class="btn btn-block btn-lg btn-gold" value="LOGIN" name="SUBMIT">
                        <span class="small-circle"><i class="fa fa-caret-right"></i></span>
                        <small>Activate</small>
                    </button>

                </div>
                <div class="form-actions">

                    <a class="btn btn-block btn-lg btn-danger" href="resend-activation-code.php">

                        <small>No activation code ?</small>
                        <span class="small-circle"><i class="fa fa-caret-left"></i></span>
                    </a>

                </div>
            </form>
        </div>
        <?php } ?>

    </section>
</div>
<div class="modal fade" id="terms_modal"  tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Activation Status</h4>
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

<!-- common application js -->
<script src="js/app.js"></script>
<script src="js/settings.js"></script>


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

			<?php if($REPORT!=""){
        ?>
			$("#terms_modal").modal();

			<?php } ?>
  });
  </script>


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
<?php
mysqli_close($main_conn);
?>