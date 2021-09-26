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
                        <label for="marque" class="mx-auto col-form-label text-primary">marque</label>
                    </div>
                    <input type="hidden" id="id_vehicule" name="id_vehicule" value="">
                    <div class="col-12 text-center">
                        <input type="text" name="marque" id="marque" required>
                    </div>
                    <div class="col-12 text-center">
                        <label for="modele" class="mx-auto col-form-label text-primary">modele</label>
                    </div>
                    <div class="col-12 text-center">
                        <input type="text" name="modele" id="modele" required>
                    </div>
                    <div class="col-12 text-center">
                        <label for="couleur" class="mx-auto col-form-label text-primary">couleur</label>
                    </div>
                    <div class="col-12 text-center">
                        <input type="text" name="couleur" id="couleur" required>
                    </div>
                    <div class="col-12 text-center">
                        <label for="immatriculation" class="mx-auto col-form-label text-primary">immatriculation</label>
                    </div>
                    <div class="col-12 text-center">
                        <input type="text" name="immatriculation" id="immatriculation" >
                    </div>
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
            <th>ref voiture</th>
            <th>marque</th>
            <th>modele</th>
            <th>couleur</th>
            <th>immat</th>
            <th>action</th>
        </tr>
        </thead>
        <tbody id="tableau">
        </tbody>
    </table>
    <div class="container p-5">
        <form class="needs-validation row text-center" method="post" id="add">
            <fieldset class="border p-2 form-group bg-light">
                <legend class="w-auto float-none text-center text-danger">Ajouter un vehicule</legend>
                <div class="col-12 text-center">
                    <label for="marque" class="mx-auto col-form-label text-primary">marque</label>
                </div>
                <div class="col-12 text-center">
                    <input type="text" name="marque" id="" required>
                </div>
                <div class="col-12 text-center">
                    <label for="modele" class="mx-auto col-form-label text-primary">modele</label>
                </div>
                <div class="col-12 text-center">
                    <input type="text" name="modele" id="" required>
                </div>
                <div class="col-12 text-center">
                    <label for="couleur" class="mx-auto col-form-label text-primary">couleur</label>
                </div>
                <div class="col-12 text-center">
                    <input type="text" name="couleur" id="" required>
                </div>
                <div class="col-12 text-center">
                    <label for="immatriculation" class="mx-auto col-form-label text-primary">immatriculation</label>
                </div>
                <div class="col-12 text-center">
                    <input type="text" name="immatriculation" id="" >
                </div>
                <div class="col-12 pt-3">
                    <button type="submit" name="ajouté" class="btn btn-primary mb-3" value="ajout">clique moi</button>
                </div>

            </fieldset>
        </form>
    </div>
<?php

$js = 'vehicule';
include_once('inc/footer.php'); ?>