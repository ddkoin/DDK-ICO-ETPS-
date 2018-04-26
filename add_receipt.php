<?php require_once('func/config.php');
checkUser($main_conn);
$TITLE_PAGE="Upload Receipt";
$tbl_index_q=my_simple_crypt("tbl_index","e");
$tbl_id_q=my_simple_crypt("id","e");
$uid=getSession("USER_ID",$main_conn);
$tbl_index=getQueryString($tbl_index_q,$main_conn);
$tbl_index_=$tbl_index;
//echo($tbl_id_q);
$tbl_id=getQueryString($tbl_id_q,$main_conn);
$tbl_id_=$tbl_id;
$tbl_index=my_simple_crypt($tbl_index,"d");
$tbl_id=my_simple_crypt($tbl_id,"d");


$ID=$tbl_id;
$JS_FILE="<script src=\"js/jquery.uploadifive.min.js\" type=\"text/javascript\"></script>";
$PATH=UPLOAD_URL;
$obj=array();
$obj['type']="deposit";
$obj['int_uid']=$uid;
$obj['int_id']=$ID;
$docs_=getRowsSingle($obj,$main_conn);
//print_r($docs_);

//$rows_count=mysqli_num_rows($docs_);

$active='0';
if($docs_){
    $rows_count=1;
    $active=$docs_['status'];
}
$file_1=UPLOAD_URL."receipt.png";

$COMMENTS="";
$COMMENTS_DT="";





    $file_1=($docs_["file"]=="" ? $file_1:$docs_["file"]);

    $COMMENTS=$docs_["comments"];
    $COMMENTS_DT=$docs_["amount"];
    $file_1=(file_exists($_SERVER["DOCUMENT_ROOT"].UPLOAD_URL.$file_1) ? UPLOAD_URL.$file_1 : UPLOAD_URL."receipt.png");




$CSS="<link rel=\"stylesheet\" type=\"text/css\" href=\"css/uploadifive.css\">";
$CSS.="\n<style type=\"text/css\">

.uploadifive-button {
	float: left;
	/*margin-right: 10px;*/
}
.queue {
	border: 1px solid #E5E5E5;
	height: 177px;
	overflow: auto;
	margin-bottom: 10px;
	padding: 0 3px 3px;
	width: 300px;
}
</style>";
$timestamp = time();
$token=md5('unique_salt' . $timestamp);
if($active=="0" ){
    $JS_FILE.=<<<js

<script type="text/javascript">
$(function() {
			$('#file_upload_doc_1').uploadifive({
				'auto'             : true,
				'fileSizeLimit' : '4000KB',
				'checkScript'      : '$PATH/check-exists.php',
				'formData'         : {
									   'timestamp' : '$timestamp',
									   'token'     : '$token',
									   'uid'     : '$uid',
									   'ID'     : '$ID',
									   'col'     : 'file'
									   
									   
				                     },
				'queueID'          : 'queue_1',
				'uploadScript'     : '$PATH/uploadifive_r.php',
				'onUploadComplete' : function(file, data) {
					$('#doc_1').attr('src', data+'?$timestamp');
				 }
			});
		});

</script>
		
js;
}

$JS_FILE.=<<<js
<script src="assets/plugins/shufflejs/modernizr.custom.min.js"></script>  <!-- Dependency for Shuffle.js -->
<script src="assets/plugins/shufflejs/jquery.shuffle.min.js"></script>    <!-- Shuffle.js -->

<script src="assets/demo/demo-extras-gallery.js"></script>
<script src="js/fxerp.js"></script>
js;

?>
    <form>
        <h2 class="page-title">Upload Transaction Receipt </h2>
        <div class="row">




            <div class="col-md-12">
                <section class="widget">

                    <div class="body">
                        <br />
                        <center>

                            <ul class="gallery row">

                                <div data-groups='["verification"]' class="item-wrapper col-md-12" data-name="Transaction Receipt">
                                    <div class="item">
                                        <img src="<?php echo($file_1)?>" class="img-responsive" id="doc_1" width="100">
                                        <h3>Upload Transaction Receipt</h3>
                                    </div>
                                </div>
                            </ul>

                            <p class="clearfix"></p>

                            <?php if($active=='0'){?>
                                <p class="mb20">
                                    Please Scan/Capture your transaction receipt and upload in the relevant section. <u>Please keep you file size less then 2MB.</u><br/></p>
                                <div id="queue_1" class="queue"></div>
                                <input id="file_upload_doc_1" name="file_upload_doc_1" type="file" multiple="false">
                                <p class="clearfix"></p>
                                <div class="panel-footer">
                                    <span class="text-gray">It must be valid  image file with properly scanned</span>
                                </div>
                            <?php } ?>



                        </center>

                    </div>
                </section>





            </div>









        </div>
    </form>

<?php


$MainContent = ob_get_contents();
ob_end_clean();

include("master.php");
?>