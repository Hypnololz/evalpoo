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
            url: "controler/controler.php?action=afficherconducteur",
            success: function (data) {

                let tab = ''
                data.forEach(data => {

                    tab+= '<tr data-id="'+data.id_conducteur+'">';
                    tab+= '<td>'+data.id_conducteur+'</td>';
                    tab+= '<td>'+data.nom+'</td>';
                    tab+= '<td>'+data.prenom+'</td>';
                    tab+= '<td><button type="button" class="btn btn-primary modalfun" data-id="'+data.id_conducteur+'"><i class="fas fa-edit"></i></button>';
                    tab+= '<button type="button" class="btn btn-primary modaldelete" data-id="'+data.id_conducteur+'"><i class="fas fa-trash"></i></button>';
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
            url: "/controler/controler.php?action=ajouterconducteur",
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
        let conducteurid = $(this).data('id');
        updateline = $(this).closest('tr');
        $.ajax({
            type: "POST",
            url: "/controler/controler.php?action=affichermodalconducteur",
            data: { id: conducteurid},
            success: function (data) {
                $('#modalupdate').modal('show');
                console.log(data)
                $('#modalupdatetitle').html("modifier conducteur")
                $('#id_conducteur').attr('value',data.id_conducteur);
                $('#nom').attr('value',data.nom);
                $('#prenom').attr('value',data.prenom);
                // afficherallmodal(data['emprunt'].abonneId,data['emprunt'].livreId,);
            },
            dataType: "json",
        });


    });

    $("#save").on("click",function (e) {
        e.preventDefault();

        $.ajax({
            type: "POST",
            url: "controler/controler.php?action=updateconducteur",
            data: $("#update").serialize(),
            success: function (data) {
                if (data['resultat'] === 'success') {
                    console.log(data);
                    let tab =''
                    tab+= '<tr data-id="'+data['conducteur'].id_conducteur+'">';
                    tab+= '<td>'+data['conducteur'].id_conducteur+'</td>';
                    tab+= '<td>'+data['conducteur'].nom+'</td>';
                    tab+= '<td>'+data['conducteur'].prenom+'</td>';
                    tab+= '<td><button type="button" class="btn btn-primary modalfun" data-id="'+data['conducteur'].id_conducteur+'"><i class="fas fa-edit"></i></button>';
                    tab+= '<button type="button" class="btn btn-primary modaldelete" data-id="'+data['conducteur'].id_conducteur+'"><i class="fas fa-trash"></i></button>';
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
        deleteline=$(this).closest('tr');
        $.ajax({
            type: "POST",
            url: "controler/controler.php?action=affichermodaldeleteconducteur",
            data: { id: abonneid},
            success: function (data) {
                let tab = '';
                $('#modaldeletetitle').html("supprimer l'emprunt")
                $('#confirmdelete').attr('data-id',data.id_conducteur)
                tab +='<h1> etes vous sur de vouloir supprimer le conducteur '+data.nom+' '+data.prenom+' </h1>'
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
            url: "http://localhost/backend/evalpoo/controler/controler.php?action=deleteconducteur",
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