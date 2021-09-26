<?php

class conducteurManager extends cobdd
{


    public function __construct()
    {

        $this->bdd = $this->connect();
    }

    public function getbyid($id)
    {
        $get = $this->bdd->query("SELECT * FROM vtc.conducteur
                                                    WHERE conducteur.id_conducteur = $id");
        $result = $get->fetch(PDO::FETCH_ASSOC);
        return ($result);
    }


    public function add(conducteur $conducteur)
    {

        $add = $this->bdd->prepare('INSERT INTO vtc.conducteur (prenom, nom )
                                                    VALUES(:val2, :val3)');

        $add->bindValue(':val2', $conducteur->getPrenom(), PDO::PARAM_STR);
        $add->bindValue(':val3', $conducteur->getNom(), PDO::PARAM_STR);
        $add->execute();
        $add->closeCursor();
        return ($add->rowCount());
    }


    public function update(conducteur $conducteur)
    {

        $update = $this->bdd->prepare('UPDATE vtc.conducteur
                                             SET conducteur.nom = :nom, conducteur.prenom = :prenom
                                             WHERE id_conducteur = :id ');
        $update->bindValue(':id', $conducteur->getId_conducteur(), PDO::PARAM_INT);
        $update->bindValue(':nom', $conducteur->getNom(), PDO::PARAM_STR);
        $update->bindValue(':prenom', $conducteur->getPrenom(), PDO::PARAM_STR);
        $update->execute();
        $update->closeCursor();
        return ($update->rowCount());
    }


    public function delete(conducteur $conducteur)
    {
        $delete = $this->bdd->prepare("DELETE FROM vtc.conducteur WHERE conducteur.id_conducteur = :id");
        $delete->bindValue(':id', $conducteur->getId_conducteur(), PDO::PARAM_INT);
        $delete->execute();
        $delete->closeCursor();
        return ($delete->rowCount());
    }

    public function getList()
    {
        $list = $this->bdd->query('SELECT * FROM vtc.conducteur');
        return $list->fetchAll(PDO::FETCH_ASSOC);
    }

}