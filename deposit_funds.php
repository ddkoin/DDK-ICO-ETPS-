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
<h2 class="page-title">Deposit Funds</h2>
 
  
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
                             <li>
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
                        <div id="1" class="tab-pane  clearfix fade in active">
                           
  <ul class="nav  nav-justified">
    <li class="active2"><a href="deposit_funds.php">Deposit funds</a></li>
    <li><a href="withdraw_funds.php">Withdraw funds</a></li>
    <li><a href="internal_transfer.php">Internal transfer</a></li>
    <li><a href="transaction_history.php">Transaction history</a></li>
    
  </ul>
                            
                           
                           
                           
                            
                        </div>
                        <div id="2" class="tab-pane fade in">
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

             <section class="widget">             <div class="row"> 
                            <h3 class="text-center"> Choose payment system</h3><br>
                             <div class="col-lg-12">
                             <section class="widget widget-tabs">
                    <header>
                        <ul class="nav nav-tabs responsive-tabs">
                            <li class="active">
                                <a href="#popular" data-toggle="tab">POPULAR</a>
                            </li>
                            <li>
                                <a href="#electronic" data-toggle="tab">ELECTRONIC PAYMENT </a>
                            </li>
                            
                             <li>
                                <a href="#bank" data-toggle="tab">BANK CARDS </a>
                            </li>
                            
                             
                            
                             <li>
                                <a href="#international" data-toggle="tab">INTERNATIONAL BANK TRANSFERS </a>
                            </li>
                            
                             <li>
                                <a href="#ex" data-toggle="tab">EXCHARGERS </a>
                            </li>
                            
                        </ul>
                    </header>
                    <div class="body tab-content">
                        <div id="popular" class="tab-pane active clearfix">
                     <br >
                           
                        <div class="col-md-6 ">

            <div class="box_p">
            <div class="row">
              <a href="#" class="" data-toggle="modal" data-target="#myModal3" data-backdrop="static">
                   <div class="col-md-6 ">
                   
                  <img src="img/etps_new.png" alt="Logo" width="157" height="77">
                   </div>
       <div class="col-md-6 ">
           <span class="text_img"> Reimbursed by ETPS, in fact 3.9%, Instantly </span>
</div>

</a>
</div>
            </div>

        </div>
        
        <div class="col-md-6" >
       
        <div class="box_p">
            <div class="row">
             <a href="#" class="" data-toggle="modal" data-target="#myModal2" data-backdrop="static">
                   <div class="col-md-6 ">
                   
                  <img src="img/etps_new.png" alt="Logo" width="157" height="77">
                   </div>
       <div class="col-md-6 ">
               <span class="text_img"> Reimbursed by ETPS, in fact 0.8%, Instantly                                                                     </span>
</div>
 </a>
</div>
            </div>
           
        </div>
        
                  
                        <div class="col-md-6 ">

            <div class="box_p">
            <div class="row">
                   <div class="col-md-6 ">
                   
                  <img src="img/etps_new.png" alt="Logo" width="157" height="77">
                   </div>
       <div class="col-md-6 ">
               <span class="text_img"> Reimbursed by ETPS, in fact $1.00, Instantly </span>
</div>
</div>
            </div>

        </div>
        
        <div class="col-md-6" >
        <div class="box_p">
            <div class="row">
                   <div class="col-md-6 ">
                   
                  <img src="img/etps_new.png" alt="Logo" width="157" height="77">
                   </div>
       <div class="col-md-6 ">
               <span class="text_img"> Reimbursed by ETPS, in fact 0.5%, Instantly </span>
</div>
</div>
            </div>
        </div>
                      
                      
                                
                        <div class="col-md-6 ">

            <div class="box_p">
            <div class="row">
                   <div class="col-md-6 ">
                   
                  <img src="img/etps_new.png" alt="Logo" width="157" height="77">
                   </div>
       <div class="col-md-6 ">
              <span class="text_img">7.5%, Instantly </span>
</div>
</div>
            </div>

        </div>
        
        <div class="col-md-6" >
        <div class="box_p">
            <div class="row">
                   <div class="col-md-6 ">
                   
                  <img src="img/etps_new.png" alt="Logo" width="157" height="77">
                   </div>
       <div class="col-md-6 ">
                <span class="text_img"> Reimbursed by ETPS, in fact 3.9%, Instantly </span>
</div>
</div>
            </div>
        </div>
                      
                      
                                
                        <div class="col-md-6 ">

            <div class="box_p">
            <div class="row">
                   <div class="col-md-6 ">
                   
                  <img src="img/etps_new.png" alt="Logo" width="157" height="77">
                   </div>
       <div class="col-md-6 ">
               <span class="text_img"> 5 - 7 Bank Days</span>
