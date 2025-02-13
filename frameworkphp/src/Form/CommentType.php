<?php

namespace App\Form;

use Core\Form\FormParam;
use Core\Form\FormType;

class CommentType extends FormType
{
    public function __construct()
    {
         $this->build();
    }

    private function build()
    {
        $this->add(new FormParam("content", "string"));
    }
}