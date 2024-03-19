<?php

namespace App\Controller;

use App\Repository\WatchRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'index.home', methods: ['GET'])]
    public function index(WatchRepository $watchRepository): Response
    {
        $watches = $watchRepository->findByNumber();
        return $this->render('home/index.html.twig', ['watches' => $watches]);
    }
}
