<?php require_once('func/config.php');

checkUser($main_conn);
           $last_date=lastDateFromFeed($main_conn);
                    $prev_date=strtotime ( '-1 day' , strtotime ( $last_date ) ) ;
                    $prev_date=date('Y-m-d',$prev_date);
                    $p_high=dailyHighLow($main_conn,$prev_date,1);
                    $p_low=dailyHighLow($main_conn,$prev_date);

                    $c_high=dailyHighLow($main_conn,$last_date,1);
                    $c_low=dailyHighLow($main_conn,$last_date);

                    $css_1=($p_high>$c_high)?"fa fa-caret-down color-red":"fa fa-caret-up color-green";
                    $css_2=($p_low>$c_low)?"fa fa-caret-down color-red":"fa fa-caret-up color-green";

                    ?>


        <div class="col-sm-3 col-xs-6">

            <div class="key"><i class="fa fa-plus-square"></i> Daily High</div>

            <div class="value"><?php echo "$". number_format($c_high,2) ?> <i class="<?php echo($css_1)?>"></i></div>

        </div>

        <div class="col-sm-3 col-xs-6">

            <div class="key"><i class="fa fa-user"></i> Daily Low</div>

            <div class="value"><?php echo "$". number_format($c_low,2) ?>  <i class="<?php echo($css_2)?>"></i></div>

        </div>

