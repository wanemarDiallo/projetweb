$(document).ready(function() {

  /**
  @param
  --
  */
  $('#recherche').focus(function(){
    $('.listeRecettes').text("Resultats de votre recherche");
  });
  $('#recherche').blur(function(){
    $('.listeRecettes').text('liste des recettes');
  });

  $('#button_recherche').on('click', function(){
    var mot = $('#recherche').val();
    $.post('traitementSearch.php', {'recherche': mot}, function(data){
        alert(data);
    });
  });
  $('.buton_favorie').on('click', function(){
    var url = window.location.href;
    var resultat = url.split('&');
    var nom_recette = resultat[1].split('=');

     nom_recette = nom_recette[1].replace(/%[0-9]*/g, ' ');
    $.ajax({
        type: "POST",
        url: 'f_cookie.php',
        data: {'recette':nom_recette },
        dataType: "text",

        success: function(data){
          alert(data);
        }
      });
  });

 //if($('.lien_sous_nav').next()===0) alert (0);
});
