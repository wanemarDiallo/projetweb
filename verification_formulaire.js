$(document).ready(function (){
  /**
    @Interaction et mise en forme des input connexion
  */
  $('.siError').hide(); //on casse les blocks d'affiche d'erreur

  /**
    @Traitement du formulaire de connexion
    @Algorithme:

    */
  $('#connecter').click(function(event){
    event.preventDefault();
    var log = $('#login').val();
    var mdp = $('#mdp').val();

    var regex_log = new RegExp("^[a-zA-Z]+[0-9]*$");

    if (!regex_log.test(log)){
          $('.err_log').empty().hide().append("l'information du champ login n'est pas valide").fadeIn();
          $('#login').css('border-color', 'red');
      }
    else if(mdp.length<8){
      $('.err_mdp').empty().hide().append("Le mot de passe doit contenir au moins 8 caractères.").fadeIn();
      $('#mdp').css('border-color', 'red');
    }
    else{
      $('.err_log, .err_mdp').empty().hide();
      $(this).css('border-color', '#CC8E69');
      $.post('connexion.php', {'login': log, 'mdp': mdp}, function(data){
          if(data==0){
          $('.err_mdp').empty().hide().append("Vous êtes pas inscris.").fadeIn();
          }else {
            $('#connexion').submit();
          }
      });
    }
  });

  $('.connexion>input, .inscription>input').on('focus', function(){
    var label = $(this).prev();
    label.fadeOut();
  });
  $('.connexion>input, .inscription>input').on('blur', function(){
    var label = $(this).prev();
    if($(this).val()=='') label.fadeIn();
  });

  $('.mdp_oubier>a').on('click', function(){
      var url = "modifPassword.php";
      window.open(url,"modifier mdp","menubar=no, status=no, scrollbars=no, menubar=no, width=500, height=500")
  });

});
