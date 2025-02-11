<?php

namespace App\Controller;

use App\Entity\Sushi;
use Attributes\DefaultEntity;
use Core\Controller\Controller;

#[DefaultEntity(entityName: Sushi::class)]
class SushiController extends Controller
{

}