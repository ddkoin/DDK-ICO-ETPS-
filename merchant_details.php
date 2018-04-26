<?php require_once('func/config.php'); 
checkUser($main_conn);
$uid=getSession("USER_ID",$main_conn,"0");
$qry=getQueryString("merchant_id",$main_conn,$uid);
$TITLE_PAGE="Your Merchant Profile";

$timestamp = time();
$token=md5('unique_salt' . $timestamp);

$PATH=UPLOAD_URL;
$merchant_check="select id from merchant where uid=".$uid;
$is_merchant=getRowsSingleSQL($merchant_check,$main_conn);

if($is_merchant){
    $merchant_details_check="select uid from merchantdetails where uid=".$uid;
    if(!getRowsSingleSQL($merchant_details_check,$main_conn)){
        $insert="insert into merchantdetails(uid)values($uid)";
        updatebySQL($insert,$main_conn);

    }

}else{
    redirect("index.php");
}
$sql="select * from merchantdetails where uid=".$uid."";
if($qry==$uid){
    $sql="select * from merchantdetails where uid=".$uid."";
}else{
    $sql="select * from merchantdetails where uid=".$qry." and status=1";
}
$data_merchant=getRowsSingleSQL($sql,$main_conn);
if(!$data_merchant){
    redirect("index.php");
}


$file_na=UPLOAD_URL."logo_na.jpg";
$logo=($data_merchant["logo"]=="" ? $file_na:$data_merchant["logo"]);


//die();
$file_2=(file_exists($_SERVER["DOCUMENT_ROOT"].UPLOAD_URL.$logo) ? UPLOAD_URL.$logo : $file_na);

$CSS.=<<<css
<style type="text/css">
.divider {
  height: 20px;
  display: block;
}

/* ========================================================================
 * FORM MISC
 * ======================================================================== */
.input-group-addon {
  -moz-border-radius: 0px;
  -webkit-border-radius: 0px;
  border-radius: 0px;
  min-width: 39px;
}
.input-group-addon .ckbox, .input-group-addon .rdio {
  position: absolute;
  top: 4px;
  left: 10px;
}

.input-group-lg > .form-control, .input-group-lg > .input-group-addon, .input-group-lg > .input-group-btn > .btn, .input-group-sm > .form-control, .input-group-sm > .input-group-addon, .input-group-sm > .input-group-btn > .btn, .input-group-xs > .form-control, .input-group-xs > .input-group-addon, .input-group-xs > .input-group-btn > .btn {
  -moz-border-radius: 0px;
  -webkit-border-radius: 0px;
  border-radius: 0px;
}

.input-sm, .form-group-sm .form-control {
  -moz-border-radius: 0px;
  -webkit-border-radius: 0px;
  border-radius: 0px;
}

.form-control {
  -moz-border-radius: 0px;
  -webkit-border-radius: 0px;
  border-radius: 0px;
  -moz-box-shadow: none;
  -webkit-box-shadow: none;
  box-shadow: none;
}

@media (max-width: 640px) {
  .form-inner-all [class*="col-"]:last-child .form-control {
    margin-top: 15px;
  }
}


/* ========================================================================
 * PROFILE
 * ======================================================================== */
.profile-cover {
  width: 100%;
}
.profile-cover .cover {
  position: relative;
  border: 10px solid #FFF;
}
.profile-cover .cover .inner-cover {
  overflow: hidden;
  height: auto;
}
.profile-cover .cover .inner-cover img {
  border: 1px solid transparent;
  text-align: center;
  width: 100%;
}
.profile-cover .cover .inner-cover .cover-menu-mobile {
  position: absolute;
  top: 10px;
  right: 10px;
}
.profile-cover .cover .inner-cover .cover-menu-mobile button i {
  font-size: 17px;
}
.profile-cover .cover ul.cover-menu {
  padding-left: 150px;
  position: absolute;
  overflow: hidden;
  left: 1px;
  float: left;
  bottom: 0px;
  width: 100%;
  margin: 0px;
  background: none repeat scroll 0% 0% rgba(0, 0, 0, 0.24);
}
.profile-cover .cover ul.cover-menu li {
  display: block;
  float: left;
  margin-right: 0px;
  padding: 0px 10px;
  line-height: 40px;
  height: 40px;
  -moz-transition: all 0.3s;
  -o-transition: all 0.3s;
  -webkit-transition: all 0.3s;
  transition: all 0.3s;
}
.profile-cover .cover ul.cover-menu li:hover {
  background-color: rgba(0, 0, 0, 0.44);
}
.profile-cover .cover ul.cover-menu li.active {
  background-color: rgba(0, 0, 0, 0.64);
}
.profile-cover .cover ul.cover-menu li a {
  color: #FFF;
  font-weight: bold;
  display: block;
  height: 40px;
  line-height: 40px;
  text-decoration: none;
}
.profile-cover .cover ul.cover-menu li a i {
  font-size: 18px;
}
.profile-cover .profile-body {
  margin: 0px auto 10px;
  position: relative;
}
.profile-cover .profile-timeline {
  padding: 15px;
}
.img-post{
    width:30px;
    height:30px;
}
.img-post2{
    width:50px;
    height:50px;
}
</style>
css;
$JS_FILE.=<<<js
<script src="assets/plugins/shufflejs/modernizr.custom.min.js"></script>  <!-- Dependency for Shuffle.js -->
<script src="assets/plugins/shufflejs/jquery.shuffle.min.js"></script>    <!-- Shuffle.js -->

