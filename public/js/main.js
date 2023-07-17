$(document).ready(function(){
    $('.sidebar li:has(ul)').click(function(e){
        e.preventDefault();
        if($(this).hasClass('activado')){
            $(this).removeClass('activado');
            $(this).children('ul').slideUp();
        }else{
            $('.sidebar li ul').slideUp();
            $('.sidebar li').removeClass('activado');
            $(this).addClass('activado');
            $(this).children('ul').slideDown();
        }
    });
    $('.sidebar li ul li a').click(function(){
      window.location.href= $(this).attr('href'); 
    });
});