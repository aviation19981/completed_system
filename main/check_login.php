
<?php

	$id = $_SESSION["id"];
	if ($id == '') {
		echo '<meta http-equiv="refresh" content="0; url=./index.php?page=nosession" />';
	}

?>
