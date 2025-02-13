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
        return $this->render('auth/login', []);
    }
}