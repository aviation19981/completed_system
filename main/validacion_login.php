<?php
	session_start();
	if (isset($_GET['lang'])) {
		$_SESSION['language'] = $_GET['lang'];
	} elseif (!isset($_SESSION['language'])) {
		$_SESSION['language'] = "es";
	}

	
	include('./db_login.php');
	include('./languagesdd.php');
	include('./va_parameters.php');
	$idiomas = './languages/lang_' . $_SESSION['language'] . '.php';
    include('./hangar_review.php');
	include('./review_reserves.php');
    include('./va_parameters.php');
    include('./review_test.php');
    include('./review_invite.php');
    include('./review_class.php');
	include('./get_pilot_data.php');
	include('./review_rank.php');
	

?>