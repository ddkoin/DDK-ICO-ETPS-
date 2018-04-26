<?php require_once('func/config.php'); 
checkUser($main_conn);
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
<h2 class="page-title">Open Account</h2>
 
  
      <div class="row"> 
        
        
<div class="col-lg-3">
            <section class="widget widget-tabs">
                    <header>
                        <ul class="nav nav-tabs ">
                            <li class="active">
                                <a href="#stats" data-toggle="tab" aria-expanded="true">Real</a>
                            </li>
                            <li class="">
                                <a href="#report" data-toggle="tab" aria-expanded="false">Demo</a>
                            </li>
                            
                        </ul>
                    </header>
                    <div class="body tab-content">
                        <div id="stats" class="tab-pane clearfix active">
                           <div class="alert alert-info">
                    
                    <strong><i class="fa fa-info-circle"></i> Trading</strong>  <a class="pull-right" href="open_acc.php"><button type="button" class="btn btn-primary btn-sm" data-placement="top" data-original-title=".btn .btn-primary .btn-sm">
                                      <i class="fa fa-plus" aria-hidden="true"></i> Add Account 
                                    </button></a>
                </div>
                           <table width="100%" class="table">
                    <tbody><tr>
                                    <th colspan="3">MT4 Micro Account</th>
                            </tr>
                            <tr>
                    <td>
                      621898
                    </td>
                    <td>
                        
                        
                                                  
                                <i class="ico-0"></i>
                  
                                            </td>
                    <td >$11.30
                        
                    </td>
                </tr>
                            <tr>
                    <td>
                        623628
                    </td>
                    <td>
                        
                        
                                                
                                <i class="ico-0"></i>
                        
                                            </td>
                    <td>$0.44
                        
                    </td>
                </tr>
                        
                    <tr>
                                    <th colspan="3">MT4 STP Account</th>
                            </tr>
                            <tr>
                    <td >
                       618102
                    </td>
                    <td >
                        
                        
                              </td>
                    <td>$0.00
                        
                    </td>
                </tr>
                        
                    <tr>
                                    <th colspan="3">Competition Account</th>
                            </tr>
                            <tr>
                    <td>
                      3107667
                    </td>
                    <td>
                        
                        
                                            </td>
                    <td>$0.006
                        
                    </td>
                </tr>
                        
                		
    </tbody></table>
                            
                        </div>
                        <div id="report" class="tab-pane">
