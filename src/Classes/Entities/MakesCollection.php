<?php

namespace CarpeDiem\Classes\Entities;

class MakesCollection
{
    private array $makes =[];

    /**
     * @return array
     */
    public function getMakes(): array
    {
        return $this->makes;
    }



    public function setMakes(array $makes): void
    {
        $this->makes = $makes;
    }
}