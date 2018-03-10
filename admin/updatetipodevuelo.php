 <section id="content">
          <section class="vbox">
            <section class="scrollable wrapper">
              <div class="panel b-a">
                <div class="panel-heading b-b">Tipo de Vuelo</div>
                <div class="panel-body">
                  <div class="h3 m-b font-thin">Información de Tipo de Vuelo</div>
                  <div class="row">
                    <div class="col-sm-8">                      
                      									 
<?php 
$tipovuelo = $_GET['tipovuelo']; 
include('db_login.php');
	$db = new mysqli($db_host , $db_username , $db_password , $db_database); $db->set_charset("utf8"); if ($db->connect_errno > 0) {
	die('Unable to connect to database [' . $db->connect_error . ']');
} 
		$sql = "SELECT * FROM flighttypes where flighttype_id=$tipovuelo";
 if (!$result = $db->query($sql))  {
	die('There was an error running the query [' . $db->error . ']');
	
	
}

while ($row = $result->fetch_assoc()) {
		$flighttype = $row['flighttype'];
		$flighttype_id = $row['flighttype_id'];
		
	}
?>





           
      <div class="container">
<form action="./?page=actualizartipodevuelo" class="form-horizontal" role="form" id="GvauserEditForm" method="post" accept-charset="utf-8">
<div style="display:none;"><input type="hidden" name="flighttype_id" value="<?php echo $flighttype_id; ?>"/></div>	<fieldset>

	
	

<div class="form-group">
<label for="GvauserName">Nombre Tipo de Vuelo</label>
<div class="col-md-8">
<input name="flighttype" class="form-control" maxlength="255" type="text" value="<?php echo $flighttype; ?>" id="GvauserName"/>
</div></div>

</fieldset>
<div class="form-group"><div class="col-lg-offset-2 col-lg-2"><input class="btn btn-primary" type="submit" value="Actualizar Tipo de Vuelo"/></div></div></form></div>

				
				
				
				
				
				





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
