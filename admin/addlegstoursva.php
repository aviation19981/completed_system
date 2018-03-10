 <section id="content">
          <section class="vbox">
            <section class="scrollable wrapper">
              <div class="panel b-a">
                <div class="panel-heading b-b">Añadir Leg</div>
                <div class="panel-body">
                  <div class="h3 m-b font-thin">Información de Leg</div>
                  <div class="row">
                    <div class="col-sm-8">                      
                      									 
<?php 
$tour = $_GET['tour']; 
$tour_leg_id =array();
$maximo =0;
include('db_login.php');
	$db = new mysqli($db_host , $db_username , $db_password , $db_database); $db->set_charset("utf8"); if ($db->connect_errno > 0) {
	die('Unable to connect to database [' . $db->connect_error . ']');
} 
		$sql = "SELECT * FROM tour_legs where tour_id=$tour order by leg_number asc";
 if (!$result = $db->query($sql))  {
	die('There was an error running the query [' . $db->error . ']');
	
	
}

while ($row = $result->fetch_assoc()) {
		$tour_leg_id[] = $row['leg_number'];
	}
	
	
	$entrada2=$tour_leg_id; //Los 10 numeros de entrada
$mayor2=$entrada2[0]; //Ponemos que el mayor es el primer elemento
//Se cambia automaticamente en el bucle
$pos2=0; //la posicion en 0
//El bucle (lo importante)
//Iniciamos un bucle del tamaño de la cantidad de elementos del array
for($j2=0;$j2<count($entrada2);$j2++)
{
  //Si mayor es menor que el elemento elejido
  if($mayor2<$entrada2[$j2])
  {
    //cambiamos el mayor
    //y obtenemos su posicion
    $mayor2=$entrada2[$j2];
    $pos2=$j2;
  }
}

$tour_leg_id_final = $mayor2+1;
	

?>





           
      <div class="container">
<form enctype="multipart/form-data" action="./?page=agregarlegtourva" class="form-horizontal" role="form" id="GvauserEditForm" method="post" accept-charset="utf-8">
<div style="display:none;">
<input type="hidden" name="leg_length" value="<?php echo $tour_leg_id_final; ?>"/>
<input type="hidden" name="tour_id" value="<?php echo $tour; ?>"/>
</div>	<fieldset>


<div class="form-group">
<label for="departure">Origen</label>
<div class="col-md-8">
<input name="departure"  class="form-control" maxlength="4" type="text"  id="departure"/>
</div></div>

<div class="form-group">
<label for="arrival">Destino</label>
<div class="col-md-8">
<input name="arrival"  class="form-control" maxlength="4" type="text" id="arrival"/>
</div></div>

<div class="form-group">
<label for="route">Ruta</label>
<div class="col-md-8">
<textarea class="form-control" rows="4" name="route" >
</textarea>
</div></div>



<div class="form-group"><div class="col-lg-offset-2 col-lg-2"><input class="btn btn-primary" type="submit" value="Agregar Leg Tour"/></div></div></form></div>

				
				
				
				
				
				





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
