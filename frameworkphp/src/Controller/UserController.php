<?php

namespace App\Controller;

use App\Entity\User;
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
        return $this->render('auth/register', [

        ]);
    }
}