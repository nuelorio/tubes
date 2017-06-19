<?php 
	
$server 	= 'localhost';
$user		= 'root';
$pass		= '';
$database	= 'bangkos';

$db 		= mysqli_connect($server,$user,$pass,$database);
if(mysqli_connect_errno()){
	echo 'database bermasalah:'.mysqli_connect_error();
	die();
}
define('BASEURL',$_SERVER['DOCUMENT_ROOT'].'/tubes/');

//list_helper
function sanitize($dirty){
	return htmlentities($dirty,ENT_QUOTES,"UTF-8");
}
function display_errors($errors){
	$display = '<ul class = "bg-danger">';
	foreach($errors as $error){
		$display .= '<li class = "text-danger">'.$error.'</li>';
	}
	$display .= '</ul>';
	return $display;
}

?>