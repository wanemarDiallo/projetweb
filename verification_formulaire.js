$(document).ready(function (){
  /**
    @Interaction et mise en forme des input connexion
  */
  $('.connexion>input, .inscription>input').on('focus', function(){
    var label = $(this).prev();
    label.fadeOut();
  });
  $('.connexion>input, .inscription>input').on('blur', function(){
    var label = $(this).prev();
    label.fadeIn();
  });
});
