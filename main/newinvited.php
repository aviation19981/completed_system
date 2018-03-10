 <?php
$name = utf8_decode($_POST['userName']);
$names = $_POST['userName'];
$surnames = $_POST['usersurName'];
$email_user = $_POST['userEmail'];

if (empty($name) || empty($email_user)) {
	
?>

<script>
alert('<?php echo NEEDED_INFORMATION; ?>');
window.location.href='./index_user.php?page=invitarpiloto';
</script>

<?php	
	
	
} else
	
	{
		
		include ('./db_login.php');
	    require_once('./sent_email.php');	
		$db = new mysqli($db_host , $db_username , $db_password , $db_database);
		$db->set_charset("utf8");
		if ($db->connect_errno > 0) {
			die('Unable to connect to database [' . $db->connect_error . ']');
		}
		
		$str = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";

	for ($i = 0 ; $i < 12 ; $i++) {
		$cad .= substr($str , rand(0 , 62) , 1);
	}
	$clave = $cad;
	$con_encriptada = md5($clave);
	
	
	$sql1 = "insert into invitacion (email,name,surname,used,codigo,fecha,pass)
                    values ('$email_user','$names','$surnames',0,'$con_encriptada',now(),'$clave');";
			if (!$result = $db->query($sql1)) {
					die('There was an error running the query [' . $db->error . ']');
				}
		
		
				
		/////////////////////////// EMAIL SENT 
	
	
	     
		   $mail = new system_mailer();
		   $mail->invitation_code($email_user,$name,$clave);  
	
	


?>

<script>
alert('<?php echo EMAIL_READY; ?>');
window.location.href='./index_user.php?page=invitarpiloto';
</script>

<?php

	} ?>