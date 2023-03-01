<?php

namespace App\Controller\Api;

use App\Entity\Professor;
use App\Repository\ProfessorRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api/professor', name: 'api_professor_')]
class ProfessorController extends AbstractController
{
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
                'message' => 'A professor with the specified id does not exist'
            ], Response::HTTP_NOT_FOUND);
        }
        return $this->json($professor, Response::HTTP_OK);
    }

}
