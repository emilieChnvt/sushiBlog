<?php

namespace App\Repository;

use App\Entity\User;
use Attributes\TargetEntity;
use Core\Repository\Repository;
#[TargetEntity(entityName: User::class)]
class UserRepository extends Repository
{

}