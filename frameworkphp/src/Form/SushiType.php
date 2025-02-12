<?php

namespace App\Form;

use Core\Form\FormParam;
use Core\Form\FormType;

class SushiType extends FormType
{
    public function __construct()
    {
        $this->build();
    }

    private function build(): void
    {

        $this->add(new FormParam("name", "string"));
        $this->add(new FormParam("ingredients", "string"));
    }

}