<?php

namespace App\Controller;
use App\Entity\Professor;
use App\Form\ProfessorType;
use App\Repository\ProfessorRepository;

use Couchbase\GetAndTouchOptions;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/professor', name:'professor_')]
class ProfessorController extends AbstractController
{
    #[Route('', name: 'list', methods: ['GET'])]
    public function list(ProfessorRepository $repository) : Response
    {
        $professors = $repository->findAll();
        return $this->render('professor/list.html.twig', [
            'professors'=>$professors
        ]);
    }

    #[Route('/create', name: 'create', methods: ['GET', 'POST'])]
    public function create(Request $request, ProfessorRepository $repository) : Response
    {
        $professor = new Professor();

        $form = $this->createForm(ProfessorType::class, $professor);
                $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $professor = $form->getData();
            $repository->save($professor, true);
            return $this->redirectToRoute('professor_list');
        }

        return $this->render('professor/form.html.twig', [
            'form'=>$form->createView()
        ]);
    }

    #[Route('{id}/update/', name: 'update', methods: ['GET', 'POST'])]
    public function update(Request $request, ProfessorRepository $repository, Professor $professor) : Response
    {
        $form = $this->createForm(ProfessorType::class, $professor);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $professor = $form->getData();
            $repository->save($professor, true);
            return $this->redirectToRoute('professor_list');
        }

        return $this->render('professor/form.html.twig', [
            'form'=>$form->createView()
        ]);
    }

    #[Route('{id}/delete/', name: 'delete', methods: ['GET'])]
    public function delete(ProfessorRepository $repository, Professor $professor)
    {
        $repository->remove($professor, true);
        return $this->redirectToRoute('professor_list');
    }
}
