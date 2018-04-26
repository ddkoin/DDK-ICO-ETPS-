<?php require_once('func/config.php'); 
checkUser();
$TITLE_PAGE="List of Fund Received";
$uid=getSession("USER_ID","0");

$html_deposits=report_panel(17);


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
<h2 class="page-title">About ETPS </h2>
 
<section class="widget">

                <header>

                    <h4>

                     Information &amp; Stats

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
                                    <td>yourname</td>
                                </tr>
                                </thead>
                                <tbody>

                                <tr>
                                    <td><b>Introducer</b></td>
                                    <td>ole2</td>
                                </tr>

                                <tr>
                                    <td><b>Account Status</b></td>
                                    <td>111 </td>
                                </tr>
                                
                               
                              



                                </tbody>
                            </table>


                </div>

            </section>
    	
<?php


 $MainContent = ob_get_contents();
 ob_end_clean();
 
 include("master.php");

?>