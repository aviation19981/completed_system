//Ready
$(document).ready(function(){
  // http://ryanve.com/lab/dimensions/ - Window height on mobiles
  if($(window).height() > $(window).width()){
  wHeight = window.screen.availHeight;
  }
  else {
  wHeight = $(window).height();
  }
  var tHeight = ($('.title').height()/2);
  $('.title').css({'margin-top':(tHeight*-1)});
  $('.cover').height(wHeight);
  $('.page').height(wHeight);
  $('.sidebar').height(wHeight);
  $('.sidebar-content').height(wHeight);
  $('.wrapper').css({'min-height':wHeight});
  $('.down').click(function(){
  $('html,body').animate({
          scrollTop: wHeight
        }, 1000); 
  });
  $('.page').hide();
  $('.page').first().show();
  if($('.page:visible').prev('.page').length == 0){
      $('.previous').hide();
    }
   if($('.page:visible').next('.page').length == 0){
      $('.next').hide();
    }
  $('.next').click(function(){
    $('.page:visible').first().fadeOut();
    $('.page:visible').next('.page').fadeIn();
    if($('.page:visible:last').next().length == 0){
      $('.next').hide();
    }
    if($('.page:visible:last').prev('.page').length > 0){
      $('.previous').show();
    }
  });
  $('.previous').click(function(){
    $('.page:visible').first().fadeOut();
    $('.page:visible').prev('.page').fadeIn();
    if($('.page:visible:first').prev('.page').length == 0){
      $('.previous').hide();
    }
    if($('.page:visible:first').next('.page').length > 0){
      $('.next').show();
    }
  });
  
  $('.toggle').click(function(){
   $(this).hide().animate({'left':'250px'},1000);
   $('.toggle-active').show().animate({'left':'250px'},1000);
   $('.sidebar').animate({'left':'0px'},1000);
  });
  
   $('.toggle-active').click(function(){
   $(this).hide().animate({'left':'0px'},1000);;
   $('.toggle').show().animate({'left':'0px'},1000);
   $('.sidebar').animate({'left':'-250px'},1000);
  });
  
});


//Resize

if (screen && screen.width > 480) {
$(window).resize(function(){
  if($(window).height() > $(window).width()){
  wHeight = window.screen.availHeight;
  }
  else {
  wHeight = $(window).height();
  }
  var tHeight = ($('.title').height()/2);
  $('.title').css({'margin-top':(tHeight*-1)});
  $('.cover').height(wHeight);
  $('.page').height(wHeight);
  $('.sidebar').height(wHeight);
  $('.sidebar-content').height(wHeight);
});
}


//Scroll
$(window).scroll(function(){
  if($(window).scrollTop() >= 50){
    $('.down').fadeOut(1500);
  }
  else {
    $('.down').fadeIn(1500);
  }
});