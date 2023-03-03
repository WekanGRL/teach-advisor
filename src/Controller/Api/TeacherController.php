<?php

namespace App\Controller\Api;

use App\Entity\Teacher;
use App\Entity\Review;
use App\Repository\TeacherRepository;
use App\Repository\ReviewRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

#[Route('/api/teacher', name: 'api_teacher_')]
class TeacherController extends AbstractController
{
    const PROF_NOT_FOUND = 'A teacher with the specified id does not exist';

    #[Route('', name:'list', methods: ['GET'])]
    public function list(TeacherRepository $repository): JsonResponse
    {
        $teachers = $repository->findAll();

        /*$arr = [];

        foreach($teachers as $teacher)
        {
            $arr[] = $teacher->__toArray();
        }

        $json = json_encode($arr);

        $json = json_encode(array_map(fn ($teacher) => $teacher->__toArray(), $teachers));

        $response = new Response();
        $response->setContent($json);
        $response->setStatusCode(Response::HTTP_OK);
        $response->headers->set('Content-Type', 'application/json');*/

        return $this->json($teachers, Response::HTTP_OK);
    }

    #[Route('/{id}', name:'findOne', methods: ['GET'])]
    public function findOne(?Teacher $teacher): JsonResponse
    {
        if ( is_null($teacher) )
        {
            return $this->json([
                'message' => TeacherController::PROF_NOT_FOUND
            ], Response::HTTP_NOT_FOUND);
        }
        return $this->json($teacher, Response::HTTP_OK);
    }

    #[Route('/{id}/reviews', name:'findOnesReview', methods:['GET'])]
    public function findOnesReview(?Teacher $teacher) : JsonResponse
    {
        if( is_null($teacher) )
        {
            return $this->json([
                'message' => TeacherController::PROF_NOT_FOUND
            ], Response::HTTP_NOT_FOUND);
        }

        return $this->json($teacher->getReviews()->toArray(), Response::HTTP_OK);
    }

    #[Route('/{id}/reviews', name:'addReviews', methods:['GET', 'POST'])]
    public function addReviews(Request $request, ?Teacher $teacher, ReviewRepository $rvRepository, ValidatorInterface $validator) : JsonResponse
    {
        if( is_null($teacher) )
        {
            return $this->json([
                'message' => TeacherController::PROF_NOT_FOUND
            ], Response::HTTP_NOT_FOUND);
        }

        $data = json_decode($request->getContent(), true);

        $review = (new Review())
                ->fromArray($data)
                ->setTeacher($teacher);

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
