<?php
 $icao = $_GET['icao'];
$contadores=0;
						  include('./db_login.php');
		$db = new mysqli($db_host , $db_username , $db_password , $db_database);
		 $db->set_charset("utf8");
		if ($db->connect_errno > 0) {
			die('Unable to connect to database [' . $db->connect_error . ']');
		}
		
                           $airport = "SELECT * FROM airports where id='$icao'";
		                   if (!$result_airport = $db->query($airport)) {
							die('There was an error running the query  [' . $db->error . ']');
							}
							
							while ($airports = $result_airport->fetch_assoc()) {
								$contadores++;
		$ident = $airports['ident'];
        $iata_code = $airports['iata_code'];
		$name = $airports['name'];
		$type = $airports['type'];
		$latitude_deg = $airports['latitude_deg'];
		$longitude_deg = $airports['longitude_deg'];
		$elevation_ft = $airports['elevation_ft'];
		$municipality = $airports['municipality'];
		$continent = $airports['continent'];
        $iso_region = $airports['iso_region'];
		$iso_country = $airports['iso_country'];
							}
							
							if($contadores>0) {
?>
<section id="content">
          <section class="vbox">
            <section class="scrollable wrapper">
              <div class="panel b-a">
                <div class="panel-heading b-b">Aeropuerto</div>
                <div class="panel-body">
                  <div class="h3 m-b font-thin">Actualizar Aeropuerto</div>
                  <div class="row">
                    <div class="col-sm-12">                      
        

           
<div class="container">

<form action="./?page=actualizarairport" class="form-horizontal" role="form" method="post" accept-charset="utf-8">
<fieldset>
<input type="hidden" class="form-control"  name="identificaciones" value="<?php echo $icao; ?>"/>

<div class="form-group">
	<label>ICAO</label>
	<div class="col-md-8">
<input type="text" class="form-control" maxlength="4"  name="icao" value="<?php echo $ident; ?>"/>
</div>
</div>


<div class="form-group">
	<label>IATA Código</label>
	<div class="col-md-8">
<input type="text" class="form-control" maxlength="3" name="iata" value="<?php echo $iata_code; ?>"/>
</div>
</div>

<div class="form-group">
	<label>Nombre</label>
	<div class="col-md-8">
<input type="text" class="form-control" name="name" value="<?php echo $name; ?>"/>
</div>
</div>

<div class="form-group">
	<label>Tipo</label>
	<div class="col-md-8">
	<select name="type"  class="form-control" >
	<?php if($type=="large_airport") {
		?>
	<option value="large_airport" selected>Aeropuerto Grande</option>
	<option value="medium_airport">Aeropuerto Mediano</option>
	<option value="small_airport">Aeropuerto Pequeño</option>
	<option value="heliport">Helipuerto</option>
		
		<?php
	} else if($type=="large_airport") {
		?>
	<option value="large_airport" selected>Aeropuerto Grande</option>
	<option value="medium_airport">Aeropuerto Mediano</option>
	<option value="small_airport">Aeropuerto Pequeño</option>
	<option value="heliport">Helipuerto</option>
		
		<?php
	} if($type=="medium_airport") {
		?>
	<option value="large_airport" >Aeropuerto Grande</option>
	<option value="medium_airport" selected>Aeropuerto Mediano</option>
	<option value="small_airport">Aeropuerto Pequeño</option>
	<option value="heliport">Helipuerto</option>
		
		<?php
	} if($type=="small_airport") {
		?>
	<option value="large_airport" >Aeropuerto Grande</option>
	<option value="medium_airport">Aeropuerto Mediano</option>
	<option value="small_airport" selected>Aeropuerto Pequeño</option>
	<option value="heliport">Helipuerto</option>
		
		<?php
	} if($type=="heliport") {
		?>
	<option value="large_airport" >Aeropuerto Grande</option>
	<option value="medium_airport">Aeropuerto Mediano</option>
	<option value="small_airport">Aeropuerto Pequeño</option>
	<option value="heliport" selected>Helipuerto</option>
		
		<?php
	}
	
	?>
	
	
	
</select>
</div>
</div>

<div class="form-group">
	<label>Latitud</label>
	<div class="col-md-8">
<input type="text" class="form-control" name="latitude_deg" value="<?php echo $latitude_deg; ?>"/>
</div>
</div>


<div class="form-group">
	<label>Longitud</label>
	<div class="col-md-8">
<input type="text" class="form-control" name="longitude_deg" value="<?php echo $longitude_deg; ?>"/>
</div>
</div>


<div class="form-group">
	<label>Elevación</label>
	<div class="col-md-8">
<input type="number" class="form-control" name="elevation_ft" value="<?php echo $elevation_ft; ?>"/>
</div>
</div>

<div class="form-group">
	<label>Municipio</label>
	<div class="col-md-8">
<input type="text" class="form-control" name="municipality" value="<?php echo $municipality; ?>"/>
</div>
</div>


<div class="form-group">
	<label>Continente</label>
	<div class="col-md-8">
	<select name="continent"  class="form-control" >
	<?php if($continent=="AF") {
		?>
	<option value="AF" selected>África</option>
	<option value="AN">Antártida</option>
	<option value="AS">Asia</option>
	<option value="OC">Oceanía</option>
	<option value="EU">Europa</option>
	<option value="NA">América del Norte</option>
	<option value="SA">América del Sur</option>	
		<?php
	} else if($continent=="AN") {
		?>
	<option value="AF" >África</option>
	<option value="AN" selected>Antártida</option>
	<option value="AS">Asia</option>
	<option value="OC">Oceanía</option>
	<option value="EU">Europa</option>
	<option value="NA">América del Norte</option>
	<option value="SA">América del Sur</option>	
		<?php
	} else if($continent=="AS") {
		?>
	<option value="AF" >África</option>
	<option value="AN">Antártida</option>
	<option value="AS" selected>Asia</option>
	<option value="OC">Oceanía</option>
	<option value="EU">Europa</option>
	<option value="NA">América del Norte</option>
	<option value="SA">América del Sur</option>	
		<?php
	} else if($continent=="OC") {
		?>
	<option value="AF" >África</option>
	<option value="AN">Antártida</option>
	<option value="AS" >Asia</option>
	<option value="OC" selected>Oceanía</option>
	<option value="EU">Europa</option>
	<option value="NA">América del Norte</option>
	<option value="SA">América del Sur</option>	
		<?php
	} else if($continent=="EU") {
		?>
	<option value="AF" >África</option>
	<option value="AN">Antártida</option>
	<option value="AS" >Asia</option>
	<option value="OC" >Oceanía</option>
	<option value="EU" selected>Europa</option>
	<option value="NA">América del Norte</option>
	<option value="SA">América del Sur</option>	
		<?php
	} else if($continent=="NA") {
		?>
	<option value="AF" >África</option>
	<option value="AN">Antártida</option>
	<option value="AS" >Asia</option>
	<option value="OC" >Oceanía</option>
	<option value="EU" >Europa</option>
	<option value="NA" selected>América del Norte</option>
	<option value="SA">América del Sur</option>	
		<?php
	} else if($continent=="SA") {
		?>
	<option value="AF" >África</option>
	<option value="AN">Antártida</option>
	<option value="AS" >Asia</option>
	<option value="OC" >Oceanía</option>
	<option value="EU" >Europa</option>
	<option value="NA" >América del Norte</option>
	<option value="SA" selected>América del Sur</option>	
		<?php
	}
	?>
	
</select>
</div>
</div>

<div class="form-group">
	<label>ISO Región</label>
	<div class="col-md-8">
<input type="text" class="form-control" name="iso_region" value="<?php echo $iso_region; ?>"/>
</div>
</div>

<div class="form-group">
	<label>País</label>
	<div class="col-md-8">
	<select name="iso_country"  class="form-control" >
	<?php 
	
		$sql23 = "select * from country_t";
	if (!$result23 = $db->query($sql23)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	
	while ($row23 = $result23->fetch_assoc()) {
		if($iso_country==$row23["iso2"]) {
			echo '<option value="' . $row23["iso2"] . '" selected>' . $row23["short_name"] . '</option>';
		} else {
			echo '<option value="' . $row23["iso2"] . '">' . $row23["short_name"] . '</option>';
		}
			
		
		
	}
	
	
	
	 ?>
</select>
</div>
</div>



<div class="form-group"><div class="col-lg-offset-2 col-lg-2"><input class="btn btn-primary" type="submit" value="Actualizar Aeropuerto"/></div></div></form></div>

				<hr>
				
				<h1>Eliminar Aeropuerto</h1>
<br>
<br>
<a href="./?page=eliminaraeropuerto&id=<?php echo $icao; ?>" type="submit" style="width:100%;" class="btn btn-block btn-warning">Eliminar</a>
				


                    </div>
                  
                  </div>
                </div>
              </div>
            </section>
          </section>
          <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a>
        </section>
      <?php 
							} 
							else {
								?>
								
								<script>   
	   
alert('Aeropuerto no existe.');
window.location = './?page=aeropuertosva';
 
</script>

								<?php
							}
							?>
