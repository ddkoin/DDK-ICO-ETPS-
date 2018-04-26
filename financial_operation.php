<?php require_once('func/config.php'); 
checkUser($main_conn);
$TITLE_PAGE="FAQ";
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
<h2 class="page-title">Financial Operation</h2>
 
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
                            <li class="active">
                                <a href="#1" data-toggle="tab" aria-expanded="true">Financial operations</a>
                            </li>
                            <li class="">
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
                        <div id="1" class="tab-pane clearfix fade in active">
                        <ul class="nav  nav-justified">
    <li><a href="deposit_funds.php">Deposit funds</a></li>
    <li><a href="withdraw_funds.php">Withdraw funds</a></li>
    <li><a href="internal_transfer.php">Internal transfer</a></li>
    <li><a href="transaction_history.php">Transaction history</a></li>
    
  </ul>

                           
                            
                           
                           
                           
                            
                        </div>
                        <div id="2" class="tab-pane fade in" >
                        <ul class="nav  nav-justified">
    <li><a href="open_acc.php">Open account</a></li>
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
                
              
                
                
                
                <div class="row"> 
                             <div class="col-lg-6">
                             <section class="widget widget-tabs">
                    <header>
                        <ul class="nav nav-tabs responsive-tabs">
                            <li class="active">
                                <a href="#depositing" data-toggle="tab">Depositing</a>
                            </li>
                            <li>
                                <a href="#fund" data-toggle="tab">Widthdraw Funds </a>
                            </li>
                            
                             <li>
                                <a href="#transfer" data-toggle="tab">Transfer To Another Account </a>
                            </li>
                            
                        </ul>
                    </header>
                    <div class="body tab-content">
                        <div id="depositing" class="tab-pane active clearfix">
                           
                        
                        <form class="form-horizontal form-label-left" role="form">
                            <fieldset>
                                <legend class="section">Depositing</legend>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label" for="default-select">Account</label>
                                    <div class="col-sm-8">
                                        <select data-placeholder="Your Trading Account?"
                                                data-width="auto"
                                                data-minimum-results-for-search="10"
                                                tabindex="-1"
                                                class="select2 form-control" id="default-select">
                                            <option value=""></option>
                                            <option value="Magellanic">Large Magellanic Cloud</option>
                                            <option value="Andromeda">Andromeda Galaxy</option>
                                            <option value="Sextans">Sextans A</option>
                                        </select>
                                        
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label" for="payment">Payment System</label>
                                    <div class="col-sm-8">
                                        <select id="payment"
                                                data-placeholder="payment"
                                                class="select2 form-control"
                                                tabindex="-1"
                                                name="payment">
                                            <option value=""></option>
                                            <option value="visa">Visa/MasterCard</option>
                                            <option value="net">NETELLER</option>
                                            <option value="web">Web Money</option>
                                              <option value="wire">Wire Transfer</option>
                                              <option value="yuu">Yuu Collect</option>
                                              <option value="perfect">Perfect Money</option>
                                                <option value="ok">Ok Pay</option>
                                                  <option value="skrill">Skrill</option>
                                           
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label for="normal-field" class="col-sm-4 control-label">Ammount</label>
                               
                                    <div class="col-sm-4">
                                        <input type="text" id="normal-field" class="form-control" placeholder="">
                                    </div>
                                    <div class="col-sm-4">
                                        <select id="ammount"
                                                data-placeholder="ammount"
                                                class="select2 form-control"
                                                tabindex="-1"
                                                name="ammount">
                                            <option value="">USD</option>
                                            <option value="visa">EUR</option>
                                           
                                           
                                        </select>
                                    </div>
                                         <p class="help-block text-danger text-center">Amount cannot be blank.</p>
                                </div>
                                
                                
                                 <center><button type="submit" class="btn btn-lg btn-primary">Confirm</button></center><br>
                                
                            </fieldset>
                            
                        </form>
           
                            
                        </div>
                        <div id="fund" class="tab-pane = clearfix">
                         <form class="form-horizontal form-label-left" role="form">
                            <fieldset>
                                <legend class="section">Depositing</legend>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label" for="default-select">Account</label>
                                    <div class="col-sm-8">
                                        <select data-placeholder="Your Trading Account?"
                                                data-width="auto"
                                                data-minimum-results-for-search="10"
                                                tabindex="-1"
                                                class="select2 form-control" id="default-select">
                                            <option value=""></option>
                                            <option value="Magellanic">Large Magellanic Cloud</option>
                                            <option value="Andromeda">Andromeda Galaxy</option>
                                            <option value="Sextans">Sextans A</option>
                                        </select>
                                        
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label" for="payment">Payment System</label>
                                    <div class="col-sm-8">
                                        <select id="payment"
                                                data-placeholder="payment"
                                                class="select2 form-control"
                                                tabindex="-1"
                                                name="payment">
                                            <option value=""></option>
                                            <option value="visa">Visa/MasterCard</option>
                                            <option value="net">NETELLER</option>
                                            <option value="web">Web Money</option>
                                              <option value="wire">Wire Transfer</option>
                                              <option value="yuu">Yuu Collect</option>
                                              <option value="perfect">Perfect Money</option>
                                                <option value="ok">Ok Pay</option>
                                                  <option value="skrill">Skrill</option>
                                           
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label for="normal-field" class="col-sm-4 control-label">Ammount</label>
                               
                                    <div class="col-sm-4">
                                        <input type="text" id="normal-field" class="form-control" placeholder="">
                                    </div>
                                    <div class="col-sm-4">
                                        <select id="ammount"
                                                data-placeholder="ammount"
                                                class="select2 form-control"
                                                tabindex="-1"
                                                name="ammount">
                                            <option value="">USD</option>
                                            <option value="visa">EUR</option>
                                           
                                           
                                        </select>
                                    </div>
                                         <p class="help-block text-danger text-center">Amount cannot be blank.</p>
                                </div>
                                
                                
                                 <center><button type="submit" class="btn btn-lg btn-primary">Withdrawal</button></center><br>
                                
                            </fieldset>
                            
                        </form>
                        </div>
                        <div id="transfer" class="tab-pane  clearfix">
                         <form class="form-horizontal form-label-left" role="form">
                            <fieldset>
                                <legend class="section">Depositing</legend>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label" for="default-select">Account</label>
                                    <div class="col-sm-8">
                                        <select data-placeholder="Your Trading Account?"
                                                data-width="auto"
                                                data-minimum-results-for-search="10"
                                                tabindex="-1"
                                                class="select2 form-control" id="default-select">
                                            <option value=""></option>
                                            <option value="Magellanic">Large Magellanic Cloud</option>
                                            <option value="Andromeda">Andromeda Galaxy</option>
                                            <option value="Sextans">Sextans A</option>
                                        </select>
                                        
                                    </div>
                                </div>
                                
                                
                                <div class="form-group">
                                    <label for="normal-field" class="col-sm-4 control-label">Ammount</label>
                               
                                    <div class="col-sm-8">
                                        <input type="text" id="normal-field" class="form-control" placeholder="">
                                    </div>
                                    
                                       
                                </div>
                                
                                
                                 <center><button type="submit" class="btn btn-lg btn-primary">Transfer</button></center><br>
                                
                            </fieldset>
                            
                        </form>
                        </div>
                        
                    </div>
              
                             </div>
                              <div class="col-lg-6">
                             <section class="widget widget-tabs">
                    <header>
                        <ul class="nav nav-tabs">
                            <li class="active">
                                <a href="#request" data-toggle="tab">Request</a>
                            </li>
                           
                            
                        </ul>
                    </header>
                    <div class="body tab-content">
                        <div id="depositing" class="tab-pane active clearfix">
                           
                        
                        
       <table class="table">
			<tbody><tr>
                                    <th>Account</th>
                                    <th>Amount</th>
                                    <th>Status</th>
                                    <th>Created</th>
                                    <th>Accepted</th>
                			</tr>
                        <tr class="">
                                    <td class="">
                        621898                    </td>
                                    <td class="">
                        <s class="green"><span dir="ltr"><span>$&thinsp;</span><span>3.80</span></span></s>                    </td>
                                    <td class="">
                        Confirmed                    </td>
                                    <td class="">
                        2016-02-18 18:38:11                    </td>
                                    <td class="">
                        2016-02-18 18:38:15                    </td>
                            </tr>
                        <tr class="">
                                    <td class="">
                        3107667                    </td>
                                    <td class="">
                        <s class="red">-<span dir="ltr"><span>$&thinsp;</span><span>3.80</span></span></s>                    </td>
                                    <td class="">
                        Confirmed                    </td>
                                    <td class="">
                        2016-02-18 18:38:11                    </td>
                                    <td class="">
                        2016-02-18 18:38:15                    </td>
                            </tr>
                        <tr class="">
                                    <td class="">
                        621898                    </td>
                                    <td class="">
                        <s class="red">-<span dir="ltr"><span>$&thinsp;</span><span>163.80</span></span></s>                    </td>
                                    <td class="">
                        Confirmed                    </td>
                                    <td class="">
                        2016-02-17 13:15:01                    </td>
                                    <td class="">
                        2016-02-17 13:48:30                    </td>
                            </tr>
                        <tr class="">
                                    <td class="">
                        623628                    </td>
                                    <td class="">
                        <s class="green"><span dir="ltr"><span>$&thinsp;</span><span>100.00</span></span></s>                    </td>
                                    <td class="">
                        Confirmed                    </td>
                                    <td class="">
                        2016-02-12 12:42:11                    </td>
                                    <td class="">
                        2016-02-12 12:42:17                    </td>
                            </tr>
                        <tr class="">
                                    <td class="">
                        623628                    </td>
                                    <td class="">
                        <s class="green"><span dir="ltr"><span>$&thinsp;</span><span>100.00</span></span></s>                    </td>
                                    <td class="">
                        Confirmed                    </td>
                                    <td class="">
                        2016-02-12 12:31:39                    </td>
                                    <td class="">
                        2016-02-12 12:31:44                    </td>
                            </tr>
                        <tr class="">
                                    <td class="">
                        621898                    </td>
                                    <td class="">
                        <s class="red">-<span dir="ltr"><span>$&thinsp;</span><span>300.00</span></span></s>                    </td>
                                    <td class="">
                        Confirmed                    </td>
                                    <td class="">
                        2016-02-12 12:23:22                    </td>
                                    <td class="">
                        2016-02-12 12:23:26                    </td>
                            </tr>
            			<tr class="normlink">
				<td colspan="4"></td>
				<td>
					<center><button type="submit" class="btn btn-primary">All requests</button></center>
				</td>
			</tr>
		</tbody></table>
                            
                        </div>
                        
                        
                        
                    </div>
                </section>
                             </div>
                            </div>

     
              </section>     
                   

                
                   
                   




            
            
                
                












              


        </div>
          
          
          </div>
<?php


 $MainContent = ob_get_contents();
 ob_end_clean();
 
 include("master.php");

?>