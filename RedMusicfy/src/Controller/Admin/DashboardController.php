<?php

namespace App\Controller\Admin;

use App\Entity\Music;
use App\Entity\Playlist;
use App\Entity\Song;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function checker(): Response
    {

        if ($this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY')) {
            return $this->render('security/login.html.twig', ['last_username' => 'admin']);
        }

        // Verifica si el usuario tiene el rol de administrador

        // return parent::index();

        // Option 1. You can make your dashboard redirect to some common page of your backend
        //
        $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        return $this->redirect($adminUrlGenerator->setController(AdminCrudController::class)->generateUrl());

        // Option 2. You can make your dashboard redirect to different pages depending on the user
        //
        // if ('jane' === $this->getUser()->getUsername()) {
        //     return $this->redirect('...');
        // }

        // Option 3. You can render some custom template to display a proper dashboard with widgets, etc.
        // (tip: it's easier if your template extends from @EasyAdmin/page/content.html.twig)
        //
        // return $this->render('some/path/my-dashboard.html.twig');
    }


    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('<img src="https://media4.giphy.com/media/v1.Y2lkPTc5MGI3NjExYW9hZnNieXlhOGd4OGkxOWJmaWd3dWV5YjNrMjE4amVvYm9ieGF2YiZlcD12MV9pbnRlcm5hbF9naWZfYnlfaWQmY3Q9Zw/oWUc2ckj4YyEz7RZGD/giphy.gif"> Red Musicfy <span class="text-small">S.A</span>');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToCrud('Users', 'fa fa-user', User::class);
        yield MenuItem::linkToCrud('Canciones', 'fa fa-music', Song::class);
        yield MenuItem::linkToCrud('Playlist', 'fa fa-list', Playlist::class);
    }
}
