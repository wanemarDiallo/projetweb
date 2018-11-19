$(document).ready(function (){
  /**
    @Interaction et mise en forme des input connexion
  */
  $('.connexion>input').on('focus', function(){
    var label = $(this).prev();
    label.fadeOut();
  });
  $('.connexion>input').on('blur', function(){
    var label = $(this).prev();
    label.fadeIn();
  });
});
