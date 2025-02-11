<?php

namespace App\Repository;

use App\Entity\Sushi;
use Attributes\TargetEntity;
use Core\Repository\Repository;

#[TargetEntity(entityName: Sushi::class)]
class SushiRepository extends Repository
{

}