<script src="assets/demo/demo-extras-gallery.js"></script>
js;
$JS_FILE.=<<<js
<script src="js/fxerp.js?v=2"></script>
<script src="js/merchant.js?v=2"></script>

js;
$span_class="form-control";
?>
<!--
<h2 class="page-title">Merchant : <?php echo($data_merchant['companyname'])?></h2>
 
<section class="widget">

               <div class="col-lg-6">
                   <div class="body no-margin">

                       <div class="form-row">
                           <div class="form-group col-md-6">
                               <label for="companyname">Company Name</label>
                               <span class="<?php echo($span_class)?>"><?php echo($data_merchant['companyname'])?></span>

                           </div>
                           <div class="form-group col-md-6">
                               <label for="ssm">ROC/SSM No</label>

                               <span class="<?php echo($span_class)?>"><?php echo($data_merchant['ssm'])?></span>
                           </div>
                       </div>
                       <div class="form-group">
                           <label for="branchname">Branch Name</label>
                           <span class="<?php echo($span_class)?>"><?php echo($data_merchant['branchname'])?></span>
                       </div>
                       <div class="form-group">
                           <label for="shortdescription">Short Description</label>

                           <span class="<?php echo($span_class)?>"><?php echo($data_merchant['shortdescription'])?></span>
                       </div>
                       <div class="form-group">
                           <label for="description">Description</label>
                           <span class="<?php echo($span_class)?>"><?php echo($data_merchant['description'])?></span>
                       </div>
                       <div class="form-row">
                           <div class="form-group col-md-4">
                               <label for="addressunitnumber">Address</label>

                               <span class="<?php echo($span_class)?>"><?php echo($data_merchant['addressunitnumber'])?></span>
                           </div>
                           <div class="form-group col-md-4">
                               <label for="streetname">Street</label>
                               <span class="<?php echo($span_class)?>"><?php echo($data_merchant['streetname'])?></span>

                           </div>
                           <div class="form-group col-md-4">
                               <label for="postcode">postcode</label>
                               <span class="<?php echo($span_class)?>"><?php echo($data_merchant['postcode'])?></span>

                           </div>
                       </div>
                       <div class="form-row">
                           <div class="form-group col-md-4">
                               <label for="city">City</label>

                               <span class="<?php echo($span_class)?>"><?php echo($data_merchant['city'])?></span>
                           </div>
                           <div class="form-group col-md-4">
                               <label for="state">State</label>

                               <span class="<?php echo($span_class)?>"><?php echo($data_merchant['state'])?></span>
                           </div>
                           <div class="form-group col-md-4">
                               <label for="country">Country</label>
                               <span class="<?php echo($span_class)?>"><?php echo getCountryName($data_merchant['country'],$main_conn)?></span>
                           </div>
                       </div>

                       <div class="form-group">
                           <label for="description">Contact Information</label>

                           <span class="<?php echo($span_class)?>"><?php echo($data_merchant['contactperson'])?></span>

                       </div>
                       <div class="form-group">
                           <label for="description">Operating hours</label>


                           <span class="<?php echo($span_class)?>"><?php echo($data_merchant['operatinghour'])?></span>
                       </div>
                       <div class="input-group">

                           <span class="<?php echo($span_class)?>"><?php echo($data_merchant['phone'])?></span>

                       </div>
                       <div class="form-group"></div>
                       <div class="input-group">


                           <span class="<?php echo($span_class)?>"><?php echo($data_merchant['fax'])?></span>

                       </div>
                       <div class="form-group"></div>

                       <div class="input-group">


                           <span class="<?php echo($span_class)?>"><?php echo($data_merchant['mobile'])?></span>

                       </div>
                       <div class="form-group"></div>
                       <div class="form-group">

                           <label for="website">Company Website</label>
                           <span class="<?php echo($span_class)?>"><?php echo($data_merchant['website'])?></span>
                       </div>
                       <div class="form-group">

                       </div>
                       <div class="form-group">
                           <label for="nric">NRIC/Passport No.</label>
                           <span class="<?php echo($span_class)?>"><?php echo($data_merchant['nric'])?></span>

                       </div>

                       <div class="form-group">
                           <label for="description">Email</label>
                           <span class="<?php echo($span_class)?>"><?php echo($data_merchant['email'])?></span>

                       </div>
                       <div class="form-group">

                       </div>

