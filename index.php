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
                            <input type="hidden" id="id_conducteur" name="id_conducteur" value="">
                            <label for="nom" class="mx-auto col-form-label text-primary">nom</label>
                        </div>
                        <div class="col-12 text-center">
                            <input type="text" name="nom" id="nom" required>
                        </div>
                        <div class="col-12 text-center">
                            <label for="prenom" class="mx-auto col-form-label text-primary">prenom</label>
                        </div>
                        <div class="col-12 text-center">
                            <input type="text" name="prenom" id="prenom" required>
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
            <th>ref conducteur</th>
            <th>nom</th>
            <th>prenom</th>
            <th>action</th>
        </tr>
        </thead>
        <tbody id="tableau">
        </tbody>
    </table>
    <div class="container p-5">
        <form class="needs-validation row text-center" method="post" id="add">
            <fieldset class="border p-2 form-group bg-light">
                <legend class="w-auto float-none text-center text-danger">Ajouter un conducteur</legend>
                <div class="col-12 text-center">
                    <label for="nom" class="mx-auto col-form-label text-primary">nom</label>
                </div>
                <div class="col-12 text-center">
                    <input type="text" name="nom" id="" required>
                </div>
                <div class="col-12 text-center">
                    <label for="prenom" class="mx-auto col-form-label text-primary">prenom</label>
                </div>
                <div class="col-12 text-center">
                    <input type="text" name="prenom" id="" >
                </div>
                <div class="col-12 pt-3">
                    <button type="submit" name="ajouté" class="btn btn-primary mb-3" value="ajout">clique moi</button>
                </div>

            </fieldset>
        </form>
    </div>
<?php
$js = 'conducteur';
include_once('inc/footer.php'); ?>