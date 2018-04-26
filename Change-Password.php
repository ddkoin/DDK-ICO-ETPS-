<?php
require_once('func/config.php');
$REPORT="";
checkUser($main_conn);
$TITLE_PAGE="Change password";
$lable="password";
$pw_type=getQueryString("type",$main_conn,"0");
if($pw_type=="1"){
	$TITLE_PAGE="Change PIN CODE";
    $lable="PIN CODE";
}
$SMS=false;
$USER_ID=getSession("USER_ID",$main_conn,"0");
$JS_FILE.=<<<js

<script src="js/fxerp.js?v=2"></script>

js;

 ?>
 
 
 
     <h2 class="page-title">Change <?php echo($lable)?> </h2>
 


		<section class="widget">
                    <header>
                        <h4><i class="fa fa-lock"></i> Change  <?php echo($lable)?> </h4>
                    </header>
                    <div class="body">
               <div class="row">
                                
                                <div class="col-md-8">
 <form validate="onchange" mark year4 onReset="this.lang='en';" name="form1" method="post"  onSubmit="return validateForm(this)" >

            <table class="table table-striped">
            
              <tr>
                <td class="labelwidth"><label>Current  <?php echo($lable)?>:</label></td>
                <td><input class="form-control" size="16" name="prevpass" type="password"></td>
              </tr>
              <tr>
                <td><label>New <?php echo($lable)?>:</label></td>
                <td>
                  <input class="form-control" type="password" size="16" name="newpass">
                  </td>
              </tr>
              <tr>
                <td><label>Confirm new  <?php echo($lable)?>:</label></td>
                <td width="382">
                  <input class="form-control" type="password" size="16" name="confirmnewpass">
                  </td>
              </tr>
              <tr>
                <td class="text" valign="middle" height="32"><label>Turing Number:</label></td>
                <td valign="middle" height="32"><img src="captcha.php" alt="Encoded CAPTCHA Image" height="38" width="150"></td>
              </tr>
              <tr>
                <td class="subtitle" colspan="2" align="center">
                 </td>
              </tr>
              <tr>
                <td class="text" ><label>Enter the Turing Number:</label></td>
                <td height="30"><input id="strCAPTCHA" class="form-control" type="text" name="strCAPTCHA" maxlength="8" size="20"></td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td align="left"><p class="unnamed1"><a href="javascript:void(0)" onclick="changePass(<?php echo($pw_type)?>)" class="btn btn-primary"><?php echo($TITLE_PAGE)?></a> </p></td>
              </tr>
                <?php if($pw_type=="1"){?>
                    <tr>
                        <td>&nbsp;Forgot PIN Code ?</td>
                        <td align="left"><p class="unnamed1"><a href="javascript:void(0)" onclick="getPass(<?php echo($pw_type)?>)" class="btn btn-success">Reset PIN code</a> </p></td>
                    </tr>
                <?php } ?>
                  
             
             
        
            </table>
              </FORM>
            </div>
      <div class="col-md-4">   
         <div class="information">
          
            <h2 class="alert alert-danger"> <i class="fa  fa-fw fa-warning"></i> A Warning Alert</h2>
                <p align="left" style="margin-right:10px;"><b>Important :</b><br>
                
                    Please keep your password in a safe place and do not divulge it 
                    to anyone. Also remember to sign off your account and close your 
                    browser window when you have finished your visit. This is especially 
                    important if you are sharing a computer with someone else or are 
                    using a computer in a public place such as a library or Internet 
                    cafe. <i><b>Don't give your username and password out to 
                    untrusted third-parties.</b></i></p>
                    </div>
                </div>    
                    
        </div>
         
			
                    </div>
                </section>
				
                   
          
        
        
 <?php
 
 $TITLE =$H1." :: ". $TITLE;
 $MainContent = ob_get_contents();
 ob_end_clean();
 include("master.php");

?>
