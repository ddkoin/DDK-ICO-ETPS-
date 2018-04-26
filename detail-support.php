<?php require_once('func/config.php'); 
checkUser($main_conn);
$TITLE_PAGE="Support Tickets";
$uid=getSession("USER_ID",$main_conn,"0");
$ID=getQueryString("ID",$main_conn,"0");

$obj=array();
			
$obj['type']='support';
$obj['int_uid']=$uid;
$obj['int_id']=$ID;
			
$rs= getRowsSingle($obj,$main_conn);
$list_msg="";
if($rs){
$list_msg=getSupportMessageNew($rs["id"],$main_conn);

    $obj=array();
	$obj['type']='message';
	$obj['read']=1;
	$obj["pk"]="thread_id";
	$obj["pk_val"]=$rs["id"];
    safeUpdateSQL($obj,$main_conn);
	$dept=$rs["department"];
	$dep=isset($DEPARTMENT[$dept]['en'])?$DEPARTMENT[$dept]['en']:"";

$JS_FILE.=<<<js
<script src="assets/plugins/shufflejs/modernizr.custom.min.js"></script>  <!-- Dependency for Shuffle.js -->
<script src="assets/plugins/shufflejs/jquery.shuffle.min.js"></script>    <!-- Shuffle.js -->

<script src="assets/demo/demo-extras-gallery.js"></script>
<script src="js/fxerp.js?v=2"></script>
js;

?>
	 <div class="col-md-12">
                        <div class="panel panel-gray">
                          <div class="panel-body mailbox-panel">
                            <header>
                              <h3 class="pull-left mt0 mb0"><?php echo($dep)?> - <?php echo($rs["subject"])?></h3>
                              <div class=" pull-right">
                                <div class="btn-group">
                                  <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
                                      <i class="fa fa-cog"></i> Action <i class="fa fa-angle-down fa-sm"></i> </button>
                                  <ul class="dropdown-menu">
                                    <li><a href="javascript:void(0)" onclick="makeSupportClose(<?php echo($rs["id"])?>,1);">Mark as Resolved</a></li>
                                  
                                 
                                  </ul>
                                </div>
                                <!-- <button type="button" class="btn btn-sm btn-default"><i class="fa fa-search"></i></button> -->
                              </div>
                            </header>
                              <div class="clearfix"></div>
                            <section class="tabular" id="support_list">
                           <?php echo($list_msg)?>
                            </section>
                            <div class="panel-footer">
                              <textarea name="textarea" rows="4" id="post" class="form-control" style="resize: none; width: none;" placeholder="Write a reply..."></textarea>
                              <div class="msg-composer">
                                <div class="pull-left"> </div>
                                <div class="pull-right clearfix"> <a href="javascript:void(0)" onclick="postMessage(<?php echo($ID)?>)" class="btn btn-primary btn-sm send-btn pull-right">Send</a> </div>
                              </div>
                            </div>
                          </div>
                          </div>
<?php
	}

 $MainContent = ob_get_contents();
 ob_end_clean();
 
 include("master.php");

?>