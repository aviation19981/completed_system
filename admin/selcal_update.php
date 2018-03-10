
       <?php
	   
	    
		include('./db_login.php');
		$db = new mysqli($db_host , $db_username , $db_password , $db_database);
		 $db->set_charset("utf8");
		if ($db->connect_errno > 0) {
			die('Unable to connect to database [' . $db->connect_error . ']');
		}
		
	
	


	

	
	$contarupdates=0;
    $registros = array();
	$fleet_ids = array();
	$contador =0;
	$contaraviones=0;
	$contaravionescleared = 0;
	$selcal_code_all = array();
	
	$sqlreg = "select * from fleets";
	if (!$resultreg = $db->query($sqlreg)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	while ($rowreg = $resultreg->fetch_assoc()) {
		$contaraviones++;
		$registros[] = $rowreg['selcal'];
		$fleet_ids[] = $rowreg['fleet_id'];
	}
	
	$totalaviones = $contaraviones-1;
	
	$sqlreg2 = "select * from fleets";
	if (!$resultreg2 = $db->query($sqlreg2)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	while ($rowreg2 = $resultreg2->fetch_assoc()) {
		if (in_array($rowreg2['operator_id'], $airlines)) {
		$contaravionescleared++;
		}
	}
	
    function selcal() {
		$paquete = rand(1,2);
		
		if($paquete==1) {
			///////////////////////////////////
		$primer_par = array("A","B","C","D","E","F","G","H");	
		$primeraletra = rand(0,3);
		$segundoletra = rand(4,7);
		///////////////////////////
		$segundo_par = array("J","K","L","M","P","Q","R","S");
		$terceraletra = rand(0,3);
		$cuartaletra = rand(4,7);
		/////////////////////////////////////////////////
		} else if ($paquete==2) {
		///////////////////////////////////
		$primer_par = array("J","K","L","M","P","Q","R","S");
		$primeraletra = rand(0,3);
		$segundoletra = rand(4,7);
		///////////////////////////
		$segundo_par = array("A","B","C","D","E","F","G","H");	
		$terceraletra = rand(0,3);
		$cuartaletra = rand(4,7);
		/////////////////////////////////////////////////
			
			
		}
		
		
		return $selcal = $primer_par[$primeraletra] . $primer_par[$segundoletra] . '-' . $segundo_par[$terceraletra] . $segundo_par[$cuartaletra];
		
    }
	    
		
	//$sqlreg2 = "select fleet_id from fleets";
	//if (!$resultreg2 = $db->query($sqlreg2)) {
		//die('There was an error running the query [' . $db->error . ']');
	//}
	//while ($rowreg2 = $resultreg2->fetch_assoc()) {
		//$fleet_iduser = $rowreg2['fleet_id'];
		
		for($h=0;$h<=$totalaviones;$h++) {
		$selcal_code = selcal();
		///////////////////
		if (in_array($selcal_code, $selcal_code_all)) {
			$h--;
		} else {
			$selcal_code_all[] = $selcal_code;
			
			if (in_array($selcal_code, $registros)) {
		      $h--;
	        } else {
		    $fleet_iduser = $fleet_ids[$h];
		   $sql1 = "update fleets set selcal='$selcal_code' where fleet_id='$fleet_iduser' and operator_id IN (" . implode(',', array_map('intval', $airlines)) . ")";
		   if (!$result = $db->query($sql1)) {
			die('There was an error running the query [' . $db->error . ']');
		   } else {
			   $contarupdates =  $contarupdates+1;
		   }
		   
			
			}
		/////////////////////
		}
		
		
		}
		
	//}
	
	
	
	
	
	if($result==TRUE) {
	   ?>
	   
	
<script>   
	   
alert('<?php echo $contaravionescleared; ?> Aeronaves Selcal Actualizado.');
window.location = './?page=admonaeronaves';
 
</script> 

	<?php } else {
		
		?>
	   
	
<script>   
	   
alert('Hubo un error.');
window.location = './?page=admonaeronaves';
 
</script> 

	<?php
	} ?>

		