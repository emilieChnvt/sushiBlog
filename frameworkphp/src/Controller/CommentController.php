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


    #[Route(uri: "/comment/delete", routeName: "delete", methods: ["POST"])]
    public function delete(): Response
    {
        $id = $this->getRequest()->get(["id"=>"number"]);
        if(!$id){ return $this->redirectToRoute('sushis');}

        $comment = $this->getRepository()->find($id);
        if(!$comment){ return $this->redirectToRoute('sushis');}

        $this->getRepository()->delete($comment);
        return $this->redirectToRoute('show', ['id' => $comment->getSushiId()]);
    }

    #[Route(uri: "/comment/edit", routeName: "update", methods: ["POST"])]
    public function update(): Response
    {


        $id = $this->getRequest()->get(["id"=>"number"]);
        if(!$id){ return $this->redirectToRoute('sushis');}

        $comment = $this->getRepository()->find($id);
        if(!$comment){ return $this->redirectToRoute('sushis');}

        $commentForm = new CommentType();


        if($commentForm->isSubmitted())
        {

            $comment->setContent($commentForm->getValue('content'));
            $comment->setSushiId($commentForm->getValue('sushiId'));

            $this->getRepository()->update($comment);
            return $this->redirectToRoute('show', ['id' => $comment->getSushiId()]);
        }

        return $this->render('comment/update',[
            "comment" => $comment,
        ]);
    }
}
