<?php

namespace App\Controller\Api;

use App\Entity\Review;
use App\Repository\ReviewRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

#[Route('/api/review', name: 'api_review_')]
class ReviewController extends AbstractController
{
    const REVIEW_NOT_FOUND = 'A review with the specified id does not exist';

    #[Route('/{id}', name: 'delete', methods:['DELETE'])]
    public function delete(?Review $review, ReviewRepository $repository): JsonResponse
    {
        if( is_null($review) )
        {
            return $this->json([
                'message' => ReviewController::REVIEW_NOT_FOUND
            ], Response::HTTP_NOT_FOUND);
        }

        $review->getTeacher()->removeReview($review);

        $repository->remove($review, true);

        return $this->json(['message' => 'Object deleted'], Response::HTTP_NO_CONTENT);
    }

    #[Route('/{id}', name: 'edit', methods: ['PATCH'])]
    public function edit(?Review $review, ReviewRepository $repository, Request $request, ValidatorInterface $validator)
    {
        if( is_null($review) )
        {
            return $this->json([
                'message' => ReviewController::REVIEW_NOT_FOUND
            ], Response::HTTP_NOT_FOUND);
        }

        $data = json_decode($request->getContent(), true);

        $review->fromArray($data);

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

        $repository->save($review, true);

        return $this->json($review, Response::HTTP_CREATED);
    }
}
