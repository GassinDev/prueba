<?php

namespace App\Controller;

use App\Entity\Playlist;
use App\Form\PlaylistType;
use App\Repository\PlaylistRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/playlist')]
class PlaylistController extends AbstractController
{
    #[Route('/', name: 'app_playlist_index', methods: ['GET'])]
    public function index(PlaylistRepository $playlistRepository): Response
    {
        // Render the index page with all playlists
        return $this->render('playlist/index.html.twig', [
            'playlists' => $playlistRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_playlist_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        // Create a new playlist
        $playlist = new Playlist();
        
        // Assign the current user to the playlist
        $user = $this->getUser();
        $playlist->setUser($user);
        
        // Create and handle the form for playlist creation
        $form = $this->createForm(PlaylistType::class, $playlist);
        $form->handleRequest($request);
    
        if ($form->isSubmitted() && $form->isValid()) {
            // Persist the playlist to the database
            $entityManager->persist($playlist);
            $entityManager->flush();
    
            // Redirect to the playlist index page after successful creation
            return $this->redirectToRoute('app_playlist_index', [], Response::HTTP_SEE_OTHER);
        }
    
        // Render the new playlist form
        return $this->render('playlist/new.html.twig', [
            'playlist' => $playlist,
            'form' => $form
        ]);
    }

    #[Route('/{id}', name: 'app_playlist_show', methods: ['GET'])]
    public function show(Playlist $playlist): Response
    {
        // Render the page to show details of a specific playlist
        return $this->render('playlist/show.html.twig', [
            'playlist' => $playlist,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_playlist_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Playlist $playlist, EntityManagerInterface $entityManager): Response
    {
        // Create and handle the form for playlist editing
        $form = $this->createForm(PlaylistType::class, $playlist);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Update the playlist in the database
            $entityManager->flush();

            // Redirect to the playlist index page after successful editing
            return $this->redirectToRoute('app_playlist_index', [], Response::HTTP_SEE_OTHER);
        }

        // Render the playlist editing form
        return $this->render('playlist/edit.html.twig', [
            'playlist' => $playlist,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_playlist_delete', methods: ['POST'])]
    public function delete(Request $request, Playlist $playlist, EntityManagerInterface $entityManager): Response
    {
        // Check if the CSRF token is valid
        if ($this->isCsrfTokenValid('delete'.$playlist->getId(), $request->request->get('_token'))) {
            // Remove the playlist from the database
            $entityManager->remove($playlist);
            $entityManager->flush();
        }

        // Redirect to the playlist index page after deletion
        return $this->redirectToRoute('app_playlist_index', [], Response::HTTP_SEE_OTHER);
    }

}
