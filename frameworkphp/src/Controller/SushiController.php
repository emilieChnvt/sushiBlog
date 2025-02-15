<?php

namespace App\Controller;

use App\Entity\Sushi;
use App\Form\SushiType;
use Attributes\DefaultEntity;
use Core\Attributes\Route;
use Core\Controller\Controller;
use Core\Http\Response;
use Core\Session\Session;

#[DefaultEntity(entityName: Sushi::class)]
class SushiController extends Controller
{
    #[Route(uri: "/", routeName: "sushis", methods: ["GET"])]
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
           return $this->redirectToRoute("sushis");
       }
       $sushi=$this->getRepository()->find($id);
       if(!$sushi)
       {
           return $this->redirectToRoute("sushis");
       }
       return $this->render('sushi/show', [
           "sushi" => $sushi,
       ]);
   }
   #[Route(uri: "/sushi/new", routeName: "add")]
    public function add():Response
   {
       if(Session::get("user")==null){ return $this->redirectToRoute("login");}
        $sushiForm = new SushiType();
        if($sushiForm->isSubmitted()){
            $sushi = new Sushi();
            $sushi->setName($sushiForm->getValue("name"));
            $sushi->setIngredients($sushiForm->getValue("ingredients"));
            $sushi->setUserId(Session::get("user")['id']);

            $id=$this->getRepository()->save($sushi);
            return $this->redirectToRoute("show",["id"=>$id]);
        }

       return $this->render('/sushi/new',[

       ]);
   }

   #[Route(uri: "/sushi/update", routeName: "update")]
   public function update():Response
   {

       $id=$this->getRequest()->get(["id"=>"number"]);
       if(!$id){return $this->redirectToRoute("show",["id"=>$id]);}
       $sushi = $this->getRepository()->find($id);
       if(!$sushi){return $this->redirectToRoute("show",["id"=>$id]);}

       if($sushi->getUserId() != Session::get("user")['id']){return $this->redirectToRoute("sushis");}

       $sushiForm = new SushiType();
       if($sushiForm->isSubmitted()){

           $sushi->setName($sushiForm->getValue("name"));
           $sushi->setIngredients($sushiForm->getValue("ingredients"));
           $sushi=$this->getRepository()->update($sushi);

           return $this->redirectToRoute("show",["id"=>$id]);
       }
       return $this->render('sushi/update',[
            "sushi"=>$sushi,
       ]);
   }

    #[Route(uri: "/sushi/delete", routeName: "delete")]
   public function delete():Response
   {
       if(!$_SESSION){return $this->redirectToRoute("login");}
       $id = $this->getRequest()->get(["id"=> "number"]);
       if(!$id){
           return $this->redirectToRoute("sushis");
       }
       $sushi=$this->getRepository()->find($id);
       if(!$sushi){
           return $this->redirectToRoute("sushis");
       }
       if($sushi->getUserId()!=Session::get("user")['id']){return $this->redirectToRoute("sushis");}
       $this->getRepository()->delete($sushi);
       return $this->redirectToRoute("sushis");
   }
}