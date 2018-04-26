<?php require_once('func/config.php');
checkUser($main_conn);
$TITLE_PAGE="Certificate";
$uid=getSession("USER_ID",$main_conn,"0");
$ID=getQueryString("id",$main_conn,0);


$obj=array();
$obj['type']='buy';
$obj['int_id']=$ID;
$obj['int_account_id']=$uid;
//$obj['int_status']=0;
$d=getRowsSingle($obj,$main_conn);
$s_body="";
$CUR="USD";


function jsDateE($input){
    $date = strtotime($input);
        return  date("Y/m/d",$date);
}
if($d){
    if($d['indnc']=="1"){
        $CUR="DNC";
    }
    $s_body = file_get_contents("email_tem/certificate.html");


    $receiver=getUserDetails($uid,$main_conn);
   $r_name = preg_split('/[\s,]+/', $receiver["name"], 3);
    $r_name_=$receiver["name"];
    if(count($r_name)>1){
      $r_name_=$r_name[0]." ".$r_name[1];
    }
    $Q_CODE="etps-gold|".$d["id"]."|".$d["account_id"]."|".$d["quantity"]."|".$d["price"]."|".$d["cost"]."|".$d["insert_time"]."|".$receiver["username"]."|".$receiver["name"];
   // $Q_CODE="ID:".$d["id"].",".PHP_EOL ."Pur. Date:".jsDateE($d["insert_time"]).",".PHP_EOL ."Pur. price:".$d["cost"]."USD,".PHP_EOL ."Month left :".(6-$d["hibah_count"]).",".PHP_EOL ."Username:".$receiver["username"].",".PHP_EOL ."Name:".$receiver["name"].",".PHP_EOL ."Item:DinarCoin Crypto Asset 999.9";


// $Q_CODE="ID:".$d["id"].",".PHP_EOL ."Pur. Date:".jsDateE($d["insert_time"]).",".PHP_EOL ."Pur. price:".$d["cost"]."USD,".PHP_EOL ."Month left :".(6-$d["hibah_count"]).",".PHP_EOL ."Username:".$receiver["username"].",".PHP_EOL ."Name:".$r_name_.",".PHP_EOL ."Item:DinarCoin Crypto Asset 999.9";
 $Q_CODE="ID:".$d["id"].",".PHP_EOL ."Pur. Date:".jsDateE($d["insert_time"]).",".PHP_EOL ."Pur. price:".$d["cost"].$CUR.",".PHP_EOL ."Month left :".(6-$d["hibah_count"]).",".PHP_EOL ."Username:".$receiver["username"].",".PHP_EOL ."Item:DinarCoin Crypto Asset 999.9";
    $s_body     = preg_replace('/{NAME}/u', $receiver['name'], $s_body);
    $s_body     = preg_replace('/{UNIT}/u', $d['quantity'], $s_body);
    $s_body     = preg_replace('/{PRICE}/u', $d['cost'], $s_body);
    $s_body     = preg_replace('/{PXD}/u', jsDateE($d["insert_time"]), $s_body);
    $s_body     = preg_replace('/{CUR}/u', $CUR, $s_body);
    $s_body     = preg_replace('/{TODAY_DATE}/u', date("Y/m/d"), $s_body);
    $s_body     = preg_replace('/{#Q_CODE}/u',  $Q_CODE, $s_body);

    ob_clean();
    $message=$s_body;
    $content = $s_body;
  //  die($Q_CODE);
    // convert to PDF
    require_once(dirname(__FILE__).'/func/html2pdf.class.php');

    $pdfdoc='';
//
    try
    {
        $width_in_mm=265;
        $height_in_mm=200;
        $html2pdf = new HTML2PDF('P', array($width_in_mm,$height_in_mm), 'en', true, 'UTF-8', array(0, 0, 0, 0));
        $html2pdf->pdf->SetDisplayMode('real');
//      $html2pdf->pdf->SetProtection(array('print'), 'spipu');
        $html2pdf->writeHTML($content, isset($_GET['vuehtml']));
        //$html2pdf->Output('test.pdf');
        header("Content-Disposition: attachment; filename=receipt.pdf");
        $html2pdf->Output('certificate.pdf');

    }
    catch(HTML2PDF_exception $e) {
        echo $e;
    }
}else{
    echo("<h2>Something wrong</h2>");
}
mysqli_close($main_conn);
?>