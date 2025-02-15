<?php

namespace App\Entity;

use App\Repository\CommentRepository;
use App\Repository\SushiRepository;
use Attributes\TargetRepository;
use Core\Attributes\Table;

#[Table(name: 'sushi')]
#[TargetRepository(repoName: SushiRepository::class)]
class Sushi
{
    private int $id;

    private string $name;
    private string $ingredients;

    private string $user_id;

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

    public function getComments()
    {
        $commentRepository = new CommentRepository();
        return $commentRepository->getCommentsBySushi($this);
    }

    public function getUserId(): string
    {
        return $this->user_id;
    }

    public function setUserId(string $user_id): void
    {
        $this->user_id = $user_id;
    }
}