<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Form\CommentType;
use Attributes\DefaultEntity;
use Core\Controller\Controller;
use Core\Http\Response;

#[DefaultEntity(entityName: Comment::class)]
class CommentController extends Controller
{
    public function save(): Response
    {
        $commentForm = new CommentType();
        if($commentForm->isSubmitted())
        {
            $comment = new Comment();
            $comment->setContent($commentForm->getValue('content'));
            $this->getRepository()->save($comment);
            return $this->redirectToRoute('show', ['id' => $comment->getSushiId()]);
        }
        return $this->redirectToRoute('sushis');
    }

}