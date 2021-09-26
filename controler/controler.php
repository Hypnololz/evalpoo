<?php
spl_autoload_register(function ($class) {
    require '../class/' . $class . '.class.php';
});


$action = $_GET['action'];
if ($action == 'afficherconducteur') {
    $managerconducteur = new conducteurManager();
    $list = $managerconducteur->getList();
    echo json_encode($list);
}
if ($action == 'ajouterconducteur') {
    if (isset($_POST['prenom']) && !empty($_POST['prenom']) && isset($_POST['nom']) && !empty($_POST['nom'])) {


        $conducteur = new conducteur($_POST);
        $manager = new conducteurManager();
        $manager->add($conducteur);

        echo "success";
    } else {
        echo 'error';
    }
}
if ($action == 'updateconducteur') {

    if (isset($_POST['prenom']) && !empty($_POST['prenom']) && isset($_POST['nom']) && !empty($_POST['nom'])) {


        $conducteur = new conducteur($_POST);
        $manager = new conducteurManager();
        $manager->update($conducteur);

        $tab['resultat'] = 'success';
        $tab['conducteur'] = $_POST;
        echo json_encode($tab);
    } else {
        echo 'error';
    }

}
if ($action == 'affichermodalconducteur') {

    $manager = new conducteurManager();
    $conducteur = $manager->getbyid($_POST['id']);
    echo json_encode($conducteur);

}
if ($action == 'affichermodaldeleteconducteur') {

    $manager = new conducteurManager();
    $conducteur = $manager->getbyid($_POST['id']);
    echo json_encode($conducteur);
}
if ($action == 'deleteconducteur') {

    $manager = new conducteurManager();
    $obj = $manager->getbyid($_POST['id']);
    $newobj = new conducteur($obj);
    $manager->delete($newobj);
    $result['resultat'] = 'success';

    echo json_encode($result);

}

/////////////////////////////vehicule////////////////////////////////////////////////////////


if ($action == 'affichervehicule') {
    $manager = new vehiculeManager();
    $list = $manager->getList();
    echo json_encode($list);
}
if ($action == 'ajoutervehicule') {
    if (isset($_POST['marque']) && !empty($_POST['marque']) && isset($_POST['modele']) && !empty($_POST['modele'])
        && isset($_POST['couleur']) && !empty($_POST['couleur'])&& isset($_POST['immatriculation']) && !empty($_POST['immatriculation'])) {


        $obj = new vehicule($_POST);
        $manager = new vehiculeManager();
        $manager->add($obj);

        echo "success";
    } else {
        echo 'error';
    }
}
if ($action == 'updatevehicule') {

    if (isset($_POST['marque']) && !empty($_POST['marque']) && isset($_POST['modele']) && !empty($_POST['modele'])
        && isset($_POST['couleur']) && !empty($_POST['couleur'])&& isset($_POST['immatriculation']) && !empty($_POST['immatriculation'])) {


        $vehicule = new vehicule($_POST);
        $manager = new vehiculeManager();
        $manager->update($vehicule);

        $tab['resultat'] = 'success';
        $tab['vehicule'] = $_POST;
        echo json_encode($tab);
    } else {
        echo 'error';
    }

}
if ($action == 'affichermodalvehicule') {

    $manager = new vehiculeManager();
    $obj = $manager->getbyid($_POST['id']);
    echo json_encode($obj);

}
if ($action == 'affichermodaldeletevehicule') {

    $manager = new vehiculeManager();
    $obj = $manager->getbyid($_POST['id']);
    echo json_encode($obj);
}
if ($action == 'deletevehicule') {

    $manager = new vehiculeManager();
    $obj = $manager->getbyid($_POST['id']);
    $newobj = new vehicule($obj);
    $manager->delete($newobj);
    $result['resultat'] = 'success';

    echo json_encode($result);

}

//////////////////////////////////////////////////////EMPRUNT////////////////////////////////////////////////////

if($action == 'afficherall'){
    $managervehicule = new vehiculeManager();
    $managerconducteur = new conducteurManager();
    $vehicule = $managervehicule->getList();
    $conducteur = $managerconducteur->getList();

    $tab['vehicule']= $vehicule;
    $tab['conducteur']=$conducteur;
    echo json_encode($tab);
}

if ($action == 'afficherlocation') {
    $manager = new association_vehicule_conducteurManager();
    $list = $manager->getList();
    echo json_encode($list);
}
if ($action == 'afficherlistvehicule') {

    $managervehicule = new vehiculeManager();
    $list = $managervehicule->getList();
    echo json_encode($list);

}
if ($action == 'afficherlistconducteur') {

    $managerconducteur = new conducteurManager();
    $list = $managerconducteur->getList();
    echo json_encode($list);
}
if ($action == 'ajouterlocation') {
    if ( isset($_POST['id_vehicule']) && !empty($_POST['id_vehicule'])
        && isset($_POST['id_conducteur']) && !empty($_POST['id_conducteur'])) {


        $location = new association_vehicule_conducteur($_POST);
        $manager = new association_vehicule_conducteurManager();
        $manager->add($location);

        echo "success";
    } else {
        echo "error";
    }
}
if ($action == 'updatelocation') {

    if (isset($_POST['id_association']) && !empty($_POST['id_association']) && isset($_POST['id_vehicule']) && !empty($_POST['id_vehicule'])
        && isset($_POST['id_conducteur']) && !empty($_POST['id_conducteur'])) {


        $location = new association_vehicule_conducteur($_POST);
        $manager = new association_vehicule_conducteurManager();
        $manager->update($location);
        $location = $manager->getbyid($_POST['id_association']);
        $tab['resultat']= 'success';
        $tab['location']= $location;
        echo json_encode($tab);


    } else {
        echo 'error';
    }

}
if ($action == 'affichermodallocation') {
    $manager = new association_vehicule_conducteurManager();
    $location = $manager->getbyid($_POST['id']);
    $tab['resultat']= 'success';
    $tab['location']= $location;
    echo json_encode($tab);

}
if ($action == 'affichermodaldeletelocation') {

    $manager = new association_vehicule_conducteurManager();
    $location = $manager->getbyid($_POST['id']);
    echo json_encode($location);
}
if ($action == 'deletelocation') {

    $manager = new association_vehicule_conducteurManager();
    $location = $manager->getbyid($_POST['id']);
    $newlocation = new association_vehicule_conducteur($location);
    $manager->delete($newlocation);
    $result['resultat'] = 'success';
    $result['location'] = $_POST;

    echo json_encode($result);

}