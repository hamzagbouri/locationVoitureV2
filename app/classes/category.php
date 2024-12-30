<?php

class Category {
    private $id;
    private $nom;

    public function __construct($id=null, $nom) {
        $this->id = $id;
        $this->nom = $nom;
    }

}
?>