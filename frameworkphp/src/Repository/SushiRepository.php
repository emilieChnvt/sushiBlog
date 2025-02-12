<?php

namespace App\Repository;

use App\Entity\Sushi;
use Attributes\TargetEntity;
use Core\Repository\Repository;

#[TargetEntity(entityName: Sushi::class)]
class SushiRepository extends Repository
{
    public function save(Sushi $sushi): int
    {
        $this->pdo->prepare("INSERT INTO $this->tableName (name, ingredients) VALUES (:name, :ingredients)")->execute([
            "name"=> $sushi->getName(),
            "ingredients"=> $sushi->getIngredients()
        ]);
        return $this->pdo->lastInsertId();

    }

}