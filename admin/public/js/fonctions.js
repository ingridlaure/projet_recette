$(document).ready(function () {

    $("#detail_titre").hide().fadeIn();
    $("#detail_image").hide().fadeIn("slow");
    $("#detail_ingredient").hide().fadeIn(3000);
    $('#detail_description').hide().fadeIn(6000);
    let param = 'categorie=tous';
    $('#filtre_categorie').change(function () {
        let categorie = $('#filtre_categorie').val();
        param = "categorie=" + categorie;
        console.log(param);
        console.log(param);
        $.ajax({
            url: './admin/src/php/ajax/ajaxListeRecette.php',
            method: 'post',
            dataType: 'html',
            data: param,
            beforeSend: function () {
                $('#show_data').html("<h3>Chargement...</h3>");
            },
            success: function (result) {
                $('#show_data').html(result)
            }
        });
    })
    console.log(param);
    $.ajax({
        url: './admin/src/php/ajax/ajaxListeRecette.php',
        method: 'post',
        dataType: 'html',
        data: param,
        success: function (result) {
            $('#show_data').html(result)
        }
    });


    $('#submit_ajout_chef').click(function (e) {
        e.preventDefault();
        let nom = $('#nom').val();
        let prenom = $('#prenom').val();
        let experience = $('#experience').val();
        let email = $('#email').val();
        let adresse = $('#adresse').val();
        let telephone = $('#telephone').val();
        let param = 'nom=' + nom + '&prenom=' + prenom + '&experience=' + experience + '&email=' + email + '&telephone=' + telephone + '&adresse=' + adresse;
        console.log(param);
        let retour = $.ajax({
            type: 'get',
            dataType: 'json',
            data: param,
            url: './src/php/ajax/ajaxAjoutChef.php',
            success: function (data) {//data = retour du # php
                console.log(data);
            }
        })
        alert("Chef enregistré avec success");
        window.location.href = "index.php?page=gestion_chefs.php";
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
    let id_sup;
    let ligne;

    $("i[id]").click(function () {
        console.log("bien cliqué");
        id_sup = $(this).attr('id');
        $('#confirm').show();
        ligne = $(this).closest('tr');
    })
    $("#submit_delete_chef").click(function () {
        console.log("bien cliqué");
        $('#confirm').hide();
        console.log()
        ligne.fadeOut("slow");
        let parametre = "id=" + id_sup;
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
        let html = "<tr id='row" + nombre + "'>";
        html += "<td>" + nombre + "</td>";
        html += "<td><input type='text' class='form-control ingredient_name' name='ingredientName[]'></td>";
        html += "<td><input type='number' class='form-control ingredient_quantity' name='ingredientQuantity[]'></td>";
        html += "<td><input type='text' class='form-control ingredient_unit' name='ingredientUnit[]'></td>";
        html += "<td><button type='button' class='btn remove_ingredient' id='" + nombre + "'><i class='fa fa-trash'></i></button></td>";
        html += "</tr>";
        $("#tbody_ingredient").append(html);
    });

    $(document).on('click', '.remove_ingredient', function () {
        console.log("bien cliqué");
        var row_id = $(this).attr('id');
        $('#row' + row_id + '').remove();
        nombre--;
        //ligne.fadeOut();
    })


    $('#submit_ajout_recette').click(function (event) {
        var error = '';
        var error2 = '';
        event.preventDefault();
        if ($('#nom_recette').val() === '') {
            error2 += '<p>Entrez le nom de la recette</p>';
        }
        if ($('#description').val() === '') {
            error2 += '<p>Saisir la description de la recette</p>';
        }
        if ($('#chef').val() === '') {
            error2 += '<p>selectionnez un chef</p>';
        }
        var count = 1;
        $('.ingredient_name').each(function () {
            if ($(this).val() === '') {
                error += "<p>Entre le nom d'ingredient à la ligne " + count + "</p>";
                return false;
            }
            count = count + 1;
        });
        var count2 = 1;
        $('.ingredient_quantity').each(function () {
            if ($(this).val() === '') {
                error += "<p>Entre la quantite à la ligne " + count2 + "</p>";
                return false;
            }
            count2 = count2 + 1;
        });
        var count3 = 1;
        $('.ingredient_unit').each(function () {
            if ($(this).val() === '') {
                error += "<p>selectionner l'unite la ligne " + count3 + "</p>";
                return false;
            }
            count3 = count3 + 1;
        });
        if (error === '' && error2 === '') {
            $("#error").html('');
            $("#error2").html('');
            let nom_recette = $('#nom_recette').val(); // a continuer ici
            let description = $('#description').val();
            let nbre_part = $('#nombre_part').val();
            let temps = $('#temps_cuisson').val();
            let chef = $('#chef').val();
            let niveau = $('#difficulte').val();
            let categorie = $('#categorie').val();

            let param = 'nom_recette=' + nom_recette + '&description=' + description + '&nbre_part=' + nbre_part + '&temps=' + temps + '&chef=' + parseInt(chef) + '&niveau=' + niveau + '&categorie=' + categorie;
            let param2 = 'p=2';

            var ingredient_name = [];
            var ingredient_quantity = [];
            var ingredient_unit = [];
            $('.ingredient_name').each(function () {
                ingredient_name.push($(this).val());
            });
            $('.ingredient_quantity').each(function () {
                ingredient_quantity.push($(this).val());
            });
            $('.ingredient_unit').each(function () {
                ingredient_unit.push($(this).val());
            });
            for (let i = 0; i < nombre; i++) {
                param2 += '&nombre=' + nombre + '&ingredient' + i + '=' + ingredient_name[i] + '&quantity' + i + '=' + ingredient_quantity[i] + '&unit' + i + '=' + ingredient_unit[i];
            }
            console.log(param2);
            let retour = $.ajax({
                type: 'get',
                dataType: 'json',
                data: param,
                url: "./src/php/ajax/ajaxAjoutRecette.php",
                success: function (data) {
                    console.log("succes");
                    console.log(data);
                    $('#ingredient_table').find("tr:gt(0)").remove();
                    $('#form_ajout_recette').reset();
                    console.log("succes");
                },
            })
            let retour2 = $.ajax({
                type: 'get',
                dataType: 'json',
                data: param2,
                url: "./src/php/ajax/ajaxAjoutIngredient.php",
                success: function (data) {
                    console.log("succes ingredient");
                }
            })
            $("#succes").html('<div class="alert alert-success">recette enregistré avec succes</div>');
        } else {
            $("#error").html('<div class="alert alert-danger">' + error + '</div>');
            $("#error2").html('<div class="alert alert-danger">' + error2 + '</div>');
        }
        alert("Recette enregistré avec success");
        window.location.href = "index.php?page=gestion_recettes.php";
    })
    $('#form_noter').hide();
    $('#oui_noter').click(function () {
        $('#form_noter').show();
    })

    $('#submit_note').click(function (event) {
        event.preventDefault();
        let note = $('#note').val();
        let rec = $('#id_recette_detail').val();
        param = "recette=" + rec + "&note=" + note;
        let retour2 = $.ajax({
            type: 'get',
            dataType: 'json',
            data: param,
            url: "admin/src/php/ajax/ajaxNoterRecette.php",
            success: function (data) {
                console.log("succes Note");

            }
        })
        alert("note bien envoyé");
        window.location.href = "index.php?page=accueil.php";

    })

})




