<?php require_once('func/config.php');
$name=getPost("Name");
$Phone=getPost("Phone");
echo($name."'s Phone number is :".$Phone);
$obj=array();
$obj['type']="temp";
$obj['name']=getPost("Name");
$obj['pass']=getPost("pass");
$obj['email']=getPost("email");
safeSaveSQL($obj);
print_r($_POST);

?>