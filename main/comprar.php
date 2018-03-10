
<?php
	$producto_id= $_GET['producto_id'];
	$gvauser_id= $_GET['gvauser_id'];
	$name= 'Compra producto: ' . $_GET['name'];
	$money = $_GET['price'];
	
	if ($money == 0) {
		$price = $money;
		
	} else {
		
		
		
	$price = (-1*$money);
	
	
	}
		
		$db = new mysqli($db_host , $db_username , $db_password , $db_database);
		$db->set_charset("utf8");
		
			
			
		
$sql= "insert into compras_tienda (producto_id,gvauser_id) values ('$producto_id','$gvauser_id')"; 
if (!$result = $db->query($sql)) {
					die('There was an error running the query [' . $db->error . ']');
				}

$sql2= "insert into bank (gvauser_id,date,quantity,jump) values ($gvauser_id,now(),$price,'$name')"; 
if (!$result2 = $db->query($sql2)) {
					die('There was an error running the query [' . $db->error . ']');
				}
				
			
			
			

	
							
?>

<script>
alert('<?php echo BOUGHT_SUCCESSFUL; ?>');
window.location = './index_user.php?page=store';
</script>
			


