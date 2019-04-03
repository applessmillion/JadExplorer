<?php
require_once 'config.php';

if(isset($_GET['creation'])){
	$con = new mysqli($ip,$p_user,$p_pw,$db);
	### Asset is being created.
}
elseif(isset($_GET['edit'])){
	$con = new mysqli($ip,$p_user,$p_pw,$db);
	### Asset is being modified.
}
else{
	echo "Unknown modification method."; 
}
?>