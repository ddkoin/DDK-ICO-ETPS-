<?php require_once('func/config.php');
checkUser($main_conn);
$TITLE_PAGE="Edit Profile";
$uid=getSession("USER_ID",$main_conn,"0");

$JS_FILE="<script src=\"js/jquery.uploadifive.min.js\" type=\"text/javascript\"></script>\n";
$tbl_configs['0']['force_condition']= $conditions=array(array('col'=>'id','value'=>'s_USER_ID','type'=>'int'));
$add_panel=createAddPanel($uid,0,$main_conn);
$timestamp = time();
$token=md5('unique_salt' . $timestamp);
$docs_=checkDocuments($uid,$main_conn);
$doc_rows=mysqli_fetch_array($docs_);
$rows_count=mysqli_num_rows($docs_);
$PATH=UPLOAD_URL;

$file_2=UPLOAD_URL."na.jpg";
$COMMENTS="";
$COMMENTS_DT="";

$request=getRequest($uid,5,$main_conn);

if($rows_count>0){

$active=$doc_rows["active"];

$file_2=($doc_rows["doc3"]=="" ? $file_2:$doc_rows["doc3"]);
$COMMENTS=$doc_rows["Comments"];
$COMMENTS_DT=$doc_rows["CommentsDate"];

$file_2=(file_exists($_SERVER["DOCUMENT_ROOT"].UPLOAD_URL.$file_2) ? UPLOAD_URL.$file_2 : UPLOAD_URL."na.jpg");
}else{
addDocuments($uid,$main_conn);//initial add with empty doc
}

$JS_FILE.=<<<js
	//<script src="js/plugin/superbox/superbox.min.js"></script>

<script src="js/fxerp.js?v=2"></script>
<script type="text/javascript">


$(function() {

			$('#file_upload_doc_2').uploadifive({
				'auto'             : true,
				'fileSizeLimit' : '200KB',
				'checkScript'      : '$PATH/check-exists.php',
				'formData'         : {
									   'timestamp' : '$timestamp',
									   'token'     : '$token',
									   'uid'     : '$uid',
									   'col'     : 'doc3'

				                     },
				'queueID'          : 'queue_2',
				'uploadScript'     : '$PATH/uploadifive.php',
				'onUploadComplete' : function(file, data) {
					$('#doc_2').attr('src', data+'?$timestamp');
                   $('#doc_all').attr('src', data+'?$timestamp');

				 }
			});

		});


</script>

js;
$JS=<<<js

wrap_js_function();
//$('.superbox').SuperBox();

js;
$CSS="<link rel=\"stylesheet\" type=\"text/css\" href=\"css/uploadifive.css\">";
$CSS.="\n<style type=\"text/css\">

.uploadifive-button {
	float: left;
	margin-right: 10px;
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
?>



   
<h2 class="page-title">Profile </h2>
<div class="row">
	   <div class="col-md-8">
<section class="widget">
                    <header>
                        <h4><i class="fa fa-user"></i> Update your profile information</h4>
                    </header>
                    <div class="body">
                      <div id="deposit-panel">
            <?php echo($add_panel)?>
            </div>
                    </div>
                </section>

    	
            
       </div>
       
       
        <div class="col-md-4">
        
        <section class="widget">
                    <header>
                        <h4><i class="fa fa-user"></i> Upload profile photo</h4>
                    </header>
                    <div class="body">
                
          
                <ul class="gallery row">
						
							<div data-groups='["verification"]' class="item-wrapper col-md-12" data-name="Address verification doc">
								<div class="item">
									<img src="<?php echo($file_2)?>" class="superbox-img img-responsive" id="doc_2">
									<h3>Profile photo</h3>
								</div>
							</div>
                  </ul>
               
                 <p class="clearfix"></p>
            
				<p class="mb20"></p>
                <div id="queue_2" class="queue"></div>
                <input id="file_upload_doc_2" name="file_upload_doc_2" type="file" multiple="false">
		<p class="clearfix"></p>
				<div class="alert alert-dismissable alert-info">
					It must be valid  image file size must less than 100KB
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