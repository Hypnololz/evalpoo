<?php

include_once('inc/header.php');

?>

    <!-- Modal -->
    <div class="modal fade" id="modalupdate" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalupdatetitle"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="modalabonne">
                    <form class="needs-validation row text-center" method="post" id="update">
                        <div class="col-12 text-center">
                            <input type="hidden" id="id_association" name="id_association" value="">
                        </div>
                        <div class="col-12 text-center">
                            <label for="id_vehicule" class="mx-auto col-form-label text-primary">conducteur</label>
                        </div>
                        <select name="id_vehicule" class="conducteurmodal">
                            <option value="" >choisir un conducteur</option>
                            <!--                    insert des option ici-->
                        </select>
                        <div class="col-12 text-center">
                            <label for="id_conducteur" class="mx-auto col-form-label text-primary">vehicule</label>
                        </div>
                        <select name="id_conducteur" class="vehiculemodal">
                            <option value="" >choisir un vehicule</option>
                            <!--                    insert des option ici-->
                        </select>
                    </form>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="save">Save changes</button>
                </div>

            </div>
        </div>
    </div>
    <div class="modal fade" id="modaldelete" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modaldeletetitle"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="modalinsert">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="confirmdelete" data-id="">Save changes</button>
                </div>
            </div>
        </div>
    </div>
    <table class="table">
        <thead>
        <tr>
            <th>ref location</th>
            <th>marque</th>
            <th>modele</th>
            <th>nom</th>
            <th>prenom</th>
            <th>action</th>
        </tr>
        </thead>
        <tbody id="tableau">
<!--        insert du tableau ici-->
        </tbody>
    </table>
    <div class="container p-5">
        <form class="needs-validation row text-center" method="post" id="add" >
            <fieldset class="border p-2 form-group bg-light">
                <legend class="w-auto float-none text-center text-danger">Ajouter une location</legend>
                <div class="col-12 text-center">
                    <label for="id_conducteur" class="mx-auto col-form-label text-primary">conducteur</label>
                </div>
                <select name="id_conducteur" class="conducteur">
                    <option value="" >choisir un conducteur</option>
<!--                    insert des option ici-->
                </select>
                <div class="col-12 text-center">
                    <label for="id_vehicule" class="mx-auto col-form-label text-primary">vehicule</label>
                </div>
                <select name="id_vehicule" class="vehicule">
                    <option value="" >choisir un vehicule</option>
                    <!--                    insert des option ici-->
                </select>
                <div class="col-12 pt-3">
                    <button type="submit" name="ajouté" class="btn btn-primary mb-3" value="ajout">clique moi</button>
                </div>

            </fieldset>
        </form>
    </div>
<?php

$js = 'location';
include_once('inc/footer.php'); ?>