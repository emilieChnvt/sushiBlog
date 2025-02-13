<?php

namespace App\Entity;

use App\Repository\CommentRepository;
use Attributes\TargetRepository;
use Core\Attributes\Table;

#[Table(name: 'comments')]
#[TargetRepository(repoName: CommentRepository::class)]
class Comment
{
    private int $id;
    private string $content;
    private int $sushi_id;

    public function getId(): int
    {
        return $this->id;
    }


    public function getSushiId(): string
    {
        return $this->sushi_id;
    }

    public function setSushiId(string $sushiId): void
    {
        $this->sushi_id = $sushiId;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function setContent(string $content): void
    {
        $this->content = $content;
    }

}