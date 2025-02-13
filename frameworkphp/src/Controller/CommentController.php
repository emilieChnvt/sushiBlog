<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Form\CommentType;
use Attributes\DefaultEntity;
use Core\Attributes\Route;
use Core\Controller\Controller;
use Core\Http\Response;

#[DefaultEntity(entityName: Comment::class)]
class CommentController extends Controller
{

    #[Route(uri: "/comment/new", routeName: "new", methods: ["POST"])]
    public function save(): Response
    {
        $commentForm = new CommentType();
        if($commentForm->isSubmitted())
        {
            $comment = new Comment();

            $comment->setContent($commentForm->getValue('content'));
            $comment->setSushiId($commentForm->getValue('sushiId'));



            $this->getRepository()->save($comment);
            return $this->redirectToRoute('show', ['id' => $comment->getSushiId()]);
        }
        return $this->redirectToRoute('sushis');
    }

}
