<?php
       require('./../db_login.php'); 
	   
	
	$db = new mysqli($db_host , $db_username , $db_password , $db_database);
	$db->set_charset("utf8");

	if ($db->connect_errno > 0) {
		die('Unable to connect to database [' . $db->connect_error . ']');
	}
	
	//////////////////////// CASO 1
	
	$sql = "DELETE FROM RoutesAIRAC";  

	if (!$result = $db->query($sql)) {
		die('There was an error running the query [' . $db->error . ']');
	}
		
	$hFile = fopen("wpNavRTE.txt", "r");
      while (($line = fgetcsv($hFile, 1000, " ")) !== FALSE) {
	   if(substr($line[0],0,1)!=';'){
		settype($line[1],"Integer");
		/////////// INGRESO
		$sql2 = "insert into RoutesAIRAC (Route_Name,Route_Num,Route_FixName,Route_FixLat,Route_FixLon)                    
						values ('$line[0]',$line[1],'$line[2]','$line[3]','$line[4]');";				
						if (!$result2 = $db->query($sql2)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		//////////////// FIN
      }
	  }
         fclose($hFile);
		 
		 
		 
		 
		 
		 
		 
		 //////////////////////// CASO 2
	
	$sql3 = "DELETE FROM NavAIDs";  

	if (!$result3 = $db->query($sql3)) {
		die('There was an error running the query [' . $db->error . ']');
	}
		
	$hFile = fopen("wpNavAID.txt", "r");
      while (($line=fgets($hFile,63)) !== FALSE) {
	if(substr($line,0,1)!=';'){
	$AIDNameFull=trim(addcslashes(substr($line,0,23),"'"));
	$AIDName=trim(substr($line,23,5));
	$AIDType=trim(substr($line,28,4));
	$AIDLat=trim(substr($line,33,10));
	$AIDLon=trim(substr($line,43,11));
	$AIDFreq=trim(substr($line,54,6));
		/////////// INGRESO
		$sql4 = "insert into NavAIDs (NavAID_NameFull,NavAID_Name,NavAID_Type, NavAID_Lat,NavAID_Lon,NavAID_Freq)                    
						values ('$AIDNameFull','$AIDName','$AIDType','$AIDLat','$AIDLon','$AIDFreq');";				
						if (!$result4 = $db->query($sql4)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		//////////////// FIN
      }
	  }
         fclose($hFile);


		 
		 
		 
		 
		 
		 
		 
		  //////////////////////// CASO 3
	
	$sql5 = "DELETE FROM NavFIXes";  

	if (!$result5 = $db->query($sql5)) {
		die('There was an error running the query [' . $db->error . ']');
	}
		
	$hFile = fopen("wpNavFIX.txt", "r");
     while (($line=fgets($hFile,52)) !== FALSE) {
      if(substr($line,0,1)!=';'){
	$FixNameFull=trim(substr($line,0,23));
	$FixLat=trim(substr($line,29,10));
	$FixLon=trim(substr($line,39,11));
		/////////// INGRESO
		$sql6 = "insert into NavFIXes (NavFIX_Name,NavFIX_Lat,NavFIX_Lon)                    
						values ('$FixNameFull','$FixLat','$FixLon');";				
						if (!$result6 = $db->query($sql6)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		//////////////// FIN
      }
	 }
         fclose($hFile);
		 
		 
		 
		 
		 
		 
		 
		 
		 
		 
		 
		 
		 
		 
		   //////////////////////// CASO 4
	
	$sql7 = "DELETE FROM NavAPTs";  

	if (!$result7 = $db->query($sql7)) {
		die('There was an error running the query [' . $db->error . ']');
	}
		
	$hFile = fopen("wpNavAPT.txt", "r");
	$i = 1;
     while (($line=fgets($hFile,76)) !== FALSE ) {
    if(substr($line,0,1)!=';' && trim($line) != "" ){
	$APTNameFull=trim(addcslashes(substr($line,0,24),"'"));
	$APTICAO=trim(substr($line,24,4));
	$APTRWY=trim(substr($line,28,3));
	$APTRWYLenght=trim(substr($line,31,5));
	$APTRWYHDG=trim(substr($line,36,3));
	$APTRWYLat=trim(substr($line,39,10));
	$APTRWYLon=trim(substr($line,49,11));
	$APTRWYILS=trim(substr($line,60,6));
	$APTRWYCRS=trim(substr($line,66,3));
    $APTRWYElev=trim(substr($line,69,5));
     $i++;
		/////////// INGRESO
		$sql8 = "INSERT INTO NavAPTs(
	NavAPT_NameFull,
	NavAPT_ICAO,
	NavAPT_RWY,
	NavAPT_RWYLenght,
	NavAPT_RWYHDG,
	NavAPT_RWYLat,
	NavAPT_RWYLon,
	NavAPT_RWYILS,
	NavAPT_RWYCRS,
	NavAPT_RWYElev)
		VALUES('$APTNameFull',
		'$APTICAO','$APTRWY',$APTRWYLenght,
		'$APTRWYHDG','$APTRWYLat',
		'$APTRWYLon','$APTRWYILS',
		'$APTRWYCRS',$APTRWYElev);";				
						if (!$result8 = $db->query($sql8)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		//////////////// FIN
      }
	 }
         fclose($hFile);



		 
		 
		 
		 
		 
		 
		 
		 
		 
		 //////////////////////// CASO 5
	
	$sql9 = "DELETE FROM NavAIRPORTS";  

	if (!$result9 = $db->query($sql9)) {
		die('There was an error running the query [' . $db->error . ']');
	}
		
	$hFile = fopen("airports.dat", "r");
	$i = 0;
    while (($line=fgets($hFile,28)) !== FALSE ) {	$i++;
    if(substr($line,0,1)!=';' && trim($line)!=""){

	$APTICAO=trim(substr($line,0,4));

	$APTLat=trim(substr($line,4,10));
	$APTLon=trim(substr($line,14,11));
		/////////// INGRESO
		$sql10 = "INSERT INTO NavAIRPORTS(NavAIRPORT_ICAO,
	NavAIRPORT_Lat,
	NavAIRPORT_Lon)
		VALUES('$APTICAO','$APTLat','$APTLon');";				
						if (!$result10 = $db->query($sql10)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		//////////////// FIN
      }
	 }
         fclose($hFile);
		 
		 




echo "Ok";
?>

	   
<script>   
	   
alert('Airac actualizado satisfactoriamente.');
window.location = './../../';
 
</script>
