<?php

namespace App\Controller;

use App\Repository\SongRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class CancionesController extends AbstractController
{
    #[Route('/canciones', name: 'canciones')]
    public function cancionesGet(SongRepository $songRepository): Response
    {
        $canciones = $songRepository->findAll();
        return $this->render('canciones/index.html.twig', [
            'canciones' => $canciones,
        ]);
    }

}
