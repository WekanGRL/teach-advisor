<?php

namespace App\Controller\Admin;

use App\Entity\Professor;
use App\Entity\Review;
use App\Entity\Subject;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\UserMenu;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        return $this->redirect($adminUrlGenerator->setController(ProfessorCrudController::class)->generateUrl());
    }

    public function configureUserMenu(UserInterface $user): UserMenu
    {
        $userMenu = parent::configureUserMenu($user);
        $userMenu->setMenuItems([]);

        return $userMenu;
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Prof Advisor');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToCrud('Professors', 'fas fa-chalkboard-teacher', Professor::class);
        yield MenuItem::linkToCrud('Reviews', 'fas fa-book-open', Review::class);
        yield MenuItem::linkToCrud('Subjects', 'fas fa-star', Subject::class);
    }
}
