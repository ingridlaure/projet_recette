$(document).ready(function () {
    $('select').selectpicker();

    $('#submit_ajout_chef').click(function (e) { //e = formulaire
        e.preventDefault(); //empêcher l'attribut action de form
        let nom = $('#nom').val();
        let prenom = $('#prenom').val();
        let experience = $('#experience').val();
        let email = $('#email').val();
        let adresse = $('#adresse').val();
        let telephone = $('#telephone').val();
        let param = 'nom=' + nom + '&prenom=' + prenom + '&experience=' + experience + '&email=' + email + '&telephone=' + telephone + '&adresse=' + adresse;
        let retour = $.ajax({
            type: 'get',
            dataType: 'json',
            data: param,
            url: './src/php/ajax/ajaxAjoutChef.php',
            success: function (data) {//data = retour du # php
                console.log(data);
            }
        })
    })

    $("td[id]").click(function () {
        //trim : supprimer les blancs avant et après
        let valeur1 = $.trim($(this).text());
        let id = $(this).attr('id');
        let name = $(this).attr('name');
        console.log(valeur1 + " id = " + id + " name = " + name);
        $(this).blur(function () {
            let valeur2 = $.trim($(this).text());
            if (valeur1 !== valeur2) {
                let parametre = "id=" + id + "&name=" + name + "&valeur=" + valeur2;
                let retour = $.ajax({
                    type: 'get',
                    dataType: 'json',
                    data: parametre,
                    url: './src/php/ajax/ajaxUpdateChef.php',
                    success: function (data) {//data = retour du # php
                        console.log(data);
                    }
                })
            }
        })
    })

    $("i[id]").click(function(){
        $('#confirm').show();
    })
    $("#submit_delete_chef").click(function(){
        console.log("bien cliqué");
        $('#confirm').hidden;
        let ligne=$(this).closest('tr');
        let id = $(this).attr('id');
        ligne.fadeOut();
        let parametre="id="+id;
        let retour=$.ajax({
            type:'get',
            dataType: 'json',
            data : parametre,
            url :'./src/php/ajax/ajaxDeleteChef.php',
            success:function(data){
                console.log(data);
            }
        })
    })
})
