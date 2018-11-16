$(document).ready(function () {

  //$('.modif_input').off('focus');

  $( "#select_modif").change(function() {
    var value = $(this).val();
    if(value!='mail'){
      $('.modif_input').attr('placeholder', value);
    }
    else {
      $('.modif_input').attr('type', 'email');
      $('.modif_input').attr('placeholder', value);
    }
  });

});
