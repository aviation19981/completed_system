 <section id="content">
          <section class="vbox">
            <section class="scrollable wrapper">
              <div class="panel b-a">
                <div class="panel-heading b-b">Aerolínea</div>
                <div class="panel-body">
                  <div class="h3 m-b font-thin">Añadir Aerolínea</div>
                  <div class="row">
                    <div class="col-sm-8">                      



           
      <div class="container">
<form enctype="multipart/form-data" action="./?page=agregaraerolinea" class="form-horizontal" role="form" id="GvauserEditForm" method="post" accept-charset="utf-8">
<fieldset>


<div class="form-group">
<label for="name">Aerolínea</label>
<div class="col-md-8">
<input name="operator"  class="form-control" type="text"  id="operator" required />
</div></div>

<div class="form-group">
<label for="abreviacion">Callsign ICAO</label>
<div class="col-md-8">
<input name="callsign"  class="form-control" maxlength="3" type="text" id="callsign" required />
</div></div>

<div class="form-group">
<label for="abreviacion">Callsign IATA</label>
<div class="col-md-8">
<input name="iata"  class="form-control" maxlength="2" type="text" id="iata" required />
</div></div>

<div class="form-group">
<label for="salario">Hub</label>
<div class="col-md-8">
<input name="hub_principal" class="form-control" type="text" maxlength="4" id="hub_principal" required />
</div></div>



<div class="form-group">
<label for="maxhoras">CEO</label>
<div class="col-md-8">
<input name="ceo" class="form-control" type="text"  id="ceo" required />
</div></div>

<div class="form-group">
<label for="maxhoras">VCEO</label>
<div class="col-md-8">
<input name="vceo" class="form-control" type="text" id="vceo"/>
</div></div>

<div class="form-group">
<label for="maxhoras">Link grupo de Facebook</label>
<div class="col-md-8">
<input name="facebook" class="form-control" type="text"  id="facebook"/>
</div></div>

<div class="form-group">
<label for="maxhoras">Link grupo de Whatsapp</label>
<div class="col-md-8">
<input name="whatsapp" class="form-control" type="text" id="whatsapp"/>
</div></div>

<div class="form-group">
<label for="image_file">Logo Aerolínea</label>
<div class="col-md-8">
<input name="image_file" class="form-control" type="file" id="image_file">
</div></div>

<div class="form-group">
<label for="image_file">Imagen Aerolínea</label>
<div class="col-md-8">
<input name="image_file2" class="form-control" type="file" id="image_file2">
</div></div>

<div class="form-group">
	<label>Descripción</label>
	<div class="col-md-8">
	<textarea name="parrafo_primero" id="parrafo_primero" rows="10" cols="80"><?php echo $parrafo_primero; ?></textarea>
            <script>
                // Replace the <textarea id="event_text"> with a CKEditor
                // instance, using default configuration.
                CKEDITOR.replace( 'parrafo_primero' );
            </script>
</div>
</div>



	
										
                                        </div>



<div class="form-group"><div class="col-lg-offset-2 col-lg-2"><input class="btn btn-primary" type="submit" value="Agregar Aerolínea"/></div></div></form></div>

				
				
				
				
				
				





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
