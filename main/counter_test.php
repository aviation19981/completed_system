

<!-- PARALLAX SECTION
================================================== -->

<section class="section-testimonials parallax-section" id="home">

	<div
		class="parallax-1"
		style="background-image:url('./images/fondos/<?php echo rand(1,10); ?>.jpg')"
		data-parallax-speed="0.4"></div>

	<div class="just_pattern_parallax"></div>
    
	<h1><font color="white"><?php echo TEST_CENTER; ?></font></h1>
	<br>
	<div class="sixteen columns"><div class="sub-text-line"></div></div>
	<br>
	<h3><font color="white"><?php echo DETAIL_TEST_CENTER; ?></font></h3>

</section>

	

			
		<section class="contact">
			<div class="container">

			
		<div id="divCounter"></div>
<script type="text/javascript">

var hoursleft = 0;
var minutesleft = 1;           // you can change these values to any value greater than 0
var secondsleft = 0;

var finishedtext = "Countdown finished!" // text that appears when the countdown reaches 0
var end = new Date();

end.setMinutes(end.getMinutes()+minutesleft);
end.setSeconds(end.getSeconds()+secondsleft);


if(localStorage.getItem("counter")){

    var value = localStorage.getItem("counter");

}else{
  var value = 0;
}


var counter = function (){


    var now = new Date();
var diff = end - now;
diff = new Date(diff);

var sec = diff.getSeconds();
var min = diff.getMinutes();

if (min < 10){
    min = "0" + min;
}
if (sec < 10){
    sec = "0" + sec;
}

if(now >= end){
    clearTimeout(timerID);
    document.getElementById('divCounter').innerHTML = finishedtext;
}
else{
    var value = min + ":" + sec;
//document.getElementById('divCounter').innerHTML = min + ":" + sec;
localStorage.setItem("counter", JSON.stringify(value));
}      

 // timerID = setTimeout("cd()", 1000);
// value = JSON.parse(localStorage.getItem("counter"));
//$('#divCounter').append(value);
document.getElementById('divCounter').innerHTML = value; 
 }





 var interval = setInterval(function (){counter();}, 1000);
 </script>
</div>
<div class="clear"></div>
<br>
</section>
</section>