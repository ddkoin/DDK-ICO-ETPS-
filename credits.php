<?php require_once('func/config.php'); 
checkUser();
$TITLE_PAGE="Credits";
$uid=getSession("USER_ID","0");

$Wallets=getWallets($uid,"USD");

$Wallets=mysqli_fetch_array($Wallets);


$lObj["type_index"]="12";
$lObj["uid"]=$uid;
$lObj['order_by']="id";
$lObj['order_type']="DESC";
$deposit=getListShort_($lObj,5);

$lObj["type_index"]="13";
$lObj["uid"]=$uid;
$lObj['order_by']="id";
$lObj['order_type']="DESC";
$withdraw=getListShort_($lObj,5);

$lObj["type_index"]="14";
$lObj["uid"]=$uid;
$lObj['order_by']="id";
$lObj['order_type']="DESC";
$transfer=getListShort_($lObj,5);

$lObj=array();
$lObj["type_index"]="5";
$lObj["account_id"]=$uid;
$lObj['order_by']="id";
$lObj['order_type']="DESC";
$transactions=getListShort_($lObj,5);

$JS_FILE.=<<<js
<script src="assets/plugins/shufflejs/modernizr.custom.min.js"></script>  <!-- Dependency for Shuffle.js -->
<script src="assets/plugins/shufflejs/jquery.shuffle.min.js"></script>    <!-- Shuffle.js -->

<script src="assets/demo/demo-extras-gallery.js"></script>
<script src="js/fxerp.js?v=2"></script>
js;

?>



    <h2 class="page-title">Wallet </h2>


<section class="widget">
                    <header>
                        <h4> Wallets</h4>
                    </header>
                    <div class="body">
        <div class="table-responsive">
			<table class="table table-striped">
				<thead>
				<tr class="info">
					<th width="10%">Currency</th><th width="20%">Amount</th>
					<th width="20%">Reserved</th><th width="10%">Deposit</th>
					<th width="10%">Withdraw</th><th width="20%">Trasnfer to member</th>

				</tr>
				</thead>
				<tbody><tr><td><?php echo(getCurSymbol())?></td>
					<td><span id='my_balance'><?php echo number_format($Wallets['balance'],2)?></span></td>
					<td><span id='my_reserve'><?php echo number_format($Wallets['reserve'],2)?></span></td>
					<td><span id='mybal_1'><a href="javascript:void(0)" onclick="handleNew_('deposit_new_12',1,'Deposit to IB')" class="btn btn-primary">Deposit</a></span></td>
					<td><span id='mybal_2'><a href="javascript:void(0)" onclick="handleNew_('withdraw_new_13',1,'Withdraw from IB')" class="btn btn-danger">Withdraw</a></span></td>
					<td><span id='mybal_3'><a href="javascript:void(0)" onclick="handleNew_('transfer_new_14',1,'Transfer to Members')" class="btn btn-warning">Transfer</a></span></td>

				</tr>
				</tbody>
			</table>
		</div>
                    </div>
                </section>
                
                
                
	


<section class="widget">
                    <header>
                        <h4> List of recent deposit request</small></h4>
                    </header>
                    <div class="body">
                      
            <?php echo($deposit)?>
    
                    </div>
                </section>
             
       
       
       
 <section class="widget">
                    <header>
                        <h4> List of recent withdraw request</h4>
                    </header>
                    <div class="body">
                       <?php echo($withdraw)?> 
                    </div>
                </section>
          

    	
            <section class="widget">
                    <header>
                        <h4> List of recent transfer</h4>
                    </header>
                    <div class="body">
                         <?php echo($transfer)?>
                    </div>
                </section>

    <section class="widget">
        <header>
            <h4> List of recent transaction</h4>
        </header>
        <div class="body">
            <?php echo($transactions)?>
        </div>
    </section>
            
            





<?php


 $MainContent = ob_get_contents();
 ob_end_clean();
 
 include("master.php");

?>