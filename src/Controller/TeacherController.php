<?php

namespace App\Controller;
use App\Entity\Teacher;
use App\Form\TeacherType;
use App\Repository\ReviewRepository;
use App\Repository\TeacherRepository;

use Couchbase\GetAndTouchOptions;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/teacher', name:'teacher_')]
class TeacherController extends AbstractController
{
    #[Route('', name: 'list', methods: ['GET'])]
    public function list(TeacherRepository $repository) : Response
    {
        $teachers = $repository->findAll();
        return $this->render('teacher/list.html.twig', [
            'teachers'=>$teachers
        ]);
    }

    #[Route('/create', name: 'create', methods: ['GET', 'POST'])]
    public function create(Request $request, TeacherRepository $repository) : Response
    {
        $teacher = new Teacher();

        $form = $this->createForm(TeacherType::class, $teacher);
                $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $teacher = $form->getData();
            $repository->save($teacher, true);
            return $this->redirectToRoute('teacher_list');
        }

        return $this->render('teacher/form.html.twig', [
            'form'=>$form->createView()
        ]);
    }

    #[Route('/{id}/update', name: 'update', methods: ['GET', 'POST'])]
    public function update(Request $request, TeacherRepository $repository, Teacher $teacher) : Response
    {
        $form = $this->createForm(TeacherType::class, $teacher);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $teacher = $form->getData();
            $repository->save($teacher, true);
            return $this->redirectToRoute('teacher_list');
        }

        return $this->render('teacher/form.html.twig', [
            'form'=>$form->createView()
        ]);
    }

    #[Route('/{id}/delete', name: 'delete', methods: ['GET'])]
    public function delete(TeacherRepository $repository, Teacher $teacher) : Response
    {
        $repository->remove($teacher, true);
        return $this->redirectToRoute('teacher_list');
    }

    #[Route('/calendar/day', name: 'show_calendar', methods: ['GET'])]
    public function showCalendar() : Response
    {
        return $this->render('teacher/calendar.html.twig');
    }

    #[Route('/{id}/reviews', name: 'listReviews', methods: ['GET'])]
    public function listReviews(Teacher $teacher, ReviewRepository $repository) : Response
    {
        $reviews = $repository->findByTeacher($teacher);

        $totalNotes = 0;
        foreach ($reviews as $review)
        {
            $totalNotes += $review->getNote();
        }

        $noteAverage = $totalNotes / count($reviews);
        return $this->render('teacher/show.html.twig');
    }


}
