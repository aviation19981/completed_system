<?php
function km2nm($lenght){
	 return round($lenght/1.852);
}
function convFL($strFL){
	if(strpbrk($strFL, 'S')!=FALSE||strpbrk($strFL, 'F')!=FALSE){
	if(strpbrk($strFL, 'S')!=FALSE) {
	        switch($strFL) {
	        case S1110:
	        	return 364;
	        break;
	        case S1060:
	        	return 348;
	        break;
	        case S1010:
	        	return 331;
	        break;
	          case S0960:
	        	return 315;
	        break;
	        case S0910:
	        	return 299;
	        break;
	        case S0860:
	        	return 282;
	        break;
	        case S0810:
	        	return 266;
	        break;
	        case S0780:
	        	return 256;
	        break;
	        case S0750:
	        	return 246;
	        break;
	        }

	} else return substr($strFL,1);

	} else return $strFL;
}
function getDist($lat1,$lon1,$lat2,$lon2){
	$lat1=deg2rad($lat1);
	$lon1=deg2rad($lon1);
	$lat2=deg2rad($lat2);
	$lon2=deg2rad($lon2);
	$rad=6372795;

	$cl1=cos($lat1);
	$cl2=cos($lat2);
	$sl1=sin($lat1);
	$sl2=sin($lat2);
	$delta=$lon2-$lon1;
	$cdelta=cos($delta);
	$sdelta=sin($delta);


	$p1=pow(($cl2*$sdelta),2);
	$p2=pow((($cl1*$sl2)-($sl1*$cl2*$cdelta)),2);
	$p3=pow(($p1+$p2),0.5);
	$p4=$sl1*$sl2;
	$p5=$cl1*$cl2*$cdelta;
	$p6=$p4+$p5;
	$p7=$p3/$p6;

	$x=($cl1*$sl2)-($sl1*$cl2*$cdelta);
	$y=$sdelta*$cl2;
	$z=rad2deg(atan(-$y/$x));
	if($x<0)$z+=180;
	$z= deg2rad(-($z + 180 % 360 - 180));
    $anglerad2=$z - 2*pi()*floor($z/(2*pi()));
    $angledeg = ($anglerad2*180)/pi();

    $dlon_W = $lon2 - $lon1 - 2*pi()*(floor(($lon2 - $lon1)/(2*pi())));
    $dlon_E = $lon1 - $lon2 - 2*pi()*(floor(($lon1 - $lon2)/(2*pi())));
    $dphi = tan($lat2/2+pi()/4)/log(tan($lat1/2+pi()/4));

    if(abs($lat2-$lat1)<0.00000001)$q=cos($lat1);
    else  $q = ($lat2-$lat1)/$dphi;

    if($dlon_W < $dlon_E){
    	$dlon_W = -1*$dlon_W;
    		 if ($dlon_W >= 0) $sign = 1;
    		 else $sign = -1;
    		 if(abs($dlon_W) >= abs($dphi))
    		 	$Atn2=($sign*pi()/2)-atan($dphi/$dlon_W);
    		 elseif($dphi>0)
    		 	$Atn2 = atan($dlon_W / $dphi);
    		 else {
				if(-1*$dlon_W >= 0)
          			$Atn2 = pi()+atan($dlon_W/$dphi);
        		else
          			$Atn2 =-1*pi()+atan($dlon_W/$dphi);

    		 }
    } else {
    	if($dlon_W >= 0)$sign = 1; else $sign = -1;
    	if(abs($dlon_E)>=abs($dphi))
    		$Atn2 = $sign*pi()/2-atan($dphi/$dlon_E);
         elseif ($dphi>0)
    		 	$Atn2 = atan($dlon_E / $dphi);
    	 else{
				if((-1*$dlon_E) >= 0)
          			$Atn2 = pi() + atan($dlon_E/$dphi);
        		else
          			$Atn2 =-1*pi()+atan($dlon_E/$dphi);
    	$dlon=$dlon_E;
    }
    $tc = $Atn2 - 2*pi()*floor($Atn2/(2*pi()));





	} return array(round(atan($p7)*$rad*0.001),$angledeg);
}
function deg2str($lat,$lon){
    if($lat>0)$dir_lat="N";
    else {$dir_lat="S";$lat=-$lat;}
    if($lon>0)$dir_lon="E"; else {$dir_lon="W"; $lon=-$lon;}
	$deg_lat=floor($lat);
	$mins_lat=($lat-$deg_lat)*60;
//	$secs_lat=floor(($lat-$mins_lat/60-$deg_lat)*3600);

	$deg_lon=floor($lon);
	$mins_lon=($lon-$deg_lon)*60;
//	$secs_lon=floor(($lon-$mins_lon/60-$deg_lon)*3600);
           if($mins_lon<10) $mlon_str="0";
           if($mins_lat<10) $mlat_str="0";
    return array($dir_lat.vsprintf("%02d%s%2.1f",array($deg_lat,$mlat_str,$mins_lat)),
    $dir_lon.vsprintf("%03d%s%2.1f",array($deg_lon,$mlon_str,$mins_lon)));
}
function ParseRoute($FromICAO,$routeStr, $ToICAO, $wx=false){

    global $RDATA,$distsumkm,$distsumnm, $AloftOBS;
    $RDATA=NULL;
    $dist=0;$distnm=0;$distsum=0;$distsumnm=0;$distsumkm=0;
    $q=mysql_query("SELECT * FROM NavAIRPORTS INNER JOIN NavAPTs ON NavAPTs.NavAPT_ICAO=NavAIRPORTS.NavAIRPORT_ICAO WHERE NavAIRPORT_ICAO='$FromICAO'" );
    $r=mysql_fetch_array($q);
    $k=0;
    list($lat,$lon)=deg2str($r['NavAIRPORT_Lat'],$r['NavAIRPORT_Lon']);
         
    $RDATA[$k]['lat_dec']=$r['NavAIRPORT_Lat'];
    $RDATA[$k]['lon_dec']=$r['NavAIRPORT_Lon']; 
    $RDATA[$k]['name']=$r['NavAPT_NameFull'];
    $RDATA[$k]['lat']=$lat;
    $RDATA[$k]['lon']=$lon;
    $RDATA[$k]['awy']="DCT";
    $RDATA[$k]['wpt']=$FromICAO;
    $k++;
    $prevlat=$r['NavAIRPORT_Lat'];
    $prevlon=$r['NavAIRPORT_Lon'];
    $Route=explode(" ",trim($routeStr));
    $i=0; $a=0;
    //Проверка на секцию эшелона


    if(strlen($Route[$i])>6) {
        		if(($fl1=strpbrk($Route[$i], 'S'))==FALSE) 
                $fl=strpbrk($Route[$i], 'F');
        		else 
                $fl=$fl1;
            $i++; $a++;
              }
    if($Route[$i]=="DCT") {$i++;
    $a++; 
    }
    if($Route[count($Route)-1]=="DCT") 
        unset($Route[count($Route)-1]);

    while($i<count($Route)-1){




     	$from=$Route[$i]; 
     	$via=$Route[$i+1];
     	$to=$Route[$i+2];
     //   echo "$i $from $via $to <br/>";
     	 //RVSM Req. slash check
    if(strpbrk($from, '/')!=FALSE) {
    	$fl=strpbrk($from, '/');
    	if(($fl1=strpbrk($fl, 'S'))==FALSE) $fl=strpbrk($fl, 'F');
    	else $fl=$fl1;
    	$from=substr_replace($from,"",stripos($from, '/'));
    	}
	if(strpbrk($via, '/')!=FALSE) {
	    $to_fl=strpbrk($via, '/');
	   if(($fl1=strpbrk($to_fl, 'S'))==FALSE) $to_fl=strpbrk($to_fl, 'F');
    	else $to_fl=$fl1;
    	$via=substr_replace($via,"",stripos($via, '/'));}

    if(strpbrk($to, '/')!=FALSE){
        $to_fl=strpbrk($to, '/');
       if(($fl1=strpbrk($to_fl, 'S'))==FALSE) $to_fl=strpbrk($to_fl, 'F');
    	else $to_fl=$fl1;
    	$to=substr_replace($to,"",stripos($to, '/'));
        }

        $to_fl=convFL($to_fl);
        $fl=convFL($fl);

     	$q=mysql_query("SELECT COUNT(*) AS Count FROM Routes WHERE Route_Name='$via'");
     	$r=mysql_fetch_array($q);
     	if($r['Count']==0&&$via!="DCT") $to=$via;
     	if($via!="DCT"&&$r['Count']!=0){
    	   $q=mysql_query("SELECT Route_Num FROM Routes WHERE Route_Name='$via' AND Route_FixName='$from'");
    	   $r1=mysql_fetch_array($q);
    	    $fix1Num=$r1['Route_Num'];
    	       	//Поиск номеров точки входа на линию и точки выхода
    	   $q=mysql_query("SELECT Route_Num FROM Routes WHERE Route_Name='$via' AND Route_FixName='$to'");
    	   $r2=mysql_fetch_array($q);
    	    $fix2Num=$r2['Route_Num'];

    		if($i!=0+$a)$off=1;else $off=0;
    		if($fix1Num<$fix2Num){

    		$q=mysql_query("SELECT Route_FixName, NavAIDs.NavAID_Type,
        	NavAIDs.NavAID_NameFull,
        	NavAIDs.NavAID_Freq,
        	Routes.Route_FixLat,
        	Routes.Route_FixLon
        	 FROM Routes
    		LEFT JOIN NavAIDs ON
        	Routes.Route_FixLat=NavAIDs.NavAID_Lat AND
        	Routes.Route_FixLon=NavAIDs.NavAID_Lon AND
        	NavAIDs.NavAID_Name=Routes.Route_FixName


    		WHERE Route_Name='$via' AND Route_Num>=$fix1Num+$off AND
    			Route_Num<=$fix2Num ORDER BY Route_Num ASC");

        } else {
        	$q=mysql_query("SELECT Route_FixName, NavAIDs.NavAID_Type,
        	NavAIDs.NavAID_NameFull,
        	NavAIDs.NavAID_Freq,
        	Routes.Route_FixLat,
        	Routes.Route_FixLon FROM Routes
        	LEFT JOIN NavAIDs ON
        	Routes.Route_FixLat=NavAIDs.NavAID_Lat AND
        	Routes.Route_FixLon=NavAIDs.NavAID_Lon AND
        	NavAIDs.NavAID_Name=Routes.Route_FixName
        	 WHERE

        	 Route_Name='$via' AND Route_Num<=$fix1Num-$off AND
    			Route_Num>=$fix2Num

    			 ORDER BY Route_Num DESC");


        }

        for($j=0;$j<mysql_num_rows($q);$j++){
    			mysql_data_seek($q,$j);
    			$r=mysql_fetch_array($q);
    			if(isset($prevlat)&&isset($prevlon)){
    				list($dist,$trk)=getDist($prevlat,$prevlon,$r['Route_FixLat'],$r['Route_FixLon']);
    				list($dec,$gv)=calcmag(10,$prevlat,$prevlon);
    				if($trk-$dec>0) $tmk=vsprintf("%03d",$trk-$dec);
    				else $tmk=vsprintf("%03d",$trk-$dec+360);
    				$trk=vsprintf("%0.1f",$trk);
    				$distnm=km2nm($dist);
    				list($lat,$lon)=deg2str($r['Route_FixLat'],$r['Route_FixLon']);
          
        $RDATA[$k]['lat_dec']=$r['Route_FixLat'];
        $RDATA[$k]['lon_dec']=$r['Route_FixLon'];
    
    				$RDATA[$k]['lat']=$lat;
    				$RDATA[$k]['lon']=$lon;
    				$RDATA[$k-1]['dist-km']=$dist;
    				$RDATA[$k-1]['dist-nm']=$distnm;
    				$RDATA[$k-1]['trk']=$trk;
    				$RDATA[$k-1]['tmk']=$tmk;
    				$RDATA[$k-1]['var']=$gv;

    				$RDATA[$k-1]['FL']=$fl;
    				$RDATA[$k]['awy']=$via;

    				if(!isset($RDATA[$k-1]['awy'])) $RDATA[$k-1]['awy']="DCT";
                    if($j==(mysql_num_rows($q)-1)&&$to_fl!==FALSE&&isset($to_fl)) $fl=$to_fl;
    				$RDATA[$k]['FL']=$fl;
    				$RDATA[$k]['wpt']=$r['Route_FixName'];
    				$RDATA[$k]['freq']=$r['NavAID_Freq'];
    				$RDATA[$k]['name']=$r['NavAID_NameFull'];
    				$k++;

    			}
				$distsum+=$dist;
				$distsumnm+=$distnm;
                $prevlat=$r['Route_FixLat'];
                $prevlon=$r['Route_FixLon'];
                  if(!isset($r['NavAID_Type']))$r['NavAID_Type']="FIX";


    			}
               $i+=2;

    } else{
	    $distnext=0;
	    $dist=0;
   // 	$latstr=floor($prevlat);
  //  	$latstr1 =$latstr-5;
   // 	$latstr+=5;
  //  	$lonstr=floor($prevlon);
   // 	$lonstr1 =$lonstr-5;
  //  	$lonstr+=5;
        $q1=mysql_query("SELECT * FROM NavAIDs WHERE
        NavAID_Name='$from' AND
        NavAIDs.NavAID_Lat BETWEEN $prevlat-10 AND $prevlat+10
        AND NavAID_Lon BETWEEN $prevlon-10 AND $prevlon+10
        ORDER BY ABS($prevlat-NavAID_Lat)+ABS($prevlon-NavAID_Lon) ASC LIMIT 1") or die('q1');
      //  echo "$from".mysql_num_rows($q1)."<br />";
        if(mysql_num_rows($q1)!=0){
	        $r1=mysql_fetch_array($q1);
	        $latstr=floor($r1['NavAID_Lat']);
	        $lonstr=floor($r1['NavAID_Lon']);

	   /* 	$latstr1 =$latstr-5;
	        $lonstr1 =$lonstr-5;
	    	$lonstr+=5;
	    	$latstr+=5;  */
	    	$lat1=$r1['NavAID_Lat'];
	    	$lon1=$r1['NavAID_Lon'];
    	} else {
	    		  $q1=mysql_query("SELECT * FROM NavFIXes WHERE
	        NavFIX_Name='$from' AND
	        NavFIX_Lat BETWEEN $prevlat-15 AND $prevlat+15
	        AND NavFIX_Lon BETWEEN $prevlon-15 AND $prevlon+15 
          ORDER BY ABS($prevlat-NavFIX_Lat)+ABS($prevlon-NavFIX_Lon) ASC LIMIT 1
	        ") or die('q1');
        //  echo "$from".mysql_num_rows($q1)."<br />";
	        $r1=mysql_fetch_array($q1);
	        $latstr=$r1['NavFIX_Lat'];
	        $lonstr=$r1['NavFIX_Lon'];

	    /*	$latstr1 =$latstr-5;
	        $lonstr1 =$lonstr-5;
	    	$lonstr+=5;
	    	$latstr+=5; */
	    	$lat1=$r1['NavFIX_Lat'];
	    	$lon1=$r1['NavFIX_Lon'];
    	}
        $q2=mysql_query("SELECT * FROM NavAIDs WHERE
        NavAID_Name='$to' AND
        NavAID_Lat BETWEEN $latstr-10 AND $latstr+10
       AND
       NavAID_Lon BETWEEN $lonstr-10 AND $lonstr+10
       ORDER BY ABS($latstr-NavAID_Lat)+ABS($lonstr-NavAID_Lon) ASC LIMIT 1") or die('q221');
          if(mysql_num_rows($q2)!=0){
		        $r2=mysql_fetch_array($q2);

		    	list($dist,$trk)=getDist($prevlat,$prevlon,$lat1,$lon1);
		    	list($dec,$gv)=calcmag(10,$prevlat,$prevlon);
		    	if($trk-$dec>0) $tmk=vsprintf("%03d",$trk-$dec);
    				else $tmk=vsprintf("%03d",$trk-$dec+360);
    				$trk=vsprintf("%0.1f",$trk);
		    	$distnm=km2nm($dist);
		    	list($lat,$lon)=deg2str($lat1,$lon1);
          
        
           $lat_dec=$lat;
          $lon_dec=$lon;
		  		$prevlat=$r2['NavAID_Lat'];
		    	$prevlon=$r2['NavAID_Lon'];
		        list($distnext,$trknext)=getDist($lat1,$lon1,$r2['NavAID_Lat'],$r2['NavAID_Lon']);
		        list($decnext,$gvnext)=calcmag(10,$lat1,$lon1);
                   if($trknext-$decnext>0) $tmknext=vsprintf("%03d",$trknext-$dec);
    				else $tmknext=vsprintf("%03d",$trknext-$decnext+360);
    				$trknext=vsprintf("%0.1f",$trknext);
		        list($latnext,$lonnext)=deg2str($r2['NavAID_Lat'],$r2['NavAID_Lon']);
        
        $latnext_dec=$r2['NavAID_Lat'];
        $lonnext_dec=$r2['NavAID_Lon'];
      


		        $distnextnm=km2nm($distnext);
        } else {
         $q2=mysql_query("SELECT * FROM NavFIXes WHERE
        NavFIX_Name='$to' AND
        NavFIX_Lat BETWEEN $latstr-15 AND $latstr+15
        AND NavFIX_Lon BETWEEN $lonstr-15 AND $lonstr+15
        ORDER BY ABS($latstr-NavFIX_Lat)+ABS($lonstr-NavFIX_Lon) ASC LIMIT 1") or die('q222');
        	     $r2=mysql_fetch_array($q2);
             //   echo "$to".mysql_num_rows($q2)."<br />";
		    	list($dist,$trk)=getDist($prevlat,$prevlon,$lat1,$lon1);
                  list($dec,$gv)=calcmag(10,$prevlat,$prevlon);
                      if($trk-$dec>0) $tmk=vsprintf("%03d",$trk-$dec);
    				else $tmk=vsprintf("%03d",$trk-$dec+360);
    				$trk=vsprintf("%0.1f",$trk);

		    	$distnm=km2nm($dist);

		  		$prevlat=$r2['NavFIX_Lat'];
		    	$prevlon=$r2['NavFIX_Lon'];
		        list($distnext,$trknext)=getDist($lat1,$lon1,$r2['NavFIX_Lat'],$r2['NavFIX_Lon']);
		        list($decnext,$gvnext)=calcmag(10,$lat1,$lon1);
                      if($trknext-$decnext>0) $tmknext=vsprintf("%03d",$trknext-$dec);
    				else $tmknext=vsprintf("%03d",$trknext-$decnext+360);
    				$trknext=vsprintf("%0.1f",$trknext);
		       list($latnext,$lonnext)=deg2str($r2['NavFIX_Lat'],$r2['NavFIX_Lon']);
                  
        $latnext_dec=$r2['NavFIX_Lat'];
        $lonnext_dec=$r2['NavFIX_Lon'];
         

		        $distnextnm=km2nm($distnext);



        }

        if(!isset($r2['NavAID_Type']))
        	$r2['NavAID_Type']="FIX";
        if(!isset($r1['NavAID_Type']))
        	$r1['NavAID_Type']="FIX";
        	
        
    	if($k==1){

    	     	$RDATA[$k-1]['dist-km']=$dist;
    				$RDATA[$k-1]['dist-nm']=$distnm;
    				$RDATA[$k-1]['trk']=$trk;
    				$RDATA[$k-1]['tmk']=$tmk;
    				$RDATA[$k-1]['var']=$gv;
    				$RDATA[$k-1]['FL']=$fl;
    		//		$RDATA[$k]['lat']=$lat;
    				list($RDATA[$k]['lat'],$RDATA[$k]['lon'])=deg2str($lat1,$lon1);
    		//		$RDATA[$k]['lon']=$lon;
            $RDATA[$k]['lat_dec']=$lat1;
    				$RDATA[$k]['lon_dec']=$lon1; 
    				$RDATA[$k]['awy']="DCT";
    				$RDATA[$k]['wpt']=$from;
    				$RDATA[$k]['FL']=$fl;
    				$RDATA[$k]['freq']=$r1['NavAID_Freq'];
            $RDATA[$k]['name']=$r1['NavAID_NameFull'];
    				$RDATA[$k]['dist-km']=$distnext;
    				$RDATA[$k]['dist-nm']=$distnextnm;
    				$RDATA[$k]['trk']=$trknext;
    				$RDATA[$k]['tmk']=$tmknext;
    				$RDATA[$k]['var']=$gvnext;
    				$RDATA[$k+1]['lat']=$latnext;
    				$RDATA[$k+1]['lon']=$lonnext; 
            $RDATA[$k+1]['lat_dec']=$latnext_dec;
    				$RDATA[$k+1]['lon_dec']=$lonnext_dec; 
    				$RDATA[$k+1]['awy']="DCT";
    				$RDATA[$k+1]['wpt']=$to;
    				$RDATA[$k+1]['FL']=$fl_to;
    				$RDATA[$k+1]['freq']=$r2['NavAID_Freq'];
    				$RDATA[$k+1]['name']=$r2['NavAID_NameFull'];
            $k+=2;
    	     }
    	     else {
    	       //	echo "$i $k $from $via $to <br />";  if($k!=1) 
             $k--;   
    	     	$RDATA[$k]['dist-km']=$distnext;
    				$RDATA[$k]['dist-nm']=$distnextnm;
    				$RDATA[$k]['trk']=$trknext;
    				$RDATA[$k]['tmk']=$tmknext;
    				$RDATA[$k]['var']=$gvnext;
    				$RDATA[$k]['FL']=$fl;
    				$RDATA[$k+1]['lat']=$latnext;
    				$RDATA[$k+1]['lon']=$lonnext;
    				
            $RDATA[$k+1]['lat_dec']=$latnext_dec;
    				$RDATA[$k+1]['lon_dec']=$lonnext_dec; 
         
    				
    				$RDATA[$k+1]['awy']="DCT";
    				$RDATA[$k+1]['wpt']=$to;
    				//$RDATA[$k+1]['FL']=$fl_to;
    				$RDATA[$k+1]['freq']=$r2['NavAID_Freq'];
    				$RDATA[$k+1]['name']=$r2['NavAID_NameFull'];
                     $k+=2;
    			}
    		$distsum=$distsum+$dist+$distnext;
    		$distsumnm=$distsumnm+$distnm+$distnextnm;
       if ($via!="DCT") $i++;else $i+=2;
      }
    }

    $q=mysql_query("SELECT * FROM NavAIRPORTS INNER JOIN NavAPTs ON NavAPTs.NavAPT_ICAO=NavAIRPORTS.NavAIRPORT_ICAO WHERE NavAIRPORT_ICAO='$ToICAO'");
      $r=mysql_fetch_array($q);
      list($dist,$trk)=getDist($prevlat,$prevlon,$r['NavAIRPORT_Lat'],$r['NavAIRPORT_Lon']);
      list($dec,$gv)=calcmag(10,$prevlat,$prevlon);
      $distnm=km2nm($dist);
     if($trk-$dec>0) $tmk=vsprintf("%03d",$trk-$dec);
    else $tmk=vsprintf("%03d",$trk-$dec+360);
    				$trk=vsprintf("%0.1f",$trk);
      list($lat,$lon)=deg2str($r['NavAIRPORT_Lat'],$r['NavAIRPORT_Lon']);
            		$RDATA[$k-1]['dist-km']=$dist;
    				$RDATA[$k-1]['dist-nm']=$distnm;
    				$RDATA[$k-1]['trk']=$trk;
    				$RDATA[$k-1]['tmk']=$tmk;
    				$RDATA[$k-1]['var']=$gv;
    				$RDATA[$k]['lat']=$lat;
    				$RDATA[$k]['lon']=$lon;
    				
    				   
      			$RDATA[$k]['lat_dec']=$r['NavAIRPORT_Lat'];
    				$RDATA[$k]['lon_dec']=$r['NavAIRPORT_Lon'];
          
    				
    				$RDATA[$k]['name']=$r['NavAPT_NameFull'];
    			//	$RDATA[$k]['awy']="DCT";
    				$RDATA[$k]['wpt']="$ToICAO";
    			//	$RDATA[$k]['freq']=$r1['NavAID_Freq'];



 $distsumkm=$distsum+$dist;
  $distsumnm=$distsumnm+$distnm;




if($wx){ 

  if(!isset($RDATA[0]["FL"]))
    for($i=0;$i<count($RDATA);$i++)
        $RDATA[$i]["FL"]=290;
      
  $RDATA[0]['wx']= $FromICAO;
  $RDATA[0]["FL"]= 60;
  $RDATA[0]['aloft']=get_aloft($FromICAO);
  
  for($p=1;$p<count($RDATA)-1;$p++)
    {
     $wx_q= mysql_query("SELECT NavAIRPORT_ICAO FROM NavAIRPORTS WHERE (NavAIRPORT_Lat BETWEEN {$RDATA[$p]['lat_dec']}-5 AND {$RDATA[$p]['lat_dec']}+5)
       AND (NavAIRPORT_Lon BETWEEN {$RDATA[$p]['lon_dec']}-10 AND {$RDATA[$p]['lon_dec']}+10) 
        ORDER BY ABS(NavAIRPORT_Lat-{$RDATA[$p]['lat_dec']})+ABS(NavAIRPORT_Lon-{$RDATA[$p]['lon_dec']}) ASC LIMIT 5");
      if(mysql_num_rows($wx_q)!=0)  {
        mysql_data_seek($wx_q,0);
      list($RDATA[$p]['wx'])=mysql_fetch_array($wx_q);
      
      if( $RDATA[$p]['wx'] !=  $RDATA[$p-1]['wx']) {$RDATA[$p]['aloft']=get_aloft($RDATA[$p]['wx']); 
            if(strlen($RDATA[$p]['aloft'][0]["time"])>3) {
            for($i=1;$i<5;$i++) {
          //  echo "Fuck $i <br />";
             mysql_data_seek($wx_q,$i); 
             list($RDATA[$p]['wx'])=mysql_fetch_array($wx_q);
              $RDATA[$p]['aloft']=get_aloft($RDATA[$p]['wx']);
              if(strlen($RDATA[$p]['aloft'][0]["time"])==3) break;
            }  }
             if(strlen($RDATA[$p]['aloft'][0]["time"])>3)
                $RDATA[$p]['aloft']=$RDATA[$p-1]['aloft'];  
             }
      else $RDATA[$p]['aloft']=$RDATA[$p-1]['aloft'];
      
     } else  $RDATA[$p]['aloft']=$RDATA[$p-1]['aloft'];
      
      
    }
 $RDATA[count($RDATA)-1]['wx']= $ToICAO;
 $RDATA[count($RDATA)-1]['FL']= 60;
  if( $RDATA[count($RDATA)-2]['wx'] !=  $ToICAO) $RDATA[count($RDATA)-1]['aloft']=get_aloft($ToICAO);
      else $RDATA[count($RDATA)-1]['aloft']=$RDATA[count($RDATA)-2]['aloft'];


   // Interpolating Wx data

    for($i=0;$i<count($RDATA);$i++){
    
            $i1=0; $i2=count($RDATA[$i]["aloft"][0])-2;
          while($RDATA[$i]["FL"]*100 > $RDATA[$i]["aloft"][0][$i1]["alt"] && $i1 <= $i2) $i1++;
          while($RDATA[$i]["FL"]*100 < $RDATA[$i]["aloft"][0][$i2]["alt"] && $i2 >= 0 ) $i2--;

          $RDATA[$i]["wind_spd"]=linterp($RDATA[$i]["aloft"][0][$i2]["alt"],$RDATA[$i]["aloft"][0][$i2]["spd"] ,$RDATA[$i]["aloft"][0][$i1]["alt"],$RDATA[$i]["aloft"][0][$i1]["spd"],$RDATA[$i]["FL"]*100);
            $RDATA[$i]["temp"]=linterp($RDATA[$i]["aloft"][0][$i2]["alt"],$RDATA[$i]["aloft"][0][$i2]["temp"] ,$RDATA[$i]["aloft"][0][$i1]["alt"],$RDATA[$i]["aloft"][0][$i1]["temp"],$RDATA[$i]["FL"]*100);
              $RDATA[$i]["wind_dir"]=linterp($RDATA[$i]["aloft"][0][$i2]["alt"],$RDATA[$i]["aloft"][0][$i2]["dir"] ,$RDATA[$i]["aloft"][0][$i1]["alt"],$RDATA[$i]["aloft"][0][$i1]["dir"],$RDATA[$i]["FL"]*100);
      
      
    }
         global $AWC; $AWC=0;                           
    // Calculating AVG W/C
     for($i=0;$i<count($RDATA);$i++){
        $AWC+=( -1* $RDATA[$i]["wind_spd"] * cos(deg2rad(abs($RDATA[$i]["wind_dir"]-$RDATA[$i]["tmk"])))) *  $RDATA[$i]["dist-nm"]/$distsumnm;

    }

 // echo "AVG W/C $AWC";
                                      
                                  
}


 // echo "<PRE>"; print_r($RDATA);" </PRE>";


}

function get_aloft($ICAO){

$url="http://www.jetplan.com/jeppesen/weatherServlet?query=999&notamFilterName=&wxType=fd&wxStation=$ICAO";

$aloft=file($url) or die('Cannot get Winds aloft');
$i=0;

while($i<count($aloft)&&(substr_count($aloft[$i],"DATA")!=1))
  $i++;

       
   $s=array("M","P");
   $r=array("-","+");
   $alt = array(6000,9000,12000,18000,24000,30000,34000,39000);
       if(!isset($AloftOBS)){
       global $AloftOBS;
        $AloftOBS['Day'] = substr($aloft[$i],22,2);
        $AloftOBS['Time'] = substr($aloft[$i],24,5);
        }
      //  print_r($AloftOBS);
    for($j=$i+2,$a=0; $j<=$i+5;$j++,$a++) {
    
  list($time,$data)=explode("  ",$aloft[$j]);
  
  $col= explode(" ",$data);
  for($k=0;$k<count($col);$k++){
  $array[$a]["time"]= $time;
  $array[$a][$k]["alt"] = $alt[$k];
  $array[$a][$k]["str"]= $col[$k];  
  $array[$a][$k]["temp"] = str_replace($s,$r,substr($col[$k],-3)) * 1;
  $array[$a][$k]["dir"]= substr($col[$k],0,2) * 10;  
  $array[$a][$k]["spd"]= substr($col[$k],2,2);
          }
      }
  if(!isset($AloftOBS['PROGS'])) $AloftOBS['PROGS'] = $array[0]["time"];    
  
//echo "<PRE>"; print_r($array); echo "</PRE>";   
  return $array;
  
}


function linterp($x1,$y1,$x2,$y2,$x){

    return $y1 +  ($y2 - $y1) / ($x2- $x1) * ($x - $x1);

}

function getPoint($lat1, $lon1, $d, $brng)
{
$lat1 = deg2rad($lat1);
$lon1 = deg2rad($lon1);
 $brng = deg2rad($brng);
$R=km2nm(6371); //$d=nm2km($d);


$lat2 = asin( sin($lat1)*cos($d/$R) + cos($lat1)*sin($d/$R)*cos($brng) );
$lon2 = $lon1 + atan2(sin($brng)*sin($d/$R)*cos($lat1), cos($d/$R)-sin($lat1)*sin($lat2));


return array( rad2deg($lat2), rad2deg($lon2)) ;
}

?>