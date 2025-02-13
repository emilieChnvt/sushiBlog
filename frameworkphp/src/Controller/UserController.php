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
            $username = $registerForm->getValue('name');


            $existingUser = $this->getRepository()->findUserByName($username);

            if ($existingUser) {
                return $this->render('auth/register', [
                    'error' => 'Ce nom d\'utilisateur est déjà pris. Veuillez en choisir un autre.'
                ]);
            }


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

                ]);

                return $this->redirectToRoute('add');}

            return $this->redirectToRoute('sushis');
        }
        return $this->render('auth/login', []);
    }

    #[Route(uri: '/logout', routeName: 'logout', methods: ['POST'])]
    public function logout():Response
    {
        $user = $this->getUser();
        if($user){
            $user->logOut();
            return $this->redirectToRoute('sushis');
        }
        return $this->redirectToRoute('login');
    }
}