<?php
include('config.php');
$title="Навигационный план полета";
include('calcmag.php');
include('calc_functions.php');
$db = mysql_connect($DBhostname, $DBusername, $DBpassword) or die ("Could not connect to MySQL");
		mysql_select_db($DBname) or die ("Could not select database");
		mysql_query ("SET NAMES utf8");
		mysql_query("SET SQL_BIG_SELECTS=1");
/*print "<form method=post action=navlog.php><table><tr><td>Aэропорт Вылета:</td>
		<td><input name=\"FromICAO\" type=\"text\" value=\"{$_POST['FromICAO']}\" size=\"4\"></td></tr><tr>";
		print"<tr><td>Маршрут:</td>
		<td colspan=\"2\"><input name=\"Route\" size=\"100\" type=\"text\" value=\"{$_POST['Route']}\" /></td></tr>";
print "<tr><td>Aэропорт Прилета:</td>
		<td><input name=\"ToICAO\" type=\"text\" value=\"{$_POST['ToICAO']}\" size=\"4\"></td></tr><tr>";
print "<input type=\"submit\" value=\"Проверить\"></td></tr></table>";
print "</form>";


print "Маршрут:<BR>";
echo $FromICAO;
print"&nbsp;";
echo $Route;
print"&nbsp;";
echo $ToICAO;*/

//echo "Сервис временно недоступен";
@ParseRoute($_GET['FromICAO'],$_GET['Route'],$_GET['ToICAO']);
$str ="
<table cellspacing=\"1\" align=\"left\">
<tr><td>AWY<br/>GMORA<br />-----</td>
  		<td >TAS<br />MAC<br />----</td>
  		<td >G/S<br /><br />---</b></td>
        <td >LAT<br />LONG<br />----</td>
        <td >FL<br />WIND<br />---</td>
        <td >WYPNT<br />FREQY<br />---</td>
        <td >TRUE<br />TRACK<br />-----</td>
        <td >DTGO<br />DIST<br />----</td>
        <td >M/T<br />VAR<br />---</td>
        <td >T/T<br />ET<br />---</td>
        <td >RMF<br />PCF<br />---</td>
        <td >ETO<br />ATO<br />---</td>
        <td >AFOB<br />ACF<br />-----</td>
        <td >WYPNT NAME<br /><br />---------</td>
        </tr><tr>
        <td colspan=\"9\" align=\"center\">TAKE OFF POSITION<br />DEPARTURE MANOEUVRE</td>
        <td><br />10</td>
        <td align=\"right\">...<br />...</td>
        <td align=\"right\">...<br />...</td>
    			<td align=\"right\">....<br />.....</td>
                 <td></td>
        </tr>";
      $style="schedule_2";
      $dtgo=$distsumnm;
      $gcmap_url="http://www.gcmap.com/map?P=";
	  
      
 for($i=0;$i<count($RDATA);$i++){

        $gcmap_url.=format_coods($RDATA[$i]['lat_dec'],$RDATA[$i]['lon_dec']);
           if($i!=count($RDATA)-1) $gcmap_url.="-";

  $str.="<tr valign=\"top\"><td>{$RDATA[$i]['awy']}</td>
    			<td></td>
    			<td></td>
    			<td>{$RDATA[$i]['lat']}<br />{$RDATA[$i]['lon']}</td>
    			<td>{$RDATA[$i]['FL']}<br /></td>
    			<td>{$RDATA[$i]['wpt']}<br />{$RDATA[$i]['freq']}</td>
    			<td>{$RDATA[$i]['trk']}</td>
    			<td align=\"right\">$dtgo<br />{$RDATA[$i]['dist-nm']}</td>
    			<td>{$RDATA[$i]['tmk']}<br />{$RDATA[$i]['var']}</td>
    			<td></td>
    			<td></td>
    			<td align=\"right\">...<br />...</td>
    			<td align=\"right\">....<br />.....</td>
    			<td>{$RDATA[$i]['name']}</td></tr>";
	         if( $style=="schedule_2") $style = "schedule_1";
	         else $style = "schedule_2"; $dtgo=$dtgo-$RDATA[$i]['dist-nm'];
    }    
    
 $gcmap_url.="&amp;MS=wls&amp;MR=120&amp;MX=700x500&amp;PM=*&amp;MP=r";
 $str .= "</table><br />";
 
// echo $gcmap_url;

   echo $str; //echo "<BR>";
   echo "<div style=\"height: 1px; clear: both;\">";
  //echo "<BR><BR><img src=\"$gcmap_url\" align=\"center\" />";
// echo "<pre>";print_r($RDATA);echo "</pre>";
  
  function format_coods($lat,$lon){
  
  if($lat>0) $lat = $lat."+N";
  else $lat = abs($lat)."+S";
 
  if($lon>0) $lon = $lon."+E";
  else $lon = abs($lon)."+W";   
  
  return $lat."+".$lon;
  
  
  
  }
?>