</div>
</div>
            </div>

        </div>
        
    
                        
           
                            
                        </div>
                        <div id="electronic" class="tab-pane = clearfix">
                           <br >
                           
                        <div class="col-md-6 ">

            <div class="box_p">
            <div class="row">
                   <div class="col-md-6 ">
                   
                  <img src="img/etps_new.png" alt="Logo" width="157" height="77">
                   </div>
       <div class="col-md-6 ">
           <span class="text_img"> Reimbursed by ETPS, in fact 3.9%, Instantly </span>
</div>
</div>
            </div>

        </div>
        <div class="col-md-6 ">

            <div class="box_p">
            <div class="row">
                   <div class="col-md-6 ">
                   
                  <img src="img/etps_new.png" alt="Logo" width="157" height="77">
                   </div>
       <div class="col-md-6 ">
           <span class="text_img"> Reimbursed by ETPS, in fact 0.8%, Instantly </span>
</div>
</div>
            </div>

        </div>
        <div class="col-md-6 ">

            <div class="box_p">
            <div class="row">
                   <div class="col-md-6 ">
                   
                  <img src="img/etps_new.png" alt="Logo" width="157" height="77">
                   </div>
       <div class="col-md-6 ">
           <span class="text_img"> Reimbursed by ETPS, in fact 0.5%, Instantly </span>
</div>
</div>
            </div>

        </div>
        <div class="col-md-6 ">

            <div class="box_p">
            <div class="row">
                   <div class="col-md-6 ">
                   
                  <img src="img/etps_new.png" alt="Logo" width="157" height="77">
                   </div>
       <div class="col-md-6 ">
           <span class="text_img"> Reimbursed by ETPS, in fact 0.5%, Instantly </span>
</div>
</div>
            </div>

        </div>
        <div class="col-md-6 ">

            <div class="box_p">
            <div class="row">
                   <div class="col-md-6 ">
                   
                  <img src="img/etps_new.png" alt="Logo" width="157" height="77">
                   </div>
       <div class="col-md-6 ">
           <span class="text_img"> 7.5%, Instantly </span>
</div>
</div>
            </div>

        </div>
                        </div>
                        <div id="bank" class="tab-pane  clearfix">
                        <br>
                        <div class="col-md-6 ">

            <div class="box_p">
            <div class="row">
                   <div class="col-md-6 ">
                   
                  <img src="img/etps_new.png" alt="Logo" width="157" height="77">
                   </div>
       <div class="col-md-6 ">
           <span class="text_img">  China UnionPay </span>
</div>
</div>
            </div>

        </div>
        
        <div class="col-md-6 ">

            <div class="box_p">
            <div class="row">
                   <div class="col-md-6 ">
                   
                  <img src="img/etps_new.png" alt="Logo" width="157" height="77">
                   </div>
       <div class="col-md-6 ">
           <span class="text_img"> Reimbursed by FBS, in fact $1.00, Instantly</span>
</div>
</div>
            </div>

        </div>
        
        <div class="col-md-6 ">

            <div class="box_p">
            <div class="row">
                   <div class="col-md-6 ">
                   
                  <img src="img/etps_new.png" alt="Logo" width="157" height="77">
                   </div>
       <div class="col-md-6 ">
           <span class="text_img"> Reimbursed by FBS, in fact 0.5%, Instantly </span>
</div>
</div>
            </div>

        </div>
                         
                        </div>
                        
                         <div id="international" class="tab-pane  clearfix">
                         <br>
                        <div class="col-md-6 ">

            <div class="box_p">
            <div class="row">
                   <div class="col-md-6 ">
                   
                  <img src="img/etps_new.png" alt="Logo" width="157" height="77">
                   </div>
       <div class="col-md-6 ">
           <span class="text_img">  5 - 7 Bank days</span>
</div>
</div>
            </div>

        </div>
 
                        <div class="col-md-6 ">

            <div class="box_p">
            <div class="row">
                   <div class="col-md-6 ">
                   
                  <img src="img/etps_new.png" alt="Logo" width="157" height="77">
                   </div>
       <div class="col-md-6 ">
           <span class="text_img">  3%, 5-7 working business days </span>
</div>
</div>
            </div>

        </div>
                        </div>
                        
                          <div id="ex" class="tab-pane  clearfix">
                          <br>
                          <div class="col-md-6 ">

            <div class="box_p">
            <div class="row">
                   <div class="col-md-5 ">
                   
                  <img src="img/etps_new.png" alt="Logo" width="157" height="77">
                   </div>
       <div class="col-md-7 ">
           <span class="text_img"> You can learn the exact commission amount from exchangers website,Instantly                                             </span>
</div>
</div>
            </div>

        </div>
        
        <div class="col-md-6 ">

            <div class="box_p">
            <div class="row">
                   <div class="col-md-5 ">
                   
                  <img src="img/etps_new.png" alt="Logo" width="157" height="77">
                   </div>
       <div class="col-md-7 ">
           <span class="text_img"> Rangkaian exchanger yang terpercaya, efisien di rantau Asia Tenggara, berazam memberikan perkhidmatan terbaik kepada pelanggan di rantau ini                                            </span>
