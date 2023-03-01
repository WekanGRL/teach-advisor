<?php

namespace App\Controller\Api;

use App\Entity\Professor;
use App\Entity\Review;
use App\Repository\ProfessorRepository;
use App\Repository\ReviewRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

#[Route('/api/professor', name: 'api_professor_')]
class ProfessorController extends AbstractController
{
    const PROF_NOT_FOUND = 'A professor with the specified id does not exist';

    #[Route('', name:'list', methods: ['GET'])]
    public function list(ProfessorRepository $repository): JsonResponse
    {
        $professors = $repository->findAll();

        /*$arr = [];

        foreach($professors as $professor)
        {
            $arr[] = $professor->__toArray();
        }

        $json = json_encode($arr);

        $json = json_encode(array_map(fn ($professor) => $professor->__toArray(), $professors));

        $response = new Response();
        $response->setContent($json);
        $response->setStatusCode(Response::HTTP_OK);
        $response->headers->set('Content-Type', 'application/json');*/

        return $this->json($professors, Response::HTTP_OK);
    }

    #[Route('/{id}', name:'findOne', methods: ['GET'])]
    public function findOne(?Professor $professor): JsonResponse
    {
        if ( is_null($professor) )
        {
            return $this->json([
                'message' => ProfessorController::PROF_NOT_FOUND
            ], Response::HTTP_NOT_FOUND);
        }
        return $this->json($professor, Response::HTTP_OK);
    }

    #[Route('/{id}/reviews', name:'findOnesReview', methods:['GET'])]
    public function findOnesReview(?Professor $professor) : JsonResponse
    {
        if( is_null($professor) )
        {
            return $this->json([
                'message' => ProfessorController::PROF_NOT_FOUND
            ], Response::HTTP_NOT_FOUND);
        }

        return $this->json($professor->getReviews()->toArray(), Response::HTTP_OK);
    }

    #[Route('/{id}/reviews', name:'addReviews', methods:['GET', 'POST'])]
    public function addReviews(Request $request, ?Professor $professor, ReviewRepository $rvRepository, ValidatorInterface $validator) : JsonResponse
    {
        if( is_null($professor) )
        {
            return $this->json([
                'message' => ProfessorController::PROF_NOT_FOUND
            ], Response::HTTP_NOT_FOUND);
        }

        $data = json_decode($request->getContent(), true);

        $review = (new Review())
                ->fromArray($data)
                ->setProfessor($professor);

        $errors = $validator->validate($review);

        if($errors->count() > 0)
        {
            $messages = [];
            foreach ($errors as $error)
            {
                $messages[$error->getPropertyPath()] = $error->getMessage();
            }
            return $this->json($messages, Response::HTTP_BAD_REQUEST);
        }

        $rvRepository->save($review, true);


        return $this->json($review, Response::HTTP_CREATED);
    }

}
