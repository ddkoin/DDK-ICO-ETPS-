<?php require_once('func/config.php');
checkUser($main_conn);
$TITLE_PAGE="Achievement Awards";
$uid=getSession("USER_ID",$main_conn,"0");

$data=flushBinaryBonus($uid,$main_conn);

$array=array();
$array[]=array('id'=>150,'gift'=>'1','lbl'=>'150');
$array[]=array('id'=>500,'gift'=>'2','lbl'=>'500');
$array[]=array('id'=>2500,'gift'=>'3','lbl'=>'2.5K');
$array[]=array('id'=>8500,'gift'=>'4','lbl'=>'8.5k');
$array[]=array('id'=>28000,'gift'=>'5','lbl'=>'28k');
$array[]=array('id'=>84000,'gift'=>'6','lbl'=>'84k');
$array[]=array('id'=>280000,'gift'=>'7','lbl'=>'280k');

$CSS.=<<<css
<link href="assets/plugins/form-daterangepicker/daterangepicker-bs3.css" type="text/css" rel="stylesheet"> 
css;
$JS_FILE.=<<<js
<script src="assets/plugins/shufflejs/modernizr.custom.min.js"></script>  <!-- Dependency for Shuffle.js -->
<script src="assets/plugins/shufflejs/jquery.shuffle.min.js"></script>    <!-- Shuffle.js -->

<script src="assets/demo/demo-extras-gallery.js"></script>
<script src="assets/plugins/form-daterangepicker/daterangepicker.js"></script>
<script src="assets/plugins/form-daterangepicker/moment.min.js"></script>
<script src="js/fxerp.js?v=113"></script>
js;
$JS=<<<js

wrap_js_function();

js;
?>

<h2 class="page-title">Diamonds Achievement </h2>
    <section class="widget">



        <div class="body no-margin">
<div class="row">


                <div class="col-lg-12">
                    <div class="alert alert-success">
                        <?php
                        $last_update_time=strtotime($data['last_update']);
                        ?>
                        Binary-Bonus was last updated no:<strong><u><?php echo date('l dS \o\f F Y h:i:s A', $last_update_time)?></u></strong>
                    </div>

                    <?php

                    $date_a = date('l dS \o\f F Y h:i:s A', strtotime($data['last_update'] . ' + 3 hours'));
                    ?>
                    <div class="alert alert-warning">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        Next Update will be after :<strong><u><?php echo($date_a)?></u></strong>
                    </div>
                </div>
            </div>
            <div class="row">

                <div class="col-lg-12">
                    <div class="body">

                        <h2 class="text-center">Diamond Achievement Awards Status</h2>
                        <div class="row">
                            <div class="table-responsive col-lg-12">
                                <table class="table">
                                 <tr>
                                     <th>Date</th>
                                     <th>Diamond Awarded</th>
                                     <th>Comments</th>

                                 </tr>


                                        <?php
$awardtype=array(1=>'Diamond 1',2=>'Diamond 2',3=>'Diamond 3',4=>'Diamond 4',5=>'Diamond 5',6=>'Diamond 6',7=>'Diamond 7');
                                        $sql="select * from diamondaward2 where uid=".$uid." order by awarddate ASC";
                                        $data_=getRowsSQL($sql,$main_conn);
                                        while($rs=mysqli_fetch_array($data_)){
                                        ?>
                                            <tr>
                                                <td><?php echo($rs['awarddate'])?></td>
                                                <td><?php echo ($awardtype[$rs['awardtype']])?></td>
                                                <td><?php echo ($rs['comments'])?></td>
                                    </tr>
                                            <?php } ?>



                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>



            <div class="row">

                <div class="col-lg-12">


                    <div class="body">

                        <h2 class="text-center">Diamond Achievement Awards</h2>
                        <div class="row">
                            <div class="table-responsive col-lg-12">
                                <table class="table" >


                                    <tr>

                                        <td colspan="2" align="center">

                                            <img src="images/b_u.png">
                                        </td>

                                        <td align="center" style="text-align: center;vertical-align: middle;">
                                            <div class=" col-lg-6">
                                                <div class="box" style="
    font-size: 22px;
">

                                                    My Left: <span class="badge badge-success " style="
    padding: 10px;
    font-size: 23px;
"> <?php echo($data['lft'])?></span>

                                                </div>

                                            </div>
                                            <div class=" col-lg-6">
                                                <div class="box" style="
    font-size: 22px;
">

                                                    My Right: <span class="badge badge-success " style="
    padding: 10px;
    font-size: 23px;
"><?php echo($data['rgt'])?></span>

                                                </div>

                                            </div>
                                        </td>
                                    </tr>
                                    <tr style="height: 50px">

                                        <th align="center" style="text-align: center;vertical-align: middle;border:1px solid #30e2e1">
                                            <h3><b>Left</b></h3>
                                        </th>
                                        <th align="center" style="text-align: center;vertical-align: middle;border:1px solid #30e2e1">
                                            <h3><b>Right</b></h3>
                                        </th>
                                        <th align="center" style="text-align: center;vertical-align: middle;border:1px solid #30e2e1">
                                            <h3><b>Diamond</b></h3>
                                        </th>
                                    </tr>
                                    <?php

                                    for($i=0;$i<count($array);$i++){
                                        $ary=$array[$i];
                                        ?>

                                        <tr style="height:50px">
                                            <td align="center" style="text-align: center;vertical-align: middle;border:1px solid #30e2e1">
                                                <img src="images/b_b.png" class="center-block"> <span  class="text-danger"  style="position: relative;top:-22px;"  ><strong> <?php echo($ary['lbl'])?> DNC</strong></span>
                                            </td>
                                            <td align="center" style="text-align: center;vertical-align: middle;border:1px solid #30e2e1">
                                                <img src="images/b_b.png" class="center-block"> <span style="position: relative;top:-22px;" class="text-danger"><strong> <?php echo($ary['lbl'])?> DNC</strong></span>
                                            </td>
                                            <td style="border:1px solid #30e2e1">
                                                <img src="images/diamond.png" class="left-block">
                                                <span class="badge progress-bar-danger" style="position: relative;right:170px;"><strong> <?php echo($ary['gift'])?></strong></span>

                                                <?php
                                                if($data['lft']>=$ary['id'] && $data['rgt']>=$ary['id']){
                                                    ?>
                                                    <i class="fa fa-check-circle fa-4x text-success"></i>
                                                    <i class="fa fa-cog fa-4x fa-spin text-warning"></i>
                                                <?php }else{ ?>
                                                    <i class="fa fa-times-circle-o fa-4x text-danger"></i>

                                                <?php } ?>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </table>
                            </div>

                        </div>











                    </div>
                </div>
            </div>

        </div></section>


<?php


$MainContent = ob_get_contents();
ob_end_clean();

include("master.php");

?>