<div class="alert alert-info">
                    
                    <strong><i class="fa fa-info-circle"></i> Trading</strong>  <a class="pull-right" href="open_acc.php"><button type="button" class="btn btn-primary btn-sm" data-placement="top" data-original-title=".btn .btn-primary .btn-sm">
                                      <i class="fa fa-plus" aria-hidden="true"></i> Add Account 
                                    </button></a>
                </div>
  
                           <table width="100%" class="table">
                    <tbody><tr>
                                    <th colspan="3">MT4 Micro Account</th>
                            </tr>
                            <tr>
                    <td>
                      621898
                    </td>
                    <td>
                        
                        
                                                  
                                <i class="ico-0"></i>
                  
                                            </td>
                    <td >$11.30
                        
                    </td>
                </tr>
                            <tr>
                    <td>
                        623628
                    </td>
                    <td>
                        
                        
                                                
                                <i class="ico-0"></i>
                        
                                            </td>
                    <td>$0.44
                        
                    </td>
                </tr>
                        
                    <tr>
                                    <th colspan="3">MT4 STP Account</th>
                            </tr>
                            <tr>
                    <td >
                       618102
                    </td>
                    <td >
                        
                        
                              </td>
                    <td>$0.00
                        
                    </td>
                </tr>
                        
                   
                        
                		
    </tbody></table>
                            
                        </div>
                        
                        
                    </div>
                </section>

     
                   
                   

                
                   
                   




            
            
                
                












              


        </div>
        
        
        <div class="col-lg-9">
          <section class="widget widget-tabs ">
                    <header>
                        <ul class="nav nav-tabs responsive-tabs">
                          <li>
                                <a href="#1" data-toggle="tab" aria-expanded="true">Financial operations</a>
                            </li>
                             <li class="active">
                                <a href="#2" data-toggle="tab" aria-expanded="false">Accounts</a>
                            </li>
                            
                            
                             <li class="">
                                <a href="#3" data-toggle="tab" aria-expanded="false">Trading platform</a>
                            </li>
                               <li class="">
                                <a href="#4" data-toggle="tab" aria-expanded="false">Promotions & bonuses</a>
                            </li>
                             <li class="">
                                <a href="#5" data-toggle="tab" aria-expanded="false">Contests</a>
                            </li>
                        </ul>
                    </header>
                    <div class="body tab-content responsive">
                        <div id="1" class="tab-pane fade in">

  <ul class="nav  nav-justified">
    <li><a href="deposit_funds.php">Deposit funds</a></li>
    <li><a href="withdraw_funds.php">Withdraw funds</a></li>
    <li><a href="internal_transfer.php">Internal transfer</a></li>
    <li><a href="transaction_history.php">Transaction history</a></li>
    
  </ul>


                           
                            
                           
                           
                           
                            
                        </div>
                        <div id="2" class="tab-pane clearfix fade in active">
 <ul class="nav  nav-justified">
    <li class="active2"><a href="open_acc.php">Open account</a></li>
    <li><a href="acc_type.php">Account types</a></li>
    <li><a href="acc_arc.php">Accounts Archive</a></li>
 
    
  </ul>
                          
                        
                        </div>
                        
                        <div id="3" class="tab-pane fade in">

 <ul class="nav  nav-justified">
    <li><a href="platform_pc.php">MT4 For PC</a></li>
    <li><a href="platform_mobile.php">MT4 For Mobile</a></li>
  
 
    
  </ul>
                           
                        </div>
                        
                        <div id="4" class="tab-pane fade in">

<ul class="nav  nav-justified">
    <li><a href="bonus_deposit.php">Bonus 100% on deposit </a></li>
    <li><a href="platform_mobile.php">Gift T-shirts</a></li>
  
 
    
  </ul>
            

                        </div>
                        
                        <div id="5" class="tab-pane fade in">

<ul class="nav  nav-justified">
    <li><a href="#">All </a></li>
    <li><a href="demo_contest.php">ETPS Pro demo-contest</a></li>
  
 
    
  </ul>
         
                           
                        </div>
                        
                        
                    </div>
                </section>


            <section class="widget"> 

 




            <div class="row"> 
                            <h3 class="text-center"> Open Account</h3><br>
                             <div class="col-lg-12">
                             <form>
                            <fieldset>
                             
                                
                                 <div class="col-sm-12">
                                <div class="form-group">
                               
                              
                                  <label><b>Account Type</b></label>
                                        <select data-placeholder="Account Type" class="select2 form-control" id="default-select">
                                            <option value="Account">Select Account Type</option>
                                            <option value="1">Micro Account</option>
                                            <option value="2">	STP Account</option>
                                           
                                        </select>
                                </div>
                                
                             
                                </div>
                                  <div class="col-sm-12">
                                <div class="form-group">
                               
                             
                                  <label><b>Initial Currency</b></label>
                                        <select data-placeholder="Initial Currency?" class="select2 form-control" id="default-select">
                                            <option value="1">USD</option>
                                           
                                        </select>
                                </div>
                                
                             
                                </div>
                                   <div class="col-sm-12">
                                <div class="form-group">
                               
                            
                                  <label><b>Leverage</b></label>
                                        <select data-placeholder="Leverage?" class="select2 form-control" id="default-select">
                                           
                                            <option value="1">1:2000</option>
                                          
                                        </select>
                                </div>
                                
                             
                                </div>
                         
                            </fieldset>
                            <div class="form-actions">
                                <div class="btn-toolbar">
                                   <center> <button type="submit" class="btn btn-lg btn-success"><b>Open Account</b></button></center>
                              
                                </div>
                            </div>
                        </form>
                             </div>
                              
                            </div></section>
                   
                   

                
                   
                   




            
            
                
                












              


        </div>
          
          
          </div>

  
  

          
<?php


 $MainContent = ob_get_contents();
 ob_end_clean();
 
 include("master.php");

?>