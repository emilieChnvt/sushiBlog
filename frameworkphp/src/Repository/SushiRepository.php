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
        $this->pdo->prepare("INSERT INTO $this->tableName (name, ingredients, user_id) VALUES (:name, :ingredients, :user_id)")->execute([
            "name"=> $sushi->getName(),
            "ingredients"=> $sushi->getIngredients(),
            "user_id"=> $sushi->getUserId(),
        ]);
        return $this->pdo->lastInsertId();

    }

    public function update(Sushi $sushi): int
    {
        $this->pdo->prepare("UPDATE $this->tableName SET name = :name, ingredients = :ingredients, user_id = :user_id WHERE id = :id")->execute([
            "name"=> $sushi->getName(),
            "ingredients"=> $sushi->getIngredients(),
            "user_id"=> $sushi->getUserId(),
            "id"=> $sushi->getId()
        ]);
        return $sushi->getId();
    }

}