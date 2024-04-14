<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/perfil')]
class PerfilController extends AbstractController
{
    #[Route('/delete/{id}/{username}', name: 'app_perfil_delete', methods: ['POST'])]
    public function delete(Request $request, EntityManagerInterface $entityManager, User $user, string $username): Response
    {
        $textoUser = $request->request->get('textoUser');
        $photo = $user->getFotoPerfil();

        if ($username === $textoUser) {

            $this->redirectToRoute('app_logout');

            $photoPath = "../public/uploads/images/" . $photo;
            if (file_exists($photoPath)) {
                unlink($photoPath);
            }

            $entityManager->remove($user);
            $entityManager->flush();
            

            return $this->redirectToRoute('loader');
        } else {
            return $this->redirectToRoute('perfil');
        }
    }

    #[Route('/edit/{id}', name: 'edit', methods: ['POST'])]
    public function edit(Request $request, User $user, EntityManagerInterface $entityManager, UserRepository $userRepository, string $id): Response
    {
        $user = $userRepository->find($id);

        // Obtener datos del formulario de la solicitud
        $username = $request->request->get('username');
        $email = $request->request->get('email');

        // Actualizar los datos del usuario
        $user->setUsername($username);
        $user->setEmail($email);

        // Persistir los cambios en la base de datos
        $entityManager->flush();

        // Redireccionar a una página de confirmación o a donde sea apropiado
        $this->addFlash('success', 'Perfil actualizado con éxito!');
        return $this->redirectToRoute('perfil');
    }

    #[Route('/changePhoto/{id}', name: 'changePhoto', methods: ['POST'])]
    public function changePhoto(Request $request, User $user, EntityManagerInterface $entityManager, UserRepository $userRepository, string $id): Response
    {
        $user = $userRepository->find($id);

        // Obtener datos del formulario de la solicitud
        $photo = $request->files->get('profile-picture');
        $oldPhoto = $user->getFotoPerfil();

        if ($photo instanceof UploadedFile) {
            // Generar un nombre único para la foto
            $newFilename = uniqid() . '.' . $photo->guessExtension();

            // Mover el archivo cargado al directorio de destino
            try {
                $oldPhotoPath = "../public/uploads/images/" . $oldPhoto; // Ruta completa al archivo antiguo
                if (file_exists($oldPhotoPath)) {
                    unlink($oldPhotoPath); // Eliminar el archivo antiguo
                }

                $photo->move(
                    $this->getParameter('images_directory'), // Directorio de destino configurado en services.yaml
                    $newFilename
                );
            } catch (FileException $e) {
                // Manejar el error si ocurre alguna excepción al mover el archivo
                // Por ejemplo, mostrar un mensaje de error o registrar el error
            }

            $user->setFotoPerfil($newFilename);

            $entityManager->flush();

            $this->addFlash('success', 'Perfil actualizado con éxito!');
            return $this->redirectToRoute('perfil');
        }
    }

    #[Route(path: '/logout', name: 'app_logout')]
    public function logout(): void
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }


    #[Route('/loader', name: 'loader')]
    public function otro(): Response
    {
        return $this->render('loader.html.twig');
    }

}
