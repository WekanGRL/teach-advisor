<?php

namespace App\Controller;
use App\Entity\Teacher;
use App\Entity\User;
use App\Form\TeacherType;
use App\Repository\ReviewRepository;
use App\Repository\TeacherRepository;

use App\Repository\UserRepository;
use Couchbase\GetAndTouchOptions;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
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
    public function create(Request $request, TeacherRepository $repository, UserPasswordHasherInterface $userPasswordHasher, EntityManagerInterface $entityManager) : Response
    {
        $teacher = new Teacher();

        $form = $this->createForm(TeacherType::class, $teacher);
                $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $teacher = $form->getData();

            // Create a new user linked to the teacher
            $user = new User();
            $user->setEmail($teacher->getEmail());
            $user->setPassword(
                $userPasswordHasher->hashPassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );
            $user->setRoles(['ROLE_TEACHER']);
            $entityManager->persist($user);
            $entityManager->flush();

            $repository->save($teacher, true);
            return $this->redirectToRoute('teacher_list');
        }

        return $this->render('teacher/form.html.twig', [
            'form'=>$form->createView(),
            'create'=>true
        ]);
    }

    #[Route('/{id}/update', name: 'update', methods: ['GET', 'POST'])]
    public function update(Request $request, TeacherRepository $tr, Teacher $teacher) : Response
    {
        $form = $this->createForm(TeacherType::class, $teacher)->remove('plainPassword');
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $teacher = $form->getData();

            $tr->save($teacher, true);
            return $this->redirectToRoute('teacher_list');
        }

        return $this->render('teacher/form.html.twig', [
            'form'=>$form->createView(),
            'create'=>false
        ]);
    }

    #[Route('/{id}/delete', name: 'delete', methods: ['GET'])]
    public function delete(TeacherRepository $repository, Teacher $teacher) : Response
    {
        $repository->remove($teacher, true);
        return $this->redirectToRoute('teacher_list');
    }

    #[Route('/dashboard', name: 'dashboard', methods: ['GET'])]
    public function listReviews(ReviewRepository $reviewRepository, TeacherRepository $teacherRepository) : Response
    {
        $user = $this->getUser();

        $teacher = $teacherRepository->findOneBy(['email'=>$user->getEmail()]);

        $reviews = $reviewRepository->findBy(['teacher' => $teacher]);

        $totalNotes = 0;
        foreach ($reviews as $review)
        {
            $totalNotes += $review->getNote();
        }

        $averageNote = $totalNotes == 0 ? "NaN" : $totalNotes / count($reviews);
        return $this->render('teacher/dashboard.html.twig', [
            'teacher'=>$teacher,
            'reviews'=>$reviews,
            'averageNote'=>$averageNote
        ]);
    }


}
