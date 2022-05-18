<?php

namespace CarpeDiem\Classes\Entities;

class ColoursCollection
{
    private array $colours =[];

    /**
     * @return array
     */
    public function getColours(): array
    {
        return $this->colours;
    }



    public function setColours(array $colours): void
    {
        $this->colours = $colours;
    }
}