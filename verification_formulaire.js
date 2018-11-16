$(document).ready(function (){

  $('#ins_submit').on("click", function(){
    var nom = $('#nom').val();
    estvalide(nom);
  });

  function estvalide(champs){
    if(!champs.val().match(\^[a-z]$\i)){
      alert("non valide");
    }
  }
});
