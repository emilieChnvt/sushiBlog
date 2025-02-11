<?php

namespace App\Controller;

use App\Entity\Sushi;
use Attributes\DefaultEntity;
use Core\Attributes\Route;
use Core\Controller\Controller;
use Core\Http\Response;

#[DefaultEntity(entityName: Sushi::class)]
class SushiController extends Controller
{
    #[Route(uri: "/sushis", routeName: "sushis", methods: ["GET"])]
    public function index():Response
    {

        $sushis=$this->getRepository()->findAll();
        return $this->render('sushi/index', [
            "sushis" => $sushis,
        ]);
    }

    #[Route(uri: "/sushi/show", routeName: "show")]
   public function show():Response
   {
       $id = $this->getRequest()->get(["id"=>"number"]);
       if(!$id)
       {
           return $this->redirectToRoute("/sushis");
       }
       $sushi=$this->getRepository()->find($id);
       if(!$sushi)
       {
           return $this->redirectToRoute("/sushis");
       }
       return $this->render('sushi/show', [
           "sushi" => $sushi,
       ]);
   }
}