</div>
</div>
            </div>

        </div>
        
        <div class="col-md-6 ">

            <div class="box_p">
            <div class="row">
                   <div class="col-md-5 ">
                   
                  <img src="img/etps_new.png" alt="Logo" width="157" height="77">
                   </div>
       <div class="col-md-7 ">
           <span class="text_img">    You can learn the exact exchange and commission rates on exchanger website. Payments are processed instantly.   </span>
</div>
</div>
            </div>

        </div>
                         
                        </div>
                        
                    </div>
                </section>
                             </div>
                              
                            </div></section>
     
                   
                   

                
                   
                   




            
            
                
                












              


        </div>
          
          
          </div>

  
    <div id="myModal3" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                            <div class="modal-dialog modal-md">
                                <div class="modal-content">

                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                        <h4 class="modal-title" id="myModalLabel2">DEPOSITING</h4>
                                    </div>
                                    <div class="modal-body">
                                    <div class="row">
                                       <div class="col-md-12 ">
                                       
                                       
                                       
                                       
                                       
                                       
                                       <form>
                            <fieldset>
                             
                                
                                <div class="form-group">
                             
                               <div class="row">
                                    <div class="col-sm-6">
                                        <input type="text"  class="form-control" placeholder="Ammount">
                                    </div>
                                    <div class="col-sm-6">
                                        <select id="ammount"
                                                data-placeholder="ammount"
                                                class="select2 form-control"
                                                tabindex="-1"
                                                name="ammount">
                                            <option value="">WMZ</option>
                                            <option value="visa">WMR</option>
                                             <option value="visa">WME</option>
                                              <option value="visa">WMU</option>
                                           
                                           
                                        </select>
                                       <!--  <p class="help-block text-danger text-center">Amount cannot be blank.</p>-->
                                    </div>
                                    </div>
                                         
                                </div>
                                <div class="form-group">
                                  
                               
                                        <select data-placeholder="Your Trading Account?" class="select2 form-control" id="default-select">
                                            <option value="Account">Account</option>
                                            <option value="1">618102</option>
                                            <option value="2">3107667</option>
                                            <option value="3">621898</option>
                                             <option value="4">623628</option>
                                        </select>
                                
                                </div>
                                
                                
                                <div class="form-group">
                             
                           
                                        <input type="text"  class="form-control" placeholder="Username">
                                  
                                    
                                    </div>
                                    
                                    <div class="form-group">
                             
                           
                                        <input type="text"  class="form-control" placeholder="Password">
                                  
                                    
                                    </div>
                                         
                                </div>
                                
                                
                                 <center><button type="submit" class="btn btn-lg btn-success"><b>Deposit Funds</b></button></center><br>
                                
                            </fieldset>
                            
                        </form>

                                       
                                      </div>
</
                                    </div>
                                    

                                </div><!-- /.modal-content -->
                            </div><!-- /.modal-dialog -->
                        </div>
                        
                        </div>

    
    
    
             <div id="myModal2" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                            <div class="modal-dialog modal-md">
                                <div class="modal-content">

                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                        <h4 class="modal-title" id="myModalLabel2">DEPOSITING</h4>
                                    </div>
                                    <div class="modal-body">
                                    <div class="row">
                                       <div class="col-md-12 ">
                                       
                                       
                                       
                                       
                                       
                                       
                                       <form>
                            <fieldset>
                             
                                
                                <div class="form-group">
                             
                               <div class="row">
                                    <div class="col-sm-6">
                                        <input type="text"  class="form-control" placeholder="Amount">
                                    </div>
                                    <div class="col-sm-6">
                                        <select id="amount"
                                                data-placeholder="amount"
                                                class="select2 form-control"
                                                tabindex="-1"
                                                name="amount">
                                            <option value="">WMZ</option>
                                            <option value="visa">WMR</option>
                                             <option value="visa">WME</option>
                                              <option value="visa">WMU</option>
                                           
                                           
                                        </select>
                                       <!--  <p class="help-block text-danger text-center">Amount cannot be blank.</p>-->
                                    </div>
                                    </div>
                                         
                                </div>
                                <div class="form-group">
                                  
                               
                                        <select data-placeholder="Your Trading Account?" class="select2 form-control" id="default-select">
                                            <option value="Account">Account</option>
                                            <option value="1">618102</option>
                                            <option value="2">3107667</option>
                                            <option value="3">621898</option>
                                             <option value="4">623628</option>
                                        </select>
                                
                                </div>
                                
                                
                                
                                
                                
                                 <center><button type="submit" class="btn btn-lg btn-success"><b>Deposit Funds</b></button></center><br>
                                
                            </fieldset>
                            
                        </form>

                                       
                                      </div>
</
                                    </div>
                                    

                                </div><!-- /.modal-content -->
                            </div><!-- /.modal-dialog -->
                        </div>
                        
                        </div>

          
<?php


 $MainContent = ob_get_contents();
 ob_end_clean();
 
 include("master.php");

?>