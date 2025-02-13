<?php

namespace App\Repository;

use App\Entity\Comment;
use App\Entity\Sushi;
use Attributes\TargetEntity;
use Core\Repository\Repository;

#[TargetEntity(entityName: Comment::class)]
class CommentRepository extends Repository
{
    public function getCommentsBySushi(Sushi $sushi): array
    {
        $query = $this->pdo->prepare("SELECT * FROM $this->tableName WHERE sushi_id = :sushi_id");
        $query->execute(['sushi_id' => $sushi->getId()]);
        return $query->fetchAll(\PDO::FETCH_CLASS, $this->targetEntity);

    }

    public function save(Comment $comment): Comment
    {
        $query = $this->pdo->prepare("INSERT INTO $this->tableName (content, sushi_id) VALUES (:content, :sushi_id)");
        $query->execute([
            'content' => $comment->getContent(),
            'sushi_id' => $comment->getSushiId()
        ]);
        return $this->find($this->pdo->lastInsertId());
    }
}