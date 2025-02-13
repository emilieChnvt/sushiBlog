<?php

namespace App\Form;

use Core\Form\FormParam;
use Core\Form\FormType;

class RegisterType extends FormType
{
    public function __construct()
    {
        $this->build();
    }
    public function build()
    {
        $this->add(new FormParam("name", "string"));
        $this->add(new FormParam("password", "string"));
    }
}