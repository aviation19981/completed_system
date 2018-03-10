 <section id="content">
          <section class="vbox">
            <section class="scrollable wrapper">
              <div class="panel b-a">
                <div class="panel-heading b-b">Correo</div>
                <div class="panel-body">
                  <div class="h3 m-b font-thin">Añadir Correo</div>
                  <div class="row">
                    <div class="col-sm-8">                      
        

           
      <div class="container">
	  <?php
	  $host= $_SERVER["HTTP_HOST"];
$url= $_SERVER["REQUEST_URI"];

?>
<form action="./?page=agregarcorreo" class="form-horizontal" role="form" id="GvauserEditForm" method="post" accept-charset="utf-8">
<fieldset>


<div class="form-group">
	<label>Correo</label>
	<div class="col-md-8">
<input type="text" class="form-control" name="staff_email" value="@<?php echo $host; ?>"/>
</div>
</div>


<div class="form-group">
	<label>Cargo</label>
	<div class="col-md-8">
<input type="text" class="form-control"  name="cargo" />
</div>
</div>

<div class="form-group">
	<label>Usuario</label>
	<div class="col-md-8">
	<select name="staff"  class="form-control" >
	<?php 
	
		$sql23 = "select * from gvausers";
	if (!$result23 = $db->query($sql23)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	
	while ($row23 = $result23->fetch_assoc()) {
		
			echo '<option value="' . $row23["gvauser_id"] . '">' . $row23["name"] . ' ' . $row23["surname"] . '</option>';
		
		
	}
	
	
	
	 ?>
</select>
</div>
</div>


<div class="form-group"><div class="col-lg-offset-2 col-lg-2"><input class="btn btn-primary" type="submit" value="Agregar Correo"/></div></div></form></div>

				
				


                    </div>
                  
                  </div>
                </div>
              </div>
            </section>
          </section>
          <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a>
        </section>
      
