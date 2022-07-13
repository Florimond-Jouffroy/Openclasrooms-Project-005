<?php

namespace Entities;

abstract class Entity
{

    //Constructeur
    public function __construct(array $data = null)
    {
        if($data != null)
            $this->hydrate($data);
    }

    //Hydratation
    public function hydrate(array $data)
    {
        foreach($data as $key => $value)
        {

            // On récupère le nom du setter correspondant à l'attribut.
            $method = 'set'.ucfirst($key);

            // Si le setter correspondant existe.
            if(method_exists($this, $method))
            {
                // On appelle le setter.
                $this->$method($value);
            }
        }
    }

}