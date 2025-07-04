<?php

namespace App\Controller\Admin;

use App\Entity\Tag;
use App\Entity\Recipe;
use App\Entity\Category;
use App\Entity\Ingredient;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route; 
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        // return $this->render('admin/dashboard.html.twig');

        $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        return $this->redirect($adminUrlGenerator->setController(RecipeCrudController::class)->generateUrl());        

        // Option 1. You can make your dashboard redirect to some common page of your backend
        //
        // $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        // return $this->redirect($adminUrlGenerator->setController(OneOfYourCrudController::class)->generateUrl());

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

    #[Route('/admin/skip-pageview', name: 'admin_skip_pv')]
    #[IsGranted('ROLE_ADMIN')]
    public function skipPageview(): Response
    {
        $cookie = Cookie::create('skip_pv', '1')
            ->withPath('/')
            ->withExpires((new \DateTimeImmutable('+1 year'))->getTimestamp())
            ->withSameSite('lax')
        ;

        $response = new Response('Cookie „skip_pv“ gesetzt — PageViews werden nicht gezählt.');
        $response->headers->setCookie($cookie);

        return $response;
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Recines')
            ->setFaviconPath('images/favicon/favicon-admin.ico');
    }

    public function configureMenuItems(): iterable
    {
        // yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Rezepte', 'fa-solid fa-list-ol', Recipe::class);
        yield MenuItem::linkToCrud('Kategorien', 'fa-solid fa-table-cells-large', Category::class);
        yield MenuItem::linkToCrud('Zutaten', 'fa-regular fa-lemon', Ingredient::class);
        yield MenuItem::linkToCrud('Tags', 'fa-solid fa-tag', Tag::class);
        yield MenuItem::linkToUrl('Homepage', 'fas fa-home', $this->generateUrl('app_homepage'));
    }
}
