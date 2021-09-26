<?php

class vehiculeManager extends cobdd
{
    public function __construct()
    {

        $this->bdd = $this->connect();
    }

    public function getbyid($id)
    {
        $get = $this->bdd->query("SELECT * FROM vtc.vehicule
                                                    WHERE vehicule.id_vehicule = $id");
        $result = $get->fetch(PDO::FETCH_ASSOC);
        return ($result);
    }


    public function add(vehicule $vehicule)
    {

        $add = $this->bdd->prepare('INSERT INTO vtc.vehicule (marque, modele, couleur, immatriculation)
                                                    VALUES(:val1, :val2, :val3, :val4)');

        $add->bindValue(':val1', $vehicule->getMarque(), PDO::PARAM_STR);
        $add->bindValue(':val2', $vehicule->getModele(), PDO::PARAM_STR);
        $add->bindValue(':val3', $vehicule->getCouleur(), PDO::PARAM_STR);
        $add->bindValue(':val4', $vehicule->getImmatriculation(), PDO::PARAM_STR);
        $add->execute();
        $add->closeCursor();
        return ($add->rowCount());
    }


    public function update(vehicule $vehicule)
    {

        $update = $this->bdd->prepare('UPDATE vtc.vehicule
                                             SET vehicule.couleur = :couleur, vehicule.marque = :marque, vehicule.modele = :modele, vehicule.immatriculation = :immatriculation
                                             WHERE id_vehicule = :id ');
        $update->bindValue(':id', $vehicule->getId_vehicule(), PDO::PARAM_INT);
        $update->bindValue(':couleur', $vehicule->getCouleur(), PDO::PARAM_STR);
        $update->bindValue(':marque', $vehicule->getMarque(), PDO::PARAM_STR);
        $update->bindValue(':modele', $vehicule->getModele(), PDO::PARAM_STR);
        $update->bindValue(':immatriculation', $vehicule->getImmatriculation(), PDO::PARAM_STR);
        $update->execute();
        $update->closeCursor();
        return ($update->rowCount());
    }


    public function delete(vehicule $vehicule)
    {
        $delete = $this->bdd->prepare("DELETE FROM vtc.vehicule WHERE vehicule.id_vehicule = :id");
        $delete->bindValue(':id', $vehicule->getId_vehicule(), PDO::PARAM_INT);
        $delete->execute();
        $delete->closeCursor();
        return ($delete->rowCount());
    }

    public function getList()
    {
        $list = $this->bdd->query('SELECT * FROM vtc.vehicule');
        return $list->fetchAll(PDO::FETCH_ASSOC);
    }
}