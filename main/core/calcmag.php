<?php

function calcmag($alt,$glat,$glon){
 if(!$isLoaded||!isset($isLoaded)){  $wmmdat = fopen("WMM.COF","r");
 global $sp,$cp,$dp,$snorm,$maxord,$otime, $oalt, $olat, $olon,$a,$b,$re,$a2,$b2,$c2,$a4,$b4,$c4,$c,$d;
 global $D1,$D2,$D3,$D4,$pp,$fn,$fm,$isLoaded;
 $isLoaded=true;
/* INITIALIZE CONSTANTS */
  $maxord = 12;
  $sp[0] = 0.0;
  $cp[0] = $pp[0]=$p[0][0] = 1.0;
  $dp[0][0] = 0.0;
  $a = 6378.137;
  $b = 6356.7523142;
  $re = 6371.2;
  $a2 = $a*$a;
  $b2 = $b*$b;
  $c2 = $a2-$b2;
  $a4 = $a2*$a2;
  $b4 = $b2*$b2;
  $c4 = $a4 - $b4;

/* READ WORLD MAGNETIC MODEL SPHERICAL HARMONIC COEFFICIENTS */
  $c[0][0] = 0.0;
  $cd[0][0] = 0.0;

  $c_str=fgets($wmmdat, 80 );
  sscanf($c_str,"%f%s",$epoch,$model);
 while( ($c_str=fgets($wmmdat, 150))!==FALSE){
 // $c_str=fgets($wmmdat, 80 );

// END OF FILE NOT ENCOUNTERED, GET VALUES
  sscanf($c_str,'%d%d%f%f%f%f',$n,$m,$gnm,$hnm,$dgnm,$dhnm);
  //echo $c_str;
  // echo "$n,$m,$gnm,$hnm,$dgnm,$dhnm<br>";
  if ($m <= $n)
    {
      $c[$m][$n] = $gnm;
      $cd[$m][$n] = $dgnm;
      if ($m != 0)
        {
          $c[$n][$m-1] = $hnm;
          $cd[$n][$m-1] = $dhnm;
        }
    }
 }



/* CONVERT SCHMIDT NORMALIZED GAUSS COEFFICIENTS TO UNNORMALIZED */

  $snorm[0][0] = 1.0;
  for ($n=1; $n<=$maxord; $n++)
    {
      $snorm[0][$n] = $snorm[0][$n-1]*(2*$n-1)/$n;
      $j = 2;
      for ($m=0,$D1=1,$D2=($n-$m+$D1)/$D1; $D2>0; $D2--,$m+=$D1)
        {
          $k[$m][$n] = ((($n-1)*($n-1))-($m*$m))/((2*$n-1)*(2*$n-3));
          if ($m > 0)
            {
              $flnmj =(($n-$m+1)*$j)/($n+$m);
              $snorm[$m][$n] = $snorm[$m-1][$n]*sqrt($flnmj);
              $j = 1;
              $c[$n][$m-1] = $snorm[$m][$n]*$c[$n][$m-1];
              $cd[$n][$m-1] = $snorm[$m][$n]*$cd[$n][$m-1];
            }
          $c[$m][$n] = $snorm[$m][$n]*$c[$m][$n];
          $cd[$m][$n] = $snorm[$m][$n]*$cd[$m][$n];
        }
      $fn[$n] = $n+1;
      $fm[$n] = $n;
    }
  $k[1][1] = 0.0;


  $otime = $oalt = $olat = $olon = -1000.0;
  fclose($wmmdat);
}

 $p=$snorm;
  $time=2005;
  $dt = $time - 2005;
  $pi = 3.14159265359;
  $dtr = $pi/180.0;
  $rlon = $glon*$dtr;
  $rlat = $glat*$dtr;
  $srlon = sin($rlon);
  $srlat = sin($rlat);
  $crlon = cos($rlon);
  $crlat = cos($rlat);
  $srlat2 = $srlat*$srlat;
  $crlat2 = $crlat*$crlat;
  $sp[1] = $srlon;
  $cp[1] = $crlon;


/* CONVERT FROM GEODETIC COORDS. TO SPHERICAL COORDS. */
  if ($alt != $oalt || $glat != $olat)
    {
      $q = sqrt($a2-$c2*$srlat2);
      $q1 = $alt*$q;
      $q2 = (($q1+$a2)/($q1+$b2))*(($q1+$a2)/($q1+$b2));
      $ct = $srlat/sqrt($q2*$crlat2+$srlat2);
      $st = sqrt(1.0-($ct*$ct));
      $r2 = ($alt*$alt)+2.0*$q1+($a4-$c4*$srlat2)/($q*$q);
      $r = sqrt($r2);
      $d = sqrt($a2*$crlat2+$b2*$srlat2);
      $ca = ($alt+$d)/$r;
      $sa = $c2*$crlat*$srlat/($r*$d);
    }
  if ($glon != $olon)
    {
      for ($m=2; $m<=$maxord; $m++)
        {
          $sp[$m] = $sp[1]*$cp[$m-1]+$cp[1]*$sp[$m-1];
          $cp[$m] = $cp[1]*$cp[$m-1]-$sp[1]*$sp[$m-1];
        }
    }
  $aor = $re/$r;
  $ar = $aor*$aor;
  $br = $bt = $bp = $bpp = 0.0;
  for ($n=1; $n<=$maxord; $n++)
    {
      $ar = $ar*$aor;
      for ($m=0,$D3=1,$D4=($n+$m+$D3)/$D3; $D4>0; $D4--,$m+=$D3)
        {
/*
   COMPUTE UNNORMALIZED ASSOCIATED LEGENDRE POLYNOMIALS
   AND DERIVATIVES VIA RECURSION RELATIONS
*/

          if ($alt != $oalt || $glat != $olat)
            {
              if ($n == $m)
                {
                  $p[$m][$n] = $st*$p[$m-1][$n-1];
                  $dp[$m][$n] = $st*$dp[$m-1][$n-1]+$ct*$p[$m-1][$n-1];

                }
              elseif ($n == 1 && $m == 0)
                {
                  $p[$m][$n] = $ct*$p[$m][$n-1];
                  $dp[$m][$n] = $ct*$dp[$m][$n-1]-$st*$p[$m][$n-1];

                }
              elseif ($n > 1 && $n != $m)
                {
                  if ($m > $n-2) $p[$m][$n-2] = 0.0;
                  if ($m > $n-2) $dp[$m][$n-2] = 0.0;
                  $p[$m][$n] = $ct*$p[$m][$n-1]-$k[$m][$n]*$p[$m][$n-2];
                  $dp[$m][$n] = $ct*$dp[$m][$n-1] - $st*$p[$m][$n-1]-$k[$m][$n]*$dp[$m][$n-2];
                }
            }

/*
    TIME ADJUST THE GAUSS COEFFICIENTS
*/
          if ($time != $otime)
            {
              $tc[$m][$n] = $c[$m][$n]+$dt*$cd[$m][$n];
              if ($m != 0) $tc[$n][$m-1] = $c[$n][$m-1]+$dt*$cd[$n][$m-1];
            }
/*
    ACCUMULATE TERMS OF THE SPHERICAL HARMONIC EXPANSIONS
*/
          $par = $ar*$p[$m][$n];
          if ($m == 0)
            {
              $temp1 = $tc[$m][$n]*$cp[$m];
              $temp2 = $tc[$m][$n]*$sp[$m];
            }
          else
            {
              $temp1 = $tc[$m][$n]*$cp[$m]+$tc[$n][$m-1]*$sp[$m];
              $temp2 = $tc[$m][$n]*$sp[$m]-$tc[$n][$m-1]*$cp[$m];
            }
          $bt = $bt-$ar*$temp1*$dp[$m][$n];
          $bp += ($fm[$m]*$temp2*$par);
          $br += ($fn[$n]*$temp1*$par);
/*
    SPECIAL CASE:  NORTH/SOUTH GEOGRAPHIC POLES
*/
          if ($st == 0.0 && $m == 1)
            {
              if ($n == 1) $pp[$n] = $pp[$n-1];
              else $pp[$n] = $ct*$pp[$n-1]-$k[$m][$n]*$pp[$n-2];
              $parp = $ar*$pp[$n];
              $bpp += ($fm[$m]*$temp2*$parp);
            }
        }
    }
  if ($st == 0.0) $bp = $bpp;
  else $bp /= $st;
/*
    ROTATE MAGNETIC VECTOR COMPONENTS FROM SPHERICAL TO
    GEODETIC COORDINATES
*/
     $bx = -$bt*$ca-$br*$sa;
     $by = $bp;
     $bz = $bt*$sa-$br*$ca;
/*
    COMPUTE DECLINATION (DEC), INCLINATION (DIP) AND
    TOTAL INTENSITY (TI)
*/
  $bh = sqrt(($bx*$bx)+($by*$by));
  $ti = sqrt(($bh*$bh)+($bz*$bz));
  //$$dec = atan2($by,$bx)/$dtr;  ;
   $dec=atan2($by,$bx)/$dtr;
  $dip = atan2($bz,$bh)/$dtr;
/*
    COMPUTE MAGNETIC GRID VARIATION IF THE CURRENT
    GEODETIC POSITION IS IN THE ARCTIC OR ANTARCTIC
    (I.E. GLAT > +55 DEGREES OR GLAT < -55 DEGREES)

    OTHERWISE, SET MAGNETIC GRID VARIATION TO -999.0
*/
  $gv = -999.0;
  if (abs($glat) >= 55.0)
    {
      if ($glat > 0.0 && $glon >= 0.0) $gv =$dec-$glon;
      if ($glat > 0.0 && $glon < 0.0) $gv = $dec+abs($glon);
      if ($glat < 0.0 && $glon >= 0.0) $gv = $dec+$glon;
      if ($glat < 0.0 && $glon < 0.0) $gv = $dec- abs($glon);
      if ($gv > +180.0) $gv -= 360.0;
      if ($gv < -180.0) $gv += 360.0;
    }
  $otime = $time;
  $oalt = $alt;
  $olat = $glat;
  $olon = $glon;
  $gv=round($dec);
  if($gv>0)$gv="E$gv"; else $gv="W".abs($gv);
  return array($dec,$gv);

}



?>
