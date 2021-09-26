<?php

class association_vehicule_conducteur
{
    private $id_association;
    private $id_vehicule;
    private $id_conducteur;

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

    /**
     * @return mixed
     */
    public function getId_association()
    {
        return $this->id_association;
    }

    /**
     * @param mixed $id_association
     */
    private function setId_association($id_association): void
    {
        $this->id_association = $id_association;
    }

    /**
     * @return mixed
     */
    public function getId_vehicule()
    {
        return $this->id_vehicule;
    }

    /**
     * @param mixed $id_vehicule
     */
    public function setId_vehicule($id_vehicule): void
    {
        $this->id_vehicule = $id_vehicule;
    }

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
    public function setId_conducteur($id_conducteur): void
    {
        $this->id_conducteur = $id_conducteur;
    }


}