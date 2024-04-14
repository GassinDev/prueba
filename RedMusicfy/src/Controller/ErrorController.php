<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ErrorController extends AbstractController
{
    #[Route('/{any}', name: 'app_not_found', requirements: ['any' => '.+'], priority: -1)]
    public function notFound(): Response
    {
        $content = $this->renderView('notFound.html.twig');
        return new Response($content, Response::HTTP_NOT_FOUND);
    }
}