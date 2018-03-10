<?php 
    include('./db_login.php');

    $dato = $_POST['icao'];
    $contando = 0;
	$db = new mysqli($db_host , $db_username , $db_password , $db_database);
	$db->set_charset("utf8");
	if ($db->connect_errno > 0) {
		die('Unable to connect to database [' . $db->connect_error . ']');
	}
	

	
	
	
	                        $sql_operator = "SELECT id FROM airports where ident='$dato'";
							if (!$result_operator = $db->query($sql_operator)) {
							die('There was an error running the query  [' . $db->error . ']');
							}
							
							while ($row_operator = $result_operator->fetch_assoc()) {
							$contando++;
							$identificacion = $row_operator['id'];
							
							}
							
							
							
							if($contando==0) {
$mensaje = "No existe ese Aeropuerto.";
echo "<script>";
echo "alert('$mensaje');";  
echo "window.location = './?page=aeropuertosva';";
echo "</script>";  	
							} else {
								echo "<script>";
echo "window.location = './?page=updateairport&icao=$identificacion';";
echo "</script>";  	
							}
							
							
							
							
							
							
						
							?>