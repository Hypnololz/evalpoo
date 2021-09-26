$(function () {


    let onglet = $('.nav-link');
    console.log(onglet);
    onglet.each(function () {
        if ($(this).attr('href') == $(location).attr('href')) {
            $(this).addClass('active');
        } else { $(this).remove('active');}
    });


    //declaration de variable
    let deleteline = '';
    let updateline = '';


    ////////////////////////////////////////////////////////////read

    //afficher la llist des ???

    function afficher(){
        $.ajax({
            type: "post",
            url: "controler/controler.php?action=affichervehicule",
            success: function (data) {

                let tab = ''
                data.forEach(data => {

                    tab+= '<tr data-id="'+data.id_vehicule+'">';
                    tab+= '<td>'+data.id_vehicule+'</td>';
                    tab+= '<td>'+data.marque+'</td>';
                    tab+= '<td>'+data.modele+'</td>';
                    tab+= '<td>'+data.couleur+'</td>';
                    tab+= '<td>'+data.immatriculation+'</td>';
                    tab+= '<td><button type="button" class="btn btn-primary modalfun" data-id="'+data.id_vehicule+'"><i class="fas fa-edit"></i></button>';
                    tab+= '<button type="button" class="btn btn-primary modaldelete" data-id="'+data.id_vehicule+'"><i class="fas fa-trash"></i></button>';
                    tab+= '</td></tr>';
                    $('#tableau').html(tab);
                });
            },
            dataType: "json"
        });
    }


    //function pour afficher tout les element du formulaire dans la modal

    function afficherallmodal(abonneid,livreid){
        $.ajax({
            type: "post",
            url: "controler/controler.php?action=afficherall",
            success: function (data) {
                console.log(data);
                $('.abonnemodal').html('')
                $(".livremodal").html('')
                data['abonne'].forEach(data=>{
                    if(data.idAbonne === abonneid ){
                        $(".abonnemodal").append($('<option selected></option>').attr('value',data.idAbonne).text(data.nom+' '+data.prenom));
                    }else{
                        $(".abonnemodal").append($('<option></option>').attr('value',data.idAbonne).text(data.nom+' '+data.prenom));
                    }
                })
                data['livre'].forEach(data=>{
                    if(data.idLivre === livreid){
                        $(".livremodal").append($('<option selected></option>').attr('value',data.idLivre).text(data.titre+' de '+data.auteur));
                    }else{
                        $(".livremodal").append($('<option></option>').attr('value',data.idLivre).text(data.titre+' '+data.auteur));
                    }
                });


            },
            dataType: "json"
        });
    }

    //function pour afficher tout les element du formulaire

    function afficherall(){
        $.ajax({
            type: "post",
            url: "controler/controler.php?action=afficherall",
            success: function (data) {
                console.log(data);
                let abonne = '';
                let livre = '';
                data['abonne'].forEach(data=>{
                    abonne += '<option value="'+data.idAbonne+'">'+data.nom+' '+data.prenom+'</option>'
                })
                data['livre'].forEach(data=>{

                    livre += '<option value="'+data.idLivre+'">'+data.titre+' de '+data.auteur+'</option>'
                })

                $(".livre").append(livre);
                $(".abonne").append(abonne);


            },
            dataType: "json"
        });
    }

    /////////////////////////////////////////////////////////add

    $("#add").submit(function (e) {

        e.preventDefault();
        $.ajax({
            type: "POST",
            url: "controler/controler.php?action=ajoutervehicule",
            data: $("#add").serialize(),
            success: function (data) {
                console.log(data);
                if (data === "success") {
                    afficher();
                } else {
                    alert('une erreur cest produite');
                }
            },
            dataType: "html",
        });

    });

    ///////////////////////////////////////////////////update


    $('#tableau').on('click',".modalfun",function (){
        let vehiculeid = $(this).data('id');
        updateline = $(this).closest('tr');
        $.ajax({
            type: "POST",
            url: "controler/controler.php?action=affichermodalvehicule",
            data: { id: vehiculeid},
            success: function (data) {
                $('#modalupdate').modal('show');
                console.log(data)
                $('#modalupdatetitle').html("modifier vehicule")
                $('#id_vehicule').attr('value',data.id_vehicule);
                $('#marque').attr('value',data.marque);
                $('#modele').attr('value',data.modele);
                $('#couleur').attr('value',data.couleur);
                $('#immatriculation').attr('value',data.immatriculation);
                // afficherallmodal(data['emprunt'].abonneId,data['emprunt'].livreId,);
            },
            dataType: "json",
        });


    });

    $("#save").on("click",function (e) {
        e.preventDefault();

        $.ajax({
            type: "POST",
            url: "controler/controler.php?action=updatevehicule",
            data: $("#update").serialize(),
            success: function (data) {
                if (data['resultat'] === 'success') {
                    console.log(data);
                    let tab =''
                    tab+= '<tr data-id="'+data['vehicule'].id_vehicule+'">';
                    tab+= '<td>'+data['vehicule'].id_vehicule+'</td>';
                    tab+= '<td>'+data['vehicule'].marque+'</td>';
                    tab+= '<td>'+data['vehicule'].modele+'</td>';
                    tab+= '<td>'+data['vehicule'].couleur+'</td>';
                    tab+= '<td>'+data['vehicule'].immatriculation+'</td>';
                    tab+= '<td><button type="button" class="btn btn-primary modalfun" data-id="'+data['vehicule'].id_vehicule+'"><i class="fas fa-edit"></i></button>';
                    tab+= '<button type="button" class="btn btn-primary modaldelete" data-id="'+data['vehicule'].id_vehicule+'"><i class="fas fa-trash"></i></button>';
                    tab+= '</td></tr>';

                    updateline.replaceWith(tab)

                    $('#modalupdate').modal('hide');
                } else {
                    alert('une erreur cest produite');
                }
            },
            dataType: "json",
        });

    });
//////////////////////////////////////////////delete
let abonneid = ''
    $('#tableau').on('click',".modaldelete",function (){
        abonneid = $(this).data('id');
        deleteline = $(this).closest('tr');
        $.ajax({
            type: "POST",
            url: "controler/controler.php?action=affichermodaldeletevehicule",
            data: { id: abonneid},
            success: function (data) {
                let tab = '';
                $('#modaldeletetitle').html("supprimer la location")
                $('#confirmdelete').attr('data-id',data.id_vehicule)
                tab +='<h1> etes vous sur de vouloir supprimer le vehicule '+data.marque+' '+data.nom+' </h1>'
                $('#modalinsert').html(tab);
                $('#modaldelete').modal('show');

            },
            dataType: "json",
        });


    });
    $("#modaldelete").on("click","#confirmdelete",function (e) {
        e.preventDefault();
        abonneid = $(this).data('id');
        $.ajax({
            type: "POST",
            url: "controler/controler.php?action=deletevehicule",
            data: {id: abonneid},
            success: function (data) {
                if (data['resultat'] === "success") {
                    deleteline.remove();
                    $('#modaldelete').modal('hide');
                } else {
                    alert('une erreur cest produite');
                }
            },
            dataType: "json",
        });

    });
    // afficherall()
    afficher();
});