</div>
               </div>
    <div class="col-lg-6">

        <section class="widget">

            <div class="body">


<div class="col-md-4">
    <div class="item">
        <img src="<?php echo($file_2)?>" class="superbox-img img-responsive" id="doc_2">

    </div>
</div>
                <div class="col-md-8">






                </div>










                <div class="clearfix"></div>
            </div>

        </section>

        <div class="clearfix"></div>


        <section class="widget">
            <header>

                <h4>

                    Store-front and

                    <small>
                        Image gallery

                    </small>

                </h4>



            </header>
            <div class="body">



                    <div class="item" id="merchan_gallery" class="gal">
<ul class="gallery">
                        <?php echo(getMerchantGalleryPhotos($uid,$main_conn))?>
</ul>
                        <p class="clearfix"></p>
                    </div>

















                <div class="clearfix"></div>
            </div>

        </section>
    </div>
    <div class="clearfix"></div>
            </section>
-->
    <section class="widget">
    <div class="container bootstrap snippets">
        <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-4">
                <div class="panel rounded shadow">
                    <div class="panel-body">
                        <div class="inner-all">
                            <ul class="list-unstyled">
                                <li class="text-center">
                                    <img data-no-retina="" class="img-circle img-responsive img-bordered-primary" src="<?php echo($file_2)?>" alt="<?php echo($data_merchant['companyname'])?>">
                                </li>
                                <li class="text-center">
                                    <h4 class="text-capitalize"><?php echo($data_merchant['companyname'])?>  </h4>
                                    <p class="text-muted text-capitalize"><?php echo($data_merchant['shortdescription'])?></p>
                                </li>
                                <li>
                                    <a href="" class="btn btn-success text-center btn-block">RCO/SSM:<?php echo($data_merchant['ssm'])?></a>
                                </li>
                                <li><br></li>
                                <li>
                                    <div class="btn-group-vertical btn-block">
                                        <a href="" class="btn btn-default"><i class="fa fa-cog pull-right"></i>Edit Account</a>
                                        <a href="" class="btn btn-default"><i class="fa fa-sign-out pull-right"></i>Logout</a>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div><!-- /.panel -->

                <div class="panel panel-theme rounded shadow">
                    <div class="panel-heading">
                        <div class="pull-left">
                            <h3 class="panel-title">Contact</h3>
                        </div>
                        <div class="pull-right">
                            <a href="#" class="btn btn-sm btn-primary"><i class="fa fa-facebook"></i></a>
                            <a href="#" class="btn btn-sm btn-primary"><i class="fa fa-twitter"></i></a>
                            <a href="#" class="btn btn-sm btn-danger"><i class="fa fa-google-plus"></i></a>
                        </div>
                        <div class="clearfix"></div>
                    </div><!-- /.panel-heading -->
                    <div class="panel-body no-padding rounded">
                        <ul class="list-group no-margin">
                            <li class="list-group-item"><i class="fa fa-envelope mr-5"></i> support@bootdey.com</li>
                            <li class="list-group-item"><i class="fa fa-globe mr-5"></i> www.bootdey.com</li>
                            <li class="list-group-item"><i class="fa fa-phone mr-5"></i> +6281 903 xxx xxx</li>
                        </ul>
                    </div><!-- /.panel-body -->
                </div><!-- /.panel -->

            </div>
            <div class="col-lg-9 col-md-9 col-sm-8">

                <div class="profile-cover">
                    <div class="cover rounded shadow no-overflow">
                        <div class="inner-cover">
                            <!-- Start offcanvas btn group menu: This menu will take position at the top of profile cover (mobile only). -->
                            <div class="btn-group cover-menu-mobile hidden-lg hidden-md">
                                <button type="button" class="btn btn-theme btn-sm dropdown-toggle" data-toggle="dropdown">
                                    <i class="fa fa-bars"></i>
                                </button>
                                <ul class="dropdown-menu pull-right no-border" role="menu">
                                    <li class="active"><a href="#"><i class="fa fa-fw fa-clock-o"></i> <span>Timeline</span></a></li>
                                    <li><a href="#"><i class="fa fa-fw fa-user"></i> <span>About</span></a></li>
                                    <li><a href="#"><i class="fa fa-fw fa-photo"></i> <span>Photos</span> <small>(98)</small></a></li>
                                    <li><a href="#"><i class="fa fa-fw fa-users"></i><span> Friends </span><small>(23)</small></a></li>
                                    <li><a href="#"><i class="fa fa-fw fa-envelope"></i> <span>Messages</span> <small>(7 new)</small></a></li>
                                </ul>
                            </div>
                            <img  src="http://bootdey.com/img/Content/flores-amarillas-wallpaper.jpeg" class="img-responsive full-width" alt="cover" style="max-height:200px;">
                        </div>
                        <ul class="list-unstyled no-padding hidden-sm hidden-xs cover-menu">
                            <li class="active"><a href="#"><i class="fa fa-fw fa-clock-o"></i> <span>Timeline</span></a></li>
                            <li><a href="#"><i class="fa fa-fw fa-user"></i> <span>About</span></a></li>
                            <li><a href="#"><i class="fa fa-fw fa-photo"></i> <span>Photos</span> <small>(98)</small></a></li>
                            <li><a href="#"><i class="fa fa-fw fa-users"></i><span> Friends </span><small>(23)</small></a></li>

                        </ul>
                    </div><!-- /.cover -->
                </div><!-- /.profile-cover -->
                <div class="divider"></div>
                <div class="panel rounded shadow">
                    <form action="...">
                        <textarea class="form-control input-lg no-border" rows="2" placeholder="What are you doing?..."></textarea>
                    </form>
                    <div class="panel-footer">
                        <button class="btn btn-success pull-right mt-5">POST</button>
                        <ul class="nav nav-pills">
                            <li><a href="#"><i class="fa fa-user"></i></a></li>
                            <li><a href="#"><i class="fa fa-map-marker"></i></a></li>
                            <li><a href="#"><i class="fa fa-camera"></i></a></li>
                            <li><a href="#"><i class="fa fa-smile-o"></i></a></li>
                        </ul><!-- /.nav nav-pills -->
                    </div><!-- /.panel-footer -->
                </div><!-- /.panel -->
                <div class="row">
                    <div class="col-md-6">
                        <div class="panel panel-success rounded shadow">
                            <div class="panel-heading no-border">
                                <div class="pull-left half">
                                    <div class="media">
                                        <div class="media-object pull-left">
                                            <img src="http://bootdey.com/img/Content/avatar/avatar2.png" alt="..." class="img-circle img-post">
                                        </div>
                                        <div class="media-body">
                                            <a href="#" class="media-heading block mb-0 h4 text-white">John Doe</a>
                                            <span class="text-white h6">on 8th June, 2014</span>
                                        </div>
                                    </div>
                                </div><!-- /.pull-left -->
                                <div class="pull-right">
                                    <a href="#" class="text-white h4"><i class="fa fa-heart"></i> 15.5K</a>
                                </div><!-- /.pull-right -->
                                <div class="clearfix"></div>
                            </div><!-- /.panel-heading -->
                            <div class="panel-body no-padding">
                                <img  src="http://lorempixel.com/340/210/nature/4/" alt="..." class="img-responsive full-width">
                                <div class="inner-all block">
                                    view all <a href="#">7 comments</a>
                                </div><!-- /.inner-all -->
                                <div class="line no-margin"></div><!-- /.line -->
                                <div class="media inner-all no-margin">
                                    <div class="pull-left">
                                        <img src="http://bootdey.com/img/Content/avatar/avatar6.png" alt="..." class="img-post2">
                                    </div><!-- /.pull-left -->
                                    <div class="media-body">
                                        <a href="#" class="h4">John Doe</a>
                                        <small class="block text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. </small>
                                        <em class="text-xs text-muted">Posted on <span class="text-danger">Dec 08, 2014</span></em>
                                    </div><!-- /.media-body -->
                                </div><!-- /.media -->
                                <div class="line no-margin"></div><!-- /.line -->
                                <div class="media inner-all no-margin">
                                    <div class="pull-left">
                                        <img src="http://bootdey.com/img/Content/avatar/avatar4.png" alt="..." class="img-post2">
                                    </div><!-- /.pull-left -->
                                    <div class="media-body">
                                        <a href="#" class="h4">John Doe</a>
                                        <small class="block text-muted">Quaerat, impedit minus non commodi facere doloribus nemo ea voluptate nesciunt deleniti.</small>
                                        <em class="text-xs text-muted">Posted on <span class="text-danger">Dec 08, 2014</span></em>
                                    </div><!-- /.media-body -->
                                </div><!-- /.media -->
                            </div><!-- /.panel-body -->
                            <div class="panel-footer">
                                <form action="#" class="form-horizontal">
                                    <div class="form-group has-feedback no-margin">
                                        <input class="form-control" type="text" placeholder="Your comment here...">
                                        <button type="submit" class="btn btn-theme fa fa-search form-control-feedback"></button>
                                    </div>
                                </form>
                            </div><!-- /.panel-footer -->
                        </div><!-- /.panel -->
                    </div>
                    <div class="col-md-6">
                        <div class="panel panel-success rounded shadow">
                            <div class="panel-heading no-border">
                                <div class="pull-left half">
                                    <div class="media">
                                        <div class="media-object pull-left">
                                            <img src="http://bootdey.com/img/Content/avatar/avatar6.png" alt="..." class="img-circle img-post">
                                        </div>
                                        <div class="media-body">
                                            <a href="#" class="media-heading block mb-0 h4 text-white">John Doe</a>
                                            <span class="text-white h6">on 8th June, 2014</span>
                                        </div>
                                    </div>
                                </div><!-- /.pull-left -->
                                <div class="pull-right">
                                    <a href="#" class="text-white h4"><i class="fa fa-heart"></i> 15.5K</a>
                                </div><!-- /.pull-right -->
                                <div class="clearfix"></div>
                            </div><!-- /.panel-heading -->
                            <div class="panel-body no-padding">
                                <div class="inner-all block">
                                    <h4>Upload on my album :D</h4>
                                    <p>
                                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Expedita, iste omnis fugiat porro consequuntur ratione iure error reprehenderit cum est ab similique magnam molestias aperiam voluptatibus quia aliquid! Sed, minima.
                                    </p>
                                    <blockquote class="mb-10">Lorem ipsum dolor sit amet, consectetur adipisicing elit. A, delectus!</blockquote>

                                    <img data-no-retina="" src="http://lorempixel.com/340/210/nature/1/" alt="..." width="100">
                                    <img data-no-retina="" src="http://lorempixel.com/340/210/nature/2/" alt="..." width="100">
                                    <img data-no-retina="" src="http://lorempixel.com/340/210/nature/3/" alt="..." width="100">
                                </div><!-- /.inner-all -->
                                <div class="inner-all bg-success">
                                    view all <a href="#">7 comments</a>
                                </div>
                            </div><!-- /.panel-body -->
                            <div class="panel-footer no-padding no-border">
                                <div class="media inner-all no-margin">
                                    <div class="pull-left">
                                        <img src="http://bootdey.com/img/Content/avatar/avatar3.png" alt="..." class="img-post2">
                                    </div><!-- /.pull-left -->
                                    <div class="media-body">
                                        <a href="#" class="h4">John Doe</a>
                                        <small class="block text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. </small>
                                        <em class="text-xs text-muted">Posted on <span class="text-danger">Dec 08, 2014</span></em>
                                    </div><!-- /.media-body -->
                                </div><!-- /.media -->
                                <div class="line no-margin"></div><!-- /.line -->
                                <div class="media inner-all no-margin">
                                    <div class="pull-left">
                                        <img src="http://bootdey.com/img/Content/avatar/avatar5.png" alt="..." class="img-post2">
                                    </div><!-- /.pull-left -->
                                    <div class="media-body">
                                        <a href="#" class="h4">John Doe</a>
                                        <small class="block text-muted">Quaerat, impedit minus non commodi facere doloribus nemo ea voluptate nesciunt deleniti.</small>
                                        <em class="text-xs text-muted">Posted on <span class="text-danger">Dec 08, 2014</span></em>
                                    </div><!-- /.media-body -->
                                </div><!-- /.media -->
                                <div class="line no-margin"></div><!-- /.line -->
                                <form action="#" class="form-horizontal inner-all">
                                    <div class="form-group has-feedback no-margin">
                                        <input class="form-control" type="text" placeholder="Your comment here...">
                                        <button type="submit" class="btn btn-theme fa fa-search form-control-feedback"></button>
                                    </div>
                                </form><!-- /.form-horizontal -->
                            </div><!-- /.panel-footer -->
                        </div><!-- /.panel -->
                    </div>
                </div>
            </div>
        </div>
    </div>
        </section>
<?php


 $MainContent = ob_get_contents();
 ob_end_clean();
 
 include("master.php");

?>