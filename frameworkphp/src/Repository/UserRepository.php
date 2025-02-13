<?php

namespace App\Repository;

use App\Entity\User;
use Attributes\TargetEntity;
use Core\Repository\Repository;
#[TargetEntity(entityName: User::class)]
class UserRepository extends Repository
{
    public function findUserByName(string $name): User | bool
    {
        $query = $this->pdo->prepare("SELECT * FROM `users` WHERE `name` = :name");
        $query->execute(['name' => $name]);
        $query->setFetchMode(\PDO::FETCH_CLASS, User::class);
        return $query->fetch();
    }
    public function save(User $user): int
    {
        $this->pdo->prepare("INSERT INTO $this->tableName(name, password)VALUES ( :name, :password)")->execute([
            "name" => $user->getName(),
            "password" => $user->getPassword()
        ]);
        return $this->pdo->lastInsertId();
    }
}