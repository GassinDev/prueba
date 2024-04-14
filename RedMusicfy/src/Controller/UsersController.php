<?php

namespace App\Controller;

use App\Repository\SongRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class UsersController extends AbstractController
{

    #[Route('/usuarios', name: 'usuarios')]
    public function usuariosGet(UserRepository $userRepository): Response
    {
        $usuarios = $userRepository->findAll();
        return $this->render('users/index.html.twig', [
            'usuarios' => $usuarios,
        ]);
    }

}
