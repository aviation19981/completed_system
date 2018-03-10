<?php
    session_start();
    require_once ("./languages/lang_" . $_SESSION['language'] . ".php");
	$name = $_POST['name'];
	$surname = $_POST['surname'];
	$emails = $_POST['email'];
	$ivao = $_POST['ivao'];
	$city = $_POST['city'];
	$hub_id = $_POST['hub'];
	$pass = $_POST['password'];
	$password2 = $_POST['password2'];
	$country = $_POST['country'];
	$birthday = $_POST['birthdate'];
	$notes = $_POST['notes'];
	$language = $_POST['language'];
	$captcha = $_POST['captcha'];
	$captchahidden = $_POST['captchahidden'];
	$codigo = $_POST['codigo'];
	$ope = $_POST['ope'];
	$accept_emails = $_POST['accept_emails'];
    $facebook = $_POST['facebook'];
	if ($captcha!=$captchahidden)
	{
	?>

	
	<script>
alert('<?php echo WRONG_CAPTCHA; ?>');
window.location = './index.php?page=admisiones';
</script>
			
	<?php	
	} else {
   
        include('./db_login.php');
		$db = new mysqli($db_host , $db_username , $db_password , $db_database);
		$db->set_charset("utf8");
		if ($db->connect_errno > 0) {
			die('Unable to connect to database [' . $db->connect_error . ']');
		}
		$sql = "SELECT * from gvausers WHERE email='$_POST[email]' or ivaovid='$_POST[ivao]'";
		if (!$result = $db->query($sql)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		$existentuser = $result->num_rows;
		if ($existentuser > 0) {
?>
<script>
alert('<?php echo USER_EXIST; ?>');
window.location = './index.php?page=admisiones';
</script>
<?php
		} else {
			
			
			if ((!empty($pass)) && (!empty($password2)))  {
			
			if ($pass==$password2)  {
				$encryptpassword = md5($pass);
				$sql1 = "insert into gvausers (facebook,operator_id,register_date,activation,name,surname,callsign,email,password,ivaovid,hub_id,country,city,reg_comments,birth_date,language,accept_emails)
                    values ('$facebook','$ope',now(),0,'$name','$surname','_NEW_','$emails','$encryptpassword','$ivao','$hub_id','$country','$city','$notes','$birthday','$language','$accept_emails');";
				if (!$result1 = $db->query($sql1)) {
					die('There was an error running the query [' . $db->error . ']');
				}
				
				
$sql8 = "UPDATE invitacion set used=1 where pass='$codigo'";

		if (!$result8 = $db->query($sql8)) {
			die('There was an error running the query [' . $db->error . ']');
		}
			

				
			?>

	<script>
alert('<?php echo SUCCESSFUL_REGISTER; ?>');
window.location = './';
</script>
			
<?php
				
			} else {
				
				?>
<script>
alert('<?php echo PASSWORD_ERROR; ?>');
window.location = './index.php?page=admisiones';
</script>
<?php
				
				
				
			}
			
			
			
			
		} else {
				
				?>
<script>
alert('<?php echo CODE_INVITATION_EMPTY; ?>');
window.location = './index.php?page=admisiones';
</script>
<?php
				
				
				
			}


		}			
				
	

			}
							
?>
			


