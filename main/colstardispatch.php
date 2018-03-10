
<!-- PARALLAX SECTION
================================================== -->

<section class="section-testimonials parallax-section" id="home">

	<div
		class="parallax-1"
		style="background-image:url('<?php picture(); ?>')"
		data-parallax-speed="0.4"></div>

	<div class="just_pattern_parallax"></div>
    
	<h1><font color="white"><?php echo DISPATCH_TITLE; ?></font></h1>
	<br>
	<div class="sixteen columns"><div class="sub-text-line"></div></div>
	<br>
	<h3><font color="white"><?php echo INFO_DISPATCH_TITLE; ?></font></h3>

</section>



		<section class="contact">
			<div class="container">
<?php

$ofp_id= $_GET['ofp_id'];
$url = 'http://www.simbrief.com/ofp/flightplans/xml/'.$ofp_id.'.xml';
            $xml = simplexml_load_file($url);
            $info = $xml;
			
			?>


<script src="http://skyvector.com/linkchart.js"></script>
<table id="table_list"  class="table table-hover">
    <!-- Flight ID -->
	<thead>
    <tr>
	<th><b>Flight Number</b></th>
	<th><b></b></th>
	<th width="36%"><b>Download FlightPlan</b></th>
        
    </tr>
	</thead>
    <tr>
        <td width="34%" ><?php echo (string) $info->general[0]->icao_airline.''.(string) $info->general[0]->flight_number; ?><br />
                   <td width="30%" >
                   </td>
                   <td><script type="text/javascript">
function download(d) {
        if (d == 'Select Format') return;
        window.location = 'http://www.simbrief.com/ofp/flightplans/' + d;
}
</script>
 
<select name="download" onChange="download(this.value)">
<option>Select Format</option>
<option value="<?php echo $info->files->pdf->link; ?>"><?php echo $info->files->pdf->name; ?></option>
<?php
  foreach($info->files->file as $file)
                {
?>
 
<option value="<?php echo $file->link; ?>"><?php echo $file->name; ?></option>
                        <?php
                    }
    ?>
</select>
 
                                      
                   </td>
                   
    <thead>
    <tr>
	<th><b>Departure</b></th>
	<th><b>Alternate</b></th>
	<th width="36%"><b>Arrival</b></th>
    </tr>
	</thead>
    
    <tr>
        <td width="34%" ><?php echo (string) $info->origin[0]->name.'('.(string) $info->origin[0]->icao_code.') <br>Planned RWY '.$info->origin[0]->plan_rwy; ?><br />
                   <td width="30%" ><?php echo (string) $info->alternate[0]->name.'('.(string) $info->alternate[0]->icao_code.') <br>Planned RWY '.$info->alternate[0]->plan_rwy; ?><br />
                   </td>
                   <td><?php echo (string) $info->destination[0]->name.'('.(string) $info->destination[0]->icao_code.') <br>Planned RWY '.$info->destination[0]->plan_rwy; ?>                                      
                   </td>
             </tr>      
                   <!-- Times Row -->
				   <thead>
   <tr>
   <th><b>Departure Time</b></th>
   <th><b>Arrival Time</b></th>
   <th width="36%"><b>Flight Time</b></th>
    </tr>
	</thead>
    
    <tr>
        <td width="34%" ><?php
        $epoch = (string) $info->times[0]->sched_out; 
$dt = new DateTime("@$epoch");  // convert UNIX timestamp to PHP DateTime
echo $dt->format('H:i'); // output = 2012-08-15 00:00:00  
       ?><br />
                   <td width="30%" ><?php
        $epoch = (string) $info->times[0]->est_on; 
$dt = new DateTime("@$epoch");  // convert UNIX timestamp to PHP DateTime
echo $dt->format('H:i'); // output = 2012-08-15 00:00:00  
       ?><br />
                   </td>
                   <td><?php
        $epoch = (string) $info->times[0]->est_block; 
$dt = new DateTime("@$epoch");  // convert UNIX timestamp to PHP DateTime
echo $dt->format('H:i'); // output = 2012-08-15 00:00:00  
       ?>                                      
                   </td>            
            <!-- Aircraft and Distance Row -->    
<thead>			
  <tr>
   <th><b>Crew</b></th>
    <th><b>Aircraft</b></th>
	 <th width="36%"><b>Distance</b></th>
    </tr>
	</thead>
    
    <tr>
        <td width="34%" ><?php echo (string) $info->crew[0]->cpt ; ?><br />
                   <td width="30%" ><?php echo (string) $info->aircraft[0]->icaocode.'('.(string) $info->aircraft[0]->reg.')'; ?><br />
                   </td>
                   <td><?php echo (string) $info->general[0]->route_distance.'(Nm)'; ?>                                      
                   </td>            
                       
        <!-- Metar and TAF --> 
     <thead>
    <tr>
	<th><b>Departure METAR</b></th>
	<th><b>Alternate METAR</b></th>
	<th colspan="2"><b>Arrival METAR</b></th>
    </tr>
	 </thead>
    <tr>
        <td width="34%" ><?php echo (string) $info->weather[0]->orig_metar; ?><br />
            
        </td>
          <td width="34%" ><?php echo (string) $info->weather[0]->altn_metar; ?><br />
          <td width="34%" ><?php echo (string) $info->weather[0]->dest_metar; ?><br />
    </tr>
    
	 <thead>
     <tr>
	 <th><b>Departure TAF</b></th>
	 <th><b>Alternate TAF</b></th>
	 <th colspan="2"><b>Arrival TAF</b></th>
       
    </tr>
	 </thead>
    <tr>
        <td width="34%" ><?php echo (string) $info->weather[0]->orig_taf; ?><br />
            
        </td>
          <td width="34%" ><?php echo (string) $info->weather[0]->altn_taf; ?><br />
          <td width="34%" ><?php echo (string) $info->weather[0]->dest_taf; ?><br />
    </tr>
    <!-- Route -->
	 <thead>
    <tr>
	<th colspan="3"><b>ATC Flight Plan</b></th>
    </tr>
	 </thead>
    <tr>
        <td colspan="3">
       <?php echo (string) $info->atc[0]->flightplan_text; ?>
        </td>
    </tr>
    
    <!-- Notes -->
	<thead>
    <tr>
	<th colspan="3"><b>Pilot Folder</b></th>
    </tr>
	</thead>
    <tr>
        <td colspan="3" style="padding: 8px;">
       <?php echo (string) $info->text[0]->plan_html; ?>
        </td>
    </tr>
    
    
</table>
      
     <?php //print_r($info);?>
	 
	 
	 
	 
	 
	 
	 </div>
	 
	 </section>