
<?php

		include('./db_login.php');
		$db = new mysqli($db_host , $db_username , $db_password , $db_database);
		$db->set_charset("utf8");
		if ($db->connect_errno > 0) {
			die('Unable to connect to database [' . $db->connect_error . ']');
		}
		
		 $examenid = $_GET['id'];
		$contarexamenes=0;
		$contarexamenes2=0;
	$sql = "select * from config_examen where id='$examenid'";
		
		if (!$result = $db->query($sql)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		
		while ($row = $result->fetch_assoc()) {

        $title = $row["titulo"];
        $duracion = $row["duracion"];
			$limite = $row['limite'];
		}	
		
		
		
		//////////////////////////////////////  VALIDAMOS EXAMENES PERDIDOS /////////////////////////
		
		
		$sqltest32 = "select * from training where examen='$examenid' and gvauser_id=$id and nota<3 and HOUR(timediff(now(),fecha))<=24";



	    if (!$resultest32 = $db->query($sqltest32)) {



		die('There was an error running the query [' . $db->error . ']');



	    }

		

		while ($rowtest32 = $resultest32->fetch_assoc()) {

			$contarexamenes2=$contarexamenes2+1;

		}
			
			
			//////////////// VALIDAMOS SI USUARIO PRESENTO Y GANÓ ESTE EXAMEN //////////////////

			

		$sqltest3 = "select * from training where examen='$examenid' and gvauser_id=$id and nota>=3";



	    if (!$resultest3 = $db->query($sqltest3)) {



		die('There was an error running the query [' . $db->error . ']');



	    }

		

		while ($rowtest3 = $resultest3->fetch_assoc()) {

			$contarexamenes=$contarexamenes+1;

		}
		
		if($contarexamenes==0 && $contarexamenes2==0) {
		
		?>

	
<!-- PARALLAX SECTION
================================================== -->

<section class="section-testimonials parallax-section" id="home">

	<div
		class="parallax-1"
		style="background-image:url('<?php picture(); ?>')"
		data-parallax-speed="0.4"></div>

	<div class="just_pattern_parallax"></div>
    
	<h1><font color="white"><?php echo TRAINING_CENTER; ?></font></h1>
	<br>
	<div class="sixteen columns"><div class="sub-text-line"></div></div>
	<br>
	<h3><font color="white"><?php echo TEST_PRO; ?></font></h3>
	

</section>


				


		<section class="contact">
			<div class="container">
			

   
				<h1>Tiempo Restante <small><div id="divCounter"></div></small></h1>
<script type="text/javascript">

var hoursleft = 0;
var minutesleft = <?php echo $duracion; ?>;           // you can change these values to any value greater than 0
var secondsleft = 0;

var finishedtext = "Countdown finished!" // text that appears when the countdown reaches 0
var end = new Date();

end.setMinutes(end.getMinutes()+minutesleft);
end.setSeconds(end.getSeconds()+secondsleft);


if(localStorage.getItem("counter")){

    var value = localStorage.getItem("counter");

}else{
  var value = 0;
}


var counter = function (){


    var now = new Date();
var diff = end - now;
diff = new Date(diff);

var sec = diff.getSeconds();
var min = diff.getMinutes();

if (min < 10){
    min = "0" + min;
}
if (sec < 10){
    sec = "0" + sec;
}

if(now >= end){
    clearTimeout(timerID);
    //document.getElementById('divCounter').innerHTML = finishedtext;
	
}

else{
    var value = min + ":" + sec;
//document.getElementById('divCounter').innerHTML = min + ":" + sec;
localStorage.setItem("counter", JSON.stringify(value));
} 


if(min==0 && sec==0) {
  document.exmaneva.submit();
}    

 // timerID = setTimeout("cd()", 1000);
// value = JSON.parse(localStorage.getItem("counter"));
//$('#divCounter').append(value);
document.getElementById('divCounter').innerHTML = value; 
 }





 var interval = setInterval(function (){counter();}, 1000);
 </script>
 
			<hr>
			<p><?php echo DETAIL_TEST_PRO; ?></p>
			<br>
			
			
			
			
			
			
				<div class="col-md-12 col-sm-7">
                            <form method="POST" name="exmaneva" action="./index_user.php?page=enttoresultados">
							<INPUT TYPE="hidden" NAME="codexamen" VALUE="<?php echo $examenid; ?>"> 
		<?php
							
       $sql12 = "select * from preguntasdeexamen where idexamen='$examenid' ORDER BY RAND()  LIMIT $limite";
		
		if (!$result12 = $db->query($sql12)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		$i2 = 1;
		$contadorespreg = 0;
		while ($row12 = $result12->fetch_assoc()) {
			
		$contadorespreg++;	
				
			
			?>
			                           
			<hr>
			
			<div class="col-sm-12">
                    <label><?php echo $i2++; ?>). <?php echo $row12["pregunta"]; ?></label>
            </div>
			
			<div class="col-sm-12">
                                    <select name="<?php echo $row12["id"]; ?>">
                                            <option selected="" value=""><?php echo SELECT_OPTION; ?></option>
											<?php if(!empty($row12['A'])) { ?>
                                            <option value="A"><?php echo $row12['A']; ?></option>
											<?php } ?>
                                            <?php if(!empty($row12['B'])) { ?>
                                            <option value="B"><?php echo $row12['B']; ?></option>
											<?php } ?>
											<?php if(!empty($row12['C'])) { ?>
                                            <option value="C"><?php echo $row12['C']; ?></option>
											<?php } ?>
											<?php if(!empty($row12['D'])) { ?>
                                            <option value="D"><?php echo $row12['D']; ?></option>
											<?php } ?>
                                        </select>
                                </div>
			
			
			
			
			<?php
			
		
			echo '<br><br>';
		}
		
		
		
		
?>
<INPUT TYPE="hidden" NAME="numpreg" VALUE="<?php echo $contadorespreg; ?>">                               
                                <div class="col-sm-12">
                                    <button type="submit" class="btn btn--primary"><?php echo SENT_TEST; ?></button>
                                </div>
                            </form>
                        </div>
			
			
			
			
			
			
			
		</body>
			
			
			</div>
			
			
			</section>

			
		<?php } else {
			
			if($contarexamenes>0) {
			?>

		

		<script>

alert('<?php echo TEST_PASSED; ?>');

window.location = './index_user.php?page=center_training';

</script>



<?php
			} else if($contarexamenes2>0) {
?>

		

		<script>

alert('<?php echo TEST_WAIT; ?>');

window.location = './index_user.php?page=center_training';

</script>



<?php


			}


			
		}
		
		?>