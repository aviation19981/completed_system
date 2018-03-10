<?php



        public function indexa()
        {


            $url = 'http://www.simbrief.com/ofp/flightplans/xml/'.$this->get->ofp_id.'.xml';
            $xml = simplexml_load_file($url);
            $this->set('info', $xml);
            $this->render('../../colstardispatch.php?'); 
            //print_r($xml);
        }


?>