<?php

namespace App\Entity;

use App\Repository\SushiRepository;
use Attributes\TargetRepository;
use Core\Attributes\Table;

#[Table(name: 'sushis')]
#[TargetRepository(repoName: SushiRepository::class)]
class Sushi
{
    private int $id;

    private string $name;
    private string $ingredients;

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getIngredients(): string
    {
        return $this->ingredients;
    }

    public function setIngredients(string $ingredients): void
    {
        $this->ingredients = $ingredients;
    }
}