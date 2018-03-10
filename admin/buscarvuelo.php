<?php 
    include('./db_login.php');

    $dato = $_POST['callsign'];
    $contando = 0;
	$db = new mysqli($db_host , $db_username , $db_password , $db_database);
	$db->set_charset("utf8");
	if ($db->connect_errno > 0) {
		die('Unable to connect to database [' . $db->connect_error . ']');
	}
	

	
	
	
	                        $sql_operator = "SELECT route_id FROM routes where flight='$dato' and operator_id IN (" . implode(',', array_map('intval', $airlines)) . ")";
							if (!$result_operator = $db->query($sql_operator)) {
							die('There was an error running the query  [' . $db->error . ']');
							}
							
							while ($row_operator = $result_operator->fetch_assoc()) {
							$contando++;
							$identificacion = $row_operator['route_id'];
							
							}
							
							
							
							if($contando==0) {
$mensaje = "No existe ese vuelo.";
echo "<script>";
echo "alert('$mensaje');";  
echo "window.location = './?page=rutasva';";
echo "</script>";  	
							} else {
								echo "<script>";
echo "window.location = './?page=updatevuelova&vuelo=$identificacion';";
echo "</script>";  	
							}
							
							
							
							
							
							
						
							?>