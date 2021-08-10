/*-----------------------------------------------------------------------------------*/
/*  FUNCTIONS
/*-----------------------------------------------------------------------------------*/
jQuery(window).load(function(){
  'use strict';
  jQuery('.dropdown-menu').addClass('dropdown-push-right');

  $('.menu-close').on('click', function(){
    $('#menuToggle').toggleClass('active');
    $('body').toggleClass('body-push-toright');
    $('#theMenu').toggleClass('menu-open');
	});

 // ADD SLIDEDOWN ANIMATION TO DROPDOWN //
  $('.dropdown').on('show.bs.dropdown', function(e){
    $(this).find('.dropdown-menu').first().stop(true, true).slideDown();
  });

  // ADD SLIDEUP ANIMATION TO DROPDOWN //
  $('.dropdown').on('hide.bs.dropdown', function(e){
    $(this).find('.dropdown-menu').first().stop(true, true).slideUp();
  });

  	$('#headerwrap').bind('resize', function(){
   		$('#headerwrap').backstretch("resize");
	});
 // defaults
    

});