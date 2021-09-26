<?php

class conducteur
{
   private $id_conducteur;
   private $prenom;
   private $nom;

    /**
     * @return mixed
     */
    public function getId_conducteur()
    {
        return $this->id_conducteur;
    }

    /**
     * @param mixed $id_conducteur
     */
    private function setId_conducteur($id_conducteur): void
    {
        $this->id_conducteur = $id_conducteur;
    }

    /**
     * @return mixed
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * @param mixed $prenom
     */
    public function setPrenom($prenom): void
    {
        $this->prenom = $prenom;
    }

    /**
     * @return mixed
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * @param mixed $nom
     */
    public function setNom($nom): void
    {
        $this->nom = $nom;
    }

    public function __construct($data = [])
    {
        if (!empty($data)) {
            $this->hydrate($data);
        }
    }
    public function hydrate(array $data)
    {
        foreach ($data as $key => $value) {
            // One gets the setter's name matching the attribute.
            $method = 'set' . ucfirst(strtolower($key));

            // If the matching setter exists
            if (method_exists($this, $method)) {
                // One calls the setter.
                $this->$method($value);
            }
        }
    }


}