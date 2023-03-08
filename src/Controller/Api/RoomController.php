<?php

namespace App\Controller\Api;

use App\Repository\RoomRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api/room', name: 'api_room')]
class RoomController extends AbstractController
{
    #[Route('/', name: 'get_all_room', methods: ['GET'])]
    public function list(RoomRepository $repository): JsonResponse
    {
        $rooms = $repository->findAll();
        return $this->json($rooms, Response::HTTP_OK);
    }
}
