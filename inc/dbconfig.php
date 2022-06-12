<?php

	include_once("conectionDB.php");

	session_start();


	if(!empty($_GET['close'])){
		session_destroy();
		header("Location: login.php");
	}

	$title = "Website Template";

?>