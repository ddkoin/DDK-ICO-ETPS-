<?php require_once('func/config.php'); 
checkUser($main_conn);
$uid=getSession("USER_ID",$main_conn,'0');
header('Content-Type: application/json; charset=utf-8');
$id=getQueryString("id",$main_conn,'0');


$rslt_child = array();


	$data=getRefUsers($id,$main_conn);


	while ($rs = mysqli_fetch_array($data)) {
		$id_=$rs['uid'];
		$usr=getUserDetails($id_);
		$name=$usr['name'];
        $img=getAvatar($id_);
		$rslt_child[] = array('id' => $id_, 'text' => $name,'icon'=>$img);
	}


	echo json_encode($rslt_child);

?>
