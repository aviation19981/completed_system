
       <?php
	   
	   		include('./db_login.php');
			
       $finantial_active = 1;
		$financial_parameter = $_POST['financial_parameter'];
		$amount = $_POST['amount'];
		$is_cost = $_POST['is_cost'];
		$is_fix_cost = $_POST['is_fix_cost'];
		$is_profit = $_POST['is_profit'];
		$linked_to_time = $_POST['linked_to_time'];
		$linked_to_pax = $_POST['linked_to_pax'];
		$linked_to_distance = $_POST['linked_to_distance'];
		$linked_to_flight = $_POST['linked_to_flight'];
		$parameter_active = $_POST['parameter_active'];
		
		 $db = new mysqli($db_host , $db_username , $db_password , $db_database);
		 $db->set_charset("utf8");
		if ($db->connect_errno > 0) {
			die('Unable to connect to database [' . $db->connect_error . ']');
		}
		
		
	
			$sql12 = "insert into financial_parameters (finantial_active,financial_parameter,amount,is_cost,is_fix_cost,is_profit,linked_to_time,linked_to_pax,linked_to_distance,linked_to_flight,parameter_active)                    
						values ('$finantial_active','$financial_parameter','$amount','$is_cost','$is_fix_cost','$is_profit','$linked_to_time','$linked_to_pax','$linked_to_distance','$linked_to_flight','$parameter_active');";				
						if (!$result12 = $db->query($sql12)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		
		
		
			
		
	   ?>
	   
	   
<script>   
	   
alert('Parámetro agregado satisfactoriamente.');
window.location = './?page=finanzasva';
 
</script>



