<?php
	header("Access-Control-Allow-Origin: *");
	require_once('../SqlCon.php');

	$sql = new SqlCon();
	$sql->getSql('user',1);
?>