
<?php
include('./db_login.php');
$db = new mysqli($db_host, $db_username, $db_password, $db_database);
if ($db->connect_errno > 0) {
    die('Unable to connect to database [' . $db->connect_error . ']');
}
$sql = "select fleet_id,DATE_FORMAT(date_out,'%Y%m%d') as date_out ,DATE_FORMAT(now(),'%Y%m%d') as currdat  from hangar where status=1";

if (!$result = $db->query($sql)) {
    die('There was an error running the query  [' . $db->error . ']');
}
while ($row = $result->fetch_assoc()) {
    $plane = $row["fleet_id"];
	$date_out  = $row["date_out"];
	$currdat  = $row["currdat"];
	$diff =$date_out-$currdat;
	if ($diff<=0)
	{
		$sql1  = "update hangar set status=0 where fleet_id='$plane'";

		if (!$result1 = $db->query($sql1)) {
			die('There was an error running the query  [' . $db->error . ']');
		}
		$sql2 = "update fleets set gvauser_id=NULL, status=100, booked=0 , hangar=0 where fleet_id='$plane'";
	
		if (!$result2 = $db->query($sql2)) {
			die('There was an error running the query [' . $db->error . ']');
		}		
	}
}




// get VA parameters
		$sqlva = "select * from va_parameters";
		$va_name = '';
		
		$plane_status_hangar = '';
		$hangar_maintenance_days = '';
		$hangar_maintenance_value = '';
		
		if (!$resultva = $db->query($sqlva)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		while ($row = $resultva->fetch_assoc()) {
			$va_name = $row["va_name"];
			
			$flight_wear = $row["flight_wear"];
			
			$plane_status_hangar = $row["plane_status_hangar"];
			$hangar_maintenance_days = $row["hangar_maintenance_days"];
			$hangar_maintenance_value = $row["hangar_maintenance_value"];
			
		}	
		
		
		
		// check damage in plane and send it to the hangar if needed
				$query3 = "select * from  fleets where status<='$plane_status_hangar' and hangar=0";
				
				if (!$result3 = $db->query($query3)) {
					die('There was an error running the query [' . $db->error . ']');
				}
				
				$estado = 0;
				while ($row3 = $result3->fetch_assoc()) {
					$estado = $row3["status"];
					$avion = $row3["fleet_id"];
					$matricula = $row3["registry"];
					$location = $row3["location"];
			
		
		
		
		
			if ($estado < $plane_status_hangar && $estado > 0) {
					$query1 = "insert into hangar (registry,gvauser_id,fleet_id,departure,location,date_in,date_out,reason) values ('$matricula','0',$avion,'$location','$location',CURDATE(),ADDDATE(CURDATE(),$hangar_maintenance_days),'Maintenance')";
					
					if (!$result_sta = $db->query($query1)) {
						die('There was an error running the query [' . $db->error . ']');
					}
					$query1 = "update fleets set booked=1 ,hangar=1, hangardate=now() where fleet_id=$avion";
				
					if (!$result_sta = $db->query($query1)) {
						die('There was an error running the query [' . $db->error . ']');
					}
					$query1 = "insert into vaprofits (value,date,gvauser_id,description) values (-$hangar_maintenance_value, now(),'0' ,'Maintenance $matricula')";
					
					if (!$result_sta = $db->query($query1)) {
						die('There was an error running the query [' . $db->error . ']');
					}
					
					// Cost for the VA for the maintenance
				    $query1 = "insert into va_finances (amount,parameter_id,finance_date,gvauser_id,description,report_type,report_id) values (-$hangar_maintenance_value, '99997', now(),'0' ,'Aircraft Maintenace $matricula','IVAO', '0')";
				    if (!$result_sta = $db->query($query1)) {
					  die('There was an error running the query [' . $db->error . ']');
				    }
				}
				
				
					}
?>