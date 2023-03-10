<?php

namespace App\Controller;

use App\Repository\TeacherRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TeachAdvisorController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function redirection(): Response
    {
        if( $this->isGranted('ROLE_ADMIN') )
        {
            return $this->redirectToRoute('admin');
        }
        else if( $this->isGranted('ROLE_TEACHER') )
        {

            return $this->redirectToRoute('teacher_dashboard');
        }
        return $this->redirectToRoute('calendar');
    }

    #[Route('/schedule', name: 'calendar', methods: ['GET'])]
    public function index() : Response
    {
        return $this->redirect('./calendar_day.html');
    }

}
