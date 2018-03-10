 <section id="content">
          <section class="vbox">
            <section class="scrollable wrapper">
              <div class="panel b-a">
                <div class="panel-heading b-b">Aeropuerto</div>
                <div class="panel-body">
                  <div class="h3 m-b font-thin">Añadir Aeropuerto</div>
                  <div class="row">
                    <div class="col-sm-8">                      
        

           
<div class="container">
<form action="./?page=agregarairpotva" class="form-horizontal" role="form" i method="post" accept-charset="utf-8">
<fieldset>


<div class="form-group">
	<label>ICAO</label>
	<div class="col-md-8">
<input type="text" class="form-control" maxlength="4"  name="icao" />
</div>
</div>


<div class="form-group">
	<label>IATA Código</label>
	<div class="col-md-8">
<input type="text" class="form-control" maxlength="3" name="iata" />
</div>
</div>

<div class="form-group">
	<label>Nombre</label>
	<div class="col-md-8">
<input type="text" class="form-control" name="name" />
</div>
</div>

<div class="form-group">
	<label>Tipo</label>
	<div class="col-md-8">
	<select name="type"  class="form-control" >
	<option value="large_airport">Aeropuerto Grande</option>
	<option value="medium_airport">Aeropuerto Mediano</option>
	<option value="small_airport">Aeropuerto Pequeño</option>
	<option value="heliport">Helipuerto</option>
	
	
</select>
</div>
</div>

<div class="form-group">
	<label>Latitud</label>
	<div class="col-md-8">
<input type="text" class="form-control" name="latitude_deg" />
</div>
</div>


<div class="form-group">
	<label>Longitud</label>
	<div class="col-md-8">
<input type="text" class="form-control" name="longitude_deg" />
</div>
</div>


<div class="form-group">
	<label>Elevación</label>
	<div class="col-md-8">
<input type="number" class="form-control" name="elevation_ft" />
</div>
</div>

<div class="form-group">
	<label>Municipio</label>
	<div class="col-md-8">
<input type="text" class="form-control" name="municipality" />
</div>
</div>


<div class="form-group">
	<label>Continente</label>
	<div class="col-md-8">
	<select name="continent"  class="form-control" >
	<option value="AF">África</option>
	<option value="AN">Antártida</option>
	<option value="AS">Asia</option>
	<option value="OC">Oceanía</option>
	<option value="EU">Europa</option>
	<option value="NA">América del Norte</option>
	<option value="SA">América del Sur</option>
</select>
</div>
</div>

<div class="form-group">
	<label>ISO Región</label>
	<div class="col-md-8">
<input type="text" class="form-control" name="iso_region" />
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
		
			echo '<option value="' . $row23["iso2"] . '">' . $row23["short_name"] . '</option>';
		
		
	}
	
	
	
	 ?>
</select>
</div>
</div>



<div class="form-group"><div class="col-lg-offset-2 col-lg-2"><input class="btn btn-primary" type="submit" value="Agregar Aeropuerto"/></div></div></form></div>

				
				


                    </div>
                  
                  </div>
                </div>
              </div>
            </section>
          </section>
          <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a>
        </section>
      
