<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\Pokemon;
use App\Repository\PokemonRepository;

use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Serializer\Normalizer\AbstractObjectNormalizer;

use Symfony\Component\HttpFoundation\JsonResponse;

class ApiController extends AbstractController
{

    private $repository;
    private $serializer;

    public function __construct(PokemonRepository $repository, SerializerInterface $serializer)
    {
        $this->repository = $repository;
        $this->serializer = $serializer;
    }

    #[Route('/api', name: 'app_api')]
    public function index(): Response
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/ApiController.php',
        ]);
    }
     /**
     * @Route("/pokemon/{name}", methods={"GET","HEAD"})
     */
    public function GetOnePokemonByName(string $name) {
        $pokemon = $this->repository->findOneByName($name);
        $jsonContent = $this->serializer->serialize($pokemon,'json', ['groups' => ['name','description']]);
        $response = new Response($jsonContent);
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }
     /**
     * @Route("/pokemons", methods={"GET","HEAD"})
     */
    public function GetPokemons() {
        $pokemons = $this->repository->findAll();
        $jsonContent = $this->serializer->serialize($pokemons,'json', ['groups' => ['name','description']]);
        $response = new Response($jsonContent);
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }
     /**
     * @Route("/pokemons/{count}", methods={"GET","HEAD"})
     */
    public function GetPokemonsCount(int $count) {
        $pokemons = $this->repository->findByCountWanted($count);
        $jsonContent = $this->serializer->serialize($pokemons,'json', ['groups' => ['name','description']]);
        $response = new Response($jsonContent);
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }



    //NE FONCTIONNE PAS//
     /**
     * @Route("/pokemons/{type}", methods={"GET","HEAD"})
     */
    /*public function GetPokemonsByType(string $type) {
        $pokemons = $this->repository->findByType($type);
        $jsonContent = $this->serializer->serialize($pokemons,'json', ['groups' => ['name','description']]);
        $response = new Response($jsonContent);
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }*/
    
}
