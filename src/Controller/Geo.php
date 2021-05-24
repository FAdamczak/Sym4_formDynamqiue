<?php

namespace App\Controller;

use App\Entity\Pays;
use App\Entity\Ville;
use App\Entity\Monument;

class Geo {
    private Pays $unPays;
    private Ville $uneVille;
    private Monument $unMonument;

    public function getPays() {
        return $this->unPays;
    }

    public function setPays(Pays $pays) {
        $this->unPays = $pays;
    }

    public function getVille() {
        if (isset($this->uneVille)) {
            return $this->uneVille;
        } else {
            return null;
        }
    }

    public function setVille(Ville $ville) {
        $this->uneVille = $ville;
    }

    public function getMonument() {
        return $this->unMonument;
    }

    public function setMonument($monument) {
        $this->unMonument = $monument;
    }
}