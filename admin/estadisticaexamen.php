
			
			
			 <section id="content">
          <section class="vbox">
            <section class="scrollable wrapper">
              <div class="panel b-a">
                <div class="panel-heading b-b">Estadísticas</div>
                <div class="panel-body">
                  <div class="h3 m-b font-thin">Estadísticas de Examen</div>
                  <div class="row">
                    <div class="col-sm-12">  
<?php
	if ($_SESSION["access_docente"] == '1')
	{	
		
		include('./db_login.php');
		$db = new mysqli($db_host , $db_username , $db_password , $db_database);
		$db->set_charset("utf8");
		if ($db->connect_errno > 0) {
			die('Unable to connect to database [' . $db->connect_error . ']');
		}
		
		 
		
	$sql = "select * from config_examen where id=1";
		
		if (!$result = $db->query($sql)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		
		while ($row = $result->fetch_assoc()) {

        $title = $row["titulo"];
        $duracion = $row["duracion"];
		$descripcion = $row["descripcion"];
		$limite = $row["limite"];
		}		
		
		
		
	
?>

<h2>Buen día: <?php echo $pilotname . ' ' . $pilotsurname . '  ' . $callsign; ?></h2>
<hr>
<br>

<br>

<?php 
			
		
	
				// select current day
	$sql = " select day(now()) as 'current_day', month(now()) as 'current_month',year(now()) as 'current_year' ; ";
	$current_day;
	$current_month;
	$current_year;
	if (!$result = $db->query($sql)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	while ($row = $result->fetch_assoc()) {
		$current_day = $row['current_day'];
		$current_month = $row['current_month'];
		$current_year = $row['current_year'];
	}
	
	
			// Calculation for flights per month current year
	$count_per_month = '';
	for ($i = 1 ; $i <= 12 ; $i++) {
		$days = $days . ',' . $i;
		$sql2 = "select ROUND(IFNULL(count(estado),0),0) as co from presentacionexamen where date_format(fecha,'%y')=date_format(now(),'%y') and date_format(fecha,'%m')=$i";
		if (!$result2 = $db->query($sql2)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		
		$meses = array('','Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre');


		while ($row2 = $result2->fetch_assoc()) {
		
		
			$count_per_month = $count_per_month . "{ Mes: '" . $meses[$i] . "', Aspirantes: ". $row2['co'] ." },";
		}
	}
	
	?>
			  <div class="col-lg-12 col-sm-12 ">
			<h2>Gráfica Presentación de Prueba <?php echo date('Y'); ?></h2>
			
			<div id="flights_per_month" ></div>
				<script>
					  var flights_per_month= Morris.Line({
					  element: 'flights_per_month',
					  data: [<?php echo $count_per_month;?>
					  ],
					  
					  
			
			
					  xkey: 'Mes',
					  ykeys: ['Aspirantes'],
					  labels: ['Aspirantes'],
					  parseTime: false,
					  resize: true,
					  stacked: true,
					  yLabelFormat: function(y){return y != Math.round(y)?'':y;}
					});
					  $('ul.nav a').on('shown.bs.tab', function (e) {
				            flights_per_month.redraw();
				    });
				</script>
				<br>
		<br>
		<hr>
		<br>
		<br>
		</div>
		
		
		
		
		
		<?php
		
		// ESTADO 0 Logeado
		// ESTADO 1 Perdido Teorico
		// ESTADO 2 Ganado Teorico
		// ESTADO 3 Perdido Practico
		// ESTADO 4 Ganado Practico INGRESO
		// ESTADO 5 Archivado Perdido
		// ESTADO 6 Archivado Ganado
		// ESTADO 7 Archivado No Presentado
		$perdidos=0;
		$ganados=0;
		$nopreset=0;
			$sql = "select * from presentacionexamen";
		
		if (!$result = $db->query($sql)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		
		while ($row = $result->fetch_assoc()) {

        if(($row["estado"]==1) || ($row["estado"]==3)) {
			$perdidos++;
		}
		
		if($row["estado"]==0) {
			$nopreset++;
		}
		
		 if($row["estado"]==4) {
			$ganados++;
		}
		
		}		
		
		$totales = $ganados+$perdidos+$nopreset;
		
		$porcentajesganados = ($ganados*100)/$totales;
		$porcentajesperdidos= ($perdidos*100)/$totales;
		$porcentajesnopreset= ($nopreset*100)/$totales;
		
			$perc_charter_reg = '';
	$perccharterflights_pilot=0;
	if ($porcentajesganados>0)
	{
		$perc_charter_reg = $perc_charter_reg . '{label: "Aprobado", value: '.$porcentajesganados.'},';
	}
	if ($porcentajesperdidos>0)
	{
		$perc_charter_reg = $perc_charter_reg . '{label: "Reprobado", value: '.$porcentajesperdidos.'},';
	}
	if ($porcentajesnopreset>0)
	{
		$perc_charter_reg = $perc_charter_reg . '{label: "No presentado", value: '.$porcentajesnopreset.'},';
	}
	if (($ganados+$perdidos+$nopreset)<1)
	{
		$perc_charter_reg = $perc_charter_reg . '{label: "No Examenes", value: 0 },';
	}
	
	
	?>
	<div class="row">
	
	<div class="col-md-6">
		<h2><center>Examenes Vigentes</center></h2>
		<div id="perc_charter_reg"></div>
					<script>
						  var perc_ch_re = Morris.Donut({
						  element: 'perc_charter_reg',
						  data: [<?php echo $perc_charter_reg ; ?>],
						  formatter: function(y){return y+' %';}
						});
						  $('ul.nav a').on('shown.bs.tab', function (e) {
				            perc_ch_re.redraw();
				            });
					</script>
				<br>
		<br>
		<br>
		<br>
</div>

	<?php
		
		// ESTADO 0 Logeado
		// ESTADO 1 Perdido Teorico
		// ESTADO 2 Ganado Teorico
		// ESTADO 3 Perdido Practico
		// ESTADO 4 Ganado Practico INGRESO
		// ESTADO 5 Archivado Perdido
		// ESTADO 6 Archivado Ganado
		// ESTADO 7 Archivado No Presentado
		$perdidose=0;
		$ganadose=0;
		$nopresentado=0;
			$sql5 = "select * from presentacionexamen";
		
		if (!$result5 = $db->query($sql5)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		
		while ($row5= $result5->fetch_assoc()) {

        if($row5["estado"]==5) {
			$perdidose++;
		}
		
		 if($row5["estado"]==6) {
			$ganadose++;
		}
		
		 if($row5["estado"]==7) {
			$nopresentado++;
		}
		
		}		
		
		$totalese = $ganadose+$perdidose+$nopresentado;
		
		$porcentajesganadose = ($ganadose*100)/$totalese;
		$porcentajesperdidose= ($perdidose*100)/$totalese;
		$porcentajenopresentado= ($nopresentado*100)/$totalese;
		
			$perc_charter_rege = '';
	$perccharterflights_pilote=0;
	if ($porcentajesganadose>0)
	{
		$perc_charter_rege = $perc_charter_rege . '{label: "Aprobado", value: '.$porcentajesganadose.'},';
	}
	if ($porcentajesperdidose>0)
	{
		$perc_charter_rege = $perc_charter_rege . '{label: "Reprobado", value: '.$porcentajesperdidose.'},';
	}
	if ($porcentajenopresentado>0)
	{
		$perc_charter_rege = $perc_charter_rege . '{label: "No Presentado", value: '.$porcentajenopresentado.'},';
	}
	if (($ganados+$perdidose+$nopresentado)<1)
	{
		$perc_charter_rege = $perc_charter_rege . '{label: "No Archivados", value: 0 },';
	}
	
	
	?>

 <div class="col-md-6">
		<h2><center>Examenes Archivados</center></h2>
		<div id="perc_charter_regs"></div>
					<script>
						  var perc_ch_re = Morris.Donut({
						  element: 'perc_charter_regs',
						  data: [<?php echo $perc_charter_rege ; ?>],
						  formatter: function(y){return y+' %';}
						});
						  $('ul.nav a').on('shown.bs.tab', function (e) {
				            perc_ch_re.redraw();
				            });
					</script>
					
				<br>
		<br>
		<br>
		<br>
</div>

		
</div>

<h2>Aspirantes de la Aerolínea Detalles</h2>
<hr>
<br>

<table id="table_list"  class="table table-hover">
																	
                                        <thead>
                                            <tr>
												<th><b>Información Usuario</b></th>
												<th><b>Fecha</b></th>
												<th><b>Calificación Teórico</b></th>
												<th><b>Calificación Entrevista</b></th>
												<th><b>Total Calificación</b></th>
												<th><b>ESTADO</b></th>
                                            </tr>
											
                                        </thead>
										<thead>
										<tr>
										</tr>
										</thead>
										 <tbody>
<?php 
$sql12 = "select * from presentacionexamen where estado<5 order by fecha desc";  
		
		if (!$result12 = $db->query($sql12)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		$cont=0;
		while ($row12 = $result12->fetch_assoc()) {
			$cont++;
		
		// ESTADO 0 Logeado
		// ESTADO 1 Perdido Teorico
		// ESTADO 2 Ganado Teorico
		// ESTADO 3 Perdido Practico
		// ESTADO 4 Ganado Practico INGRESO
		// ESTADO 5 Archivado Perdido
		// ESTADO 6 Archivado Ganado
		// ESTADO 7 Archivado No Presentado
		
		if($row12["estado"]==0) {
			$respuesta = '<span class="label label-info">Ingresado, Sin presentar.</span>';
		} else if($row12["estado"]==1) {
			$respuesta = '<span class="label label-danger">Perdió Examen Teórico.</span>';
		} else if($row12["estado"]==2) {
			$respuesta = '<span class="label label-warning">Ganó Examen Teórico.</span>';
		} else if($row12["estado"]==3) {
			$respuesta = '<span class="label label-danger">Perdió Examen Práctico.</span>';
		} else if($row12["estado"]==4) {
			$respuesta = '<span class="label label-success">Ganó Examen Práctico | ADMITIDO.</span>';
		} else if($row12["estado"]==5) {
			$respuesta = '<span class="label label-success">ARCHIVADO.</span>';
		} else if($row12["estado"]==6) {
			$respuesta = '<span class="label label-success">ARCHIVADO.</span>';
		} else if($row12["estado"]==6) {
			$respuesta = '<span class="label label-success">ARCHIVADO.</span>';
		}
		
		if($row12["operator_id"]==0) {
				
				$va = '<span class="label label-danger">Examen de temporadas anteriores, no menciona aerolínea</span>';
				
			} else {
				
		$operator_id_va = $row12["operator_id"];
		
		$sql_id_va = "select operator from operators where operator_id='$operator_id_va'";  
		
		if (!$result_id_va = $db->query($sql_id_va)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		
		while ($row_id_va = $result_id_va->fetch_assoc()) {
			$va = '<span class="label label-success">' .  $row_id_va["operator"] . '<span class="label label-danger">';
		}
				
				
				
				
				
			}
			
			
			 echo '<tr>';
			                              echo '<td>' . $row12["nombres"] . ' ' . $row12["apellidos"] . ' [<a href="https://www.ivao.aero/Member.aspx?ID=' . $row12["vid"] . '" target="_blank">' . $row12["vid"] . '</a>] [' . $row12['rango'] . ']<br>' . $row12['email'] . '<br>' . $va . '</td>';

										   echo '<td>' . $row12['fecha'] . ' (' . $row12['ip'] . ')</td>';
											 echo '<td>' . $row12['calificacion'] . '</td>';
											 echo '<td>' . $row12['calificacionentrevista'] . '</td>';
											 echo '<td>' . $row12['calificaciontotal'] . '</td>';
											echo '<td>' . $respuesta  . '</td>';
										echo '</tr>';
										
		}
		
		
		
		
?>
</tbody>
</table>



<?

if ($cont==0) {
	echo '<div class="alert alert-danger"> No hay examenes en proceso.</div>';
}
				
			
		
}
				else
				{
					echo '<div class="alert alert-danger"> You do not have access to teacher module</div>';
				}
				?>

				

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