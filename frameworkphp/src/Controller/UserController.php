<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegisterType;
use Attributes\DefaultEntity;
use Core\Attributes\Route;
use Core\Controller\Controller;
use Core\Http\Response;

#[DefaultEntity(entityName: User::class)]
class UserController extends Controller
{
    #[Route(uri: '/register', routeName: 'register', methods: ['POST'])]
    public function register():Response
    {
        $registerForm = new RegisterType();
        if($registerForm->isSubmitted())
        {
            $user = new User();

            $user->setName($registerForm->getValue('name'));
            $user->setPassword($registerForm->getValue('password'));
            $id = $this->getRepository()->save($user);

            return $this->redirectToRoute('login');
        };
        return $this->render('auth/register', [

        ]);
    }

    #[Route(uri: '/login', routeName: 'login', methods: ['POST'])]
    public function login():Response
    {
        \Core\Session\Session::start();
        $registerForm = new RegisterType();
        if($registerForm->isSubmitted())
        {
            $user = $this->getRepository()->findUserByName($registerForm->getValue('name'));
            if(!$user){return $this->redirectToRoute('login');}

            $id = $user->getId();
            if(!$id){return $this->redirectToRoute('login');}

            $user = $this->getRepository()->find($id);
            if(!$user){return $this->redirectToRoute('login');}



            $success = $user->logIn($registerForm->getValue('password'));
            if($success){
                \Core\Session\Session::set("user", [
                    "id" => $user->getId(),
                    "name" => $user->getName(),
                    "authenticator" => $user->getAuthenticator() // Si tu as un champ pour l'authentificateur
                ]);

                return $this->redirectToRoute('add');}





            return $this->redirectToRoute('sushis');
        }
        return $this->render('auth/login', []);
    }
}