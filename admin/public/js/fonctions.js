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

    $("i[id]").click(function () {
        console.log("bien cliqué");
        $('#confirm').show();
    })
    $("#submit_delete_chef").click(function () {
        console.log("bien cliqué");
        $('#confirm').hide();
        let ligne = $(this).closest('tr');
        let id = $(this).attr('id');
        ligne.fadeOut();
        let parametre = "id=" + id;
        let retour = $.ajax({
            type: 'get',
            dataType: 'json',
            data: parametre,
            url: './src/php/ajax/ajaxDeleteChef.php',
            success: function (data) {
                console.log(data);
            }
        })
    })

    let nombre = 0;
    $("#ajout_ingredient").click(function () {
        console.log('bine cliqué');
        nombre++;
        let html = "<tr id='row"+nombre+"'>";
        html += "<td>" + nombre + "</td>";
        html += "<td><input class='form-control ingredient_name' name='ingredientName[]'></td>";
        html += "<td><input class='form-control ingredient_quantity' name='ingredientQuantity[]'></td>";
        html += "<td><input class='form-control ingredient_unit' name='ingredientUnit[]'></td>";
        html += "<td><button type='button' class='btn remove_ingredient' id='"+nombre+"'><i class='fa fa-trash'></i></button></td>";
        html += "</tr>";
        //document.getElementById("tbody_ingredient").insertRow().innerHTML = html;
        $("#tbody_ingredient").append(html);
    });

    $(document).on('click','.remove_ingredient', function(){
        console.log("bien cliqué");
       var row_id=$(this).attr('id');
       $('#row'+row_id+'').remove();
        //ligne.fadeOut();
    })

    $('#form_ajout_recette').on('submit',function(event){
        event.preventDefault();
        var error='';
        var error2='';
        if($('#nom_recette').val()===''){
            error2+='<p>Entrez le nom de la recette</p>';
        }
        if($('#description').val()==='') {
            error2 += '<p>Saisir la description de la recette</p>';
        }
        if($('#chef').val()===''){
            error2+='<p>selectionnez un chef</p>';
        }
        var count=1;
        $('.ingredient_name').each(function(){
            if($(this).val()===''){
                error+="<p>Entre le nom d'ingredient à la ligne "+count+"</p>";
                return false;
            }
            count=count+1;
        });
        var count2=1;
        $('.ingredient_quantity').each(function(){
            if($(this).val()===''){
                error+="<p>Entre la quantite à la ligne "+count2+"</p>";
                return false;
            }
            count2=count2+1;
        });
        var count3=1;
        $('.ingredient_unit').each(function(){
            if($(this).val()===''){
                error+="<p>selectionner l'unite la ligne "+count3+"</p>";
                return false;
            }
            count3=count3+1;
        });
        var form_data=$(this).serialize();

        if(error===''&& error2===''){
            console.log(form_data);
            $("#error").html('');
            $("#error2").html('');
            $.ajax({
                url:"./src/php/ajax/ajaxAjoutRecette.php",
                method:"POST",
                data:form_data,
                success:function(data){
                    if(data==='ok'){
                        $('#ingredient_table').find("tr:gt(0)").remove();
                        $("#error2").html('<div class="alert alert-success">recette enregistré avec succes</div>');
                    }
                }
            })

        }else{
            $("#error").html('<div class="alert alert-danger">'+error+'</div>');
            $("#error2").html('<div class="alert alert-danger">'+error2+'</div>');
        }
    })

    /*$('#submit_ajout_recette').click(function (e) { //e = formulaire
        e.preventDefault(); //empêcher l'attribut action de form
        let nom = $('#nom_recette').val();
        let description = $('#description').val();
        let nombre_part = $('#nombre_part').val();
        let photo = $('#image_recette').val();
        let temps = $('#temps_cuisson').val();
        let idchef=$('#chef').val();
        let niveau=$('#difficulte').val();
        let categorie=$('#categorie').val();

        let param = 'nom=' + nom + '&description=' + description + '&nombre_part=' + nombre_part + '&photo=' + photo + '&temps=' + temps + '&idchef=' + idchef+ '&niveau=' + niveau+ '&categorie=' + categorie;

        let retour = $.ajax({
            type: 'get',
            dataType: 'json',
            data: param,
            url: './src/php/ajax/ajaxAjoutRecette.php',
            success: function (data) {//data = retour du # php
                console.log(data);
            }
        })
    })*/
})




