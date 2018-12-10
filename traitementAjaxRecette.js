$(document).ready(function() {

    /**
    @param traitementRecherche
        on recupère la donnée saisie, s'il clique sur recherche ou la touche 
        entre sur le clavier.
    */

    $('#button_recherche').on('click', function() {
        var mot = $('#recherche').val();
        $.post('traitementSearch.php', { 'recherche': mot }, function(data) {
            $('#suggestion').css({
                "display": "block",
                "width": "100%",
                "position": "absolute",
                "top": "100%",
                "background-color": "white"
            }).html(data);
        });
    });
    /** à partir de trois caratère on fait des suggestions */
    $('#recherche').on('keyup', function() {
        var mot = $('#recherche').val();
        if (mot.length > 3) {
            $.post('traitementSearch.php', { 'recherche': mot }, function(data) {
                $('#suggestion').css({
                    "display": "block",
                    "width": "100%",
                    "position": "absolute",
                    "top": "100%",
                    "background-color": "white"
                }).html(data);
            });
        }
    }).on('blur', function() {
        $('#suggestion').css({
            "display": "none"
        });
    }).on('focus', function() {
        var mot = $('recherche').val();
        if (mot == "") {
            $('#suggestion').css({
                "display": "none"
            });
        }
    });

    /**
     * traitement favorie
     */
    $('.buton_favorie').on('click', function() {
        var url = window.location.href;
        var resultat = url.split('&');
        var nom_recette = resultat[1].split('=');

        nom_recette = nom_recette[1].replace(/%[0-9]*/g, ' ');
        $.ajax({
            type: "POST",
            url: 'f_cookie.php',
            data: { 'recette': nom_recette },
            dataType: "text",

            success: function(data) {
                alert(data);
            }
        });
    });
});