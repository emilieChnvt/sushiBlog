<?php

namespace App\Repository;

use App\Entity\User;
use Attributes\TargetEntity;
use Core\Repository\Repository;
#[TargetEntity(entityName: User::class)]
class UserRepository extends Repository
{
    public function save(User $user): int
    {
        $this->pdo->prepare("INSERT INTO $this->tableName(name, password)VALUES ( :name, :password)")->execute([
            "name" => $user->getName(),
            "password" => $user->getPassword()
        ]);
        return $this->pdo->lastInsertId();
    }
}