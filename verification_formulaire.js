$(document).ready(function() {
    /**
     @Traitement du formulaire de connexion
     @Algorithme:

     */
    $('#connecter').click(function(event) {
        event.preventDefault();
        var log = $('#login').val();
        var mdp = $('#mdp').val();

        var regex_log = new RegExp("^[a-zA-Z]+[0-9]*$");

        if (!regex_log.test(log)) {
            $('.err_log').empty().hide().append("l'information du champ login  ou mot de passe n'est pas valide.").fadeIn();
            $('#login').css('border-color', 'red');
        } else if (mdp.length < 8) {
            $('.err_mdp').empty().hide().append("l'information du champ login  ou mot de passe n'est pas valide.").fadeIn();
            $('#mdp').css('border-color', 'red');
        } else {
            $('.err_log, .err_mdp').empty().hide();
            $(this).css('border-color', '#CC8E69');
            $.post('connexion.php', { 'login': log, 'mdp': mdp }, function(data) {
                if (data == 0) {
                    $('.err_mdp').empty().hide().append("Vous êtes pas inscris.").fadeIn();
                } else {
                    $('#connexion').submit();
                }
            });
        }
    });

    $('.connexion>input, .inscription>input').on('focus', function() {
        var label = $(this).prev();
        label.fadeOut();
    });
    $('.connexion>input, .inscription>input').on('blur', function() {
        var label = $(this).prev();
        if ($(this).val() == '') label.fadeIn();
    });

    $('.envoi').on('click', function() {

        var nom = $(this).prev().attr('value');
        var log = $('.log').text();
        $.ajax({
            url: "t_panier.php",
            type: 'POST',
            data: { 'nom': nom, 'login': log },
            dataType: 'text',

            success: function(data) {
                window.setInterval(wait(), 3000);
            }
        });
    });

    function wait() {
        $('#main_panier form').css("display", "none");
        $('#main_panier').html('<p><img src="photos/ajax-loader.gif"/></p>');
        $('#main_panier').css({
            'width': '50%',
            'margin': '20% auto'
        });
        $('#main_panier p').css({
            'text-align': 'center'
        });
        window.location.reload('panier.php');
    }
    /**
     * @param leFooter
     * 
     */
});