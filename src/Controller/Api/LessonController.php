<?php

namespace App\Controller\Api;

use App\Repository\LessonRepository;
use App\Repository\RoomRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api/lesson', name: 'api_lesson')]
class LessonController extends AbstractController
{
    #[Route('/', name: 'get_all_lessons', methods: ['GET'])]
    public function list(LessonRepository $repository,): JsonResponse
    {
        $lessons = $repository->list();

        return $this->json($lessons, Response::HTTP_OK);
    }

    #[Route('/date', name: 'get_date', methods: ['POST'])]
    public function date_week(LessonRepository $repository, Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $startDate = new \DateTime($data['startDate']);
        $endDate = new \DateTime($data['endDate']);

        $lessons = $repository->getByTimeInterval($startDate,$endDate);
        
        return $this->json($lessons, Response::HTTP_OK);
    }
}
