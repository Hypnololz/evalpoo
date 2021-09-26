$(function () {
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



    /////////////////////////////////////////////////////////add

    $("#add").submit(function (e) {

        e.preventDefault();
        $.ajax({
            type: "POST",
            url: "controler/controler.php?action=ajouterconducteur",
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
            url: "controler/controler.php?action=affichermodalconducteur",
            data: { id: conducteurid},
            success: function (data) {
                $('#modalupdate').modal('show');
                console.log(data)
                $('#modalupdatetitle').html("modifier conducteur")
                $('#id_conducteur').attr('value',data.id_conducteur);
                $('#nom').attr('value',data.nom);
                $('#prenom').attr('value',data.prenom);
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
                tab +='<h1> etes vous sur de vouloir supprimer le conducteur '+data.nom+' '+data.prenom+' '+data.id_conducteur+' </h1>'
                $('#modalinsert').html(tab);
                $('#modaldelete').modal('show');

            },
            dataType: "json",
        });


    });
    $("#confirmdelete").on("click",function (e) {
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: "controler/controler.php?action=deleteconducteur",
            data: {id: abonneid},
            success: function (data) {
                if (data) {
                    deleteline.remove();
                    $('#modaldelete').modal('hide');
                } else {
                    alert('une erreur cest produite');
                }
            },
            dataType: "json",
        });

    });
    afficher();
});