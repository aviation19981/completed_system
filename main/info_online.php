 <?
/**
 * IVAO Traffic list
 *
 * @author Aki Kettunen www.akikettu.net
 * @package defaultPackage
 */
/*
BEGINNG OF CONFIGURATION
*/

/**
 *  EDIT by Chris Doehring (272909), 2012-12-04
 *  Added check function for local airport country codes...
 *
 */
 

    
	
 function checkCountryIcao($check) {

    include('./db_login.php');
	$db = new mysqli($db_host , $db_username , $db_password , $db_database);
	$db->set_charset("utf8");
	if ($db->connect_errno > 0) {
		die('Unable to connect to database [' . $db->connect_error . ']');
	}

	$countryicao = array();
    $sql_division ="select * from va_parameters where va_parameters_id=1";

	if (!$result_division = $db->query($sql_division)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	while ($row_division = $result_division->fetch_assoc()) {
		$countryicao[]= $row_division["division"];
	}
    
    foreach($countryicao as $id => $value) {
        if(trim($value) == trim($check)) {
            return true;
        }
    }
    return false;
 }

$countryicaoPCA = "SK";

// For easy translation..
$lng['staffingb'] = 'Staff en linea';
$lng['atcingb'] = 'ATC en linea - CO';
$lng['noatcingb'] = 'No hay ATC en linea.';
$lng['trafficingb'] = 'Trafico Salidas/Llegadas';
$lng['notrafficingb'] = 'No hay trafico Salidas/Llegadas.';
$lng['atcbingb'] = '<a href="http://www.ivao.aero/atcss/new.asp" target="_blank">Add a Booking</a>';
$lng['noatcbingb'] = 'No se puede reservar.';
$lng['totalonline'] = 'Hay %s ATC(s) y %s  piloto(s) conectado(s) en IVAO.';
$lng['today'] = 'Hoy';
$lng['tomorrow'] = 'Mañana';
$weekdays = array(
    1 => 'Lunes',
    2 => 'Martes',
    3 => 'Miercoles',
    4 => 'Jueves',
    5 => 'Viernes',
    6 => 'Sabado',
    0 => 'Domingo'
);

// Put here 2 first letter of airport ICAO codes
#$countryicao = 'NW';

// Put here country code of staff members
$staffcountry = 'CO';

$airports = array(
'SKBO' => '', 
'SKRG' => '', 
'SKCL' => '', 
'SKPE' => '', 
'SKSP' => '', 
'SKSM' => '', 
'SKCG' => '', 
'SKRH' => '', 
'SKBG' => '', 
'SKMD' => '', 
'SKBQ' => '', 
'SKBS' => '', 
);

$validcontrollers = array('DEL','GND','TWR','DEP','APP','CTR','FSS');

$ctrlevel = array(
   1 => 'OBS',
   2 => 'AS1',
   3 => 'AS2',
   4 => 'AS3',
   5 => 'ADC',
   6 => 'APC',
   7 => 'ACC',
   8 => '<span class="green">SEC</span>',
   9 => '<span class="green">SAI</span>',
  10 => '<span class="green">CAI</span>',
  11 => '<span class="red">SUP</span>',
  12 => '<span class="red">ADM</span>'
);

/*
END OF CONFIGURATION
*/

//http://www.ivao.aero/whazzup/status.txt
//http://dataservice.gatools.org/data/ivao.txt

// DOWNLOAD ONLINE-LISTAUS
//---------------------------------------------------------------------------------------------------------
$filecontents = file_get_contents('http://api.ivao.aero/getdata/whazzup/whazzup.txt');
$rows = explode("\n", $filecontents);

$filepart = '';
$pilots = array();
$pilotcount = 0;
$controllers = array();
$staff = array();
$controllercount = 0;
$generaldata = array();

foreach ($rows as $row) {
    if (substr($row,0,1) == '!') {
        $filepart = substr($row,1);
    } else {
        switch ($filepart) {
            case 'CLIENTS':
                $fields = explode(":", $row);
                if ($fields[3] == 'ATC') {
                    $controllercount++;
                    if (in_array(substr($fields[0],-3), $validcontrollers) && checkCountryIcao(substr($fields[0],0,2))) { array_push($controllers, $fields); }
                        if (substr($fields[0],0,3) == $staffcountry . '-') { array_push($staff, $fields); }
                } else {
                    $pilotcount++;
                    if (checkCountryIcao(substr($fields[11],0,2)) OR checkCountryIcao(substr($fields[13],0,2))) {
                        array_push($pilots, $fields);
                    }
                }
                break;
            case 'GENERAL':
                list($key, $value) = explode('=', $row);
                $generaldata[trim($key)] = trim($value);
                break;
        }
    }
}


// DOWNLOAD BOOKING LIST
//---------------------------------------------------------------------------------------------------------
$filecontentsa = file_get_contents('http://www.ivao.aero/schedule/indd.asp');
$rowsa = explode("\n", $filecontentsa);

$filepart = '';
$booking_pilots = array();
$booking_controllers = array();

foreach ($rowsa as $rowa) {
    if (substr($rowa,0,1) == '!') {
        $filepart = substr($rowa,1);
    } else {
        switch (trim($filepart)) {
            case 'CLIENTS:':
                $fields = explode(":", $rowa);
                if ($fields[3] == 'ATC') {
                    if (checkCountryIcao(substr($fields[0],0,2))) { 
                        switch ($fields[16]) {
                            case DateAdd(0):
                            if (!isset($booking_controllers[0])) { $booking_controllers[0] = array(); }
                            array_push($booking_controllers[0], $fields);
                            break;
                            
                            case DateAdd(1):
                            if (!isset($booking_controllers[1])) { $booking_controllers[1] = array(); }
                            array_push($booking_controllers[1], $fields);
                            break;
                            
                            case DateAdd(2):
                            if (!isset($booking_controllers[2])) { $booking_controllers[2] = array(); }
                            array_push($booking_controllers[2], $fields);
                            break;
                            
/**/

                            case DateAdd(3):
                            if (!isset($booking_controllers[3])) { $booking_controllers[3] = array(); }
                            array_push($booking_controllers[3], $fields);
                            break;
                            
                            case DateAdd(4):
                            if (!isset($booking_controllers[4])) { $booking_controllers[4] = array(); }
                            array_push($booking_controllers[4], $fields);
                            break;
                            
                            case DateAdd(5):
                            if (!isset($booking_controllers[5])) { $booking_controllers[5] = array(); }
                            array_push($booking_controllers[5], $fields);
                            break;
                            
                            case DateAdd(6):
                            if (!isset($booking_controllers[6])) { $booking_controllers[6] = array(); }
                            array_push($booking_controllers[6], $fields);
                            break;

                        }
                    }
                } else {
                    if (checkCountryIcao(substr($fields[11],0,2)) OR checkCountryIcao(substr($fields[13],0,2))) {
                        array_push($booking_pilots, $fields);
                    }
                }
                break;
        }
    }
}

function remove_accents( $string )
{
   $string = htmlentities($string);
   return preg_replace("/&([a-z])[a-z]+;/i","$1",$string);
}




// BOOKINGS
//-------------------------------------------------------------------------------------------------------------------
// ATC




function DateAdd($v,$d=null , $f="Ymd"){
    
$d=($d?$d:GMdate("Y-m-d")); 
    return GMdate($f,strtotime($v." days",strtotime($d))); 
}





    
    
    
    
    
?>