 <section id="content">
          <section class="vbox">
            <section class="scrollable wrapper">
              <div class="panel b-a">
                <div class="panel-heading b-b">Leg</div>
                <div class="panel-body">
                  <div class="h3 m-b font-thin">Editar Leg</div>
                  <div class="row">
                    <div class="col-sm-8">                      
                      									 
<?php 
$tour = $_GET['tour']; 
include('db_login.php');
	$db = new mysqli($db_host , $db_username , $db_password , $db_database); $db->set_charset("utf8"); if ($db->connect_errno > 0) {
	die('Unable to connect to database [' . $db->connect_error . ']');
} 
		$sql = "SELECT * FROM tour_legs where tour_leg_id=$tour";
 if (!$result = $db->query($sql))  {
	die('There was an error running the query [' . $db->error . ']');
	
	
}

while ($row = $result->fetch_assoc()) {
		$tour_leg_id = $row['tour_leg_id'];
		$departure = $row['departure'];
		$arrival = $row['arrival'];
		$route = $row['route'];
	}
?>





           
      <div class="container">
<form enctype="multipart/form-data" action="./?page=actualizarlegtourva" class="form-horizontal" role="form" id="GvauserEditForm" method="post" accept-charset="utf-8">
<div style="display:none;"><input type="hidden" name="tour_leg_id" value="<?php echo $tour_leg_id; ?>"/></div>	<fieldset>


<div class="form-group">
<label for="departure">Origen</label>
<div class="col-md-8">
<input name="departure"  class="form-control" maxlength="4" type="text" value="<?php echo $departure; ?>" id="departure"/>
</div></div>

<div class="form-group">
<label for="arrival">Destino</label>
<div class="col-md-8">
<input name="arrival"  class="form-control" maxlength="4" type="text" value="<?php echo $arrival; ?>" id="arrival"/>
</div></div>

<div class="form-group">
<label for="route">Ruta</label>
<div class="col-md-8">
<textarea class="form-control" rows="4" name="route" >
<?php echo $route; ?>
</textarea>
</div></div>



<div class="form-group"><div class="col-lg-offset-2 col-lg-2"><input class="btn btn-primary" type="submit" value="Actualizar Leg Tour"/></div></div></form></div>

				
				
				
				
				
				





                    </div>
                  
                  </div>
                </div>
              </div>
            </section>
          </section>
          <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a>
        </section>
      </section>
    </section>
  </section>
