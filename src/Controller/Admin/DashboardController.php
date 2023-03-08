<?php

namespace App\Controller\Admin;

use App\Entity\Teacher;
use App\Entity\Review;
use App\Entity\Subject;
use App\Entity\Lesson;
use App\Entity\Room;
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
        return $this->redirect($adminUrlGenerator->setController(TeacherCrudController::class)->generateUrl());
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
        yield MenuItem::linkToCrud('Teachers', 'fas fa-chalkboard-teacher', Teacher::class);
        yield MenuItem::linkToCrud('Reviews', 'fas fa-magnifying-glass', Review::class);
        yield MenuItem::linkToCrud('Subjects', 'fas fa-star', Subject::class);
        yield MenuItem::linkToCrud('Lessons', 'fas fa-book', Lesson::class);
        yield MenuItem::linkToCrud('Rooms', 'fas fa-door-open', Room::class);
    }
}