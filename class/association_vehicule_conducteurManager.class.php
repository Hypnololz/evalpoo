<?php

class association_vehicule_conducteurManager extends cobdd
{


    public function __construct()
    {

        $this->bdd = $this->connect();
    }

    public function getbyid($id)
    {
        $get = $this->bdd->query("SELECT * FROM vtc.association_vehicule_conducteur
                                                    join vtc.conducteur c on c.id_conducteur = association_vehicule_conducteur.id_conducteur
                                                    join vtc.vehicule v on v.id_vehicule = association_vehicule_conducteur.id_vehicule
                                                    WHERE association_vehicule_conducteur.id_association = $id");
        $result = $get->fetch(PDO::FETCH_ASSOC);
        return ($result);
    }


    public function add(association_vehicule_conducteur $asso)
    {

        $add = $this->bdd->prepare('INSERT INTO vtc.association_vehicule_conducteur (id_vehicule, id_conducteur )
                                                    VALUES(:val2, :val3)');


        $add->bindValue(':val2', $asso->getId_vehicule(), PDO::PARAM_INT);
        $add->bindValue(':val3', $asso->getId_conducteur(), PDO::PARAM_INT);
        $add->execute();
        $add->closeCursor();
        return ($add->rowCount());
    }


    public function update(association_vehicule_conducteur $asso)
    {

        $update = $this->bdd->prepare('UPDATE vtc.association_vehicule_conducteur
                                             SET id_conducteur = :id_conducteur, id_vehicule = :id_vehicule
                                             WHERE association_vehicule_conducteur.id_association = :id ');
        $update->bindValue(':id', $asso->getId_association(), PDO::PARAM_INT);
        $update->bindValue(':id_conducteur', $asso->getId_conducteur(), PDO::PARAM_INT);
        $update->bindValue(':id_vehicule', $asso->getId_vehicule(), PDO::PARAM_INT);
        $update->execute();
        $update->closeCursor();
        return ($update->rowCount());
    }


    public function delete(association_vehicule_conducteur $asso)
    {
        $delete = $this->bdd->prepare("DELETE FROM vtc.association_vehicule_conducteur WHERE association_vehicule_conducteur.id_association = :id");
        $delete->bindValue(':id', $asso->getId_association(), PDO::PARAM_INT);
        $delete->execute();
        $delete->closeCursor();
        return ($delete->rowCount());
    }

    public function getList()
    {
        $list = $this->bdd->query('SELECT * FROM vtc.association_vehicule_conducteur
                                            join vtc.vehicule v on v.id_vehicule = association_vehicule_conducteur.id_vehicule
                                            join vtc.conducteur c on c.id_conducteur = association_vehicule_conducteur.id_conducteur');

        return $list->fetchAll(PDO::FETCH_ASSOC);
    }

}
