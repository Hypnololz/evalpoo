$(function () {


    let onglet = $('.nav-link');
    console.log(onglet);
    onglet.each(function () {
        if ($(this).attr('href') == $(location).attr('href')) {
            $(this).addClass('active');
        } else { $(this).remove('active');}
    });


    //declaration de variable



    ////////////////////////////////////////////////////////////read

    //afficher la llist des ???

    function afficher(){
        $.ajax({
            type: "post",
            url: "controler/controler.php?action=afficherlocation",
            success: function (data) {

                let tab = ''
                data.forEach(data => {

                    tab+= '<tr data-id="'+data.id_association+'">';
                    tab+= '<td>'+data.id_association+'</td>';
                    tab+= '<td>'+data.marque+'</td>';
                    tab+= '<td>'+data.modele+'</td>';
                    tab+= '<td>'+data.nom+'</td>';
                    tab+= '<td>'+data.prenom+'</td>';
                    tab+= '<td><button type="button" class="btn btn-primary modalfun" data-id="'+data.id_association+'"><i class="fas fa-edit"></i></button>';
                    tab+= '<button type="button" class="btn btn-primary modaldelete" data-id="'+data.id_association+'"><i class="fas fa-trash"></i></button>';
                    tab+= '</td></tr>';
                    $('#tableau').html(tab);
                });
            },
            dataType: "json"
        });
    }


    //function pour afficher tout les element du formulaire dans la modal

    function afficherallmodal(conducteurid,vehiculeid){
        $.ajax({
            type: "post",
            url: "controler/controler.php?action=afficherall",
            success: function (data) {
                console.log(data);
                $('.abonnemodal').html('')
                $(".livremodal").html('')
                data['vehicule'].forEach(data=>{
                    if(data.id_vehicule === vehiculeid ){
                        $(".abonnemodal").append($('<option selected></option>').attr('value',data.id_vehicule).text(data.marque+' '+data.modele));
                    }else{
                        $(".abonnemodal").append($('<option></option>').attr('value',data.id_vehicule).text(data.marque+' '+data.modele));
                    }
                })
                data['conducteur'].forEach(data=>{
                    if(data.id_conducteur === conducteurid){
                        $(".livremodal").append($('<option selected></option>').attr('value',data.id_conducteur).text(data.nom+' '+data.prenom));
                    }else{
                        $(".livremodal").append($('<option></option>').attr('value',data.id_conducteur).text(data.nom+' '+data.prenom));
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
                data['conducteur'].forEach(data=>{
                    abonne += '<option value="'+data.id_conducteur+'">'+data.nom+' '+data.prenom+'</option>'
                })
                data['vehicule'].forEach(data=>{

                    livre += '<option value="'+data.id_vehicule+'">'+data.marque+' de '+data.modele+'</option>'
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
            url: "controler/controler.php?action=ajouterlocation",
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

    let updateline = '';
    $('#tableau').on('click',".modalfun",function (){
        let vehiculeid = $(this).data('id');
        updateline = $(this).closest('tr');
        $.ajax({
            type: "POST",
            url: "controler/controler.php?action=affichermodallocation",
            data: { id: vehiculeid},
            success: function (data) {
                $('#modalupdate').modal('show');
                console.log(data)
                $('#modalupdatetitle').html("modifier location")
                $('#id_association').attr('value',data['location'].id_association);
                afficherallmodal(data['location'].id_conducteur,data['location'].id_vehicule,);
            },
            dataType: "json",
        });
        updateline = '';

    });

    $("#save").on("click",function (e) {
        e.preventDefault();

        $.ajax({
            type: "POST",
            url: "controler/controler.php?action=updatelocation",
            data: $("#update").serialize(),
            success: function (data) {
                if (data['resultat'] === 'success') {
                    console.log(data);
                    let tab =''
                    tab+= '<tr data-id="'+data['location'].id_association+'">';
                    tab+= '<td>'+data['location'].id_association+'</td>';
                    tab+= '<td>'+data['location'].marque+'</td>';
                    tab+= '<td>'+data['location'].modele+'</td>';
                    tab+= '<td>'+data['location'].nom+'</td>';
                    tab+= '<td>'+data['location'].prenom+'</td>';
                    tab+= '<td><button type="button" class="btn btn-primary modalfun" data-id="'+data['location'].id_association+'"><i class="fas fa-edit"></i></button>';
                    tab+= '<button type="button" class="btn btn-primary modaldelete" data-id="'+data['location'].id_association+'"><i class="fas fa-trash"></i></button>';
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
let abonneid =''
    let deleteline = '';
    $('#tableau').on('click',".modaldelete",function (){
         abonneid = $(this).data('id');
        deleteline=$(this).closest('tr');
        $.ajax({
            type: "POST",
            url: "controler/controler.php?action=affichermodaldeletelocation",
            data: { id: abonneid},
            success: function (data) {
                let tab = '';
                $('#modaldeletetitle').html("supprimer l'emprunt")
                $('#confirmdelete').attr('data-id',data.id_association)
                tab +='<h1> etes vous sur de vouloir supprimer le vehicule '+data.marque+' '+data.modele+' </h1>'
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
            url: "controler/controler.php?action=deletelocation",
            data: {id: abonneid},
            success: function (data) {
                if (data['resultat'] === "success") {
                    afficher();
                    $('#modaldelete').modal('hide');
                } else {
                    alert('une erreur cest produite');
                }
            },
            dataType: "json",
        });

    });
    afficherall()
    afficher();
});